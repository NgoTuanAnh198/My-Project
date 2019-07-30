<?php
require_once 'models/Model.php';

class Category extends Model
{
  const STATUS_ENABLED = 1;
  const STATUS_DISABLED = 0;

  public function getAllPagination()
  {
    //do hiển thị theo cơ chế phân trang,
    //nên sẽ không lấy toàn bộ dữ liệu nữa
    // thay vào đó sẽ sử dung cơ chế limit (bản ghi bắt đầu lấy, lấy đến bản ghi nào)
    //ví dụ LIMIT (0, 5) lấy bản ghi ví trí đầu tiên đến ví trí thứ 4
    $connection = $this->openConnection();
    $querySelect = "SELECT * FROM categories 
                    ORDER BY categories.created_at DESC
                    LIMIT {$this->startpoint}, {$this->per_page}";
    $results = mysqli_query($connection, $querySelect);
    $categories = [];
    if (mysqli_num_rows($results) > 0) {
      $categories = mysqli_fetch_all($results, MYSQLI_ASSOC);
    }
    $this->closeConnection($connection);

    return $categories;
  }

  public function getAll()
  {
    $connection = $this->openConnection();
    $querySelect = "SELECT * FROM categories";
    $results = mysqli_query($connection, $querySelect);
    $categories = [];
    if (mysqli_num_rows($results) > 0) {
      $categories = mysqli_fetch_all($results, MYSQLI_ASSOC);
    }
    $this->closeConnection($connection);

    return $categories;
  }


  public function getById($id)
  {
    $connection = $this->openConnection();
    $querySelect = "SELECT * FROM categories WHERE id = $id";
    $results = mysqli_query($connection, $querySelect);
    $category = [];
    if (mysqli_num_rows($results) == 1) {
      $categories = mysqli_fetch_all($results,
        MYSQLI_ASSOC);
      $category = $categories[0];
    }

    return $category;
  }


}