<?php
    session_start();
	include('common.php');
        $id = $_SESSION["id"];

    if(isset($_POST["item"])) {
   
    if (!empty($_POST["item"])) {
      addListItem($_POST["item"], $_SESSION["username"], $db);
    }
    header('Location: todolist.php');
    exit();
  }
       

    else if(isset($_POST["delete"])){
        $deleteQuery = $db->prepare("DELETE FROM todolist 
        WHERE id = :id AND item = :item");
        
        $deleteQuery->execute([
            'id' => $id,
            'item' => trim($_POST["delete"])
        ]);
    }
       
    header("Location: todolist.php");
?>