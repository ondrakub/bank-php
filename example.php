<?php

require_once 'bank.class.php';


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