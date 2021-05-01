<?php
namespace Controller;

use Controller\Traits\RenderViewTrait;

class UserController {

    use RenderViewTrait;

    /**
     * Displays the login page.
     */
    public function connexionPage() {
        $var = [];
        if(isset($_GET["error"])) {
            if(isset($_GET["color"])){
                $color = $_GET["color"];
            }
            else{
                $color = "red";
            }
            $var = ["error" => $_GET["error"], "color" => $color];
        }

        $this->render('connexion', 'Connexion', ['menu', 'connexion'], null, $var);
    }
}