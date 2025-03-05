<?php
namespace App\Repositories\BankAccount;

use App\Repositories\RepositoryInterface;

interface BankAccountRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getBankAccount();

    public function getAllBankAccount();
}
