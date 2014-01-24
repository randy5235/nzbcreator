<?php
/* Created by Randy Wressell 2014
    Please retain credit and authorship if redistributed
    Created: 1/22/2014
    Last Updated: 1/23/2014
*/

class database
{
    public function Connect()
    {
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=nzb_creator;charset=utf8','root','SuperMountain23',array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch (Exception $e)
        {
            throw new Exception('Could not connect to the database', 0, $e);
        }
    }


    public function DBInsert($group,$first,$last)
    {
	    $db = new PDO('mysql:host=localhost;dbname=nzb_creator;charset=utf8','root','SuperMountain23',array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	    $query = $db->prepare("INSERT INTO Groups (GroupName,FirstPost,LastPost) Values (:GroupName, :FirstPost, :LastPost)");
	    $query->execute(array(':GroupName' => $group,':FirstPost' => $first, ':LastPost' => $last));
	}
}
?>	 
