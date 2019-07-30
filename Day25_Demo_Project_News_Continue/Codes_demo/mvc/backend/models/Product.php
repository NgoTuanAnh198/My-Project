<?php
require_once 'models/Model.php';
require_once 'helpers/Helper.php';

class Product extends Model
{
  const STATUS_ENABLED = 1;
  const STATUS_DISABLED = 0;

  /**
   * Lấy dữ liệu có phân trang
   * @param array $arrSearch Mảng các từ khóa search nếu có
   * @return array|null
   */
  public function getAllPagination()
  {
    $connection = $this->openConnection();
    $querySelect = "SELECT products.*, admins.username as admin_username, categories.name as category_name FROM products
                    INNER JOIN admins ON admins.id = products.admin_id
                    INNER JOIN categories ON categories.id = products.category_id
                    ORDER BY products.created_at DESC
                    LIMIT {$this->startpoint}, {$this->per_page}
                    ";
    $results = mysqli_query($connection, $querySelect);

    $products = [];
    if (mysqli_num_rows($results) > 0) {
      $products = mysqli_fetch_all($results, MYSQLI_ASSOC);
    }
    $this->closeConnection($connection);
    return $products;
  }

  /**
   * Hàm insert dữ liệu vào database
   * @param array $products Mảng products
   * @return bool|mysqli_result
   */
  public function insert($products = [])
  {
    $connection = $this->openConnection();
    $queryInsert = "INSERT INTO products
              (`category_id`, `admin_id`, `name`, `price`, `avatar`, `summary`, `content`, `status`)
        VALUES( 
        {$products['category_id']}, 
        {$products['admin_id']}, 
        '{$products['name']}', 
        {$products['price']}, 
        '{$products['avatar']}', 
        '{$products['summary']}', 
        '{$products['content']}', 
        {$products['status']})";
    $isInsert = mysqli_query($connection, $queryInsert);
    $this->closeConnection($connection);

    return $isInsert;
  }

  public function delete($id = 0)
  {
    $connection = $this->openConnection();
    $queryDelete = "DELETE FROM products WHERE id=$id";
    $isDelete = mysqli_query($connection, $queryDelete);
    $this->closeConnection($connection);
    return $isDelete;
  }

  public function getById($id)
  {
    $connection = $this->openConnection();
    //do bảng products có các khóa ngoại nên cần join các bảng liên quan để lấy các thông tin cần thiết
    $querySelect = "
        SELECT products.*, categories.name as category_name, admins.username as admin_username FROM products
        LEFT JOIN categories ON categories.id = products.category_id
        LEFT JOIN admins ON admins.id = products.admin_id
        WHERE products.id = $id";

    $results = mysqli_query($connection, $querySelect);
    $products = [];
    if (mysqli_num_rows($results) == 1) {
      $products = mysqli_fetch_all($results,
        MYSQLI_ASSOC);
      $products = $products[0];
    }

    return $products;
  }

  public function update($products = [])
  {
    $connection = $this->openConnection();
    $queryUpdate = "UPDATE products 
        SET 
            `category_id` = {$products["category_id"]},
            `admin_id` = {$products["admin_id"]},
            `name` = '{$products["name"]}',
            `price` = {$products["price"]},
            `summary` = '{$products["summary"]}',
            `content` = '{$products["content"]}',
            `status` = {$products["status"]}
        WHERE `id` = {$products['id']}";
    $isUpdate = mysqli_query($connection, $queryUpdate);
    $this->closeConnection($connection);
    return $isUpdate;
  }

}