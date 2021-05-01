<div id="container" data-id = "<?= $var["id"] ?>">
    <div id="article">
        <h2><?= $var["article"]->getTitle() ?></h2>
        <h3 class="date"><?= "Publié le " . $var["article"]->getDate() ?></h3>
        <hr>
        <p id="content"><?= $var["article"]->getContent() ?></p>
        <?php
        if($var["user"]->getAdmin() === 1){ ?>
            <i id="change" class="far fa-edit"></i><?php
        }
        ?>
    </div>
    <div id="commentary">
        <h2>Commentaires</h2>
        <form>
            <div>
                <input type="hidden" id="user" value="<?= $var["user"]->getId() ?>" >
                <textarea id="changeComment"></textarea>
            </div>
            <div>
                <input id="submit" type="submit" value="Ajouter">
            </div>
        </form>

        <div id="containerCommentary"></div>
    </div>
</div>
<script src="/assets/js/comment.js"></script>