<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/assets/parts/functionUtils.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/DB.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/Manager/Traits/ManagerTrait.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/Entity/User.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/Manager/UserManager.php';

session_start();

use Model\Manager\UserManager;

if(isset($_POST["name"], $_POST["password"])){
    $name = sanitize($_POST["name"]);
    if(strlen($_POST["password"]) < 6){
        header("Location: index.php?error=Le mot de passe est trop court&color=red");
        exit;
    }

    $pass = password_hash(sanitize($_POST["password"]), PASSWORD_DEFAULT);

    $manager = new UserManager();
    $user = $manager->insertUser($name, $pass);
    if(is_string($user)){
        header("Location: index.php?error=" . $user . "&color=red");
    }else{
        $_SESSION['user'] = $user;
        header("Location: index.php?controller=articles");
    }

}else{
    header("Location: index.php?error=Merci de renseigner les champs obligatoire correctement&color=red");
}