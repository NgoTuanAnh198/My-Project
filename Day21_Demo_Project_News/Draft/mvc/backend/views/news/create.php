<?php include_once 'views/layouts/header.php' ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>Tạo mới bản ghi</h2>
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
        <form method="post" action="">
            <div class="form-group">
                <label>title</label>
                <input type="text" class="form-control" name="title" value="<?php echo isset($_POST['title'])? $_POST['title']:''?>"/>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category_id">
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id'] ?>" <?php echo isset($_POST['category_id']) && $category['id'] == $_POST['category_id'] ? "selected=true" : null ?>>
                                <?php echo $category['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Upload ảnh (File dạng ảnh, dung lượng upload không vượt quá 2Mb)</label>
                <input type="file" name="avatar" class="form-control">
            </div>
            <div class="form-group">
                <label>summary</label>
                <input type="text" class="form-control" name="summary" value="<?php echo isset($_POST['summary'])? $_POST['summary']:''?>"/>
            </div>
            <div class="form-group">
                <label>content</label>
                <textarea name="content" id="content-description" class="form-control"><?php echo isset($_POST['content'])? $_POST['content']: '' ?></textarea>
            </div>
            <div class="form-group">
                <label>Comment_total</label>
                <input type="number" name="comment_total" value="<?php echo isset($_POST['comment_total']) ? $_POST['comment_total'] : ''; ?>"
                       class="form-control"/>
            </div>
            <div class="form-group">
                <label>Like_total</label>
                <input type="number" name="like_total" value="<?php echo isset($_POST['like_total']) ? $_POST['like_total'] : ''; ?>"
                       class="form-control"/>
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
                    <option <?php echo $selectedStatusEnable; ?> value="<?php echo News::STATUS_ENABLED?>">ENABLE</option>
                    <option <?php echo $selectedStatusDisabled;  ?>value="<?php echo News::STATUS_DISABLED?>">DISABLE</option>
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


