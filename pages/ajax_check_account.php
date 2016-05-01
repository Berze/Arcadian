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
		
		$temp = strspn("$account", "123456789- '");
		if($temp != strlen($account))
		{
		echo '<font color="red">Name contains illegal letters. Use only: <b>123456789! Remember to not use 0!</b></font>';
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