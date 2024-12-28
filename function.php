<?php
function inputClean($input=null){
    return htmlspecialchars(stripcslashes(trim($input)));
}

function dbConn(){
    $conn=new mysqli(SERVERNAME,USERNAME,PASSWORD,DBNAME);
    if($conn->connect_error){
        die("Database Error ".$conn->connect_error);
    }
    return $conn;
}
?>