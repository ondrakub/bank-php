Bank for PHP
================================

[![Total Downloads](https://poser.pugx.org/ondrakub/bank-php/downloads)](https://packagist.org/packages/ondrakub/bank-php)
[![Build Status](https://travis-ci.org/ondrakub/bank-php.svg?branch=master)](https://travis-ci.org/ondrakub/bank-php)
[![Latest Stable Version](https://poser.pugx.org/ondrakub/bank-php/v/stable)](https://packagist.org/packages/ondrakub/bank-php)
[![License](https://img.shields.io/badge/license-New%20BSD-blue.svg)](https://github.com/ondrakub/bank-php/blob/master/license.md)

Bank for PHP is a very small and easy-to-use library for works with bank account

Install
-------
via composer

```
php composer.phar require ondrakub/bank-php
```

Usage
-----
It is simple to use. Just call static methods ``Bank::getName($code)`` for getting name of bank and ``Bank::getCodes($name)`` for getting an array of codes of banks

```php
try {

	echo Bank::getName(3030);

} catch (BankException $e) {
	echo 'Error: '. $e->getMessage();
}


try {

	$codes = Bank::getCodes('bank');

	foreach ($codes as $key => $value) {
		echo $key . ' - '. $value . '<br>';
	}

} catch (BankException $e) {
	echo 'Error: '. $e->getMessage();
}
```

Or you can work with account number

```php
try {

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

} catch (BankException $e) {
	echo 'Error: '. $e->getMessage();
}

```