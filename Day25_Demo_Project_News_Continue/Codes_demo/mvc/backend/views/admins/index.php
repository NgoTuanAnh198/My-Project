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
        <a class="btn btn-primary"
           href="index.php?controller=admin&action=create">
            <span class="glyphicon glyphicon-plus"></span>
            Thêm mới
        </a>
        <h2>Danh sách admin trên hệ thống</h2>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Role</th>
                <th>Username</th>
                <th>Created_at</th>
                <th>Ation</th>
            </tr>
          <?php if (!empty($admins)): ?>
            <?php foreach ($admins as $admin): ?>
                  <tr>
                      <td>
                        <?php echo $admin['id']; ?>
                      </td>
                      <td>
                        <?php echo $admin['role_name']; ?>
                      </td>
                      <td>
                        <?php echo $admin['username']; ?>
                      </td>
                      <td>
                        <?php
                        echo date('d-m-Y H:i:s',
                          strtotime($admin['created_at']));
                        ?>
                      </td>
                      <td>
                        <?php
                        $urlDetail = 'index.php?controller=admin&action=detail&id=' . $admin['id'];
                        $urlUpdate = 'index.php?controller=admin&action=update&id=' . $admin['id'];
                        $urlDelete = 'index.php?controller=admin&action=delete&id=' . $admin['id'];
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
