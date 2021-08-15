<?php

class wallet {
    public $balance = 0;
    const bonus = 50;

    public function getBalance()
    {
        return $this->balance;
    }

    public function addBonusToBalance()
    {
       $this->balance += self::bonus;
    }

    public function deposite($value)
    {
        $this->balance += $value;
    }

    public function withdraw($value)
    {
        $this->balance -= $value;
    }
}


class WalletTransactions extends wallet {
    public function depositeTransaction($depositeValue)
    {
        $this->deposite($depositeValue);
        return $this->getBalance();
    }
    public function withdrawTransaction($withdrawValue)
    {
        $this->withdraw($withdrawValue);
        return $this->getBalance();
    }
}


$may = new WalletTransactions;
$may->addBonusToBalance();
echo " <br> before SuperMarket  <br>";
echo $may->getBalance();
echo " <br> After SuperMarket  <br>";
echo $may->withdrawTransaction(30);
echo " <br> After deposite  <br>";
echo $may->depositeTransaction(100);
echo " <br> after arrived  <br>";
echo $may->withdrawTransaction(50);
