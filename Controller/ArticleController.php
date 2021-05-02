<?php
namespace Controller;

require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/Entity/User.php';

use Controller\Traits\RenderViewTrait;
use Model\Entity\Article;
use Model\Manager\ArticleManager;
use Model\Manager\UserManager;

class ArticleController {

    use RenderViewTrait;

    private ArticleManager $articleManager;
    private UserManager $userManager;

    public function __construct() {
        $this->articleManager = new ArticleManager();
        $this->userManager = new UserManager();
    }

    /**
     * Displays the list of available items.
     */
    public function articles() {
        $articles = $this->articleManager->getAll();

        $this->render('articles', 'Mes articles', ['menu', 'articles'], "articles", ['articles' => $articles]);
    }

    /**
     * Add a new article.
     */
    public function addArticle($form){
        if(isset($form["title"]) && strlen($form["title"]) > 45){
            echo "<div id='error'>Merci de respecter la limite du titre</div>";
        }else{
            if(isset($form['content'], $form['user'])) {

                $content = htmlentities($form['content']);
                $user_fk = intval($form['user']);
                $title = htmlentities($form['title']);

                $user = $this->userManager->getById($user_fk);
                if($user->getId()) {
                    $article = new Article($content, $user, $title);
                    $this->articleManager->add($article);
                    header("Location: index.php?controller=articles");
                }
            }
        }

        $this->render('add.article', 'Ajouter un article', ['menu', 'addArticle'], null, ["user" => $_SESSION["user"]]);
    }

    /**
     * Displays the article that has a certain id
     * @param $id
     */
    public function showArticle($id){
        $article = $this->articleManager->getById($id);
        $this->render('article', $article->getTitle(),  ['menu', 'article'], "article", ['article' => $article, 'id' => $id, 'user' => $_SESSION['user']]);
    }
}