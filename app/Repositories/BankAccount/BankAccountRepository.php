<?php
namespace App\Repositories\BankAccount;

use App\Repositories\BaseRepository;

class BankAccountRepository extends BaseRepository implements BankAccountRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Model\BankAccount::class;
    }

    public function getBankAccount()
    {
        return $this->model->select('*')->orderBy('id','desc')->paginate(20);
    }

    public function getAllBankAccount()
    {
        return $this->model->select('*')->orderBy('line','asc')->get();
    }
}
