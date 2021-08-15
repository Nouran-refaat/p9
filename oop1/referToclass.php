<?php 

class Wallet {

    public $balance;
    const bonus = 50;
    public static $points = 100;

    public static function addBonusToBalance($balance)
    {
        return $balance + self::bonus;
    }

    public function getBalance()
    {
        return $this->balance;
    }

}

// echo wallet::$points;
// echo wallet::addBonusToBalance(500);
// echo Wallet::bonus; // :: double colon , scope resolution operator

// $userWallet = new Wallet;
// $userWallet->addBonusToBalance();
// $userWallet->balance = 500;
// print_r($userWallet);

// $userWallet = new wallet;
// $userWallet->balance = 500;

?>