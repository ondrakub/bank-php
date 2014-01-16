Bank for PHP
================================

Bank for PHP is a very small and easy-to-use library for getting Czech code or name of bank

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


(c) Ondřej Kubíček, 2014 (http://www.kubon.cz)