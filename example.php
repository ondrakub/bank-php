<?php

use Ondrakub\Bank;

require_once __DIR__ . '/vendor/autoload.php';

try {

	echo Bank::getName(3030);

} catch (BankException $e) {
	echo 'Error: '. $e->getMessage();
}


try {

	$codes = Bank::getCodes('bank');

	foreach ($codes as $key => $value) {
		echo $key . ' - '. $value['name'] . '<br>';
	}

} catch (BankException $e) {
	echo 'Error: '. $e->getMessage();
}


//accept xx-xx/xxxx, xx/xxxx, 00-xx/xxxx
$bank = new Bank('1135595026/3030');

echo 'account number: ' . $bank->getAccount() . '<br>';
echo 'full account number: ' . $bank->getAccount(Bank::ZERO) . '<br>';
echo 'prefix: ' . $bank->getPrefix() . '<br>';
echo 'prefix with zero: ' . $bank->getPrefix(Bank::ZERO) . '<br>';
echo 'number: ' . $bank->getNumber() . '<br>';
echo 'number with zero: ' . $bank->getNumber(Bank::ZERO) . '<br>';
echo 'code: ' . $bank->getCode() . '<br>';
echo 'valid account: ' . $bank->isValid() . '<br>';
echo 'IBAN: ' . $bank->getIban() . '<br>';
echo 'formatted IBAN: ' . $bank->getIban(Bank::FORMATTED) . '<br>';
echo 'BIC code (SWIFT): ' . $bank->getBic();