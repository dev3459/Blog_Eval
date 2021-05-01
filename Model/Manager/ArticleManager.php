<?php
namespace Model\Manager;

use Model\Entity\Article;
use Model\Entity\Comment;
use Model\Entity\User;
use Model\Manager\Traits\ManagerTrait;
use Model\Manager\UserManager;
use Model\DB;

class ArticleManager {
    use ManagerTrait;

    /**
     * Return all items.
     */
    public function getAll(): array {
        $articles = [];
        $request = $this->db->prepare("SELECT * FROM article");
        $result = $request->execute();
        if($result) {
            $data = $request->fetchAll();
            foreach ($data as $article) {
                $manager = new UserManager();
                $user = $manager->getById($article['user_fk']);
                if($user->getId()) {
                    $articles[] = new Article($article['content'], $user, $article["title"], $article['publish'],  $article['id']);
                }
            }
        }
        return $articles;
    }

    /**
     * Add an article into the database.
     * @param Article $article
     * @return bool
     */
    public function add(Article $article): bool
    {
        $request = $this->db->prepare("INSERT INTO article (content, user_fk, title) VALUES (:content, :user_fk, :title)");

        $request->bindValue(':content', $article->getContent());
        $request->bindValue(':user_fk', $article->getUser()->getId());
        $request->bindValue(":title", $article->getTitle());

        return $request->execute() && DB::getInstance()->lastInsertId() != 0;
    }

    /**
     * Get article by id
     * @param $id
     * @return Article
     */
    public function getById($id): Article
    {
        $request = $this->db->prepare("SELECT * FROM article WHERE id = :id");
        $request->bindValue(":id", $id);
        if($request->execute()){
            if($selected = $request->fetch()){
                $manager = new UserManager();
                $user = $manager->getById($selected["user_fk"]);
                return new Article($selected["content"], $user , $selected["title"], $selected['publish']);
            }
            $user = new User("User inconnu","","0");
            return new Article("L'article nexiste pas ",$user, "Inconnu", "Date inconnue");
        }
    }

    /**
     * Get comment by article id
     * @param $id
     * @return array
     */
    function getComment($id): array
    {
        $request = $this->db->prepare("SELECT comment.publish, comment.content, comment.id, a.user_fk FROM articlecomment as a INNER JOIN comment ON a.comment_fk = comment.id WHERE a.article_fk = :id");
        $request->bindValue(":id", $id);
        if($request->execute()){
            $comments = [];
            $userManager = new UserManager();
            foreach($request->fetchAll() as $selected){
                $comment = new Comment();
                $comment
                    ->setContent($selected["content"])
                    ->setId($selected["id"])
                    ->setAuthor($userManager->getById($selected["user_fk"]))
                    ->setDate($selected["publish"]);
                $comments[] = $comment;
            }
            return $comments;
        }
    }

    /**
     * Add a comment to a selected article
     * @param int $idUser
     * @param int $idArticle
     * @param string $content
     */
    public function addComment(int $idUser, int $idArticle, string $content){
        $request = $this->db->prepare("INSERT INTO comment (content) VALUES (:content)");
        $request->bindValue(":content", sanitize($content));
        $request->execute();
        $id = $this->db->lastInsertId();

        $request = $this->db->prepare("INSERT INTO articleComment (article_fk, comment_fk, user_fk) VALUES (:article_fk, :comment_fk, :user_fk)");
        $request->bindValue(":article_fk", $idArticle);
        $request->bindValue(":comment_fk", $id);
        $request->bindValue(":user_fk", $idUser);
        $request->execute();
    }

    /**
     * Delete article
     * @param $id
     */
    public function supprArticle($id){
        $request = $this->db->prepare("DELETE FROM article WHERE id = :id");
        $request->bindValue(":id", $id);
        $request->execute();
    }

    /**
     * Delete comment
     * @param $id
     */
    public function removeComment($id){
        $request = $this->db->prepare("DELETE FROM comment WHERE id = :id");
        $request->bindValue(":id", $id);
        $request->execute();
    }

    /**
     * Modyfi a article to a selected article
     * @param $id
     * @param $content
     */
    public function modifArticle($id, $content){
        $request = $this->db->prepare("UPDATE article SET content = :content WHERE id = :id");
        $request->bindValue(":content", sanitize($content));
        $request->bindValue(":id", $id);
        $request->execute();
    }
}