<?php
if(!defined('INITIALIZED'))
	exit;

if(Website::getServerConfig()->isSetKey('mySQL_Host'))
{
	define('SERVERCONFIG_SQL_TYPE', 'SQL_Type');
	define('SERVERCONFIG_SQL_HOST', 'mySQL_Host');
	define('SERVERCONFIG_SQL_PORT', 'mySQL_Port');
	define('SERVERCONFIG_SQL_USER', 'mySQL_User');
	define('SERVERCONFIG_SQL_PASS', 'mySQL_Pass');
	define('SERVERCONFIG_SQL_DATABASE', 'mySQLDatabase');
	define('SERVERCONFIG_SQLITE_FILE', 'SQL_DB');
}
elseif(Website::getServerConfig()->isSetKey('SQL_Host'))
{
	define('SERVERCONFIG_SQL_TYPE', 'SQL_Type');
	define('SERVERCONFIG_SQL_HOST', 'SQL_Host');
	define('SERVERCONFIG_SQL_PORT', 'SQL_Port');
	define('SERVERCONFIG_SQL_USER', 'SQL_User');
	define('SERVERCONFIG_SQL_PASS', 'SQL_Pass');
	define('SERVERCONFIG_SQL_DATABASE', 'SQLDatabase');
	define('SERVERCONFIG_SQLITE_FILE', 'SQL_DB');
}
else
	new Error_Critic('#E-3', 'There is no key <b>sqlHost</b> or <b>mysqlHost</b> in server config', array(new Error('INFO', 'use server config cache: <b>' . (Website::getWebsiteConfig()->getValue('useServerConfigCache') ? 'true' : 'false') . '</b>')));
if(Website::getServerConfig()->getValue(SERVERCONFIG_SQL_TYPE) == 'mysql')
{
	Website::setDatabaseDriver(Database::DB_MYSQL);
	if(Website::getServerConfig()->isSetKey(SERVERCONFIG_SQL_HOST))
		Website::getDBHandle()->setDatabaseHost(Website::getServerConfig()->getValue(SERVERCONFIG_SQL_HOST));
	else
		new Error_Critic('#E-7', 'There is no key <b>' . SERVERCONFIG_SQL_HOST . '</b> in server config file.');
	if(Website::getServerConfig()->isSetKey(SERVERCONFIG_SQL_PORT))
		Website::getDBHandle()->setDatabasePort(Website::getServerConfig()->getValue(SERVERCONFIG_SQL_PORT));
	else
		new Error_Critic('#E-7', 'There is no key <b>' . SERVERCONFIG_SQL_PORT . '</b> in server config file.');
	if(Website::getServerConfig()->isSetKey(SERVERCONFIG_SQL_DATABASE))
		Website::getDBHandle()->setDatabaseName(Website::getServerConfig()->getValue(SERVERCONFIG_SQL_DATABASE));
	else
		new Error_Critic('#E-7', 'There is no key <b>' . SERVERCONFIG_SQL_DATABASE . '</b> in server config file.');
	if(Website::getServerConfig()->isSetKey(SERVERCONFIG_SQL_USER))
		Website::getDBHandle()->setDatabaseUsername(Website::getServerConfig()->getValue(SERVERCONFIG_SQL_USER));
	else
		new Error_Critic('#E-7', 'There is no key <b>' . SERVERCONFIG_SQL_USER . '</b> in server config file.');
	if(Website::getServerConfig()->isSetKey(SERVERCONFIG_SQL_PASS))
		Website::getDBHandle()->setDatabasePassword(Website::getServerConfig()->getValue(SERVERCONFIG_SQL_PASS));
	else
		new Error_Critic('#E-7', 'There is no key <b>' . SERVERCONFIG_SQL_PASS . '</b> in server config file.');
}
elseif(Website::getServerConfig()->getValue(SERVERCONFIG_SQL_TYPE) == 'sqlite')
{
	Website::setDatabaseDriver(Database::DB_SQLITE);
	if(Website::getServerConfig()->isSetKey(SERVERCONFIG_SQLITE_FILE))
		Website::getDBHandle()->setDatabaseFile(Website::getServerConfig()->getValue(SERVERCONFIG_SQLITE_FILE));
	else
		new Error_Critic('#E-7', 'There is no key <b>' . SERVERCONFIG_SQLITE_FILE . '</b> in server config file.');
}
elseif(Website::getServerConfig()->getValue(SERVERCONFIG_SQL_TYPE) == 'pgsql')
{
	// does pgsql use 'port' parameter? I don't know
	Website::setDatabaseDriver(Database::DB_PGSQL);
	if(Website::getServerConfig()->isSetKey(SERVERCONFIG_SQL_HOST))
		Website::getDBHandle()->setDatabaseHost(Website::getServerConfig()->getValue(SERVERCONFIG_SQL_HOST));
	else
		new Error_Critic('#E-7', 'There is no key <b>' . SERVERCONFIG_SQL_HOST . '</b> in server config file.');
	if(Website::getServerConfig()->isSetKey(SERVERCONFIG_SQL_DATABASE))
		Website::getDBHandle()->setDatabaseName(Website::getServerConfig()->getValue(SERVERCONFIG_SQL_DATABASE));
	else
		new Error_Critic('#E-7', 'There is no key <b>' . SERVERCONFIG_SQL_DATABASE . '</b> in server config file.');
	if(Website::getServerConfig()->isSetKey(SERVERCONFIG_SQL_USER))
		Website::getDBHandle()->setDatabaseUsername(Website::getServerConfig()->getValue(SERVERCONFIG_SQL_USER));
	else
		new Error_Critic('#E-7', 'There is no key <b>' . SERVERCONFIG_SQL_USER . '</b> in server config file.');
	if(Website::getServerConfig()->isSetKey(SERVERCONFIG_SQL_PASS))
		Website::getDBHandle()->setDatabasePassword(Website::getServerConfig()->getValue(SERVERCONFIG_SQL_PASS));
	else
		new Error_Critic('#E-7', 'There is no key <b>' . SERVERCONFIG_SQL_PASS . '</b> in server config file.');
}


else
	new Error_Critic('#E-6', 'Database error. Unknown database type in <b>server config</b> . Must be equal to: "<b>mysql</b>", "<b>sqlite</b>" or "<b>pgsql</b>" . Now is: "<b>' . Website::getServerConfig()->getValue(SERVERCONFIG_SQL_TYPE) . '</b>"');
Website::setPasswordsEncryption(Website::getServerConfig()->getValue('encryptionType'));
$SQL = Website::getDBHandle();