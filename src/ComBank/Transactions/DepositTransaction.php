<?php

namespace ComBank\Transactions;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 11:30 AM
 */

use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Transactions\Contracts\BankTransactionInterface;
use DepositTransactionTest;

class DepositTransaction  extends BaseTransaction implements BankTransactionInterface
{

    public function applyTransaction(BankAccountInterface $bankAccountInterface): float
    {
        return $bankAccountInterface->getBalance() + $this->amount;
    }

    public function getTransactionInfo(): string
    {
           return 'DEPOSIT_TRANSACTION';
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    
}
