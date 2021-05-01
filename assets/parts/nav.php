<div id="menu">
    <ul>
        <li><a href="?controller=articles">Blog</a></li>
        <?php if(isset($_SESSION["user"]) && !is_string($_SESSION["user"])){ ?>
            <li><a href="../../deconnexion.php">Déconnexion</a></li><?php
        } else { ?>
            <li><a href="/">Connexion</a></li><?php
        }
        ?>
    </ul>
</div>