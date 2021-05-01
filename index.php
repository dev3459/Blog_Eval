<?php
//We include all mandatory files.
require_once './assets/parts/include.php';
require_once './Controller/ArticleController.php';
require_once './Controller/UserController.php';

//We use ArticleController as well as UserController
use Controller\ArticleController;
use Controller\UserController;

//Either the url contains the controller parameter ( $_GET['controller'] => http://localhost?controller=MonSuperController ).
if(isset($_GET['controller'])) {
    if(isset($_SESSION["user"]) && !is_string($_SESSION["user"])){
        //Then, the user requests an action to be performed.
        switch($_GET['controller']) {
            case 'articles': // ex: http://localhost?controller=articles
                $controller = new ArticleController();
                if(isset($_GET['action'])) {
                    switch($_GET['action']) {
                        case 'new' :
                            //Display the add article page
                            $controller->addArticle($_POST);
                            break;
                        case 'show' :
                            //Displays the article whose id = $_GET["article"]
                            if(isset($_GET["article"])){
                                $controller->showArticle($_GET["article"]);
                            }
                            break;
                        default:
                            http_response_code(404);
                            echo "Merci de ne pas modifié l'url !";
                            break;
                    }
                } else {
                    //Display of all articles.
                    $controller->articles();
                }
                break;
            default:
                //We display a 404 not found page. Because the controller does not exist !
                http_response_code(404);
                echo "Merci de ne pas modifié l'url !";
                break;
        }
    }
    else{
        //Displays the login page
        $controller = new UserController();
        $controller->connexionPage();
    }
}
else {
    //Show articles
    if(isset($_SESSION["user"]) && !is_string($_SESSION["user"])){
        header("Location: index.php?controller=articles");
    }
    //Displays the login page
    else{
        $controller = new UserController();
        $controller->connexionPage();
    }
}
