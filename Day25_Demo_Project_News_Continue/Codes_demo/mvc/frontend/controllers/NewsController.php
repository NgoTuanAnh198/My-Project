<?php
require_once 'controllers/Controller.php';
require_once 'models/News.php';

class NewsController extends Controller
{
    public function detail()
    {
//      echo "<pre>";
//      print_r($_GET);
//      die;
        $id = $_GET['id'];
        $newsModel = new News();
        $news = $newsModel->getById($id);
//              echo "<pre>";
//      print_r($news);
//      die;
        require_once 'views/news/detail.php';
    }
}