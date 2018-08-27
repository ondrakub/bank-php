<?php

use Tester\Assert;
use Ondrakub\Bank;

require __DIR__ . '/../vendor/autoload.php';


date_default_timezone_set('Europe/Prague');

Tester\Environment::setup();



Assert::same('Air Bank a.s.', Bank::getName(3030));

Assert::exception(function() {
	 Bank::getName(1234);
}, "Ondrakub\BankException", "Bad code");

Assert::type('array', Bank::getCodes('bank'));

Assert::exception(function() {
	 Bank::getCodes('nobank');
}, "Ondrakub\BankException", "No match found");


foreach (Bank::getCodes() as $key => $value) {
	Assert::type('string', $value['name']);
}

Assert::exception(function() {
	new Ondrakub\Bank('0/01');
}, "Ondrakub\BankException", "Enter account number in right format");


$b = new Ondrakub\Bank('1135595026/3030');

Assert::same('1135595026/3030', $b->getAccount());
Assert::same('000000-1135595026/3030', $b->getAccount(Bank::ZERO));
Assert::same(0, $b->getPrefix());
Assert::same('000000', $b->getPrefix(Bank::ZERO));
Assert::same(1135595026, $b->getNumber());
Assert::same('1135595026', $b->getNumber(Bank::ZERO));
Assert::same('3030', $b->getCode());
Assert::true($b->isValid());
Assert::same('CZ0430300000001135595026', $b->getIban());
Assert::same('CZ04 3030 0000 0011 3559 5026', $b->getIban(Bank::FORMATTED));
Assert::same('AIRA CZ PP', $b->getBic());