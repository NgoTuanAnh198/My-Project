<?php
require_once 'controllers/Controller.php';
require_once 'models/Category.php';

class CategoryController extends Controller
{
    /**
     * Lấy danh sách toàn bộ tên danh mục trong CSDL
     */
    public function index()
    {
        $categories = new Category();
        $Categories = $categories->getAll();
        require_once 'views/categories/index.php';
    }

    /**
     * Xem chi tiết 1 categories
     */
    public function detail()
    {
        //xử lý trường hợp id không hợp lệ thì báo lỗi
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            //khai báo session hiển thị lỗi, được hiển thị tại file views/layouts/header.php
            $_SESSION['error'] = 'Tham số không hợp lệ';
            //hàm chuyển hướng bên dưới không cần truyền vào controller và action
            //thì mặc định sẽ có controller=book và action=show
            //theo như cách đã code trong file gốc index.php của ứng dụng
            header("Location: index.php");
        }
        $categoriesModel = new Category();
        //lấy ra thông tin của categories
        $categories = $categoriesModel->getCategoriesById($_GET['id']);

        require_once 'views/categories/detail.php';
    }

    /**
     * Sửa 1 categories
     */
    public function update()
    {
        //xử lý trường hợp id không hợp lệ thì báo lỗi
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            //khai báo session hiển thị lỗi, được hiển thị tại file views/layouts/header.php
            $_SESSION['error'] = 'Tham số không hợp lệ';
            //hàm chuyển hướng bên dưới không cần truyền vào controller và action
            //thì mặc định sẽ có controller=book và action=show
            //theo như cách đã code trong file gốc index.php của ứng dụng
            header("Location: index.php");
            //cần có lệnh exit sau lệnh header, để tránh lỗi ko chuyển hướng được
            exit();
        }
        $id = $_GET['id'];
        //hiển thị dữ liệu categories ra view
        //Khởi tạo đối tượng categories để sử dụng
        //các phương thức trong class Category
        $categoriesModel = new Category();
        $categories = $categoriesModel->getCategoriesById($id);


        //xử lý trường hợp submit form sử dụng method POST
        //thì sẽ update bản ghi tương ứng
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $avatarArr = $_FILES['avatar'];
            $description = $_POST['description'];
            $status = $_POST['status'];

            if (empty($name)){
                $_SESSION['error'] = 'Name ko được để trống';
                require_once 'views/categories/update.php';
            }
            if ($avatarArr['size'] > 0 && $avatarArr['error'] == 0) {
                $extention = pathinfo($avatarArr['name'], PATHINFO_EXTENSION);
                //xử lý upload không phải dạng ảnh
                if (!in_array($extention, ['jpg', 'gif', 'png', 'jpeg'])) {
                    $_SESSION['error'] = "Cần upload định dạng ảnh";
                    require_once 'views/categories/update.php';
                    return;
                }
                // xử lý upload quá kích thước ảnh
                else if ($avatarArr['size'] > 2 * 1024 * 1024 ) {
                    $_SESSION['error'] = "Dung lượng ảnh tối đa là 2MB";
                    require_once 'views/categories/update.php';
                    return;
                }
            }
            $avatar = $categories['avatar'];
            //nếu user có thao tác upload ảnh thì xử lý upload
            if($avatarArr['size'] > 0 && $avatarArr['error']==0 ){
                $dirUpload = "/uploads";
               // khai báo thư mục có tên uploads, nằm trong thư mục asset
                $absolutePathUpload =__DIR__.'/../assets' .$dirUpload;

                //thực hiện delete ảnh cũ
                if (!empty($avatar)){
                    @unlink($absolutePathUpload.'/'.$avatar);
                }
                if (!file_exists($absolutePathUpload)){
                    mkdir($absolutePathUpload);
                }
                //sửa lại tên file để đảm bảo tính duy nhất
                $filename = time() .$avatarArr['name'];
                $isUpload = move_uploaded_file($avatarArr['tmp_name'], $absolutePathUpload.'/'. $filename);
                if ($isUpload){
                    $avatar = $filename;
                }
            }
            // Tạo ra biến categories dạng mảng, chứa các thông tin đã thay đổi
            //sau khi submit form, nên dùng cách này cho nhiều trường có nhiều truong dữ liệu
            $categories = [
                'id'=>$id,
                'name' => $name,
                'avatar' => $avatar,
                'description' =>$description,
                'status'=>$status,
            ];
            // truyền biến mảng vào hàm update
            $categoriesModel = new Category();
            $isUpdate = $categoriesModel->updateCategories($categories);
            if ($isUpdate) {
                $_SESSION['success'] = "Cập nhật bản ghi #$id thành công";
            } else {
                $_SESSION['error'] = "Cập nhật bản ghi #$id thất bại";
            }
            header("Location: index.php?controller=category&action=index");
            exit();
        }
        require_once 'views/categories/update.php';
    }


    /**
     * thêm 1 categories
     */
    public function create()
    {
        //khi người dùng submit form
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $avatarArr = $_FILES['avatar'];
            $description = $_POST['description'];
            $status = $_POST['status'];

            //nếu để trống name thì báo lỗi
            if (empty($name)) {
                $_SESSION['error'] = "Name không được để trống";
                require_once 'views/categories/create.php';
                return;
            }
            //validate cho ảnh truong hop co anh upload len
            if ($avatarArr['size'] > 0 && $avatarArr['error'] == 0) {
                $extention = pathinfo($avatarArr['name'], PATHINFO_EXTENSION);
                //xử lý upload không phải dạng ảnh
                if (!in_array($extention, ['jpg', 'gif', 'png', 'jpeg'])) {
                    $_SESSION['error'] = "Cần upload định dạng ảnh";
                    require_once 'views/categories/create.php';
                    return;
                }
                // xử lý upload quá kích thước ảnh
                else if ($avatarArr['size'] > 2 * 1024 * 1024 ) {
                    $_SESSION['error'] = "Dung lượng ảnh tối đa là 2MB";
                    require_once 'views/categories/create.php';
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
                $filename = time() .$avatarArr['name'];
                $isUpload = move_uploaded_file($avatarArr['tmp_name'], $absolutePathUpload.'/'. $filename);
                if ($isUpload){
                    $avatar = $filename;
                }
            }
            // Tạo ra biến categories dạng mảng, chứa các thông tin đã thay đổi
            //sau khi submit form, nên dùng cách này cho nhiều trường có nhiều truong dữ liệu
            $categories = [
                'name' => $name,
                'avatar' => $avatar,
                'description' => $description,
                'status' => $status
            ];
            //khởi tạo đối tượng categories để sử dụng các phương thức trong class Category
            $categoriesModel = new Category();
            $isInsert = $categoriesModel->insertCategories($categories);
            if ($isInsert) {
                $_SESSION['success'] = "Thêm bản ghi thành công";
            } else {
                $_SESSION['error'] = "Thêm bản ghi thất bại";
            }
            header("Location: index.php?controller=category&action=index");
            // cần có lệnh exit sau lệnh header tránh lỗi không chuyển hướng được
            exit();
        }

        require_once 'views/categories/create.php';
    }


    /**
     * Delete 1 categories
     */
    public function delete()
    {
        //xử lý trường hợp id không hợp lệ thì báo lỗi
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            //khai báo session hiển thị lỗi, được hiển thị tại file views/layouts/header.php
            $_SESSION['error'] = 'Tham số không hợp lệ';
            header("Location: index.php");
            //cần có lệnh exit sau lệnh header, để tránh lỗi ko chuyển hướng được
            exit();
        }
        $categoriesModel = new Category();
        $id = $_GET['id'];
        $categories = $categoriesModel->getCategoriesById($id);
        $isDelete = $categoriesModel->deleteCategories($id);
        $avatar = $categories['avatar'];
        // khai báo thư mục có tên uploads, nằm trong thư mục asset
        $absolutePathUpload =__DIR__.'/../assets/uploads';

        //thực hiện delete ảnh cũ
        if (!empty($avatar)){
            @unlink($absolutePathUpload.'/'.$avatar);
        }
        else if ($isDelete) {
            $_SESSION['success'] = "Xóa bản ghi $id thành công";
        } else {
            $_SESSION['error'] = "Xóa bản ghi $id thất bại";
        }
        header("Location: index.php");
        //cần có lệnh exit sau lệnh header, để tránh lỗi ko chuyển hướng được
        exit();
    }
}

?>
