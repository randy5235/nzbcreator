<?php
/**
 * Created by PhpStorm.
 * User: Randy
 * Date: 1/24/14
 * Time: 4:19 PM
 */
class newsserver
{
    public function __construct($newsserver,$username,$password)
    {
            $this->nntp = new Net_NNTP_Client();
            $ret = $this->nntp->connect($newsserver);
            if( PEAR::isError($ret))
            {
                echo 'Could not connect';
            }
            else
            {
                echo 'Connection was successful <br />';
                $ret = $this->nntp->authenticate($username,$password);
                if( PEAR::isError($ret))
                {
                    echo 'Bad Credentials<br />';
                }
            }
        return $ret;

    }

}