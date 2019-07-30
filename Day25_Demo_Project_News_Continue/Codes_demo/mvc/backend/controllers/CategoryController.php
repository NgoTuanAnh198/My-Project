<?php
/**
 * Created by PhpStorm.
 * User: nvmanh
 * Date: 7/16/2019
 * Time: 6:58 PM
 */
require_once 'models/Category.php';
require_once 'controllers/Controller.php';

class CategoryController extends Controller
{
  /**
   * Phương thức xử lý hiển thị danh sách category
   */
  public function index()
  {
    //truy vấn lấy ra tất cả dữ liệu trong table
//        categories
    $categoryModel = new Category();
    $categories = $categoryModel->getAllPagination();
    //lấy phân trang
    $pages = $categoryModel->getPagination('categories');
    require_once 'views/categories/index.php';
  }

  /**
   * Phương thức xử lý thêm mới category
   */
  public function create()
  {
    //xử lý khi người dùng submit form
    if (isset($_POST['submit'])) {
      $name = $_POST['name'];
      $description = $_POST['description'];
      $status = $_POST['status'];
      $avatarArr = $_FILES['avatar'];
//            echo '<pre>';
//            print_r($avatarArr);
//            die;
      //xử lý validate, trường hợp user để trống name
//            của category thì báo lỗi
      if (empty($name)) {
        $_SESSION['error'] = 'Name không được để trống';
        require_once 'views/categories/create.php';
        return;
      }
      //validate cho trường hợp có ảnh đc upload lên
      if ($avatarArr['size'] > 0 && $avatarArr['error'] == 0) {
        $extension = pathinfo($avatarArr['name'],
          PATHINFO_EXTENSION);
        //xử lý trường hợp upload ko phải dạng ảnh
        if (!in_array($extension, ['jpg', 'gif', 'png', 'jpeg'])) {
          $_SESSION['error'] = "Cần upload định dạng ảnh";
          $isError = 1;
          require_once 'views/categories/create.php';
          return;
        } else if ($avatarArr['size'] > 2 * 1024 * 1024) {
          $_SESSION['error'] = "Dung lượng ảnh tối đa có thể upload là 2Mb";
          require_once 'views/categories/create.php';
          return;
        }

      }
      $avatar = '';
      //nếu user có thao tác upload ảnh,
//            thì xử lý upload
      if ($avatarArr['size'] > 0 && $avatarArr['error'] == 0) {
        $dirUpload = '/uploads';
        //khai báo thư mục có tên uploads, nằm trong thư mục
//                assets, dùng để chứa các file được upload lên
        $absolutePathUpload = __DIR__ . '/../assets' . $dirUpload;
        if (!file_exists($absolutePathUpload)) {
          mkdir($absolutePathUpload);
        }
        //sửa lại tên file để đảm bảo tính duy nhất
//                cho từng file đc upload
        $fileName = 'category-' . time() . $avatarArr['name'];
        $isUpload = move_uploaded_file($avatarArr['tmp_name'],
          $absolutePathUpload . '/' . $fileName);
//                nếu upload thành công thì mới lưu tên ảnh vào trường avatar
        if ($isUpload) {
          $avatar = $fileName;
        }
      }
      //khai báo mảng chưa các thông tin về categoey
      //để insert vào CSDL
      $category = [
        'name' => $name,
        //trường avatar sẽ đưuọc sinh ra
        //sau khi upload file thành công
        'avatar' => $avatar,
        'description' => $description,
        'status' => $status,
      ];

      $categoryModel = new Category();
      $isInsert = $categoryModel->insert($category);
      if ($isInsert) {
        $_SESSION['success'] = 'Insert thành công';
      } else {
        $_SESSION['error'] = 'Insert thất bại';
      }
      header("Location: index.php?controller=category&action=index");
      exit();


//            echo '<pre>';
//            print_r($_POST);

    }
    require_once 'views/categories/create.php';
  }

  public function update()
  {
    //xử lý validate cho trường hợp
    //ko truyền id hoặc id không phải là số thì báo lỗi
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'Tham số ID không hợp lệ';
      header("Location: index.php");
      exit();
    }

