<?php
require_once 'models/Model.php';

class News extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    public $connection;

    /**
     * Truy vấn DB lấy toàn bộ news trong
     * table news
     * giả sử tên bảng của mình là news
     */
    public function getAll()
    {
        $connection = $this->openConnection();
        $querySelect = "SELECT * FROM news ORDER BY created_at DESC ";
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

    public function getNewsById($id)
    {
        // Mở kết nối
        $connection = $this->openConnection();
        // tạo câu truy vấn lấy news theo id truyền vào và thực thi câu truy vấn này
        $querySelect = "SELECT * FROM news where id=$id LIMIT 1"; //LIMIT 1 Giới hạn 1 giá trị
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
     */
    public function insertNews($news=[])
    {
        // mở kết nối
        $connection = $this->openConnection();
        $queryInsert = "INSERT INTO news(`tittle`,`summary`,`content'`,`comment_total`,`like_total`,`status`) 
              VALUES ('{$news['title']}',
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