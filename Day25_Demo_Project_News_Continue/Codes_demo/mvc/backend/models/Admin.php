<?php
require_once 'models/Model.php';
require_once 'helpers/Helper.php';

class Admin extends Model
{

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
        $querySelect = "SELECT admins.*, roles.id as role_id, roles.name as role_name FROM admins
                    LEFT JOIN roles ON roles.id = admins.role_id
                    ORDER BY admins.created_at DESC
                    LIMIT {$this->startpoint}, {$this->per_page}
                    ";
        $results = mysqli_query($connection, $querySelect);

        $admins = [];
        if (mysqli_num_rows($results) > 0) {
            $admins = mysqli_fetch_all($results, MYSQLI_ASSOC);
        }
        $this->closeConnection($connection);

        return $admins;
    }

    /**
     * Hàm insert dữ liệu vào database
     * @param array $admins Mảng admins
     * @return bool|mysqli_result
     */
    public function insert($admin = [])
    {
        $connection = $this->openConnection();
        $queryInsert = "INSERT INTO admins
              (`role_id`, `username`, `password`)
        VALUES( 
        {$admin['role_id']}, 
        '{$admin['username']}', 
        '{$admin['password']}'
        )";
        $isInsert = mysqli_query($connection, $queryInsert);
        $this->closeConnection($connection);

        return $isInsert;
    }

    public function delete($id = 0)
    {
        $connection = $this->openConnection();
        $queryDelete = "DELETE FROM admins WHERE id=$id";
        $isDelete = mysqli_query($connection, $queryDelete);
//    do trong bảng news có liên kết đến bảng admin qua trường admin_id,
//    nên khi xóa admin thì cần xóa các bản ghi tin tức mà do admin này tạo ra
        $queryDeleteNews = "DELETE FROM news WHERE admin_id = $id";
        mysqli_query($connection, $queryDeleteNews);
        $this->closeConnection($connection);

        return $isDelete;
    }

    public function getById($id)
    {
        $connection = $this->openConnection();
        //do bảng admins có  khóa ngoại role_id nên cần join các bảng roles để lấy các thông tin cần thiết
        $querySelect = "
        SELECT admins.*, roles.name as role_name, roles.name as role_name FROM admins
        LEFT JOIN roles ON roles.id = admins.role_id
        WHERE admins.id = $id";

        $results = mysqli_query($connection, $querySelect);
        $admin = [];
        if (mysqli_num_rows($results) == 1) {
            $admin = mysqli_fetch_all($results,
                MYSQLI_ASSOC);
            $admin = $admin[0];
        }

        return $admin;
    }

    public function update($admin = [])
    {
        $connection = $this->openConnection();
        $queryUpdate = "UPDATE admins 
        SET `role_id` = {$admin["role_id"]},
            `username` = '{$admin["username"]}',
            `password` = '{$admin["password"]}'
        WHERE `id` = {$admin['id']}";

        $isUpdate = mysqli_query($connection, $queryUpdate);
        $this->closeConnection($connection);
        return $isUpdate;
    }

    /**
     * Lấy đối tượng admin dựa vào username và password
     * @param array $admin
     * @return array|null
     */
    public function getAdminLogin($admin = [])
    {
        $connection = $this->openConnection();
        $querySelect = "
                    SELECT * FROM admins 
                    WHERE `username` = '{$admin['username']}' AND `password` = '{$admin['password']}' LIMIT 1";
        $results = mysqli_query($connection, $querySelect);
        $adminArr = [];
        if (mysqli_num_rows($results) == 1) {
            $adminArr = mysqli_fetch_all($results, MYSQLI_ASSOC);
            $adminArr = $adminArr[0];
        }

        return $adminArr;
    }

}