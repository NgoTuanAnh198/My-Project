<?php
require_once 'models/Model.php';
require_once 'helpers/Helper.php';

class News extends Model
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
    //do hiển thị theo cơ chế phân trang,
    //nên sẽ không lấy toàn bộ dữ liệu nữa
    // thay vào đó sẽ sử dung cơ chế limit (bản ghi bắt đầu lấy, lấy đến bản ghi nào)
    //ví dụ LIMIT (0, 5) lấy bản ghi ví trí đầu tiên đến ví trí thứ 4
    $connection = $this->openConnection();
    $querySelect = "SELECT news.*, admins.username as admin_username, categories.name as category_name FROM news
                    LEFT JOIN admins ON admins.id = news.admin_id
                    LEFT JOIN categories ON categories.id = news.category_id
                    {$this->querySearch}
                    ORDER BY news.created_at DESC
                    LIMIT {$this->startpoint}, {$this->per_page}
";
    $results = mysqli_query($connection, $querySelect);

    $news = [];
    if (mysqli_num_rows($results) > 0) {
      $news = mysqli_fetch_all($results, MYSQLI_ASSOC);
    }
    $this->closeConnection($connection);

    return $news;
  }

  /**
   * Hàm insert dữ liệu vào database
   * @param array $news Mảng news
   * @return bool|mysqli_result
   */
  public function insert($news = [])
  {
    $connection = $this->openConnection();
    $queryInsert = "INSERT INTO news
              (`title`, `category_id`, `admin_id`, `avatar`, `summary`, `content`, `comment_total`, `like_total`, `status`)
        VALUES('{$news['title']}', 
        {$news['category_id']}, 
        {$news['admin_id']}, 
        '{$news['avatar']}', 
        '{$news['summary']}', 
        '{$news['content']}', 
        {$news['comment_total']},
        {$news['like_total']},
        {$news['status']})";

    $isInsert = mysqli_query($connection, $queryInsert);
    $this->closeConnection($connection);

    return $isInsert;
  }

  public function delete($id = 0)
  {
    $connection = $this->openConnection();
    $queryDelete = "DELETE FROM news WHERE id=$id";
    $isDelete = mysqli_query($connection, $queryDelete);
    $this->closeConnection($connection);
    return $isDelete;
  }

  public function getById($id)
  {
    $connection = $this->openConnection();
    //do bảng news có các khóa ngoại nên cần join các bảng liên quan để lấy các thông tin cần thiết
    $querySelect = "
        SELECT news.*, categories.name as category_name, admins.username as admin_username FROM news
        LEFT JOIN categories ON categories.id = news.category_id
        LEFT JOIN admins ON admins.id = news.admin_id
        WHERE news.id = $id";

    $results = mysqli_query($connection, $querySelect);
    $news = [];
    if (mysqli_num_rows($results) == 1) {
      $news = mysqli_fetch_all($results,
        MYSQLI_ASSOC);
      $news = $news[0];
    }

    return $news;
  }

  public function update($news = [])
  {
    $connection = $this->openConnection();
    $queryUpdate = "UPDATE news 
        SET `title` = '{$news["title"]}',
            `category_id` = {$news["category_id"]},
            `admin_id` = {$news["admin_id"]},
            `avatar` = '{$news["avatar"]}',
            `summary` = '{$news["summary"]}',
            `content` = '{$news["content"]}',
            `comment_total` = {$news["comment_total"]},
            `like_total` = {$news["like_total"]},
            `status` = {$news["status"]}
        WHERE `id` = {$news['id']}";
    $isUpdate = mysqli_query($connection, $queryUpdate);
    $this->closeConnection($connection);
    return $isUpdate;
  }

}