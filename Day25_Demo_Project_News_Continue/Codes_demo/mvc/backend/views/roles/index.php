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
           href="index.php?controller=role&action=create">
            <span class="glyphicon glyphicon-plus"></span>
            Thêm mới
        </a>
        <h2>Danh sách quyền</h2>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Tên quyền</th>
                <th>Mô tả</th>
                <th>Action</th>
            </tr>
          <?php if (!empty($roles)): ?>
            <?php foreach ($roles as $role): ?>
                  <tr>
                      <td>
                        <?php echo $role['id']; ?>
                      </td>
                      <td>
                        <?php echo $role['name']; ?>
                      </td>
                      <td>
                        <?php echo $role['description']; ?>
                      </td>
                      <td>
                        <?php
                        $urlDetail = 'index.php?controller=role&action=detail&id=' . $role['id'];
                        $urlUpdate = 'index.php?controller=role&action=update&id=' . $role['id'];
                        $urlDelete = 'index.php?controller=role&action=delete&id=' . $role['id'];
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
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once 'views/layouts/footer.php' ?>
