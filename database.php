<?php
/* Created by Randy Wressell 2014
    Please retain credit and authorship if redistributed
    Created: 1/22/2014
    Last Updated: 1/23/2014
*/

class database
{
    public function __construct()
    {
        try
        {
            $this->db = new PDO('mysql:host=localhost;dbname=nzb_creator;charset=utf8','root','SuperMountain23',array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch (Exception $e)
        {
            throw new Exception('Could not connect to the database', 0, $e);
        }
    }


    public function DBInsert($group,$first,$last)
    {
	    //$db = new PDO('mysql:host=localhost;dbname=nzb_creator;charset=utf8','root','SuperMountain23',array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	    $query = $this->db->prepare("INSERT INTO Groups (GroupName,FirstPost,LastPost) Values (:GroupName, :FirstPost, :LastPost)");
	    $query->execute(array(':GroupName' => $group,':FirstPost' => $first, ':LastPost' => $last));
        echo "Added: " .$group.":".$first.":".$last.":"."\n";
	}

    public function DBCompare($group)
    {
        $query = $this->db->prepare("SELECT GroupName,FirstPost, LastPost FROM Groups where GroupName = :groupname");
        $query->execute(array(':groupname' => $group));
        return $result = $query->fetch(PDO::FETCH_ASSOC);

    }
    public function DBUpdate($group,$first,$last)
    {
        // test for new stuff
    }
}
?>	 
