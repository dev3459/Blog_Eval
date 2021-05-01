<div class="container">
    <form method="post">
        <label for="title">45 caractères maximum</label>
        <input type="text" id="title" name="title" placeholder="Titre du post">
        <textarea name="content" id="content" placeholder="Message"></textarea>
        <input type="hidden" name="user" value="<?= $var["user"]->getId() ?>>">
        <input type="submit" value="Ajouter un article">
    </form>
</div>