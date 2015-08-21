<?php

namespace Ondrakub;

/**
 * Bank for PHP - small and easy-to-use library for works with bank account
 *
 * @author     Ondřej Kubíček
 * @copyright  Copyright (c) 2014 Ondřej Kubíček
 * @license    New BSD License
 * @link       http://www.kubon.cz
 * @version    1.1
 */
class Bank
{

	const
		ZERO = TRUE,
		FORMATTED = TRUE;

	/**
	 * taken from https://www.cnb.cz/cs/platebni_styk/ucty_kody_bank/ to date 1. 2. 2014
	 */
	private static $banks = array(
		  '0100' => array('name' => 'Komerční banka, a.s.',
		  				   'bic' => 'KOMBCZPP'),
		  '0300' => array('name' => 'Československá obchodní banka. a.s.',
		  				   'bic' => 'CEKOCZPP'),
		  '0600' => array('name' => 'GE Money Bank, a.s.',
		  				   'bic' => 'AGBACZPP'),
		  '0710' => array('name' => 'Česká národní banka',
		  				   'bic' => 'CNBACZPP'),
		  '0800' => array('name' => 'Česká spořitelna',
		  				   'bic' => 'GIBACZPX'),
		  '2010' => array('name' => 'Fio banka',
		  				   'bic' => 'FIOBCZPP'),
		  '2020' => array('name' => 'Bank of Tokyo-Mitsubishi UFJ (Holland) N.V. Prague Branch, organizační složka',
		  				   'bic' => 'BOTKCZPP'),
		  '2030' => array('name' => 'AKCENTA, spořitelní a úvěrní družstvo',
		  				   'bic' => ''),
		  '2050' => array('name' => 'WPB Capital, spořitelní družstvo',
		  				   'bic' => ''),
		  '2060' => array('name' => 'Citfin, spořitelní družstvo',
		  				   'bic' => 'CITFCZPP'),
		  '2070' => array('name' => 'Moravský Peněžní Ústav – spořitelní družstvo',
		  				   'bic' => 'MPUBCZPP'),
		  '2100' => array('name' => 'Hypoteční banka, a.s.',
		  				   'bic' => ''),
		  '2200' => array('name' => 'Peněžní dům, spořitelní družstvo',
		  				   'bic' => ''),
		  '2210' => array('name' => 'Evropsko-ruská banka, a.s.',
		  				   'bic' => 'FICHCZPP'),
		  '2220' => array('name' => 'Artesa, spořitelní družstvo',
		  				   'bic' => 'ARTTCZPP'),
		  '2240' => array('name' => 'Poštová banka, a.s., pobočka Česká republika',
		  				   'bic' => 'POBNCZPP'),
		  '2250' => array('name' => 'Záložna CREDITAS, spořitelní družstvo',
		  				   'bic' => 'CTASCZ22'),
		  '2310' => array('name' => 'ZUNO BANK AG, organizační složka',
		  				   'bic' => 'ZUNOCZPP'),
		  '2600' => array('name' => 'Citibank Europe plc, organizační složka',
		  				   'bic' => 'CITICZPX'),
		  '2700' => array('name' => 'UniCredit Bank Czech Republic and Slovakia, a.s.',
		  				   'bic' => 'BACXCZPP'),
		  '3020' => array('name' => 'MEINL BANK Aktiengesellschaft,pobočka Praha',
		  				   'bic' => ''),
		  '3030' => array('name' => 'Air Bank a.s.',
		  				   'bic' => 'AIRACZPP'),
		  '3500' => array('name' => 'ING Bank N.V.',
		  				   'bic' => 'INGBCZPP'),
		  '4000' => array('name' => 'LBBW Bank CZ a.s.',
		  				   'bic' => 'SOLACZPP'),
		  '4300' => array('name' => 'Českomoravská záruční a rozvojová banka, a.s.',
		  				   'bic' => 'CMZRCZP1'),
		  '5400' => array('name' => 'The Royal Bank of Scotland plc, organizační složka',
		  				   'bic' => 'ABNACZPP'),
		  '5500' => array('name' => 'Raiffeisenbank a.s.',
		  				   'bic' => 'RZBCCZPP'),
		  '5800' => array('name' => 'J & T Banka, a.s.',
		  				   'bic' => 'JTBPCZPP'),
		  '6000' => array('name' => 'PPF banka a.s.',
		  				   'bic' => 'PMBPCZPP'),
		  '6100' => array('name' => 'Equa bank a.s.',
		  				   'bic' => 'EQBKCZPP'),
		  '6200' => array('name' => 'COMMERZBANK Aktiengesellschaft, pobočka Praha',
		  				   'bic' => 'COBACZPX'),
		  '6210' => array('name' => 'mBank S.A., organizační složka',
		  				   'bic' => 'BREXCZPP'),
		  '6300' => array('name' => 'BNP Paribas Fortis SA/NV, pobočka Česká republika',
		  				   'bic' => 'GEBACZPP'),
		  '6700' => array('name' => 'Všeobecná úverová banka a.s., pobočka Praha',
		  				   'bic' => 'SUBACZPP'),
		  '6800' => array('name' => 'Sberbank CZ, a.s.',
		  				   'bic' => 'VBOECZ2X'),
		  '7910' => array('name' => 'Deutsche Bank A.G. Filiale Prag',
		  				   'bic' => 'DEUTCZPX'),
		  '7940' => array('name' => 'Waldviertler Sparkasse Bank AG',
		  				   'bic' => 'SPWTCZ21'),
		  '7950' => array('name' => 'Raiffeisen stavební spořitelna a.s.',
		  				   'bic' => ''),
		  '7960' => array('name' => 'Českomoravská stavební spořitelna, a.s.',
		  				   'bic' => ''),
		  '7970' => array('name' => 'Wüstenrot-stavební spořitelna a.s.',
		  				   'bic' => ''),
		  '7980' => array('name' => 'Wüstenrot hypoteční banka a.s.',
		  				   'bic' => ''),
		  '7990' => array('name' => 'Modrá pyramida stavební spořitelna, a.s.',
		  				   'bic' => ''),
		  '8030' => array('name' => 'Raiffeisenbank im Stiftland eG pobočka Cheb, odštěpný závod',
		  				   'bic' => 'GENOCZ21'),
		  '8040' => array('name' => 'Oberbank AG pobočka Česká republika',
		  				   'bic' => 'OBKLCZ2X'),
		  '8060' => array('name' => 'Stavební spořitelna České spořitelny, a.s.',
		  				   'bic' => ''),
		  '8090' => array('name' => 'Česká exportní banka, a.s.',
		  				   'bic' => 'CZEECZPP'),
		  '8150' => array('name' => 'HSBC Bank plc - pobočka Praha',
		  				   'bic' => 'MIDLCZPP'),
		  '8200' => array('name' => 'PRIVAT BANK AG der Raiffeisenlandesbank Oberösterreich v České republice',
		  				   'bic' => 'CNBACZPP')
	);

