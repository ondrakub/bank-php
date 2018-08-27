<?php

namespace Ondrakub;

/**
 * Bank for PHP - small and easy-to-use library for works with bank account
 *
 * @author     Ondřej Kubíček
 * @copyright  Copyright (c) 2014 Ondřej Kubíček
 * @license    New BSD License
 * @link       http://www.kubon.cz
 * @version    1.3
 */
class Bank
{

	const
		ZERO = TRUE,
		FORMATTED = TRUE;

	/**
	 * taken from https://www.cnb.cz/cs/platebni_styk/ucty_kody_bank/ to date 1. 8. 2018
	 */
	private static $banks = array(
		'0100' => array('name' => 'Komerční banka, a.s.',
			'bic' => 'KOMB CZ PP'),
		'0300' => array('name' => 'Československá obchodní banka, a.s.',
			'bic' => 'CEKO CZ PP'),
		'0600' => array('name' => 'MONETA Money Bank, a.s.',
			'bic' => 'AGBA CZ PP'),
		'0710' => array('name' => 'Česká národní banka',
			'bic' => 'CNBA CZ PP'),
		'0800' => array('name' => 'Česká spořitelna, a.s.',
			'bic' => 'GIBA CZ PX'),
		'2010' => array('name' => 'Fio banka, a.s.',
			'bic' => 'FIOB CZ PP'),
		'2020' => array('name' => 'MUFG Bank (Europe) N.V. Prague Branch',
			'bic' => 'BOTK CZ PP'),
		'2030' => array('name' => 'Československé úvěrní družstvo',
			'bic' => ''),
		'2060' => array('name' => 'Citfin, spořitelní družstvo',
			'bic' => 'CITF CZ PP'),
		'2070' => array('name' => 'Moravský Peněžní Ústav – spořitelní družstvo',
			'bic' => 'MPUB CZ PP'),
		'2100' => array('name' => 'Hypoteční banka, a.s.',
			'bic' => ''),
		'2200' => array('name' => 'Peněžní dům, spořitelní družstvo',
			'bic' => ''),
		'2220' => array('name' => 'Artesa, spořitelní družstvo',
			'bic' => 'ARTT CZ PP'),
		'2240' => array('name' => 'Poštová banka, a.s., pobočka Česká republika',
			'bic' => 'POBN CZ PP'),
		'2250' => array('name' => 'Banka CREDITAS a.s.',
			'bic' => 'CTAS CZ 22'),
		'2260' => array('name' => 'NEY spořitelní družstvo',
			'bic' => ''),
		'2275' => array('name' => 'Podnikatelská družstevní záložna',
			'bic' => ''),
		'2600' => array('name' => 'Citibank Europe plc, organizační složka',
			'bic' => 'CITI CZ PX'),
		'2700' => array('name' => 'UniCredit Bank Czech Republic and Slovakia, a.s.',
			'bic' => 'BACX CZ PP'),
		'3030' => array('name' => 'Air Bank a.s.',
			'bic' => 'AIRA CZ PP'),
		'3050' => array('name' => 'BNP Paribas Personal Finance SA, odštěpný závod',
			'bic' => 'BPPF CZ P1'),
		'3060' => array('name' => 'PKO BP S.A., Czech Branch',
			'bic' => 'BPKO CZ PP'),
		'3500' => array('name' => 'ING Bank N.V.',
			'bic' => 'INGB CZ PP'),
		'4000' => array('name' => 'Expobank CZ a.s.',
			'bic' => 'EXPN CZ PP'),
		'4300' => array('name' => 'Českomoravská záruční a rozvojová banka, a.s.',
			'bic' => 'CMZR CZ P1'),
		'5500' => array('name' => 'Raiffeisenbank a.s.',
			'bic' => 'RZBC CZ PP'),
		'5800' => array('name' => 'J & T BANKA, a.s.',
			'bic' => 'JTBP CZ PP'),
		'6000' => array('name' => 'PPF banka a.s.',
			'bic' => 'PMBP CZ PP'),
		'6100' => array('name' => 'Equa bank a.s.',
			'bic' => 'EQBK CZ PP'),
		'6200' => array('name' => 'COMMERZBANK Aktiengesellschaft, pobočka Praha',
			'bic' => 'COBA CZ PX'),
		'6210' => array('name' => 'mBank S.A., organizační složka',
			'bic' => 'BREX CZ PP'),
		'6300' => array('name' => 'BNP Paribas S.A., pobočka Česká republika',
			'bic' => 'GEBA CZ PP'),
		'6700' => array('name' => 'Všeobecná úverová banka a.s., pobočka Praha',
			'bic' => 'SUBA CZ PP'),
		'6800' => array('name' => 'Sberbank CZ, a.s.',
			'bic' => 'VBOE CZ 2X'),
		'7910' => array('name' => 'Deutsche Bank Aktiengesellschaft Filiale Prag, organizační složka',
			'bic' => 'DEUT CZ PX'),
		'7940' => array('name' => 'Waldviertler Sparkasse Bank AG',
			'bic' => 'SPWT CZ 21'),
		'7950' => array('name' => 'Raiffeisen stavební spořitelna a.s.',
			'bic' => ''),
		'7960' => array('name' => 'Českomoravská stavební spořitelna, a.s.',
			'bic' => ''),
		'7970' => array('name' => 'Wüstenrot - stavební spořitelna a.s.',
			'bic' => ''),
		'7980' => array('name' => 'Wüstenrot hypoteční banka a.s.',
			'bic' => ''),
		'7990' => array('name' => 'Modrá pyramida stavební spořitelna, a.s.',
			'bic' => ''),
		'8030' => array('name' => 'Volksbank Raiffeisenbank Nordoberpfalz eG pobočka Cheb',
			'bic' => 'GENO CZ 21'),
		'8040' => array('name' => 'Oberbank AG pobočka Česká republika',
			'bic' => 'OBKL CZ 2X'),
		'8060' => array('name' => 'Stavební spořitelna České spořitelny, a.s.',
			'bic' => ''),
		'8090' => array('name' => 'Česká exportní banka, a.s.',
			'bic' => 'CZEE CZ PP'),
		'8150' => array('name' => 'HSBC Bank plc - pobočka Praha',
			'bic' => 'MIDL CZ PP'),
		'8200' => array('name' => 'PRIVAT BANK der Raiffeisenlandesbank Oberösterreich Aktiengesellschaft, pobočka Česká republika',
			'bic' => ''),
		'8215' => array('name' => 'ALTERNATIVE PAYMENT SOLUTIONS, s.r.o.',
			'bic' => ''),
		'8220' => array('name' => 'Payment Execution s.r.o.',
			'bic' => 'PAER CZ P1'),
		'8230' => array('name' => 'EEPAYS s. r. o.',
			'bic' => 'EEPS CZ PP'),
		'8240' => array('name' => 'Družstevní záložna Kredit',
			'bic' => ''),
		'8250' => array('name' => 'Bank of China (Hungary) Close Ltd. Prague branch, odštěpný závod',
			'bic' => 'BKCH CZ PP'),
		'8260' => array('name' => 'PAYMASTER a.s.',
			'bic' => ''),
		'8265' => array('name' => 'Industrial and Commercial Bank of China Limited Prague Branch, odštěpný závod',
			'bic' => 'ICBK CZ PP'),
		'8270' => array('name' => 'Fairplay Pay s.r.o.',
			'bic' => ''),
		'8280' => array('name' => 'B-Efekt a.s.',
			'bic' => 'BEFK CZ P1'),
		'8290' => array('name' => 'EUROPAY s.r.o.',
			'bic' => 'ERSO CZ PP'),
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
	 * @return int|string
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
	 * @return int|string
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
	 * @return string
	 */
	public function getCode()
	{
		return sprintf("%04d", $this->code);
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