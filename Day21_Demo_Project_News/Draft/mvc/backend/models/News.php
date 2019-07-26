<?php
require_once 'models/Model.php';
//require_once 'helpers/Helper.php';

class News extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    public $connection;

    /**
     * Truy vấn DB lấy toàn bộ news trong
     * table news
     * giả sử tên bảng của mình là news
     * success
     */
    public function getAll()  //success
    {
        $connection = $this->openConnection();
        $querySelect = "SELECT news.*, admins.username as admin_username, categories.name as category_name FROM news
                    LEFT JOIN admins ON admins.id = news.admin_id
                    LEFT JOIN categories ON categories.id = news.category_id
                    {$this->querySearch}
                    ORDER BY news.created_at DESC
//                    LIMIT {$this->startpoint}, {$this->per_page}";

        $results = mysqli_query($connection, $querySelect);
        $news = [];
        if (mysqli_num_rows($results) > 0) {
            $news = mysqli_fetch_all($results,
                MYSQLI_ASSOC);
        }
        //sau khi thực thi thành công thì đóng kết nối
        $this->closeConnection($connection);
        return $news;
    }

    public function getNewsById($id)  //success
    {
        // Mở kết nối
        $connection = $this->openConnection();
        //do bảng news có các khóa ngoại nên cần join các bảng liên quan để lấy các thông tin cần thiết
        $querySelect = "
        SELECT news.*, categories.name as category_name, admins.username as admin_username FROM news
        LEFT JOIN categories ON categories.id = news.category_id
        LEFT JOIN admins ON admins.id = news.admin_id
        WHERE news.id = $id";

        $result = mysqli_query($connection, $querySelect);
        $news = [];
        if (mysqli_num_rows($result) > 0) {
            $news = mysqli_fetch_all($result, MYSQLI_ASSOC);
            // Do truy vấn này chỉ trả về đúng 1 bản ghi nên có thể set lại biến news như sau:
            $news = $news[0];
        }
        //đóng kết nối
        mysqli_close($connection);
        return $news;
    }

    /**
     * Update dữ liệu news
     * @param $news array mảng news
     * @return boolean TRUE nếu update thành công, ngược lại là FALSE
     */
    public function updateNews($news)
    {
        //mở kết nối
        $connection = $this->openConnection();
        $queryUpdate = "UPDATE news SET NAME = '{$news['title']}' where id = {$news['id']}";
        $isUpdate = mysqli_query($connection, $queryUpdate);

        //đóng kết nối
        mysqli_close($connection);
        if ($isUpdate) {
            return true;
        }
        return false;
    }

    /**
     * Insert dữ liệu news
     * @param $news array mảng news
     * @return boolean TRUE nếu insert thành công, ngược lại là FALSE
     * success
     */
    public function insertNews($news = [])
    {
        // mở kết nối
        $connection = $this->openConnection();
        $queryInsert = "INSERT INTO news(`title`,`category_id`,`admin_id`,`avatar`,`summary`,`content`,`comment_total`,`like_total`,`status`) 
              VALUES ('{$news['title']}',
                    '{$news['category_id']}',
                    '{$news['admin_id']}',
                    '{$news['avatar']}',
                    '{$news['summary']}',
                    '{$news['content']}',
                    {$news['comment_total']},
                    {$news['like_total']},
                    {$news['status']})";
        $isInsert = mysqli_query($connection, $queryInsert);

        //đóng kết nối
        mysqli_close($connection);
        if ($isInsert) {
            return true;
        }
        return false;
    }

    /**
     * Xóa dữ liệu news
     * @param $id integer id news
     * @return boolean TRUE nếu delete thành công, ngược lại là FALSE
     * success
     */
    public function deleteNews($id)
    {
        // mở kết nối
        $connection = $this->openConnection();
        $queryDelete = "DELETE FROM news WHERE id = $id";
        $isDelete = mysqli_query($connection, $queryDelete);
        // đóng kết nối
        mysqli_close($connection);
        if ($isDelete) {
            return true;
        }
        return false;
    }
}