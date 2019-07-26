<?php

require_once 'controllers/Controller.php';
require_once 'models/News.php';
require_once 'models/Category.php';

class NewsController extends Controller
{
    public function index()
    {
        /**
         * lấy thông tin tất cả tin tức
         * success
         */

        $arrSearch = [];
        // xu ly khi submit form search
        if (isset($_GET['submit_search'])){
            $title = $_GET['title'];
            $category_id =$_GET['category_id'];
            $comment_total = $_GET['comment_total'];
            $like_total = $_GET['like_total'];
            $arrSearch =[
                'title' =>$title,
                'category_id'=>$category_id,
                'comment_total'=>$comment_total,
                'like_total'=>$like_total,
            ];
        }
        $news = new News();
        $News = $news->getAll($arrSearch);
        // ham lay phan trang
        $pages = $news->getPagination('news');
        // lay thong tin danh muc cho phan search
        $category_model = new Category();
        $categories = $category_model->getAll();

//        truyen ra views
        require_once 'views/news/index.php';
    }

    /**
     * Xem chi tiết 1 news
     * success
     */
    public function detail()
    {
        // xử lý trường hợp id không hợp lệ thì báo lỗi
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            //khai báo session hiển thị lỗi, được hiển thị tại file views/layouts/header.php
            $_SESSION['error'] = "tham số không hợp lệ";
            header("Location:index.php?controller=news&action=index");
            exit();
        }
        $newsModel = new News();
        // Lấy ra thông tin của news;
        $news = $newsModel->getNewsById($_GET['id']);

        require_once 'views/news/detail.php';
    }

    /**
     * sửa 1 news
     * success
     */
    public function update()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'Tham số không hợp lệ';
            header("Location:index.php?controller=news&action=index");
            //cần có lệnh exit sau lệnh header, để tránh lỗi ko chuyển hướng được
            exit();
        }
        $id = $_GET['id'];
        // hiển thị dữ liệu news ra views
        //Khởi tạo đối tượng news để sử dụng các phương thức trong class News
        $newsModel = new News();
        $news = $newsModel->getNewsById($id);
        //Xử lý trường hợp submit form sử dụng method POST thì sẽ update bản ghi tương ứng
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $category_id=$_POST['category_id'];
            $summary = $_POST['summary'];
            $content = $_POST['content'];
            $comment = $_POST['comment_total'];
            $like_total = $_POST['like_total'];
            $status = $_POST['status'];
            $avatarArr=$_FILES['avatar'];

