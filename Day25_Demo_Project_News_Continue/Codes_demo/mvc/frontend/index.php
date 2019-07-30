<?php
session_start();
//FILE GỐC CỦA ỨNG DỤNG
//nhiệm vụ chính của file index.php
//là gọi (import) đúng controller
//dựa vào tham số trên trình duyệt
//Các tham số trên trình duyệt bắt buộc
//bạn phải tự định nghĩa từ trước
//quy định url có dạng sau
//index.php?controller=<tên-controller>&action=<tên-action>
//Các bươc
//1 - Lấy các tham số tương ứng từ url
$controller = isset($_GET['controller']) ?
    $_GET['controller'] : 'home';
$action = isset($_GET['action']) ?
    $_GET['action'] : 'index';

//mục đích chính là làm sao import được đúng controller
//dựa vào tham số truyền từ trình duyệt
//echo '<pre>';
//echo $controller . "/$action";
//do tên controller bắt đầu bằng chữ hoa
//nên cần dùng hàm ucfirst để chuyển
$controller = ucfirst($controller);
//nối thêm chuỗi Controller để giống tên class
//của controller
$controllerClass = $controller . "Controller";
//echo $controller;

//nếu file controller tồn tại thì mới import
$pathController = "controllers/$controllerClass.php";
if (!file_exists($pathController)) {
    die("Trang bạn tìm không tồn tại");
}
//import file controller
require_once $pathController;
$object = new $controllerClass;
//sau khi khởi tạo đối tượng thành công,
//gọi action đã bắt được từ url
//trước khi gọi cần kiểm tra xem controller đó
//có action đó hay chưa
if (!method_exists($object, $action)) {
    die("Phương thức $action không tồn tại");
}
$object->$action();