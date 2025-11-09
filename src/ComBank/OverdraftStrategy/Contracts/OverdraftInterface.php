<?php namespace ComBank\OverdraftStrategy\Contracts;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/27/24
 * Time: 7:44 PM
 */

interface OverdraftInterface
{
public function isGrantOverdraftFunds(float $newAmount): bool;
      
   
public function getOverdraftFundsAmount():float;
    
    

    

}
