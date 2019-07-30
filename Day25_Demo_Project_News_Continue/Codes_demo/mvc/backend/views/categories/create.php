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
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '';?>" class="form-control"/>
            </div>
            <div class="form-group">
                <label>
                    Upload ảnh đại diện
                    (File dạng ảnh, dung lượng upload không vượt quá 2Mb)
                </label>
                <input type="file" name="avatar" class="form-control">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea id='category-description' name="description"
                          class="form-control"><?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?>
                </textarea>
            </div>
            <div class="form-group">
                <?php
                $selectedStatusEnabled = '';
                $selectedStatusDisabled = '';
                if (isset($_POST['status'])) {
                    switch ($_POST['status']) {
                        case Category::STATUS_ENABLED:
                            $selectedStatusEnabled = "selected=true";
                            break;
                        case Category::STATUS_DISABLED:
                            $selectedStatusDisabled = "selected=true";
                            break;
                    }

                }
                ?>
                <label>Status</label>
                <select name="status" class="form-control">
                    <option <?php echo $selectedStatusEnabled?> value="<?php echo Category::STATUS_ENABLED ?>">
                        Enabled
                    </option>
                    <option <?php echo $selectedStatusDisabled?> value="<?php echo Category::STATUS_DISABLED ?>">
                        Disabled
                    </option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="submit"
                       class="btn btn-success" value="Save"/>
                <a href="index.php?controller=category&action=index"
                   class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once 'views/layouts/footer.php' ?>
