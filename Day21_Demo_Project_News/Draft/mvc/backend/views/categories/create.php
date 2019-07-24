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
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo isset($_POST['name'])? $_POST['name']:''?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Upload ảnh</label>
                <input type="file" name="avatar" class="form-control">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea cols="" rows="" name="description" id="category-description" class="form-control"><?php echo isset($_POST['description']) ? $_POST['description']: ''?>
                </textarea>
            </div>
            <div class="form-group">
                <?php
                $selectedStatusEnable = '';
                $selectedStatusDisabled = '';
                if (isset($_POST['status'])) {
                    switch ($_POST['status']) {
                        case Category::STATUS_ENABLED:
                            $selectedStatusEnable = "selected=true"; break;
                        case Category::STATUS_DISABLED:
                            $selectedStatusDisabled="selected=true"; break;
                    }
                }
                ?>
                <label>status</label>
                <select name="status" class="form-control">
                    <option <?php echo $selectedStatusEnable ?> value="<?php echo Category::STATUS_ENABLED?>">ENABLE</option>
                    <option <?php echo $selectedStatusDisabled ?>value="<?php echo Category::STATUS_DISABLED?>">DISABLE</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Save" class="btn btn-success">
                <a href="index.php?controller=category&action=index" class="btn btn-secondary">Cancel</a>
            </div>
        </form>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once 'views/layouts/footer.php' ?>

