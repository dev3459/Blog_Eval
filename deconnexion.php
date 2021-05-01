<?php
session_start();

//Logging out of a user
if(isset($_SESSION["user"]) && !is_string($_SESSION["user"])){
    unset($_SESSION["user"]);
    header("Location: index.php");
}