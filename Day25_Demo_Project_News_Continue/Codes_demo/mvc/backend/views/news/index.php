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
        <div class="search-form">
            <h4>Tìm kiếm</h4>
<!--            SEARCH nên để method get để có thể xử lý cho trường hợp phân trang-->
            <form action="index.php?controller=news&action=index" method="GET">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <label>Tên bài viết</label>
                        <input type="text" name="title" value="<?php echo isset($_GET['title']) ? $_GET['title'] : ''?>" class="form-control"/>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <label>Danh mục</label>
                        <select class="form-control" name="category_id">
                          <?php if (!empty($categories)): ?>
                          <option value="0">Select</option>
                            <?php foreach ($categories as $category): ?>
                                  <option value="<?php echo $category['id'] ?>" <?php echo isset($_GET['category_id']) && $category['id'] == $_GET['category_id'] ? "selected=true" : null ?>>
                                    <?php echo $category['name'] ?>
                                  </option>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <label>Lượt comment</label>
                        <input type="number" name="comment_total" value="<?php echo isset($_GET['comment_total']) ? $_GET['comment_total'] : ''?>" class="form-control"/>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <label>Lượt like</label>
                        <input type="number" name="like_total" value="<?php echo isset($_GET['like_total']) ? $_GET['like_total'] : ''?>" class="form-control"/>
                    </div>
<!--                    cần thêm 2 input hidden tương ứng với 2 param controller và action trên url-->
                    <input type="hidden" name="controller" value="<?php echo isset($_GET['controller']) ? $_GET['controller'] : ''?>"/>
                    <input type="hidden" name="action" value="<?php echo isset($_GET['action']) ? $_GET['action'] : ''?>"/>
                </div>
                <br />
                <div class="form-group">
                    <button type="submit" name="submit_search" class="btn btn-success">
                        <span class="fa fa-search"></span> Tìm kiếm
                    </button>
                    <a href="index.php?controller=news&action=index" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
        <a class="btn btn-primary"
           href="index.php?controller=news&action=create">
            <span class="glyphicon glyphicon-plus"></span>
            Thêm mới
        </a>

        <h2>Danh sách tin tức</h2>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Tên bài viết</th>
                <th>Danh mục</th>
                <th>Người tạo</th>
                <th>Avatar</th>
                <th>Lượt comment</th>
                <th>Lượt like</th>
                <th>Lượt view</th>
                <th>Status</th>
                <th>Created_at</th>
                <th>Ation</th>
            </tr>
          <?php if (!empty($news)): ?>
            <?php foreach ($news as $new): ?>
                  <tr>
                      <td>
                        <?php echo $new['id']; ?>
                      </td>
                      <td>
                        <?php echo $new['title']; ?>
                      </td>
                      <td>
                        <?php echo $new['category_name']; ?>
                      </td>
                      <td>
                        <?php echo $new['admin_username']; ?>
                      </td>
                      <td>
                        <?php if (!empty($new['avatar'])): ?>
                            <img src="assets/uploads/<?php echo $new['avatar'] ?>"
                                 width="80px"/>
                        <?php endif; ?>
                      </td>
                      <td>
                        <?php echo $new['comment_total']; ?>
                      </td>
                      <td>
                        <?php echo $new['like_total']; ?>
                      </td>
                      <td>
                        <?php echo $new['view']; ?>
                      </td>
                      <td>
                        <?php
                        $statusText = '';
                        switch ($new['status']) {
                          case News::STATUS_ENABLED:
                            $statusText = 'Active';
                            break;
                          case News::STATUS_DISABLED:
                            $statusText = 'Disabled';
                            break;
                        }
                        echo $statusText;
                        ?>
                      </td>
                      <td>
                        <?php
                        echo date('d-m-Y H:i:s',
                          strtotime($new['created_at']));
                        ?>
                      </td>
                      <td>
                        <?php
                        $urlDetail = 'index.php?controller=news&action=detail&id=' . $new['id'];
                        $urlUpdate = 'index.php?controller=news&action=update&id=' . $new['id'];
                        $urlDelete = 'index.php?controller=news&action=delete&id=' . $new['id'];
                        ?>
                          <a href="<?php echo $urlDetail ?>">
                              <span class="fa fa-eye"></span>
                          </a> &nbsp;
                          <a href="<?php echo $urlUpdate ?>">
                              <span class="fa fa-pencil"></span>
                          </a> &nbsp;
                          <a href="<?php echo $urlDelete ?>"
                             onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này hay không?');">
                              <span class="fa fa-trash"></span>
                          </a> &nbsp;
                      </td>
                  </tr>
            <?php endforeach; ?>
          <?php else: ?>
              <tr>
                  <td colspan="7">
                      Không có bản ghi nào
                  </td>
              </tr>
          <?php endif; ?>
        </table>
      <?php
      //hiển thị phân trang đã có được từ controller
      echo $pages;
      ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once 'views/layouts/footer.php' ?>
