<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Libraries\Helpers;
use App\User;
use Auth;
use Redirect;
use Route;
use Illuminate\Http\Request;
use Log;
use DB;
use Input;
use Hash;
use Validator;
use Mail;
use Session;
use App\Model\Service;
use Cart;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface;
use App\Repositories\Ticket\TicketRepositoryInterface;
use App\Repositories\TicketReply\TicketReplyRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\ServiceReview\ServiceReviewRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;


class TicketController extends Controller
{
    protected $paymentMethodRepository;
    protected $ticketRepository;
    protected $userRepository;
    protected $ticketReplyRepository;
    protected $categoryRepository;
    protected $serviceRepository;
    protected $orderRepository;
    protected $titleTicket = [
        '1' => 'Cancel & Partial',
        '2' => 'Refill',
        '3' => 'Speed up',
        '4' => 'Other',
        '5' => 'Partial',
    ];

    protected $serviceReviewRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ServiceRepositoryInterface $serviceRepository,
        ServiceReviewRepositoryInterface $serviceReviewRepository,
        PaymentMethodRepositoryInterface $paymentMethodRepository,
        TicketRepositoryInterface $ticketRepository,
        UserRepositoryInterface $userRepository,
        TicketReplyRepositoryInterface $ticketReplyRepository,
        CategoryRepositoryInterface $categoryRepository

    ) {
        $this->orderRepository = $orderRepository;
        $this->categoryRepository = $categoryRepository;
        $this->serviceRepository = $serviceRepository;
        $this->serviceReviewRepository = $serviceReviewRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->ticketRepository = $ticketRepository;
        $this->userRepository = $userRepository;
        $this->ticketReplyRepository = $ticketReplyRepository;
    }

    public function tickets()
    {
        $user = Auth::user();
        $items = $this->ticketRepository->getTicketUsers($user->id);
        $max = $this->ticketRepository->maxTicket($user->id);
        $view = 'frontend.tickets';
        return view($view, compact('items', 'max'));
    }

    public function viewTicket($id)
    {
        $info = $this->ticketRepository->find($id);
        $info->update(['support_new' => 1]);
        $items = $this->ticketRepository->getMessageById($id);
        $view = 'frontend.viewticket';
        return view($view, compact('items', 'info'));
    }

    public function replyTicket(Request $request, $id)
    {
        $validation_rules = array(
            'message' => 'required|max:255',

        );
        $messages = array(
            'message.required' => 'Message cannot be empty',
        );
        $validator = Validator::make($request->all(), $validation_rules, $messages);
        if ($validator->fails()) {
            return redirect()->route('account.view-ticket', $id)
                ->withErrors($validator)
                ->withInput();
        }
        $info = $this->ticketRepository->find($id);

        if ($info->status == 'closed' || $info->canmessage == 1) {
            return redirect()->route('account.view-ticket', [$id])->with(['error' => 'Closed']);
        }
        $info->update(['client_new' => 2, 'status' => 'pending', 'updated_at' => date('Y-m-d H:i:s')]);
        $user = Auth::user();
        $params = [
            'support' => 1,
            'user_id' => $user->id,
            'ticket_id' => $id,
            'message' => $request->message,
            'support_team' => ''
        ];
        $this->ticketReplyRepository->create($params);
        return redirect()->route('account.view-ticket', [$id]);
    }

    public function addTicket($request)
    {
        $error = [
            "error" => "All fields cannot be blank",
            "language" => "All fields cannot be blank"
        ];
        try {
            $title = data_get($request, 'data.title', '');
            $requestData = trim(data_get($request, 'data.request', ''));
            $messageText = trim(data_get($request, 'data.message_text', ''));
            $orderId = data_get($request, 'data.order_id', 0);
            if (empty($messageText)) {
                return response()->json($error);
            }
            if (empty($orderId)) {
                return response()->json($error);
            }
            $title = $this->titleTicket[$requestData];
            $orderArr = explode(',', $orderId);
            $orderId = (@$orderArr[0]);
            $order = $this->orderRepository->findOrderByUser($orderId, Auth::user()->id);
            if (!$order) {
                return response()->json([
                    "error" => "Invalid Order ID",
                    "language" => "Invalid Order ID"
                ]);
            } else {
            }
            if($requestData == '2'){
                app('App\Http\Controllers\Frontend\TaskController')->newTask($orderId);
            }elseif($requestData == '1'){
                app('App\Http\Controllers\Frontend\TaskController')->newTask($orderId, 'partial');
            }
            $params = [
                'user_id' => Auth::user()->id,
                'subject' => $title,
                'status' => 'pending',
                'request' => $requestData,
                'order_id' => $orderId ? $orderId : 0,
                'support_new' => 1,
                'client_new' => 2,
                'canmessage' => 2
            ];
            if (!empty($orderId)) {
                $ticket = $this->ticketRepository->getTicketOrder($orderId);
                if ($ticket && $requestData != '2') {
                    return response()->json([
                        "error" => "Ticket already exists",
                        "language" => "Ticket already exists"
                    ]);
                }
            }
            $ticket = $this->ticketRepository->create($params);
            if ($ticket) {
                $params = [
                    'support' => 1,
                    'user_id' => $ticket->user_id,
                    'ticket_id' => $ticket->id,
                    'message' => $messageText,
                    'support_team' => ''
                ];
                $this->ticketReplyRepository->create($params);
            }
            $data = ['Thời gian' => date('H:i d/m/Y'), 'Order' => $orderId, 'Type' => $title, 'Message' => $messageText];
            Helpers::sendMessageTelegram($data);
            return response()->json([
                "success" => "Add successfully",
                "language" => "Add successfully"
            ]);
        } catch (\Exception $e) {
            Log::error('addTicket' . $e->getMessage());
            return response()->json([
                "error" => "Add error",
                "language" => "Add error"
            ]);
        }
    }

    public function ticketSend(Request $request)
    {
        $validation_rules = array(
            'subject' => 'required|max:255',
            'message' => 'required|max:255',

        );
        $messages = array(
            'subject.required' => 'Subject cannot be empty',
            'message.required' => 'Message cannot be empty',
        );

        $validator = Validator::make($request->all(), $validation_rules, $messages);
        if ($validator->fails()) {
            return redirect()->route('account.messages')
                ->withErrors($validator)
                ->withInput();
        }
        $user = Auth::user();

        // $max = $this->ticketRepository->maxTicket($user->id);
        // if ($max >= 3) {
        //     return redirect()->route('account.messages')->with(['error_max' => 'MAX PENDING TICKET PER USER LIMITED TO 3.']);
        // }
        $subject = $request->subject;
        $message = $request->message;
        $params = [
            'user_id' => $user->id,
            'subject' => $subject,
            'status' => 'pending',
            'support_new' => 1,
            'client_new' => 2,
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
        return redirect()->route('account.messages')->with(['success_tickers' => 'Add ticket successfully']);
    }
}
