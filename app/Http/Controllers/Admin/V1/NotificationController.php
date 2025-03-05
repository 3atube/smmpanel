<?php

namespace App\Http\Controllers\Admin\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Setting, App\Model\Admin, App\Model\Addtocard;
use Illuminate\Support\Facades\Hash;
use App\Libraries\Helpers;
use Illuminate\Support\Str;
use App\User;
use Auth, DB, File, Image, Redirect, Cache;
use App\Exports\CustomerExport;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;
use WebService;
use Carbon\Carbon;
use Validator;
use Response;
use App\Model\Provider;
use App\Repositories\Ticket\TicketRepositoryInterface;
use App\Repositories\TicketReply\TicketReplyRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Notification\NotificationRepositoryInterface;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $notificationRepository;
    protected $ticketRepository;
    protected $userRepository;
    protected $ticketReplyRepository;
    public function __construct(NotificationRepositoryInterface $notificationRepository, TicketRepositoryInterface $ticketRepository, UserRepositoryInterface $userRepository, TicketReplyRepositoryInterface $ticketReplyRepository)
    {
        $this->notificationRepository = $notificationRepository;
        $this->ticketRepository = $ticketRepository;
        $this->userRepository = $userRepository;
        $this->ticketReplyRepository = $ticketReplyRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function addView()
    {
        $info = null;
        return view('admin-view.notifications.single', compact('info'));
    }

    public function list(Request $request)
    {
        $items = $this->notificationRepository->getNotification();
        return view('admin-view.notifications.list', compact('items'));
    }

    public function store(Request $request)
    {
        $validation_rules = array(
            'title' => 'required|max:255',
            // 'content' => 'required',
        );
        $messages = array(
            'title.required' => 'Title cannot be empty',
            'content.required' => 'Content cannot be empty',
        );
        $validator = Validator::make($request->all(), $validation_rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $this->notificationRepository->create($request->all());
        return redirect()->route('admin.notifications')->with('success', 'Notifications successful');
    }

    public function editView($id)
    {
        $info = $this->notificationRepository->find($id);
        return view('admin-view.notifications.single', compact('info'));
    }

    public function update($id, Request $request)
    {
        $info = $this->notificationRepository->find($id);
        $validation_rules = array(
            'title' => 'required|max:255',
            // 'content' => 'required',
        );
        $messages = array(
            'title.required' => 'Title cannot be empty',
            'content.required' => 'Content cannot be empty',
        );
        $validator = Validator::make($request->all(), $validation_rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $info->update($request->all());
        return redirect()->route('admin.notifications')->with('success', 'Update successful');
    }

    public function destroy($id)
    {
        $this->notificationRepository->delete($id);
        return response()->json([
            'r' => route('admin.notifications'),
            'm' => 'Xóa thành công',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }

}
