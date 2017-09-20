<?php
include('config.php');
include('libs/Sql.php');
include('libs/MySql.php');
include('libs/PgSql.php');

$mySql = new MySql;
$pgSql = new PgSql;

// My action
try
{
    if (isset($_POST['ButMy']))   
    {
        if($_POST['ButMy'] == 'Insert')
        {
	    $sqlInsert = $mySql->insert('MY_TEST','key','data')->values('User01', 'someText')->exec();
	    $mySql->restartVal();
        }
        elseif($_POST['ButMy'] == 'Update')
        {
            $sqlUpdate = $mySql->update('MY_TEST')->set('data', 'newText')->where('key', 'User01')->exec();
	    $mySql->restartVal();
        }
        elseif($_POST['ButMy'] == 'Delete')
        {
            $sqlDelete = $mySql->delete('MY_TEST')->where('key', 'User01')->exec();
	    $mySql->restartVal();
        }	
    }
    //Select
    $resultMy = $mySql->select('data')->from('MY_TEST')->where('key', 'User01')->exec();
}
catch(Exception $error)
{
    $msgMy = $error->getMessage();
}

// PG action
try
{
    if (isset($_POST['ButPg']))   
    {
        if($_POST['ButPg'] == 'Insert')
        {
		$sqlInsert = $pgSql->insert('PG_TEST','key','data')->values('User01', 'someText')->exec();
        }
        elseif($_POST['ButPg'] == 'Update')
        {
		$sqlUpdate = $pgSql->update('PG_TEST')->set('data', 'newText')->where('key', 'User01')->exec();
        }
        elseif($_POST['ButPg'] == 'Delete')
        {
		$sqlDelete = $pgSql->delete('PG_TEST')->where('key', 'User01')->exec();
        }
    }
	//Select
	$resultPg = $pgSql->select('key, data')->from('PG_TEST')->where('key', 'User01')->exec();
}
catch(Exception $error)
{
    $msgPg = $error->getMessage();	
}

include('templates/index.php');
