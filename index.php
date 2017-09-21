<?php
include('config.php');
include('libs/Sql.php');
include('libs/View.php');

$Sql = new Sql;
$view = new View(TEMPLATE);
$sqlArray = array();

try
{
    $sqlArray['Select'] = $Sql->select('data')->from('MY_TEST')->whereOrOn('key', 'User01')->exec();
    $sqlArray['Select Distinct'] = $Sql->select('data', 'distinct')->from('MY_TEST')->whereOrOn('key', 'User01')->exec();
    $sqlArray['Select Join'] = $Sql->select('data')->from('TableA')->join('TableB')->whereOrOn('TableA.name', 'TableB.name', 'on')->exec();
    $sqlArray['Select Left Join'] = $Sql->select('data')->from('TableA')->join('TableB', 'leftJoin')->whereOrOn('TableA.name', 'TableB.name', 'on')->exec();
    $sqlArray['Select Right Join'] = $Sql->select('data')->from('TableA')->join('TableB', 'rightJoin')->whereOrOn('TableA.name', 'TableB.name', 'on')->exec();
    $sqlArray['Select Cross Join'] = $Sql->select('data')->from('TableA')->join('TableB', 'crossJoin')->whereOrOn('TableA.name', 'TableB.name', 'on')->exec();
    $sqlArray['Select Natural Join'] = $Sql->select('data')->from('TableA')->join('TableB', 'naturalJoin')->whereOrOn('TableA.name', 'TableB.name', 'on')->exec();
    $sqlArray['Select Group Having Order Limit'] = $Sql->select('data')->from('MY_TEST')->whereOrOn('key', 'User01')->group('key')->having('id=1 or id=2')->
    order('name','desc')->limit(10)->exec();
    $sqlArray['Insert'] = $Sql->insert('MY_TEST','key','data')->values('User01', 'someText')->exec();
    $sqlArray['Update'] = $Sql->update('MY_TEST')->set('data', 'newText')->whereOrOn('key', 'User01')->exec();
    $sqlArray['Delete'] = $Sql->delete('MY_TEST')->whereOrOn('key', 'User01')->exec();

    $view->createTemplate($sqlArray);
}
catch(Exception $error)
{
    $msgMy = $error->getMessage();
}
