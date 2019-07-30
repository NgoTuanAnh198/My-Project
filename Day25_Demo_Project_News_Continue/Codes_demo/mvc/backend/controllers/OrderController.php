<?php

require_once 'models/Order.php';
require_once 'controllers/Controller.php';

class OrderController extends Controller
{
  /**
   * Hiển thị danh sách các đơn hàng
   */
  public function index()
  {
    $orderModel = new Order();
    //sử dụng cơ chế phân trang
    $orders = $orderModel->getAllPagination();
    $pages = $orderModel->getPagination('orders');
    //truyền ra views
    require_once 'views/orders/index.php';
  }

  /**
   * Lấy thông tin chi tiết của đơn hàng, dựa vào id order truyền từ url
   */
  public function orderDetail() {
    if (!isset($_GET['order_id']) || !is_numeric($_GET['order_id'])) {
      $_SESSION['Tham số order id không hợp lệ'];
      header("Location: index.php");
      exit();
    }

    $order_id = $_GET['order_id'];
    //sử dụng cơ chế phân trang
    $orderModel = new Order();
    $orders = $orderModel->getAllOrderDetailPagination($order_id);
    $pages = $orderModel->getPagination('order_details');
    require_once 'views/orders/order_detail.php';
  }

}