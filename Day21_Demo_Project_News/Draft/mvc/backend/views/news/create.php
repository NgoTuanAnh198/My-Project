<?php include_once 'views/layouts/header.php' ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- hiển thị thong báo lỗi-->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <!--    form create-->
        <h2>Tạo mới bản ghi</h2>
        <form method="post" action="">
            <div class="form-group">
                <label>title</label>
                <input type="text" class="form-control" name="title" value=""/>
            </div>
            <div class="form-group">
                <label>summary</label>
                <input type="text" class="form-control" name="summary" value=""/>
            </div>
            <div class="form-group">
                <label>content</label>
                <textarea name="content" id="content-description" cols="" rows="" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>comment_total</label>
                <input type="text" class="form-control" name="comment_total" value=""/>
            </div>
            <div class="form-group">
                <label>like_total</label>
                <input type="text" class="form-control" name="like_total" value=""/>
            </div>
            <div class="form-group">
                <label>status</label>
                <select name="status" class="form-control">
                    <option value="<?php echo News::STATUS_ENABLED?>">ENABLE</option>
                    <option value="<?php echo News::STATUS_DISABLED?>">DISABLE</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Save" class="btn btn-success">
                <a href="index.php?controller=news&action=index" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once 'views/layouts/footer.php' ?>


