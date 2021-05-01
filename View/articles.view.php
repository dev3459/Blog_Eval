<div class="articles">
    <div id="btnAddArticle">
        <a href="?controller=articles&action=new">Créer un nouveau post</a>
    </div>
<?php
    if(isset($var['articles'])) {
        foreach ($var['articles'] as $article) { ?>
            <a class="articleSelect" href="?controller=articles&action=show&article=<?= $article->getId() ?>">
                <article data-id= <?= $article->getId() ?>>
                    <h2><?= $article->getTitle() ?></h2>
                    <h3 class="date"><?= $article->getDate() ?></h3>
                    <hr>
                    <?php
                        echo '<span class="paraph">';
                            echo strlen($article->getContent()) > 700 ?
                                substr($article->getContent(), 0, 700). "<span class='voirPlus'>... Voir plus</span>":
                                $article->getContent();
                        echo '</span>';
                    ?>
                    <span class="author">publié par <?= $article->getUser()->getUsername() ?></span><?php
                    if($_SESSION["user"]->getAdmin() === 1){?>
                        <span class="close"><i class="fas fa-times"></i></span>
                    <?php } ?>
                </article>
            </a>
        <?php
        }
    } 
?>
</div>