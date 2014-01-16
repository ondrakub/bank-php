Bank for PHP
================================

Bank for PHP is a very small and easy-to-use library for getting Czech code or name of bank

Usage
-----
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

Files
-----
readme.md        - This file.
license.md       - The license for this software (New BSD License).
bank.class.php   - The core Bank class source.
example.php      - Example.


(c) Ondřej Kubíček, 2014 (http://www.kubon.cz)