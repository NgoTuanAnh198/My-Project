<?php
require_once 'models/Model.php';

class Product extends Model
{
  const STATUS_ENABLED = 1;
  const STATUS_DISABLED = 0;

  /**
   * Lấy dữ liệu có phân trang
   * @param array $arrSearch Mảng các từ khóa search nếu có
   * @return array|null
   */
  public function getAll()
  {
    //do hiển thị theo cơ chế phân trang,
    //nên sẽ không lấy toàn bộ dữ liệu nữa
    // thay vào đó sẽ sử dung cơ chế limit (bản ghi bắt đầu lấy, lấy đến bản ghi nào)
    //ví dụ LIMIT (0, 5) lấy bản ghi ví trí đầu tiên đến ví trí thứ 4
    $connection = $this->openConnection();
    $querySelect = "SELECT products.*, admins.username as admin_username, categories.name as category_name FROM products
                    INNER JOIN admins ON admins.id = products.admin_id
                    INNER JOIN categories ON categories.id = products.category_id
                    ORDER BY products.created_at DESC
";
    $results = mysqli_query($connection, $querySelect);
    $products = [];
    if (mysqli_num_rows($results) > 0) {
      $products = mysqli_fetch_all($results, MYSQLI_ASSOC);
    }
    $this->closeConnection($connection);

    return $products;
  }


  public function getById($id)
  {
    $connection = $this->openConnection();
    //do bảng products có các khóa ngoại nên cần join các bảng liên quan để lấy các thông tin cần thiết
    $querySelect = "
        SELECT products.*, categories.name as category_name, admins.username as admin_username FROM products
        INNER JOIN categories ON categories.id = products.category_id
        INNER JOIN admins ON admins.id = products.admin_id
        WHERE products.id = $id";

    $results = mysqli_query($connection, $querySelect);
    $product = [];
    if (mysqli_num_rows($results) == 1) {
      $products = mysqli_fetch_all($results,
        MYSQLI_ASSOC);
      $product = $products[0];
    }

    return $product;
  }

}