<?php
if(!defined('INITIALIZED'))
	exit;

echo '<?xml version="1.0" encoding="utf-8" standalone="yes"?>';

$account = strtoupper(trim($_REQUEST['account']));

if(empty($account))
{
	echo '<font color="red">Please enter an account number.</font>';
	exit;
}


if(strlen($account) < 8)
{

	if(!check_account_name($account))
	{
		echo '<font color="red">Invalid account number format. Use only numbers 0-9.</font>';
		exit;
	}

		//blocked letters:
		$bl = array('Q','W', 'E','R', "T", 'Y', "U", "I", "O", "P", "A", "S", "D", "F", "G", "H", "J", "K", "L", "Z", "X", "C", "V", "B", "N", "M", "0");
	foreach($bl as $bl1)
	if($bl1 == substr($account, 4, strlen($bl1)))
	{
		echo '<font color="red">Invalid account number format. Use only numbers 1-9. Remember you cannot use "0" in your number! Minimum 5 numbers!</font>';
		exit;
	}


if($account == $bl)
		{
	echo 'HWDP';
		exit;

		}

	$account_db = new Account();
	$account_db->find($account);
	if($account_db->isLoaded())
		echo '<font color="red">Account with this number already exist.</font>';
	else
		echo '<font color="green">Good account number ( '.htmlspecialchars($account).' ). You can create account.</font>';
}
else
	echo '<font color="red">Account number is too long (max. 8 chars).</font>';
exit;