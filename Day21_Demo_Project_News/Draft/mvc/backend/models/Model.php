<?php
require_once 'configs/database.php';
class Model {
    public function openConnection() {
        $connection = mysqli_connect
        (DB_HOST, DB_USERNAME,
            DB_PASSWORD, DB_NAME,
            DB_PORT);
        if (!$connection) {
            die("Không thể kết nối! Lỗi: " .
                mysqli_connect_error());
        }
        mysqli_query($connection, "SET NAMES 'utf8'");
        return $connection;
    }
    /**
     * Đóng kết nối mysqli
     * @param $connection
     */
    public function closeConnection($connection){
    mysqli_close($connection);
    }
}