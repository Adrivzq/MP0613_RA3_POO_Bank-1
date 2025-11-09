<?php

namespace ComBank\Bank\Contracts;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/27/24
 * Time: 7:26 PM
 */

use ComBank\Exceptions\BankAccountException;
use ComBank\Exceptions\FailedTransactionException;
use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;
use ComBank\Transactions\Contracts\BankTransactionInterface;
use PhpParser\Node\Scalar\Float_;

interface BankAccountInterface
{
    function getBalance(): float;
    function closeAccount(): void;
    function reopenAccount(): void;
   public function setBalance(float $balance): void;
    public function transaction(BankTransactionInterface $transaction);
    public function getOverDraftFundsAmount(): float;

    public function isGrantOverDraftFunds(float $amount): bool;
    public function applyOverdraft(OverdraftInterface $overdraft): void;





    const STATUS_OPEN = 'OPEN';
    const STATUS_CLOSED = 'CLOSED';
}
