<?php
//Get session variable
$userrole=$_SESSION['USERROLE'];
//pass $userrole to bellow $menu variable and include it 
$dashboard="users/dashboards/$userrole.php";
include $dashboard;

?>