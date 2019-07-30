<?php
/**
 * Created by PhpStorm.
 * User: nvmanh
 * Date: 7/16/2019
 * Time: 6:58 PM
 */
require_once 'models/Role.php';
require_once 'controllers/Controller.php';

class RoleController extends Controller
{
  /**
   * Phương thức xử lý hiển thị danh sách Role
   */
  public function index()
  {
    $roleModel = new Role();
    $roles = $roleModel->getAll();
    //truyền ra views
    require_once 'views/roles/index.php';
  }

  /**
   * Phương thức xử lý thêm mới Role
   */
  public function create()
  {
    //xử lý khi người dùng submit form
    if (isset($_POST['submit'])) {
      $name = $_POST['name'];
      $description = $_POST['description'];
      //xử lý validate, trường hợp user để trống name
//            của role thì báo lỗi
      if (empty($name)) {
        $_SESSION['error'] = 'Name không được để trống';
        require_once 'views/roles/create.php';
        return;
      }
      //khai báo mảng chưa các thông tin về categoey
      //để insert vào CSDL
      $role = [
        'name' => $name,
        'description' => $description,
      ];

      $roleModel = new Role();
      $isInsert = $roleModel->insert($role);
      if ($isInsert) {
        $_SESSION['success'] = 'Insert role thành công';
      } else {
        $_SESSION['error'] = 'Insert role thất bại';
      }
      header("Location: index.php?controller=role&action=index");
      exit();
    }
    require_once 'views/roles/create.php';
  }

  public function update()
  {
    //xử lý validate cho trường hợp
    //ko truyền id hoặc id không phải là số thì báo lỗi
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'Tham số ID không hợp lệ';
      header("Location: index.php?controller=role&action=index");
      exit();
    }

    $roleModel = new Role();
    $role = $roleModel->getById($_GET['id']);
    //xử lý khi người dùng submit form
    if (isset($_POST['submit'])) {
      $name = $_POST['name'];
      $description = $_POST['description'];
      //xử lý validate, trường hợp user để trống name
//            của role thì báo lỗi
      if (empty($name)) {
        $_SESSION['error'] = 'Name không được để trống';
        require_once 'views/roles/create.php';
        return;
      }
      //khai báo mảng chưa các thông tin về categoey
      //để insert vào CSDL
      $role = [
        'id' => $_GET['id'],
        'name' => $name,
        'description' => $description,
      ];

      $isUpdate= $roleModel->update($role);
      if ($isUpdate) {
        $_SESSION['success'] = 'Update role thành công';
      } else {
        $_SESSION['error'] = 'Update role thất bại';
      }
      header("Location: index.php?controller=role&action=index");
      exit();
    }
    require_once 'views/roles/update.php';
  }

  public function delete()
  {
    //xử lý validate cho trường hợp
    //ko truyền id hoặc id không phải là số thì báo lỗi
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'Tham số ID không hợp lệ';
      header("Location: index.php?controller=role&action=index");
      exit();
    }

    $id = $_GET['id'];
    $roleModel = new Role();
    $isDelete = $roleModel->delete($id);
    if ($isDelete) {
      $_SESSION['success'] = "Xóa bản ghi #$id thành công";
    } else {
      $_SESSION['error'] = "Xóa bản ghi #$id thất bại";
    }

    header("Location: index.php?controller=role&action=index");
    exit();
  }

  public function detail()
  {
    //xử lý validate cho trường hợp
    //ko truyền id hoặc id không phải là số thì báo lỗi
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'Tham số ID không hợp lệ';
      header("Location: index.php?controller=role&action=index");
      exit();
    }

    $id = $_GET['id'];
    //truy vấn để lấy ra dữ liệu tương ứng với category
//        theo id vừa bắt được
    $roleModel = new Role();
    $role = $roleModel->getById($id);
    require_once 'views/roles/detail.php';
  }

}