<?php
//I am including the include.php file which contains all other required files.
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/parts/include.php";

//I am using ArticleManager
use Model\Manager\ArticleManager;

//I define the type of the header which is JSON
header('Content-Type: application/json');

//We get the method (for example: POST)
$requestType = $_SERVER['REQUEST_METHOD'];

//We declare a new instance of ArticleManager
$articleManager = new ArticleManager();

//In case it is equal to post
switch($requestType) {
    case 'POST':
        //then we get the encoded JSON file
        $data = json_decode(file_get_contents('php://input'));
        //and we see if the GET of id exists if it exists in this case we modify the article
        if(isset($_GET["id"])){
            modifArticle($articleManager, $_GET["id"], $data->content);
            break;
        }
        //and in any case we launch the deletion of the article
        supprArticle($articleManager, $data->id);
        break;
    default:
        break;
}

//Function that calls the articleManager to delete an article
function supprArticle(ArticleManager $articleManager, int $id){
    $articleManager->supprArticle($id);
}

//Function that calls the articleManager to modify an article
function modifArticle(ArticleManager $articleManager, int $id, string $content){
    $articleManager->modifArticle($id,$content);
}