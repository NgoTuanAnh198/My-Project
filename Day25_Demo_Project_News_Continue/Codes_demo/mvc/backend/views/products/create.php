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
        <h2>Thêm mới sản phẩm</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>"
                       class="form-control"/>
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
                <label>
                    Upload ảnh đại diện
                    (File dạng ảnh, dung lượng upload không vượt quá 2Mb)
                </label>
                <input type="file" name="avatar" class="form-control">
            </div>
            <div class="form-group">
                <label>Giá</label>
                <input type="number" name="price" value="<?php echo isset($_POST['price']) ? $_POST['price'] : 0; ?>"
                       class="form-control"/>
            </div>
            <div class="form-group">
                <label>Summary</label>
                <textarea name="summary"
                          class="form-control"><?php echo isset($_POST['summary']) ? $_POST['summary'] : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea name="content" id='category-description'
                          class="form-control"><?php echo isset($_POST['content']) ? $_POST['content'] : ''; ?></textarea>
            </div>
            
            <div class="form-group">
              <?php
              $selectedStatusEnabled = '';
              $selectedStatusDisabled = '';
              if (isset($_POST['status'])) {
                switch ($_POST['status']) {
                  case Product::STATUS_ENABLED:
                    $selectedStatusEnabled = "selected=true";
                    break;
                  case Product::STATUS_DISABLED:
                    $selectedStatusDisabled = "selected=true";
                    break;
                }
              }
              ?>
                <label>Status</label>
                <select name="status" class="form-control">
                    <option <?php echo $selectedStatusEnabled ?> value="<?php echo Product::STATUS_ENABLED ?>">
                        Enabled
                    </option>
                    <option <?php echo $selectedStatusDisabled ?> value="<?php echo Product::STATUS_DISABLED ?>">
                        Disabled
                    </option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="submit"
                       class="btn btn-success" value="Save"/>
                <a href="index.php?controller=product&action=index"
                   class="btn btn-secondary">Back</a>
            </div>
        </form>
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once 'views/layouts/footer.php' ?>