//            xu ly TH de trong title
            if (empty($title)){
                $_SESSION['error']='Title khong duoc de trong';
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
                }
                else if ($avatarArr['size'] > 2 * 1024 * 1024) {
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
            //tạo biến news dạng mảng, chứa các thông tin đã thay đổi sau khi
            //submit form, nên dùng cách này cho nhiều trường hợp có nhiều kiểu dữ liệu
            $news = [
                'id'=>$_GET['id'],
                'title' => $title,
                'category_at'=> $category_id,
                'admin_id' => isset($_SESSION['admin']) ? $_SESSION['admin']['id'] : 0,
                'avatar'=>$avatar,
                'summary' => $summary,
                'content' => $content,
                'comment_total' => $comment,
                'like_total' => $like_total,
                'status' => $status
            ];
            //truyền biến mảng vào hàm upadate
            $isUpdate = $newsModel->updateNews($news);
            if ($isUpdate) {
                $_SESSION['success'] = "Cập nhật bản ghi #$id thành công";
            } else {
                $_SESSION['error'] = "Cập nhật bản ghi #$id thất bại";
            }
            header("Location:index.php?controller=news&action=index");
            //cần có lệnh exit sau lệnh header để tránh lỗi không chuyển hướng được
            exit();
        }
        require_once 'views/news/update.php';
    }

    /**
     * Thêm 1 news
     * success
     */
    public function create()
    {
        $categoy_model = new Category();
        $categories = $categoy_model->getAll();
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $category_id = $_POST['category_id'];
            $avatarArr = $_FILES['avatar'];
            $summary = $_POST['summary'];
            $content = $_POST['content'];
            $comment = $_POST['comment_total'];
            $like = $_POST['like_total'];
            $view = $_POST['view'];
            $status = $_POST['status'];

            //Hiện thị thông báo lôi
            if (empty($title)){
                $_SESSION['error']="Tiêu đề không được để trống";
               require_once 'views/news/create.php';
               return;
            }
            //validate cho ảnh truong hop co anh upload len
            if ($avatarArr['size'] > 0 && $avatarArr['error'] == 0) {
                $extention = pathinfo($avatarArr['name'], PATHINFO_EXTENSION);
                //xử lý upload không phải dạng ảnh
                if (!in_array($extention, ['jpg', 'gif', 'png', 'jpeg'])) {
                    $_SESSION['error'] = "Cần upload định dạng ảnh";
                    require_once 'views/news/create.php';
                    return;
                }
                // xử lý upload quá kích thước ảnh
                else if ($avatarArr['size'] > 2 * 1024 * 1024 ) {
                    $_SESSION['error'] = "Dung lượng ảnh tối đa là 2MB";
                    require_once 'views/news/create.php';
                    return;
                }
            }
            $avatar = '';
            //nếu user có thao tác upload ảnh thì xử lý upload
            if($avatarArr['size'] > 0 && $avatarArr['error']==0 ){
                $dirUpload = "/uploads";
                // khai báo thư mục có tên uploads, nằm trong thư mục asset
                $absolutePathUpload =__DIR__.'/../assets' .$dirUpload;
                if (!file_exists($absolutePathUpload)){
                    mkdir($absolutePathUpload);
                }
                //sửa lại tên file để đảm bảo tính duy nhất
                $filename ='news-'. time() .$avatarArr['name'];
                $isUpload = move_uploaded_file($avatarArr['tmp_name'], $absolutePathUpload.'/'. $filename);
                if ($isUpload){
                    $avatar = $filename;
                }
            }
            // tạo ra biến news dạng mảng, chứa các thông tin về news sau khi
            //submit form, nên dùng cách này cho nhiều trường hợp có nhiều trường dũ liệu
            $news = [
                'title' => $title,
                'category_id'=>$category_id,
                'admin_id'=>isset($_SESSION['admin'])? $_SESSION['admin']['id']:0,
                'avatar'=>$avatar,
                'summary' => $summary,
                'content' => $content,
                'comment_total' => $comment,
                'like_total' => $like,
                'view' => $view,
                'status' => $status,
            ];

            //Khởi tạo đối tượng news để sử dụng
            //các phương thức trong class News
            $newsModel = new News();
            $isInsert = $newsModel->insertNews($news);
            if ($isInsert) {
                $_SESSION['success'] = "Thêm bản ghi thành công";
            } else {
                $_SESSION['error'] = "Thêm bản ghi thất bại";
            }
            header("Location:index.php?controller=news&action=index");
            // Cần có lệnh exit sau lệnh header, để tránh lỗi không chuyển hướng được
            exit();
        }
        require_once 'views/news/create.php';
    }

    /**
     * Xóa 1 news
     * success
     */
    public function delete()
    {
        //xử lý trường hợp id không hợp lệ thì báo lỗi
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            //khai báo session hiển thị lỗi, được hiển thị tại file views/layouts/header.php
            $_SESSION['error'] = 'Tham số không hợp lệ';
            //hàm chuyển hướng bên dưới không cần truyền vào controller và action
            //thì mặc định sẽ có controller=news và action=index
            //theo như cách đã code trong file gốc
            header("Location:index.php?controller=news&action=index");
            //cần có lệnh exit sau lệnh header, để tránh lỗi ko chuyển hướng được
            exit();
        }
        $newsModel = new News();
        $id = $_GET['id'];
        $isDelete = $newsModel->deleteNews($id);
        if ($isDelete){
            $_SESSION['success']= "Xóa bản ghi #$id thành công";
        }
        else{
            $_SESSION['error']="Xóa bản ghi #$id thất bại";
        }
        header("Location:index.php?controller=news&action=index");
        //cần có lệnh exit sau lệnh header để tránh lỗi không chuyển hướng được
        exit();
    }
}

?>