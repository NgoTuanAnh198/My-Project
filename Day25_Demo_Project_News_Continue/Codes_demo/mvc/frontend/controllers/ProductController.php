<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';

class ProductController extends Controller
{
    public function detail()
    {
        $id = $_GET['id'];
        $productModel = new Product();
        $product = $productModel->getById($id);
        require_once 'views/products/detail.php';
    }
}