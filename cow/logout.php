<?php
include("common.php");
if($_SESSION["status"]== "loggedin"){
    if(isset($_SESSION)){
        session_destroy();
        session_regenerate_id(TRUE);
        session_start();
    }
}
header('Location: start.php');
?>