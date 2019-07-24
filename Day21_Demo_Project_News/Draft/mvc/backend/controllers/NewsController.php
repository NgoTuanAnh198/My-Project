<?php

require_once 'controllers/Controller.php';
require_once 'models/News.php';

class NewsController extends Controller
{
    public function index()
    {
        /**
         * lấy thông tin tất cả tin tức
         */
        $news = new News();
        $News = $news->getAll();
        require_once 'views/news/index.php';
    }

    /**
     * Xem chi tiết 1 news
     */
    public function detail()
    {
        // xử lý trường hợp id không hợp lệ thì báo lỗi
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            //khai báo session hiển thị lỗi, được hiển thị tại file views/layouts/header.php
            $_SESSION['error'] = "tham số không hợp lệ";
            // Hàm chuyển hướng bên dưới không cần truyền vào controller và action
            // thì mặc định sẽ có controller = home và action=show
            //theo như cách đã code trong file gốc show_categories.php của ứng dụng
            header("Location: show_categories.php");
        }
        $newsModel = new News();
        // Lấy ra thông tin của news;
        $news = $newsModel->getNewsById($_GET['id']);

        require_once 'views/news/detail.php';
    }

    /**
     * sửa 1 news
     */
    public function update()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            //khai báo session hiển thị lỗi, được hiển thị tại file views/layouts/header.php
            $_SESSION['error'] = 'Tham số không hợp lệ';
            //hàm chuyển hướng bên dưới không cần truyền vào controller và action
            //thì mặc định sẽ có controller=book và action=show
            //theo như cách đã code trong file gốc show_categories.php của ứng dụng
            header("Location: show_categories.php");
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
            $summary = $_POST['summary'];
            $content = $_POST['content'];
            $comment = $_POST['comment_total'];
            $like = $_POST['like_total'];
            $status = $_POST['status'];

            //tạo biến news dạng mảng, chứa các thông tin đã thay đổi sau khi
            //submit form, nên dùng cách này cho nhiều trường hợp có nhiều kiểu dữ liệu
            $news = [
                'title' => $title,
                'summary' => $summary,
                'content' => $content,
                'comment_total' => $comment,
                'like_total' => $like,
                'status' => $status
            ];
            //truyền biến mảng vào hàm upadate
            $isUpdate = $newsModel->updateNews($news);
            if ($isUpdate) {
                $_SESSION['success'] = "Cập nhật bản ghi #$id thành công";
            } else {
                $_SESSION['error'] = "Cập nhật bản ghi #$id thất bại";
            }
            header("Location: show_categories.php");
            //cần có lệnh exit sau lệnh header để tránh lỗi không chuyển hướng được
            exit();
        }
        require_once 'views/news/update.php';
    }

    /**
     * Thêm 1 news
     */
    public function create()
    {
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $summary = $_POST['summary'];
            $content = $_POST['content'];
            $comment = $_POST['comment_total'];
            $like = $_POST['like_total'];
            $status = $_POST['status'];

            //Hiện thị thông báo lôi
            if (empty($title)){
                $_SESSION['error']="Tiêu đề không được để trống";
                header("Location:index.php?controller=news&action=create");
                exit();
            }

            // tạo ra biến news dạng mảng, chứa các thông tin về news sau khi
            //submit form, nên dùng cách này cho nhiều trường hợp có nhiều trường dũ liệu
            $news = [
                'title' => $title,
                'summary' => $summary,
                'content' => $content,
                'comment_total' => $comment,
                'like_total' => $like,
                'status' => $status
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
            header("Location:index.php?controller=news&action=create");
            // Cần có lệnh exit sau lệnh header, để tránh lỗi không chuyển hướng được
            exit();
        }
        require_once 'views/news/create.php';
    }

    /**
     * Xóa 1 news
     */
    public function delete()
    {
        //xử lý trường hợp id không hợp lệ thì báo lỗi
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            //khai báo session hiển thị lỗi, được hiển thị tại file views/layouts/header.php
            $_SESSION['error'] = 'Tham số không hợp lệ';
            //hàm chuyển hướng bên dưới không cần truyền vào controller và action
            //thì mặc định sẽ có controller=book và action=show
            //theo như cách đã code trong file gốc show_categories.php của ứng dụng
            header("Location: show_categories.php");
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
        header("Location: show_categories.php");
        //cần có lệnh exit sau lệnh header để tránh lỗi không chuyển hướng được
        exit();
    }
}

?>