<?php
    /*if(!isset($_GET["name"])){
        header("HTTP/1.1 400 Invalid Request");
        die("not get here properly");
    }*/
    session_start();
    $name = $_POST["name"];
    $password = $_POST["password"];
    //echo "$name, $password";

    if($name && $password){
        //echo "great";
        $_SESSION["status"]= "loggedin";
        $_SESSION["username"] = "$name";
        setcookie("last_login", date("D y M d, g:i:s a"), time() + (86400 * 7));
        header('Location: todolist.php');
    }else{
        //echo "not great";
        $_SESSION["flash"] = "must submit username and password";
        $url=$_SERVER["HTTP_ORIGIN"]."/start.php";
        //echo $url;
        header("Location: $url");
    }
    
    
    ?>