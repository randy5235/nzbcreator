<?php
/**
 * Created by PhpStorm.
 * User: Randy Wressell
 * Date: 1/11/14
 * Time: 5:58 PM
 * Please retain author credit if redistributing.
 * Last updated: 1/23/2014

 */


require_once 'Net/NNTP/Client.php';
require_once 'database.php'; //database connection object

$nntp = new Net_NNTP_Client();
$ret = $nntp->connect('news.usenetserver.com');

if( PEAR::isError($ret)) {
    echo 'Could not connect';
} else {
    echo 'Connection was successful <br />';
    $ret = $nntp->authenticate('txpsycho','Headhunterv1.3');
    if( PEAR::isError($ret)) {
        echo 'Bad Credentials<br />';
    } else {
        $groups = $nntp->getGroups();
        // Print a list of avaible newsgroups
	    //print_r($groups);
        $dbconnection = new database();
        //$dbconnection->Connect();
	    $count=0;
        foreach($groups as $group) {
            	if (stristr($group['group'],"alt.bin")){
		            $dbconnection->DBInsert($group['group'],$group['first'],$group['last']);
		            echo $group['group'].":".$group['first'].":".$group['last'].":".$count."\n";
           	        $count++;
		        }
        }
    }
}





?>


