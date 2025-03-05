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
use App\Repositories\BankAccount\BankAccountRepositoryInterface;

class BankAccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $bankAccountRepository;
    public function __construct(BankAccountRepositoryInterface $bankAccountRepository){
        $this->bankAccountRepository = $bankAccountRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function bankAccounts(){
        $items = $this->bankAccountRepository->getBankAccount();
       return view('admin-view.bank-accounts.list', compact('items'));
    }

    public function addView(){
        $viewRender = view('admin-view.bank-accounts.add')->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Add new',
        ]);
    }

    public function store(Request $request){
        $validation_rules = array(
            'bank_content' => 'required',
        );
        $messages = array(
            'bank_content.required' => 'Content cannot be empty',
            'bank_alici.required' => 'Recipient name cannot be empty',
            'bank_sube.required' => 'Branch no cannot be empty',
            'bank_hesap.required' => 'Account number cannot be empty',
            'bank_iban.required' => 'IBAN cannot be empty',
        );
        $validator = Validator::make($request->all(), $validation_rules, $messages);
        if($validator->fails()) {
            return response()->json([
                'm' => $validator->messages(),
                's' => 'error',
                'r' => null,
                't' => "error",
                'time' => 1
            ]);
        }
        
        $this->bankAccountRepository->create($request->all());
        return response()->json([
                'r' => route('admin.bank-accounts'),
                'm' => 'Transaction successful',
                's' => 'success',
                't' => "error",
                'time' => 1
            ]);
    }

    public function editView($id){
        
        $info = $this->bankAccountRepository->find($id);
        $viewRender = view('admin-view.bank-accounts.edit', compact('info' ))->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Edit ('.$info->id.')',
        ]);
    }

    public function update($id, Request $request){
        $validation_rules = array(
            'bank_content' => 'required',
        );
        $messages = array(
            'bank_content.required' => 'Content cannot be empty',
            'bank_name.required' => 'The name of the Bank cannot be empty',
            'bank_alici.required' => 'Recipient name cannot be empty',
            'bank_sube.required' => 'Branch no cannot be empty',
            'bank_hesap.required' => 'Account number cannot be empty',
            'bank_iban.required' => 'IBAN cannot be empty',
        );
        $validator = Validator::make($request->all(), $validation_rules, $messages);
        if($validator->fails()) {
            return response()->json([
                'm' => $validator->messages(),
                's' => 'error',
                'r' => null,
                't' => "error",
                'time' => 1
            ]);
        }
        $info = $this->bankAccountRepository->find($id);
        
        $info->update($request->all());
        return response()->json([
                'r' => route('admin.bank-accounts'),
                'm' => 'Update thành công',
                's' => 'success',
                't' => "error",
                'time' => 1
            ]);
    }

    public function destroy($id){
        $this->bankAccountRepository->delete($id);
        return response()->json([
                'r' => route('admin.bank-accounts'),
                'm' => 'Xóa thành công',
                's' => 'success',
                't' => "error",
                'time' => 1
            ]);
    }
}
