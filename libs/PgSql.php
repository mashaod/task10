<?php
Class PgSql extends Sql
{
    public $dbPg;	
    
    public function __construct()
    {
        $this->dbPg = pg_connect('host=' . DB_HOST .  ' dbname=' . DB_DB . ' user=' . DB_USER . ' password=' . DB_PASSWORD_PG)
            or die('connection pg failed');
    }
    
    public function exec()
    {
    	parent::exec();
    	$sqlClean = str_replace('`','', $this->sql);
	$resultPg = pg_query($this->dbPg, $sqlClean) or die ('Ошибка запроса: ' . pg_last_error());

		if(isset($resultPg) && !empty($resultPg))
	    {
		   return $resultPg;
	    }
	    else
	    {
		   throw new Exception("Wrong values");
	    }
    }
}
?>
