<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';

class CartController extends Controller
{
    public function index()
    {

        require_once 'views/carts/index.php';
    }

    public function add() {
      //do trong file .htaccess đã bắt trường hợp chỉ cho phép id là số
//      nên ko cần bắt validate bằng code php tại đây
      $id = $_GET['id'];
      $urlCartList = $_SERVER['SCRIPT_NAME'];
      header("Location: $urlCartList/gio-hang-cua-ban");
      exit();
    }

    public function delete() {
//      $id = $_GET['id'];
    }
}