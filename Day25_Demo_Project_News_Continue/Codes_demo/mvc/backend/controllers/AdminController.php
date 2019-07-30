<?php
/**
 * Created by PhpStorm.
 * User: nvmanh
 * Date: 7/16/2019
 * Time: 6:58 PM
 */
require_once 'models/Admin.php';
require_once 'models/Role.php';
require_once 'controllers/Controller.php';

class AdminController extends Controller
{
    /**
     * Phương thức xử lý hiển thị danh sách Admin
     */
    public function index()
    {
        //truy vấn lấy ra tất cả dữ liệu trong table
//        categories
        $adminModel = new Admin();
        $admins = $adminModel->getAllPagination();
        //hàm lấy phân trang
        $pages = $adminModel->getPagination('admins');
        //truyền ra views
        require_once 'views/admins/index.php';
    }

    /**
     * Phương thức xử lý thêm mới Admin
     */
    public function create()
    {
        $rolesModel = new Role();
        $roles = $rolesModel->getAll();

        //xử lý khi người dùng submit form
        if (isset($_POST['submit'])) {
            $role_id = $_POST['role_id'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];

            //validate trường hợp không nhập username hoặc password
            if (empty($username) || empty($password)) {
                $_SESSION['error'] = 'Username hoặc password không được để trống';
                require_once 'views/admins/create.php';
                return;
            }

            //validate trường hợp confirm password không đúng
            if ($password != $password_confirm) {
                $_SESSION['error'] = 'Password nhập lại chưa đúng';
                require_once 'views/admins/create.php';
                return;
            }
            //khai báo mảng chưa các thông tin về categoey
            //để insert vào CSDL
            $admin = [
                'role_id' => $role_id,
                'username' => $username,
                //sử dụng mã hóa md5 cho password
                'password' => md5($password),
            ];

            $adminModel = new Admin();
            $isInsert = $adminModel->insert($admin);
            if ($isInsert) {
                $_SESSION['success'] = 'Insert admin thành công';
            } else {
                $_SESSION['error'] = 'Insert admin thất bại';
            }
            header("Location: index.php?controller=admin&action=index");
            exit();
        }
        require_once 'views/admins/create.php';
    }

    public function update()
    {
        //xử lý validate cho trường hợp
        //ko truyền id hoặc id không phải là số thì báo lỗi
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'Tham số ID không hợp lệ';
            header("Location: index.php?controller=admin&action=index");
            exit();
        }
        $id = $_GET['id'];
        $rolesModel = new Role();
        $roles = $rolesModel->getAll();
        $adminModel = new Admin();
        $admin = $adminModel->getById($id);
        //xử lý khi người dùng submit form
        if (isset($_POST['submit'])) {
            $role_id = $_POST['role_id'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];

            //validate trường hợp không nhập username hoặc password
            if (empty($username) || empty($password)) {
                $_SESSION['error'] = 'Username hoặc password không được để trống';
                require_once 'views/admins/update.php';
                return;
            }

            //validate trường hợp confirm password không đúng
            if ($password != $password_confirm) {
                $_SESSION['error'] = 'Password nhập lại chưa đúng';
                require_once 'views/admins/update.php';
                return;
            }
            //khai báo mảng chưa các thông tin về categoey
            //để insert vào CSDL
            $admin = [
                'id' => $id,
                'role_id' => $role_id,
                'username' => $username,
                //sử dụng mã hóa md5 cho password
                'password' => md5($password),
            ];

            $isUpdate = $adminModel->update($admin);
            if ($isUpdate) {
                $_SESSION['success'] = 'Update admin thành công';
            } else {
                $_SESSION['error'] = 'Update admin thất bại';
            }
            header("Location: index.php?controller=admin&action=index");
            exit();
        }
        require_once 'views/admins/update.php';
    }

    public function delete()
    {
        //xử lý validate cho trường hợp
        //ko truyền id hoặc id không phải là số thì báo lỗi
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'Tham số ID không hợp lệ';
            header("Location: index.php?controller=admin&action=index");
            exit();
        }

        $id = $_GET['id'];
        $adminModel = new Admin();
        $isDelete = $adminModel->delete($id);
        if ($isDelete) {
            $_SESSION['success'] = "Xóa bản ghi #$id thành công";
        } else {
            $_SESSION['error'] = "Xóa bản ghi #$id thất bại";
        }

        header("Location: index.php?controller=admin&action=index");
        exit();
    }

    public function detail()
    {
        //xử lý validate cho trường hợp
        //ko truyền id hoặc id không phải là số thì báo lỗi
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'Tham số ID không hợp lệ';
            header("Location: index.php?controller=admin&action=index");
            exit();
        }

        $id = $_GET['id'];
        $adminModel = new Admin();
        $admin = $adminModel->getById($id);
        require_once 'views/admins/detail.php';
    }

    public function login() {
        //trường hợp admin đã đăng nhập thành công rồi,
//        thì không cho phép họ truy cập lại link login nữa
        //mà chuyển hướng họ về trang danh sách tin tức
        if (isset($_SESSION['admin'])) {
            header("Location: index.php?controller=news&action=index");
            exit();
        }
        //xử lý submit form khi click nút Login
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            //validate trường hợp không nhập username hoặc password
            if (empty($username) || empty($password)) {
                $_SESSION['error'] = 'Username hoặc password không được để trống';
                require_once 'views/admins/login.php';
                return;
            }

            $admin = [
                'username' => $username,
                //do password đang lưu trong bảng admins dưới dạng mã hóa md5
                //nên cần sử dung hàm md5 để mã hóa
                'password' => md5($password),
            ];

            $adminModel = new Admin();
            $adminLogin = $adminModel->getAdminLogin($admin);
            if (!empty($adminLogin)) {
                $_SESSION['success'] = 'Đăng nhập thành công';
                //điều quan trọng nhất sau khi login thành công
                //là tạo session quy định riêng cho việc đã login thành công này
                $_SESSION['admin'] = $adminLogin;
                //chuyển hướng người dùng tới trang danh sách tin tức
                header("Location: index.php?controller=news&action=index");
                exit();
            }
            else {
                $_SESSION['error'] = 'Sai tài khoản hoặc mật khẩu';
                require_once 'views/admins/login.php';
            }
        }
        require_once 'views/admins/login.php';
    }

    public function logout() {
//        session_destroy();
        //xóa session liên quan đến admin đã khởi tạo khi login thành công
        unset($_SESSION['admin']);
        $_SESSION['success'] = "Logout thành công";
        //chuyển hướng về trang login
        header("Location: index.php?controller=admin&action=login");
        exit();
    }

}