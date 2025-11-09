<?php
 
namespace ComBank\Bank;
 
/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/27/24
 * Time: 7:25 PM
 */
 
use ComBank\Exceptions\BankAccountException;
use ComBank\Exceptions\InvalidArgsException;
use ComBank\Exceptions\ZeroAmountException;
use ComBank\OverdraftStrategy\NoOverdraft;
use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\FailedTransactionException;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;
use ComBank\Support\Traits\AmountValidationTrait;
use ComBank\Transactions\Contracts\BankTransactionInterface;
 
class BankAccount implements BankAccountInterface
{
    use AmountValidationTrait;
    private $balance;
    private $status;
 
    private $overdraft;
 
    function __construct(float $newBalance)
    {
        $this->validateAmount($newBalance);
        $this->setBalance($newBalance);
        $this->status = BankAccountInterface::STATUS_OPEN;
        $this->overdraft = new NoOverdraft();
    }
    public function getBalance(): float
    {
        return $this->balance;
    }
    public function setBalance($balance): void
    {
        $this->balance = $balance;
    }
    public function isOpen(): bool
    {
        return $this->status === BankAccountInterface::STATUS_OPEN;
    }
    public function closeAccount(): void
    {
        $this->status = BankAccountInterface::STATUS_CLOSED;
    }
    public function reopenAccount(): void
    {
        if ($this->isOpen()) {
            throw new BankAccountException("My account is now reopened");
        }
        $this->status = BankAccountInterface::STATUS_OPEN;
    }
    public function transaction(BankTransactionInterface $bankTransactionInterface): void
    {
        if (!$this->isOpen()) {
            throw new BankAccountException("Account is closed");
        }
        try {
            $newBalance = $bankTransactionInterface->applyTransaction($this);
            $this->setBalance($newBalance);
        } catch (InvalidOverdraftFundsException $e) {
            throw new FailedTransactionException($e->getMessage());
        }
    }
    public function isGrantOverDraftFunds(float $amount): bool
    {
        $newBalance = $this->balance + $amount;
        $availableFunds = $newBalance + $this->overdraft->getOverdraftFundsAmount();
        return $availableFunds >= 0;
    }
 
    public function getOverDraftFundsAmount(): float
    {
        return $this->overdraft->getOverdraftFundsAmount();
    }
    public function applyOverdraft(OverdraftInterface $overdraft): void
    {
        $this->overdraft = $overdraft;
    }


}
