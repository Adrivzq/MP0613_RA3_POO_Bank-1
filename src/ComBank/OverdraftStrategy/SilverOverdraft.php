<?php namespace ComBank\OverdraftStrategy;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 1:39 PM
 */

/**
 * @description: Grant 100.00 overdraft funds.
 * */
class SilverOverdraft 
{
    public function isGrantOverDraftFunds(float $newAmount): bool
    {
        return ($this->getOverDraftFundsAmount() + $newAmount) >= 0;
    }
    public function getOverDraftFundsAmount(): float
    {
        return 100.00;
    } 
}
