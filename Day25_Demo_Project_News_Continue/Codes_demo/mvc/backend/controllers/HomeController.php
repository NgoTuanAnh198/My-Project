<?php
require_once 'controllers/Controller.php';
class HomeController extends Controller {
    public function show() {
        require_once 'views/homes/show.php';
    }
}