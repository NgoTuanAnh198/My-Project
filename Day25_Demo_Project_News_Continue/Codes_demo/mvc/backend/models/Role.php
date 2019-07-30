<?php
require_once 'models/Model.php';
require_once 'helpers/Helper.php';

class Role extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * Lấy dữ liệu có phân trang
     *
     * @return array|null
     */
    public function getAll()
    {
        $connection = $this->openConnection();
        $querySelect = "SELECT * FROM roles";
        $results = mysqli_query($connection, $querySelect);

        $roles = [];
        if (mysqli_num_rows($results) > 0) {
            $roles = mysqli_fetch_all($results, MYSQLI_ASSOC);
        }
        $this->closeConnection($connection);

        return $roles;
    }

    /**
     * Hàm insert dữ liệu vào database
     * @param array $role Mảng role
     * @return bool|mysqli_result
     */
    public function insert($role = [])
    {
        $connection = $this->openConnection();
        $queryInsert = "
                  INSERT INTO roles(`name`, `description`)
                  VALUES(
                  '{$role['name']}', 
                  '{$role['description']}'
                  )";
        $isInsert = mysqli_query($connection, $queryInsert);
        $this->closeConnection($connection);

        return $isInsert;
    }

    public function delete($id = 0)
    {
        $connection = $this->openConnection();
        $queryDelete = "DELETE FROM roles WHERE id=$id";
        $isDelete = mysqli_query($connection, $queryDelete);
        //Chú ý, khi xóa dữ liệu ở bảng roles, cần xóa các dữ liệu admin mà đang có role bị xóa tại bảng admins
        $queryDeleteAdmin = "DELTE FROM admins WHERE role_id = $id";
        mysqli_query($connection, $queryDeleteAdmin);
        $this->closeConnection($connection);
        return $isDelete;
    }

    public function getById($id)
    {
        $connection = $this->openConnection();
        $querySelect = "
        SELECT * FROM roles WHERE roles.id = $id";
        $results = mysqli_query($connection, $querySelect);
        $role = [];
        if (mysqli_num_rows($results) == 1) {
            $role = mysqli_fetch_all($results,
                MYSQLI_ASSOC);
            $role = $role[0];
        }

        return $role;
    }

    public function update($role = [])
    {
        $connection = $this->openConnection();
        $queryUpdate = "
        UPDATE roles 
        SET `name` = '{$role["name"]}',
            `description` = '{$role["description"]}'
        WHERE `id` = {$role['id']}";
        $isUpdate = mysqli_query($connection, $queryUpdate);
        $this->closeConnection($connection);
        return $isUpdate;
    }

}