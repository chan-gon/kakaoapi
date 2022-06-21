<?php

class config {
    private $REST_API_KEY;
    private $REDIRECT_URI;
    private $CLIENT_SECRET;

    public function __construct() {
        $this->REST_API_KEY = "fd8a555ed7deb0580382fff0f0319be2";
        $this->REDIRECT_URI = "http://localhost:85/login/callback.php";
        $this->CLIENT_SECRET = "ZGf4V2WXcXnllZDxkx5K3dNJk12AkJtO";
    }
}
?>