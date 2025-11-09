<?php
 
namespace ComBank\Support\Traits;
 
/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 2:35 PM
 */
 
use ComBank\Exceptions\InvalidArgsException;
use ComBank\Exceptions\ZeroAmountException;
use PharIo\Manifest\NoEmailAddressException;
 
trait AmountValidationTrait
{
       /**
        * @param float $amount
        * @throws InvalidArgsException
        * @throws ZeroAmountException
        */
       public function validateAmount(float $amount): void
       {
              if ($amount < 0) {
                     echo "Error transaction: Insufficient balance to complete the withdrawal";
              }
       }
}