<?php
require_once 'controllers/Controller.php';
class UserController extends Controller {
    public function profile() {
        require_once 'views/users/profile.php';
    }
}