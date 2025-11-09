## About ComBank application
> Using this small program to explain about the OOP and PHPUnit.

> To run the program, please read the follow:
#### Requirements
* PHP 8.x

#### Features
1. Open account
2. Apply overdraft
3. Deposit funds
4. Withdraw funds
5. Display balance
6. Close account

#### Installation
```
git clone https://github.com/Stucom-Pelai/MP0613_RA3_POO_Bank.git
```

```
composer install
```

#### Run Unit Test
```
./vendor/bin/phpunit ./tests
```

#### Run Unit Test with report
```
./vendor/bin/phpunit --testdox-html testdox.html
```

#### Manual Test
```
php src/index.php
```

#### Class Diagram
```mermaid
classDiagram
    BankAccountInterface <|.. BankAccount :implements
    OverdraftInterface <|.. NoOverdraft :implements
    OverdraftInterface <|.. SilverOverdraft :implements
    BankTransactionInterface <|.. DepositTransaction :implements
    BankTransactionInterface <|.. WithdrawTransaction :implements
    <<interface>> BankAccountInterface    
    <<interface>> OverdraftInterface 
    BaseTransaction <|-- DepositTransaction :extends
    BaseTransaction <|-- WithdrawTransaction :extends
    BankAccount --> OverdraftInterface : use
    BankAccount --> BankTransactionInterface : use
    <<interface>> BankTransactionInterface    
    <<abstract>> BaseTransaction 
    BankAccount --> AmountValidationTrait : use
    BaseTransaction --> AmountValidationTrait : use
    

    class BankAccount{
	  -balance
	  -status
      -overdraft
      +transaction(BankTransactionInterface) void
      +isOpen() bool
      +reopenAccount() void
      +closeAccount() void
      +getBalance() float
      +getOverdraft() OverdraftInterface
      +applyOverdraft(OverdraftInterface) void
      +setBalance(float) void
    } 

    class BankAccountInterface{
      +transaction(BankTransactionInterface) void
      +isOpen() bool
      +reopenAccount() void
      +closeAccount() void
      +getBalance() float
      +getOverdraft() OverdraftInterface
      +applyOverdraft(OverdraftInterface) void
      +setBalance(float) void
    } 

    class OverdraftInterface{
      +isGrantOverdraftFunds(float) bool
      +getOverdraftFundsAmount() float     
    } 

    class SilverOverdraft{
      +isGrantOverdraftFunds(float) bool
      +getOverdraftFundsAmount() float     
    } 
    class NoOverdraft{
      +isGrantOverdraftFunds(float) bool
      +getOverdraftFundsAmount() float     
    } 

    class AmountValidationTrait{
      +validateAmount(float) void    
    } 

    class BaseTransaction{
      #amount    
    } 

    class BankTransactionInterface{
      +applyTransaction(BankAccountInterface) float    
      +getTransactionInfo() string    
      +getAmount() float    
    } 
    class DepositTransaction{
      +applyTransaction(BankAccountInterface) float    
      +getTransactionInfo() string    
      +getAmount() float    
    } 
    class WithdrawTransaction{
      +applyTransaction(BankAccountInterface) float    
      +getTransactionInfo() string    
      +getAmount() float    
    } 
```

#### Sequence Diagram
```mermaid
sequenceDiagram
    participant index
    participant BankAccount
    participant DepositTransaction

    activate index
    index->>BankAccount: new BankAccount(400€)
    activate BankAccount
    index->>BankAccount: getBalance()
    index->>BankAccount: closeAccount()
    index->>BankAccount: reopenAccount()
    index->>BankAccount: transaction(150€)
    deactivate index
    BankAccount-->>DepositTransaction: applyTransaction(account)
    deactivate BankAccount
    activate DepositTransaction
    DepositTransaction-->>DepositTransaction: calculateBalance
    
    DepositTransaction-->>BankAccount: return newBalance
    deactivate DepositTransaction

    activate BankAccount
    BankAccount-->>BankAccount: setBalance(550€)
    BankAccount-->>index: void
    deactivate BankAccount

    activate index
    deactivate index
```

