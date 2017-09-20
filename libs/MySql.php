<?php
Class MySql extends Sql
{
    public $dbMy;
    
    public function __construct()
    {
        $this->dbMy = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD_MY)
    		    or die ("<br/>Error MySQL");
        $connect = mysql_select_db('user1', $this->dbMy)
    		    or die ("<br/>Error DB");
    }

    public function exec()
    {
         parent::exec();
        
         $resultMy = mysql_query($this->sql, $this->dbMy);
         if(isset($resultMy) && !empty($resultMy))
         {
             return $resultMy;
         }
         else
         {
             throw new Exception("Wrong values");
         }
    }
}
?>
