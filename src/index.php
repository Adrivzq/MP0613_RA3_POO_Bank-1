<?php

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/27/24
 * Time: 7:24 PM
 */

use ComBank\Bank\BankAccount;
use ComBank\OverdraftStrategy\SilverOverdraft;
use ComBank\Transactions\DepositTransaction;
use ComBank\Transactions\WithdrawTransaction;
use ComBank\Exceptions\BankAccountException;
use ComBank\Exceptions\FailedTransactionException;
use ComBank\Exceptions\ZeroAmountException;
use ComBank\Transactions\Contracts\BankTransactionInterface;

require_once 'bootstrap.php';


//---[Bank account 1]---/
// create a new account1 with balance 400
pl('--------- [Start testing bank account #1, No overdraft] --------');
try {
    // show balance account
$bankAccount1 = new BankAccount( 400.00);
pl("My balance :" . $bankAccount1->getBalance()); //hecho

    // close account
pl("My account is now closed" .$bankAccount1->closeAccount());  //hecho 

    // reopen account
pl("Close and reopen the account." . $bankAccount1->reopenAccount()); //hecho

    // deposit +150 
    $depositTransaction = new DepositTransaction (150);                 //hecho
    $bankAccount1->transaction($depositTransaction);
    pl('Doing transaction deposit (+150) with current balance ' . $bankAccount1->getBalance());
    pl('My new balance after deposit (+150) : ' . $bankAccount1->getBalance()); 


    // withdrawal -25
    $withdrawTransaction = new WithdrawTransaction (amount: 25); //hecho
    $bankAccount1->transaction($withdrawTransaction);
    pl('Doing transaction withdrawal (-25) with current balance ' . $bankAccount1->getBalance());

    pl('My new balance after withdrawal (-25) : ' . $bankAccount1->getBalance());


    // withdrawal -600  //hecho
$withdrawTransaction1 = new WithdrawTransaction(amount: 600);
$bankAccount1->transaction($withdrawTransaction1);

    pl('Doing transaction withdrawal (-600) with current balance ' . $bankAccount1->getBalance());

} catch (ZeroAmountException $e) {
    pl($e->getMessage());
} catch (BankAccountException $e) {
    pl($e->getMessage());
} catch (FailedTransactionException $e) {
    pl('Error transaction: ' . $e->getMessage());
}
pl('My balance after failed last transaction : ' . $bankAccount1->getBalance()."/n")  ;






//---[Bank account 2]---/
pl('--------- [Start testing bank account #2, Silver overdraft (100.0 funds)] --------'. "/n");
try {
    
    // show balance account //hecho
    $bankAccount2 = new BankAccount(200);

    pl("my balance is : " . $bankAccount2->getBalance() ."/n");
   
    // deposit +100 //hecho
    $depositTransaction = new DepositTransaction(amount:100);
    $bankAccount2->transaction($depositTransaction);
    
    pl('Doing transaction deposit (+100) with current balance ' . $bankAccount2->getBalance()."/n");
    
    pl('My new balance after deposit (+100) : ' . $bankAccount2->getBalance(). "/n");

    // withdrawal -300
    $withdrawTransaction2 = new withdrawTransaction(amount:300);
    $bankAccount2->transaction(bankTransactionInterface:$withdrawTransaction2);
    pl('Doing transaction deposit (-300) with current balance ' . $bankAccount2->getBalance());
   
    pl('My new balance after withdrawal (-300) : ' . $bankAccount2->getBalance());

    // withdrawal -50
    pl('Doing transaction deposit (-50) with current balance ' . $bankAccount2->getBalance());
     $bankAccount2->transaction(new WithdrawTransaction(50.0));
    pl('My new balance after withdrawal (-50) with funds : ' . $bankAccount2->getBalance());
    $withdrawTransaction = new WithdrawTransaction(120.0);

    // withdrawal -120
    pl('Doing transaction withdrawal (-120) with current balance ' . $bankAccount2->getBalance());
    
} catch (FailedTransactionException $e) {
    pl('Error transaction: ' . $e->getMessage());
}
pl('My balance after failed last transaction : ' . $bankAccount2->getBalance());

try {
    pl('Doing transaction withdrawal (-20) with current balance : ' . $bankAccount2->getBalance());
    $bankAccount2->transaction(new WithdrawTransaction(20.0));
} catch (FailedTransactionException $e) {
    pl('Error transaction: ' . $e->getMessage());
}
pl('My new balance after withdrawal (-20) with funds : ' . $bankAccount2->getBalance());

try {
   
} catch (BankAccountException $e) {
    pl($e->getMessage());
}
