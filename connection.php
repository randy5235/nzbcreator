<?php
/**
 * Created by PhpStorm.
 * User: Randy Wressell
 * Date: 1/11/14
 * Time: 5:58 PM
 * Please retain author credit if redistributing.
 * Last updated: 1/23/2014

 */

/* Requirements and includes */
require_once 'Net/NNTP/Client.php';
require_once 'database.php'; //database connection object class

// Declare CONSTANTS for use in database and newsserver configuration

$config_ini=parse_ini_file('config.ini');
define("DATABASENAME","$config_ini[databasename]");
define("USERNAME","$config_ini[username]");
define("PASSWORD","$config_ini[password]");
define("NEWSSERVER","$config_ini[newsserver]");
define("NEWSUSERNAME","$config_ini[news_username]");
define("NEWSPASSWORD","$config_ini[news_password]");

$dsn = "mysql:host=$config_ini[host];dbname=".DATABASENAME.";charset=utf8";


$nntp = new Net_NNTP_Client();
$ret = $nntp->connect(NEWSSERVER);

if( PEAR::isError($ret)) {
    echo 'Could not connect';
} else {
    echo 'Connection was successful <br />';
    $ret = $nntp->authenticate(NEWSUSERNAME,NEWSPASSWORD);
    if( PEAR::isError($ret)) {
        echo 'Bad Credentials<br />';
    } else {
        $groups = $nntp->getGroups();
        // Print a list of avaible newsgroups
	    //print_r($groups);
        $dbconnection = new database($dsn,USERNAME,PASSWORD);
        //$dbconnection->Connect();
	    $count=0;
        foreach($groups as $group) {
            	if (stristr($group['group'],"alt.bin")){
                    $compare = $dbconnection->DBCompare($group['group']);
                    if ($compare)
                    {
                        print_r($compare);
                        echo " we have a match!\n";
                    }else{

		            $dbconnection->DBInsert($group['group'],$group['first'],$group['last']);
		            //echo $group['group'].":".$group['first'].":".$group['last'].":".$count."\n";
           	        $count++;
                    }
		        }
        }
    }
}





?>


