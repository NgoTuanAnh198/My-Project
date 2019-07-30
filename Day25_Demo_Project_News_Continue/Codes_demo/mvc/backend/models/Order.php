<?php
require_once 'models/Model.php';
require_once 'helpers/Helper.php';

class Order extends Model
{

  const PAYMENT_STATUS_DONE = 1; //đã thanh toán
  const PAYMENT_STATUS_DONE_TEXT = 'Đã thanh toán'; //đã thanh toán
  const PAYMENT_STATUS_UNDONE = 0; // chưa thanh toán
  const PAYMENT_STATUS_UNDONE_TEXT = 'Chưa thanh toán'; // chưa thanh toán
  /**
   * Lấy dữ liệu có phân trang
   *
   * @return array|null
   */
  public function getAllPagination()
  {
    //do hiển thị theo cơ chế phân trang,
    //nên sẽ không lấy toàn bộ dữ liệu nữa
    // thay vào đó sẽ sử dung cơ chế limit (bản ghi bắt đầu lấy, lấy đến bản ghi nào)
    //ví dụ LIMIT (0, 5) lấy bản ghi ví trí đầu tiên đến ví trí thứ 4
    $connection = $this->openConnection();
    $querySelect = "SELECT * FROM orders
                    ORDER BY updated_at, created_at DESC
                    LIMIT {$this->startpoint}, {$this->per_page}
                    ";
    $results = mysqli_query($connection, $querySelect);

    $orders = [];
    if (mysqli_num_rows($results) > 0) {
      $orders = mysqli_fetch_all($results, MYSQLI_ASSOC);
    }
    $this->closeConnection($connection);

    return $orders;
  }

  public function getAllOrderDetailPagination($order_id)
  {
    $connection = $this->openConnection();
    $querySelect = "SELECT order_details.*, products.name as product_name, products.price as product_price FROM orders
                    INNER JOIN order_details ON order_details.order_id = orders.id
                    INNER JOIN products ON products.id = order_details.product_id
                    WHERE orders.id = $order_id
                    LIMIT {$this->startpoint}, {$this->per_page}
                    ";
    $results = mysqli_query($connection, $querySelect);

    $orders = [];
    if (mysqli_num_rows($results) > 0) {
      $orders = mysqli_fetch_all($results, MYSQLI_ASSOC);
    }
    $this->closeConnection($connection);

    return $orders;
  }

}