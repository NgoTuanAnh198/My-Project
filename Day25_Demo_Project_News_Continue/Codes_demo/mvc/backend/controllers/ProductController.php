<?php
/**
 * Created by PhpStorm.
 * User: nvmanh
 * Date: 7/16/2019
 * Time: 6:58 PM
 */
require_once 'models/Product.php';
require_once 'models/Category.php';
require_once 'controllers/Controller.php';

class ProductController extends Controller
{
  /**
   * Phương thức xử lý hiển thị danh sách Product
   */
  public function index()
  {
    $productsModel = new Product();
    $products = $productsModel->getAllPagination();
    //hàm lấy phân trang
    $pages = $productsModel->getPagination('products');
    //lấy thông tin danh mục cho phần search
    $category_model = new Category();
    $categories = $category_model->getAll();
    //truyền ra views
    require_once 'views/products/index.php';
  }

  /**
   * Phương thức xử lý thêm mới Product
   */
  public function create()
  {
    $category_model = new Category();
    $categories = $category_model->getAll();

    //xử lý khi người dùng submit form
    if (isset($_POST['submit'])) {
      $name= $_POST['name'];
      $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : 0;
      $summary = $_POST['summary'];
      $content = $_POST['content'];
      $price = $_POST['price'];
      $status = $_POST['status'];
      $avatarArr = $_FILES['avatar'];
      //xử lý validate, trường hợp user để trống name
//            của products thì báo lỗi
      if (empty($name)) {
        $_SESSION['error'] = 'Name không được để trống';
        require_once 'views/products/create.php';
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
          require_once 'views/products/create.php';
          return;
        } else if ($avatarArr['size'] > 2 * 1024 * 1024) {
          $_SESSION['error'] = "Dung lượng ảnh tối đa có thể upload là 2Mb";
          require_once 'views/products/create.php';
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
        $fileName = 'products-' . time() . $avatarArr['name'];
        $isUpload = move_uploaded_file($avatarArr['tmp_name'],
          $absolutePathUpload . '/' . $fileName);
//                nếu upload thành công thì mới lưu tên ảnh vào trường avatar
        if ($isUpload) {
          $avatar = $fileName;
        }
      }
      //khai báo mảng chưa các thông tin về categoey
      //để insert vào CSDL
      $products = [
        'name' => $name,
        'category_id' => $category_id,
        'admin_id' => isset($_SESSION['admin']) ? $_SESSION['admin']['id'] : 0,
        //trường avatar sẽ đưuọc sinh ra
        //sau khi upload file thành công
        'avatar' => $avatar,
        'price' => $price,
        'summary' => $summary,
        'content' => $content,
        'status' => $status,
      ];

      $productsModel = new Product();
      $isInsert = $productsModel->insert($products);
      if ($isInsert) {
        $_SESSION['success'] = 'Insert thành công';
      } else {
        $_SESSION['error'] = 'Insert thất bại';
      }
      header("Location: index.php?controller=product&action=index");
      exit();
    }
    require_once 'views/products/create.php';
  }

  public function update()
  {
    //xử lý validate cho trường hợp
    //ko truyền id hoặc id không phải là số thì báo lỗi
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'Tham số ID không hợp lệ';
      header("Location: index.php?controller=product&action=index");
      exit();
    }
    $category_model = new Category();
    $categories = $category_model->getAll();

    $productModel = new Product();
    $product = $productModel->getById($_GET['id']);
    //xử lý khi người dùng submit form
    if (isset($_POST['submit'])) {
      $name= $_POST['name'];
      $category_id = $_POST['category_id'];
      $summary = $_POST['summary'];
      $content = $_POST['content'];
      $price = $_POST['price'];
      $status = $_POST['status'];
      $avatarArr = $_FILES['avatar'];
      //xử lý validate, trường hợp user để trống name
//            của products thì báo lỗi
      if (empty($name)) {
        $_SESSION['error'] = 'Name không được để trống';
        require_once 'views/products/update.php';
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
          require_once 'views/products/update.php';
          return;
        } else if ($avatarArr['size'] > 2 * 1024 * 1024) {
          $_SESSION['error'] = "Dung lượng ảnh tối đa có thể upload là 2Mb";
          require_once 'views/products/update.php';
          return;
        }

      }
      $avatar = $product['avatar'];
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
        $fileName = 'product-' . time() . $avatarArr['name'];
        $isUpload = move_uploaded_file($avatarArr['tmp_name'],
          $absolutePathUpload . '/' . $fileName);
//                nếu upload thành công thì mới lưu tên ảnh vào trường avatar
        if ($isUpload) {
          $avatar = $fileName;
        }
      }
      //khai báo mảng chưa các thông tin về categoey
      //để update vào CSDL
      $product = [
        'id' => $_GET['id'],
        'name' => $name,
        'category_id' => $category_id,
        'admin_id' => isset($_SESSION['admin']) ? $_SESSION['admin']['id'] : 0,
        //trường avatar sẽ đưuọc sinh ra
        //sau khi upload file thành công
        'avatar' => $avatar,
        'summary' => $summary,
        'content' => $content,
        'price' => $price,
        'status' => $status,
      ];

      $isUpdate = $productModel->update($product);
      if ($isUpdate) {
        $_SESSION['success'] = 'Update thành công';
      } else {
        $_SESSION['error'] = 'Update thất bại';
      }
      header("Location: index.php?controller=product&action=index");
      exit();
    }
    //lấy danh sách category đang có trên hệ thống
    require_once 'views/products/update.php';
  }

  public function delete() {
    //xử lý validate cho trường hợp
    //ko truyền id hoặc id không phải là số thì báo lỗi
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'Tham số ID không hợp lệ';
      header("Location: index.php?controller=product&action=index");
      exit();
    }

    $id = $_GET['id'];
    $productModel = new Product();
    $isDelete = $productModel->delete($id);
    if ($isDelete) {
      $_SESSION['success'] = "Xóa bản ghi #$id thành công";
    }
    else {
      $_SESSION['error'] = "Xóa bản ghi #$id thất bại";
    }

    header("Location: index.php?controller=product&action=index");
    exit();
  }

  public function detail() {
    //xử lý validate cho trường hợp
    //ko truyền id hoặc id không phải là số thì báo lỗi
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'Tham số ID không hợp lệ';
      header("Location: index.php?controller=product&action=index");
      exit();
    }

    $id = $_GET['id'];
    //truy vấn để lấy ra dữ liệu tương ứng với category
//        theo id vừa bắt được
    $productModel = new Product();
    $product = $productModel->getById($id);
    require_once 'views/products/detail.php';
  }

}