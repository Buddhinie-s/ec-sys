<?php
//Get session variable
$userrole=$_SESSION['USERROLE'];
//pass $userrole to bellow $menu variable and include it 
$menu="users/menus/$userrole.php";
include $menu;

?>