<?php namespace ComBank\Transactions;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 1:24 PM
 */

use ComBank\Exceptions\FailedTransactionException;
use ComBank\Exceptions\InvalidArgsException;
use ComBank\Exceptions\ZeroAmountException;
use ComBank\Support\Traits\AmountValidationTrait;

abstract class BaseTransaction
{
    use AmountValidationTrait;
    protected float $amount;
    function __construct(float $amount)
    {
        if ($amount <= 0) {
            throw new ZeroAmountException("Transaction amount must be greater than zero");
        }
        $this->amount = $amount;
    }
}
    