	/** @var string */
	private $account = NULL;

	/** @var int */
	private $prefix = NULL;

	/** @var int */
	private $number = NULL;

	/** @var int */
	private $code = NULL;

	/** @var bool */
	private $valid = FALSE;


	/**
	 * Create object
	 * @param string account number
	 * @throws BankException
	 */
	public function __construct($account)
	{
		$this->parse($account);
		$this->valid();
	}

	/**
	 * prefix account
	 * @param bool zero
	 * @return int
	 */
	public function getPrefix($zero = FALSE)
	{
		if ($zero === FALSE) {
			return $this->prefix;
		}

		return sprintf("%06d", $this->prefix);
	}

	/**
	 * account number
	 * @param bool zero
	 * @return int
	 */
	public function getNumber($zero = FALSE)
	{
		if ($zero === FALSE) {
			return $this->number;
		}

		return sprintf("%010d", $this->number);
	}

	/**
	 * account code
	 * @return int
	 */
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * full account number
	 * @param bool zero
	 * @return string
	 */
	public function getAccount($zero = FALSE)
	{
		if ($zero === FALSE) {
			return $this->account;
		}
		return  $this->getPrefix(self::ZERO) . '-' . $this->getNumber(self::ZERO) .'/'. $this->getCode();
	}

	/**
	 * IBAN code
	 * @param bool formatted
	 * @return string
	 */
	public function getIban($formatted = FALSE)
	{
		$iban = 'CZ' . $this->generateIbanVerifyCode() . $this->getIbanFormat();
		if ($formatted === FALSE) {
			return $iban;
		}

		return implode(' ', str_split($iban, 4));
	}

	/**
	 * BIC code (SWIFT)
	 * @return string
	 */
	public function getBic()
	{
		return self::$banks[$this->getCode()]['bic'];
	}

	/**
	 * if the account is valid
	 * @return bool
	 */
	public function isValid()
	{
		return $this->valid;
	}

	/**
	 * @param int code
	 * @return string
	 * @throws BankException
	 */
	public static function getName($code)
	{
		if (array_key_exists($code, self::$banks)) {
			return self::$banks[$code]['name'];
		}
		throw new BankException('Bad code');
	}

	/**
	 * @param string
	 * @return array
	 * @throws BankException
	 */
	public static function getCodes($name = '')
	{
		if (empty($name)){
			return self::$banks;
		}

		$ret = array_filter(self::$banks, function($var) use ($name) { return strpos(strtolower($var['name']), strtolower($name)) !== FALSE; });
		if (!empty($ret)) {
			return $ret;
		}
		throw new BankException('No match found');
	}


	private function parse($account)
	{
		if (!preg_match('/(([\d]{0,6})[\-])?([\d]{2,10})\/([\d]{4})/', $account, $match)){
			throw new BankException('Enter account number in right format');
		}

		$this->prefix = (int) $match[2];
		$this->number = (int) $match[3];
		$this->code = (int) $match[4];

		$this->account = $account;
	}


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


	private function generateIbanVerifyCode()
	{
		for ($i = 0; $i < 100; $i++) {
			$vc = sprintf("%02d", $i);
			if (bcmod($this->getIbanFormat() . '1235' . $vc, 97) === '1'){
				return $vc;
			}
		}
		return FALSE;
	}


	private function getIbanFormat()
	{
		return $this->getCode() . $this->getPrefix(self::ZERO) . $this->getNumber(self::ZERO);
	}



}

/**
 * An exception generated by Bank.
 */
class BankException extends \Exception
{
}