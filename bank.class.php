<?php

/**
 * Bank for PHP - small and easy-to-use library for getting Czech code or name of bank 
 *
 * @author     Ondřej Kubíček
 * @copyright  Copyright (c) 2014 Ondřej Kubíček
 * @license    New BSD License
 * @link       http://www.kubon.cz
 * @version    1.0.1
 */
class Bank
{

	const ZERO = TRUE;

	private static $banks = array(
		  '0100' => 'Komerční banka',
		  '0300' => 'Československá obchodní banka | Poštovní spořitelna', //there are two banks with the same code
		  '0600' => 'GE Money Bank',
		  '0710' => 'Česká národní banka',
		  '0800' => 'Česká spořitelna',
		  '2010' => 'Fio banka',
		  '2020' => 'Bank of Tokyo-Mitsubishi',
		  '2100' => 'Hypoteční banka',
		  '2210' => 'Evropsko-ruská banka',
		  '2230' => 'AXA Bank',
		  '2240' => 'Poštová banka, a.s.',
		  '2310' => 'Zuno',
		  '2600' => 'Citibank',
		  '2700' => 'UniCredit Bank',
		  '3030' => 'Air Bank',
		  '3500' => 'ING Bank N.V.',
		  '4000' => 'LBBW Bank CZ',
		  '4300' => 'Českomoravská záruční a rozvojová banka',
		  '5000' => 'Crédit Agricole',
		  '5400' => 'Royal Bank of Scotland',
		  '5500' => 'Raiffeisenbank',
		  '5800' => 'J&T BANKA',
		  '6000' => 'PPF banka',
		  '6100' => 'Equa bank',
		  '6200' => 'COMMERZBANK Aktiengesellschaft',
		  '6210' => 'mBank',
		  '6300' => 'Fortis Bank SA/NV',
		  '6700' => 'Všeobecná úverová banka',
		  '6800' => 'Sberbank CZ',
		  '7910' => 'Deutsche Bank',
		  '7940' => 'Waldviertler Sparkasse von 1842 AG',
		  '7950' => 'Raiffeisen stavební spořitelna',
		  '7960' => 'Českomoravská stavební spořitelna',
		  '7970' => 'Wüstenrot - stavební spořitelna',
		  '7980' => 'Wüstenrot hypoteční banka',
		  '7990' => 'Modrá pyramida stavební spořitelna',
		  '8030' => 'Raiffeisenbank im Stiftland eG',
		  '8040' => 'Oberbank AG',
		  '8060' => 'Stavební spořitelna České spořitelny',
		  '8070' => 'HYPO stavební spořitelna',
		  '8090' => 'Česká exportní banka',
		  '8150' => 'HSBC Bank plc - pobočka Praha',
		  '8200' => 'PRIVAT BANK AG',
		  '8211' => 'Saxo Bank A/S',
		  '8221' => 'Volksbank Löbau-Zittau eG',
		  '8231' => 'Bank Gutmann Aktiengesellschaft'
	);

	private $account = NULL;

	private $prefix = NULL;

	private $number = NULL;

	private $code = NULL;

	private $valid = FALSE;

	public function __construct($account)
	{
		$this->parse($account);
		$this->valid();
	}


	public function getPrefix($zero = FALSE)
	{
		if ($zero === FALSE) {
			return $this->prefix;
		}

		return sprintf("%06d", $this->prefix);
	}

	public function getNumber($zero = FALSE)
	{
		if ($zero === FALSE) {
			return $this->number;
		}

		return sprintf("%010d", $this->number);
	}

	public function getCode()
	{
		return $this->code;
	}

	public function getAccount()
	{
		return $this->account;
	}

	public function getIban()
	{
		
	}

	public function getBic()
	{
		
	}

	public function isValid()
	{
		return $this->valid;
	}

	private function parse($account)
	{
		if (!preg_match('/(([\d]{0,6})[\-])?([\d]{2,10})\/([\d]{4})/', $account, $match)){
			throw new BankException('Enter account number');	
		}

		$this->prefix = (int) $match[2];
		$this->number = (int) $match[3];
		$this->code = (int) $match[4];

		$this->account = $account;
	}

	/*000000-1135595026/3030
		pro první část čísla účtu: 10, 5, 8, 4, 2, 1
		pro druhou část čísla účtu: 6, 3, 7, 9, 10, 5, 8, 4, 2, 1.
		sečíst násobky, pak vydělit 11 a zbytek musí byt roven 0
	*/
	private function valid()
	{
		$prefix_scales = array(10, 5, 8, 4, 2, 1);
		$number_scales = array(6, 3, 7, 9, 10, 5, 8, 4, 2, 1);

		if ($this->calculate($this->getPrefix(self::ZERO), $prefix_scales) && $this->calculate($this->getNumber(self::ZERO), $number_scales)){
			$this->valid = TRUE;
		}
	}

	private function calculate($number, $scales)
	{
		$sum = 0;
		foreach ($scales as $key => $value) {
			$sum += $number[$key]*$value;
		}
		
		return bcmod($sum, 11) === '0' ? TRUE : FALSE;
	}


	/**
	 * @param int code
	 * @return string
	 * @throws BankException
	 */
	public static function getName($code)
	{
		if (is_numeric($code) && array_key_exists($code, self::$banks)) {
			return self::$banks[$code];
		}
		throw new BankException('Bad code');
	}

	/**
	 * @param string 
	 * @return array
	 * @throws BankException
	 */
	public static function getCodes($name)
	{
		$ret = array_filter(self::$banks, function($var) use ($name) { return strpos(strtolower($var), strtolower($name)) !== false; });
		if (!empty($ret)) {
			return $ret;
		}
		throw new BankException('No match found');
	}



}

/**
 * An exception generated by Bank.
 */
class BankException extends Exception
{
}