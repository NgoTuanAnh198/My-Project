<?php include_once 'views/layouts/header.php' ?>
<!-- Main content -->
<div class="form-login container">
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php
            //nơi hiển thị thông báo lỗi nếu có
            //sau khi thông báo lỗi xong cần xóa session này đi, để tránh việc hiển thị lại sau mỗi lần
            //            refresh trang
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success" role="alert">
            <?php
            //nơi hiển thị thông báo thành công nếu có
            //sau khi thông báo thành công xong cần xóa session này đi, để tránh việc hiển thị lại sau mỗi lần
            //            refresh trang
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
        </div>
    <?php endif; ?>
    <form action="" method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>"/>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password"/>
        </div>
        <div class="form-group center-align">
            <input type="submit" name="submit" value="Login" class="btn btn-primary"/>
        </div>
    </form>
</div>
<!-- /.content -->
<!-- /.content-wrapper -->
<?php include_once 'views/layouts/footer.php' ?>
