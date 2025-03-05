<?php

namespace App\Http\Controllers\Admin\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Setting, App\Model\Admin, App\Model\Addtocard;
use Illuminate\Support\Facades\Hash;
use App\Libraries\Helpers;
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
use Storage;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $ticketRepository;
    protected $userRepository;
    protected $ticketReplyRepository;
    public function __construct(TicketRepositoryInterface $ticketRepository, UserRepositoryInterface $userRepository, TicketReplyRepositoryInterface $ticketReplyRepository)
    {
        $this->ticketRepository = $ticketRepository;
        $this->userRepository = $userRepository;
        $this->ticketReplyRepository = $ticketReplyRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function unread($id)
    {
        $info = $this->ticketRepository->find($id);
        $params = ['client_new' => 2, 'status' => 'pending'];
        $info->update($params);
        return redirect()->route('admin.tickets');
    }

    public function readNew($id)
    {
        $info = $this->ticketRepository->find($id);
        $params = ['client_new' => 1, 'status' => 'answered'];
        $info->update($params);
        return redirect()->route('admin.tickets');
    }

    public function lock($id)
    {
        $info = $this->ticketRepository->find($id);
        $params = ['canmessage' => 1, 'client_new' => 1];
        $info->update($params);
        return redirect()->route('admin.tickets');
    }

    public function unlock($id)
    {
        $info = $this->ticketRepository->find($id);
        $params = ['canmessage' => 2, 'client_new' => 2];
        $info->update($params);
        return redirect()->route('admin.tickets');
    }

    public function close($id)
    {
        $info = $this->ticketRepository->find($id);
        $params = ['status' => 'closed', 'client_new' => 1];
        $info->update($params);
        return redirect()->route('admin.tickets');
    }

    public function tickets(Request $request)
    {
        $items = $this->ticketRepository->getTicket($request->status, $request->search, $request->search_type);
        return view('admin-view.tickets.list', compact('items'));
    }

    public function read($id)
    {
        $info = $this->ticketRepository->find($id);
        $info->update(['client_new' => 1]);
        $items = $this->ticketRepository->getMessageById($id);
        return view('admin-view.tickets.read', compact('info', 'items'));
    }

    private function putFileImage($image)
    {
        if (!Storage::disk('public_home')->exists('/tickets')) {
            Storage::disk('public_home')->makeDirectory('tickets/');
        }
        $fileName = $image->getClientOriginalName();
        @$temp = explode(".", $fileName);
        @$temp = Str::slug(@$temp['0']) . '.' . @$temp['1'];
        Storage::disk('public_tickets')->putFileAs('', $image, $fileName);
        return $fileName;
    }

    public function postRead(Request $request, $id)
    {
        $info = $this->ticketRepository->find($id);

        $validation_rules = array(
            'message' => 'required',
        );
        if (!empty($request->file)) {
            $validation_rules['file'] =  'mimes:jpg,jpeg,png|max:2048';
        }

        $messages = array(
            'message.required' => 'Message cannot be empty',
            'file.required' => 'The :attribute field is required.',
            'file.mimes' => 'Only jpg, jpeg, png are allowed.',
            'file.max' => 'Please upload file under 2MB'
        );
        $validator = Validator::make($request->all(), $validation_rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        $image = null;
        if (!empty($request->file)) {
            $ticket = $this->putFileImage($request->file('file'));
            $image = '/tickets/' . $ticket;
        }
        $params = [
            'support' => 2,
            'user_id' => $info->user_id,
            'ticket_id' => $info->id,
            'message' => $request->message,
            'support_team' => '',
            'image' => $image
        ];
        $info->update(['status' => 'answered', 'support_new' => 2]);
        $this->ticketReplyRepository->create($params);
        return redirect()->route('admin.tickets-read', [$info->id]);
    }

    public function addView()
    {
        $viewRender = view('admin-view.tickets.add')->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'New support request',
        ]);
    }

    public function store(Request $request)
    {

        $username = $request->username;
        $validation_rules = array(
            'username' => 'required',
            'subject' => 'required',
            'message' => 'required',
        );
        $messages = array(
            'message.required' => 'Message cannot be empty',
            'subject.required' => 'Message cannot be empty',
            'username.required' => 'Message cannot be empty',
        );
        $validator = Validator::make($request->all(), $validation_rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'm' => $validator->messages(),
                's' => 'error',
                'r' => null,
                't' => "error",
                'time' => 1
            ]);
        }
        $check = $this->userRepository->getUserByName($username);
        if (!$check) {
            return response()->json([
                'm' => (object) ['username' => 'Không có username này'],
                's' => 'error',
                'r' => null,
                't' => "error",
                'time' => 1
            ]);
        } else {
            $user_id = $check->id;
        }
        $username = $request->username;
        $subject = $request->subject;
        $message = $request->message;
        $params = [
            'user_id' => $user_id,
            'subject' => $subject,
            'status' => 'pending',
            'canmessage' => 2
        ];
        $ticket = $this->ticketRepository->create($params);
        if ($ticket) {
            $params = [
                'support' => 1,
                'user_id' => $ticket->user_id,
                'ticket_id' => $ticket->id,
                'message' => $message,
                'support_team' => ''
            ];
            $this->ticketReplyRepository->create($params);
        }
        return response()->json([
            'r' => route('admin.tickets'),
            'm' => 'Transaction successful',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }

    public function editView($id)
    {
        $info = $this->ticketReplyRepository->find($id);
        $viewRender = view('admin-view.tickets.edit-reply', compact('info'))->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Edit (' . $info->id . ')',
        ]);
    }

    public function update($id, Request $request)
    {
        $info = $this->ticketReplyRepository->find($id);
        $infoTicket = $this->ticketRepository->find($info->ticket_id);

        $validation_rules = array(
            'message' => 'required',
        );
        if (!empty($request->file)) {
            $validation_rules['file'] =  'mimes:jpg,jpeg,png|max:2048';
        }

        $messages = array(
            'message.required' => 'Message cannot be empty',
            'file.required' => 'The :attribute field is required.',
            'file.mimes' => 'Only jpg, jpeg, png are allowed.',
            'file.max' => 'Please upload file under 2MB'
        );
        $validator = Validator::make($request->all(), $validation_rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'm' => $validator->messages(),
                's' => 'error',
                'r' => null,
                't' => "error",
                'time' => 1
            ]);
        }
        if (!empty($request->file)) {
            $ticket = $this->putFileImage($request->file('file'));
            $image = '/tickets/' . $ticket;
        }
        $params = [
            'support' => 2,
            'user_id' => $infoTicket->user_id,
            'ticket_id' => $infoTicket->id,
            'message' => $request->message,
            'support_team' => '',
        ];
        if (!empty($request->file)) {
            $params['image'] = $image;
        }
        $info->update($params);
        $infoTicket->update(['status' => 'answered', 'support_new' => 2]);
        return response()->json([
            'r' => route('admin.tickets-read', [$info->ticket_id]),
            'm' => 'Update thành công',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }

    public function destroy($id)
    {
        $this->ticketRepository->delete($id);
        return response()->json([
            'r' => route('admin.providers'),
            'm' => 'Xóa thành công',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }

    public function destroyReply($id)
    {
        $this->ticketReplyRepository->delete($id);
        return redirect()->back();
    }
}
