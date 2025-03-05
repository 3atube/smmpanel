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
use App\Repositories\Language\LanguageRepositoryInterface;

class LanguageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $languageRepository;
    protected $ticketRepository;
    protected $userRepository;
    protected $ticketReplyRepository;
    public function __construct(LanguageRepositoryInterface $languageRepository, TicketRepositoryInterface $ticketRepository, UserRepositoryInterface $userRepository, TicketReplyRepositoryInterface $ticketReplyRepository)
    {
        $this->languageRepository = $languageRepository;
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
        $viewRender = view('admin-view.languages.add')->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'New',
        ]);
    }

    public function list(Request $request)
    {
        $items = $this->languageRepository->getLanguage();
        return view('admin-view.languages.list', compact('items'));
    }

    public function store(Request $request)
    {
        $validation_rules = array(
            'language_key' => 'required|max:255',
            'language_value' => 'required|max:255',
        );
        $messages = array(
            'language_key.required' => 'Key cannot be empty',
            'language_value.required' => 'Value cannot be empty',
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
        $this->languageRepository->create($request->all());
        return response()->json([
            'r' => route('admin.languages'),
            'm' => 'Language successful',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }

    public function editView($id)
    {
        $info = $this->languageRepository->find($id);
        $viewRender = view('admin-view.languages.edit', compact('info'))->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Edit (' . $info->id . ')',
        ]);
    }

    public function update($id, Request $request)
    {
        $info = $this->languageRepository->find($id);
        $info->update($request->all());
        return response()->json([
            'r' => route('admin.languages'),
            'm' => 'Update thành công',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }

    public function destroy($id)
    {
        $this->languageRepository->delete($id);
        return response()->json([
            'r' => route('admin.languages'),
            'm' => 'Xóa thành công',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }

}
