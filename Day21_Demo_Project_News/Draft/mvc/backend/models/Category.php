<?php
require_once 'models/Model.php';

class Category extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    public $connection;

    /**
     * Truy vấn DB lấy toàn bộ category trong
     * table category
     * giả sử tên bảng của mình là categories
     */

    public function getAll()
    {

        // kết nối cơ sở dữ liệu
        $connection = $this->openConnection();  // $this tham chiếu đến đối tượng object
        //tạo câu truy vấn lấy toàn bộ dữ liệu trong bảng categories và thực thi truy vấn
        $querySelect = "SELECT * FROM categories ";
        $results = mysqli_query($connection, $querySelect);
        $categories = [];
        if (mysqli_num_rows($results) > 0) {
            $categories = mysqli_fetch_all($results, MYSQLI_ASSOC);
        }
        // sau khi thực thi thành công thì đóng kết nối
        $this->closeConnection($connection);
        return $categories;
    }

    public function getCategoriesById($id)
    {
        // mở kết nối
        $connection = $this->openConnection();
        // Tạo câu truy vấn lấy categories theo id truyền vào và thực thi câu truy vấn này
        $querySelect = "SELECT * FROM categories WHERE id = $id LIMIT 1";
        $results = mysqli_query($connection, $querySelect);
        $categories = [];
        if (mysqli_num_rows($results) > 0) {
            $categories = mysqli_fetch_all($results, MYSQLI_ASSOC);
            // do truy vấn này chỉ trả về đúng 1 bản ghi nên có thể set lại biến categories như sau
            $categories = $categories[0];
        }
        // đóng kết nối
        mysqli_close($connection);
        return $categories;
    }

    /**
     * Update dữ liệu categories
     * @param $categories array mảng categories
     * @return boolean TRUE nếu update thành công, ngược lại là FALSE
     */
    public function updateCategories($categories)
    {
        // mở kết nối
        $connection = $this->openConnection();
        $queryUpdate = "UPDATE categories SET  `name` = '{$categories['name']}',
                                                   `description`= '{$categories['description']}',
                                                     `avatar` =  '{$categories['avatar']}',
                                                     `status` =  '{$categories['status']}'
                                                WHERE id = {$categories['id']}";
        $isUpdate = mysqli_query($connection, $queryUpdate);
        // đóng kết nối
        mysqli_close($isUpdate);
        if ($isUpdate) {
            return true;
        }
        return false;
    }

    /**
     * Insert dữ liệu categories
     * @param $categories array mảng categories
     * @return boolean TRUE nếu insert thành công, ngược lại là FALSE
     */
    public function insertCategories($categories = [])
    {
        //mở kết nối
        $connection = $this->openConnection();
        $queryInsert = "INSERT INTO categories (`name`,`avatar`,`description`,`status`)
          VALUES ('{$categories['name']}',
                  '{$categories['avatar']}',
                  '{$categories['description']}',
                  {$categories['status']})";
        $isInsert = mysqli_query($connection, $queryInsert);
        // đóng kết nối
        mysqli_close($connection);
        if ($isInsert) {
            return true;
        }
        return false;
    }

    /**
     * Delete dữ liệu categories
     * @param $id integer id categories
     * @return boolean TRUE nếu insert thành công, ngược lại là FALSE
     */
    public function deleteCategories($id = 0)
    {
        // mở kết nối
        $connection = $this->openConnection();
        $queryDelete = "DELETE FROM categories WHERE id = $id";
        $isDelete = mysqli_query($connection, $queryDelete);
        $queryDeleteNews = "DELETE FROM news WHERE category_id = $id";
        mysqli_query($connection, $queryDeleteNews);
        //đóng kết nối
        mysqli_close($connection);
        if ($isDelete) {
            return true;
        }
        return false;
    }
}

?>