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
        <h2>Cập nhật tin tức #<?php echo $news['id']?></h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title"
                       value="<?php echo isset($_POST['title']) ? $_POST['title'] : $news['title']; ?>"
                       class="form-control"/>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category_id">
                  <?php if (!empty($categories)):
                    $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : $news['category_id'];
                    ?>
                    <?php foreach ($categories as $category): ?>
                      <option value="<?php echo $category['id'] ?>" <?php echo $category['id'] == $category_id ? "selected=true" : null ?>>
                        <?php echo $category['name'] ?>
                      </option>
                  <?php endforeach; ?>
                  <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label>
                    Upload ảnh đại diện
                    (File dạng ảnh, dung lượng upload không vượt quá 2Mb)
                </label>
                <input type="file" name="avatar" class="form-control">
                <?php if (!empty($news['avatar'])): ?>
                    <img src="assets/uploads/<?php echo $product['avatar']?>" width="60" />
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label>Summary</label>
                <textarea name="summary"
                          class="form-control"><?php echo isset($_POST['summary']) ? $_POST['summary'] : $news['summary']; ?></textarea>
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea name="content" id='category-description'
                          class="form-control"><?php echo isset($_POST['content']) ? $_POST['content'] : $news['content']; ?></textarea>
            </div>
            <div class="form-group">
                <label>Comment_total</label>
                <input type="number" name="comment_total"
                       value="<?php echo isset($_POST['comment_total']) ? $_POST['comment_total'] : $news['comment_total']; ?>"
                       class="form-control"/>
            </div>
            <div class="form-group">
                <label>Like_total</label>
                <input type="number" name="like_total"
                       value="<?php echo isset($_POST['like_total']) ? $_POST['like_total'] : $news['like_total']; ?>"
                       class="form-control"/>
            </div>
            <div class="form-group">
              <?php
              $selectedStatusEnabled = '';
              $selectedStatusDisabled = '';
              $status = isset($_POST['status']) ? isset($_POST['status']) : $news['status'];
              switch ($status) {
                case News::STATUS_ENABLED:
                  $selectedStatusEnabled = "selected=true";
                  break;
                case News::STATUS_DISABLED:
                  $selectedStatusDisabled = "selected=true";
                  break;
              }
              ?>
                <label>Status</label>
                <select name="status" class="form-control">
                    <option <?php echo $selectedStatusEnabled ?> value="<?php echo News::STATUS_ENABLED ?>">
                        Enabled
                    </option>
                    <option <?php echo $selectedStatusDisabled ?> value="<?php echo News::STATUS_DISABLED ?>">
                        Disabled
                    </option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="submit"
                       class="btn btn-success" value="Save"/>
                <a href="index.php?controller=news&action=index"
                   class="btn btn-secondary">Cancel</a>
            </div>
        </form>
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once 'views/layouts/footer.php' ?>
