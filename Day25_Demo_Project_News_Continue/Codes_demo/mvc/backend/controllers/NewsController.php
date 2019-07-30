<?php
/**
 * Created by PhpStorm.
 * User: nvmanh
 * Date: 7/16/2019
 * Time: 6:58 PM
 */
require_once 'models/News.php';
require_once 'models/Category.php';
require_once 'controllers/Controller.php';

class NewsController extends Controller
{
  /**
   * Phương thức xử lý hiển thị danh sách News
   */
  public function index()
  {
    $arrSearch = [];
    //xử lý khi submit form search
    if (isset($_GET['submit_search'])) {
      $title = $_GET['title'];
      $category_id = $_GET['category_id'];
      $comment_total = $_GET['comment_total'];
      $like_total = $_GET['like_total'];
      $arrSearch = [
        'title' => $title,
        'category_id' => $category_id,
        'comment_total' => $comment_total,
        'like_total' => $like_total,
      ];
    }
    $newsModel = new News();
    $news = $newsModel->getAllPagination($arrSearch);
    //hàm lấy phân trang
    $pages = $newsModel->getPagination('news');
    //lấy thông tin danh mục cho phần search
    $category_model = new Category();
    $categories = $category_model->getAll();

    //truyền ra views
    require_once 'views/news/index.php';
  }

  /**
   * Phương thức xử lý thêm mới News
   */
  public function create()
  {
    $category_model = new Category();
    $categories = $category_model->getAll();

    //xử lý khi người dùng submit form
    if (isset($_POST['submit'])) {
      $title= $_POST['title'];
      $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : 0;
      $summary = $_POST['summary'];
      $content = $_POST['content'];
      $comment_total = $_POST['comment_total'];
      $like_total = $_POST['like_total'];
      $status = $_POST['status'];
      $avatarArr = $_FILES['avatar'];
      //xử lý validate, trường hợp user để trống name
//            của news thì báo lỗi
      if (empty($title)) {
        $_SESSION['error'] = 'Title không được để trống';
        require_once 'views/news/create.php';
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
          require_once 'views/news/create.php';
          return;
        } else if ($avatarArr['size'] > 2 * 1024 * 1024) {
          $_SESSION['error'] = "Dung lượng ảnh tối đa có thể upload là 2Mb";
          require_once 'views/news/create.php';
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
        $fileName = 'news-' . time() . $avatarArr['name'];
        $isUpload = move_uploaded_file($avatarArr['tmp_name'],
          $absolutePathUpload . '/' . $fileName);
//                nếu upload thành công thì mới lưu tên ảnh vào trường avatar
        if ($isUpload) {
          $avatar = $fileName;
        }
      }
      //khai báo mảng chưa các thông tin về categoey
      //để insert vào CSDL
      $news = [
        'title' => addslashes($title),
        'category_id' => $category_id,
        'admin_id' => isset($_SESSION['admin']) ? $_SESSION['admin']['id'] : 0,
        //trường avatar sẽ đưuọc sinh ra
        //sau khi upload file thành công
        'avatar' => $avatar,
        'summary' => $summary,
        'content' => $content,
        'comment_total' => $comment_total,
        'like_total' => $like_total,
        'status' => $status,
      ];

      $newsModel = new News();
      $isInsert = $newsModel->insert($news);
      if ($isInsert) {
        $_SESSION['success'] = 'Insert thành công';
      } else {
        $_SESSION['error'] = 'Insert thất bại';
      }
      header("Location: index.php?controller=news&action=index");
      exit();


//            echo '<pre>';
//            print_r($_POST);

    }
    //lấy danh sách category đang có trên hệ thống
    require_once 'views/news/create.php';
  }

  public function update()
  {
    //xử lý validate cho trường hợp
    //ko truyền id hoặc id không phải là số thì báo lỗi
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'Tham số ID không hợp lệ';
      header("Location: index.php?controller=news&action=index");
      exit();
    }
    $category_model = new Category();
    $categories = $category_model->getAll();

    $newsModel = new News();
    $news = $newsModel->getById($_GET['id']);
    //xử lý khi người dùng submit form
    if (isset($_POST['submit'])) {
      $title= $_POST['title'];
      $category_id = $_POST['category_id'];
      $summary = $_POST['summary'];
      $content = $_POST['content'];
      $comment_total = $_POST['comment_total'];
      $like_total = $_POST['like_total'];
      $status = $_POST['status'];
      $avatarArr = $_FILES['avatar'];
      //xử lý validate, trường hợp user để trống name
//            của news thì báo lỗi
      if (empty($title)) {
        $_SESSION['error'] = 'Title không được để trống';
        require_once 'views/news/create.php';
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
          require_once 'views/news/create.php';
          return;
        } else if ($avatarArr['size'] > 2 * 1024 * 1024) {
          $_SESSION['error'] = "Dung lượng ảnh tối đa có thể upload là 2Mb";
          require_once 'views/news/create.php';
          return;
        }

      }
      $avatar = $news['avatar'];
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
        $fileName = 'news-' . time() . $avatarArr['name'];
        $isUpload = move_uploaded_file($avatarArr['tmp_name'],
          $absolutePathUpload . '/' . $fileName);
//                nếu upload thành công thì mới lưu tên ảnh vào trường avatar
        if ($isUpload) {
          $avatar = $fileName;
        }
      }
      //khai báo mảng chưa các thông tin về categoey
      //để update vào CSDL
      $news = [
        'id' => $_GET['id'],
        'title' => $title,
        'category_id' => $category_id,
        'admin_id' => isset($_SESSION['admin']) ? $_SESSION['admin']['id'] : 0,
        //trường avatar sẽ đưuọc sinh ra
        //sau khi upload file thành công
        'avatar' => $avatar,
        'summary' => $summary,
        'content' => $content,
        'comment_total' => $comment_total,
        'like_total' => $like_total,
        'status' => $status,
      ];

      $newsModel = new News();
      $isInsert = $newsModel->update($news);
      if ($isInsert) {
        $_SESSION['success'] = 'Update thành công';
      } else {
        $_SESSION['error'] = 'Update thất bại';
      }
      header("Location: index.php?controller=news&action=index");
      exit();
    }
    //lấy danh sách category đang có trên hệ thống
    require_once 'views/news/update.php';
  }

  public function delete() {
    //xử lý validate cho trường hợp
    //ko truyền id hoặc id không phải là số thì báo lỗi
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'Tham số ID không hợp lệ';
      header("Location: index.php?controller=news&action=index");
      exit();
    }

    $id = $_GET['id'];
    $newsModel = new News();
    $isDelete = $newsModel->delete($id);
    if ($isDelete) {
      $_SESSION['success'] = "Xóa bản ghi #$id thành công";
    }
    else {
      $_SESSION['error'] = "Xóa bản ghi #$id thất bại";
    }

    header("Location: index.php?controller=news&action=index");
    exit();
  }

  public function detail() {
    //xử lý validate cho trường hợp
    //ko truyền id hoặc id không phải là số thì báo lỗi
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'Tham số ID không hợp lệ';
      header("Location: index.php?controller=news&action=index");
      exit();
    }

    $id = $_GET['id'];
    //truy vấn để lấy ra dữ liệu tương ứng với category
//        theo id vừa bắt được
    $newsModel = new News();
    $news = $newsModel->getById($id);
    require_once 'views/news/detail.php';
  }

}