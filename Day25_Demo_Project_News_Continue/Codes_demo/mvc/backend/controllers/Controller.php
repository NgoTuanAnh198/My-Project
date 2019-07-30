<?php
/**
 * Created by PhpStorm.
 * User: nvmanh
 * Date: 7/12/2019
 * Time: 9:21 AM
 */

class Controller
{
  //Title của trang
  public $pageTitle = 'Title của trang';

  public function __construct()
  {
    //cần check bảo mật, nếu user chưa đăng nhập mà click vào các url đã biết thì
//        cần chuyển hướng về trang login, bắt buộc phải đăng nhập
    //tuy nhiên cần loại trừ controller là admin và action là login thì mới chuyển hướng
    if (!isset($_SESSION['admin']) && $_GET['action'] != 'login') {
      $_SESSION['error'] = "Bạn cần đăng nhập để sử dụng hệ thống";
      header("Location: index.php?controller=admin&action=login");
      exit();
    }
  }
}