    $id = $_GET['id'];
    //truy vấn để lấy ra dữ liệu tương ứng với category
//        theo id vừa bắt được
    $categoryModel = new Category();
    $category = $categoryModel->getById($id);
//        echo '<pre>';
//        print_r($category);
//        die;
    //xử lý khi người dùng submit form
    if (isset($_POST['submit'])) {
      $name = $_POST['name'];
      $description = $_POST['description'];
      $status = $_POST['status'];
      $avatarArr = $_FILES['avatar'];
      //xử lý validate, trường hợp user để trống name
//            của category thì báo lỗi
      if (empty($name)) {
        $_SESSION['error'] = 'Name không được để trống';
        require_once 'views/categories/update.php';
        return;
      }
      //validate cho trường hợp có ảnh đc upload lên
      if ($avatarArr['size'] > 0 && $avatarArr['error'] == 0) {
        $extension = pathinfo($avatarArr['name'],
          PATHINFO_EXTENSION);
        //xử lý trường hợp upload ko phải dạng ảnh
        if (!in_array($extension, ['jpg', 'gif', 'png', 'jpeg'])) {
          $_SESSION['error'] = "Cần upload định dạng ảnh";
          $isError = 1;
          require_once 'views/categories/update.php';
          return;
        } else if ($avatarArr['size'] > 2 * 1024 * 1024) {
          $_SESSION['error'] = "Dung lượng ảnh tối đa có thể upload là 2Mb";
          require_once 'views/categories/update.php';
          return;
        }

      }
      $avatar = $category['avatar'];
      //nếu user có thao tác upload ảnh,
//            thì xử lý upload
      if ($avatarArr['size'] > 0 && $avatarArr['error'] == 0) {

        $dirUpload = '/uploads';
        //khai báo thư mục có tên uploads, nằm trong thư mục
//                assets, dùng để chứa các file được upload lên
        $absolutePathUpload = __DIR__ . '/../assets' . $dirUpload;
        //thực hiện xóa ảnh cũ đi
        if (!empty($avatar)) {
          @unlink($absolutePathUpload . '/' . $avatar);
        }

        if (!file_exists($absolutePathUpload)) {
          mkdir($absolutePathUpload);
        }
        //sửa lại tên file để đảm bảo tính duy nhất
//                cho từng file đc upload
        $fileName = 'category-' . time() . $avatarArr['name'];
        $isUpload = move_uploaded_file($avatarArr['tmp_name'],
          $absolutePathUpload . '/' . $fileName);
//                nếu upload thành công thì mới lưu tên ảnh vào trường avatar
        if ($isUpload) {
          $avatar = $fileName;
        }
      }
      //khai báo mảng chưa các thông tin về categoey
      //để insert vào CSDL
      $category = [
        'id' => $id,
        'name' => $name,
        //trường avatar sẽ đưuọc sinh ra
        //sau khi upload file thành công
        'avatar' => $avatar,
        'description' => $description,
        'status' => $status,
      ];

      $categoryModel = new Category();
      $isUpdate = $categoryModel->update($category);
      if ($isUpdate) {
        $_SESSION['success'] = 'Update thành công';
      } else {
        $_SESSION['error'] = 'Update thất bại';
      }
      header("Location: index.php?controller=category&action=index");
      exit();


//            echo '<pre>';
//            print_r($_POST);

    }
    require_once 'views/categories/update.php';
  }

  public function delete()
  {
    //xử lý validate cho trường hợp
    //ko truyền id hoặc id không phải là số thì báo lỗi
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'Tham số ID không hợp lệ';
      header("Location: index.php");
      exit();
    }

    $id = $_GET['id'];
    $categoryModel = new Category();
    //xóa ảnh đã tồn tại trên server nếu có
    $category = $categoryModel->getById($id);
    @unlink(__DIR__ . '/../assets/uploads/' . $category['avatar']);
    $isDelete = $categoryModel->delete($id);
    if ($isDelete) {
      $_SESSION['success'] = "Xóa bản ghi $id thành công";
    } else {
      $_SESSION['error'] = "Xóa bản ghi $id thất bại";
    }

    header("Location: index.php");
    exit();
  }

  public function detail()
  {
    //xử lý validate cho trường hợp
    //ko truyền id hoặc id không phải là số thì báo lỗi
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'Tham số ID không hợp lệ';
      header("Location: index.php");
      exit();
    }

    $id = $_GET['id'];
    //truy vấn để lấy ra dữ liệu tương ứng với category
//        theo id vừa bắt được
    $categoryModel = new Category();
    $category = $categoryModel->getById($id);
    require_once 'views/categories/detail.php';
  }

}