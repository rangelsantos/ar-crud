<?php
session_start();
if(!$_SESSION['status'] == true){
    header("location: index.php");
}
?>
