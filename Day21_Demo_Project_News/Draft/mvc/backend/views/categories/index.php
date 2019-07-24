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
        <a class="btn btn-primary" href="index.php?controller=category&action=create">
            <span class="glyphicon glyphicon-plus"></span>
            Thêm mới
        </a>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <!--                <th>Description</th>-->
                <th>Avatar</th>
                <th>Status</th>
                <th>Created_at</th>
                <th>Action</th>
            </tr>
            <?php if (!empty($Categories)): ?>
                <?php foreach ($Categories as $category): ?>
                    <tr>
                        <td><?php echo $category['id']; ?></td>
                        <td><?php echo $category['name']; ?></td>
                        <!--                        <td>--><?php //echo $category['Description']; ?><!--</td>-->
                        <td><?php if (!empty($category['avatar'])): ?>
                                <img src="assets/uploads/<?php echo $category['avatar'] ?>" width="80px">
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php $statusText = '';
                            switch ($category['status']) {
                                case Category::STATUS_ENABLED:
                                    $statusText = "Active";
                                    break;
                                case Category::STATUS_DISABLED:
                                    $statusText = "Disable";
                                    break;
                            }
                            echo $statusText;
                            ?>

                        </td>
                        <td><?php echo date('d-m-Y H:i:s', strtotime($category['created_at'])) ?>

                        </td>
                        <td>
                            <?php  $urlDetail = 'index.php?controller=category&action=detail&id=' . $category['id'];
                             $urlUpdate = 'index.php?controller=category&action=update&id=' . $category['id'];
                             $urlDelete = 'index.php?controller=category&action=delete&id=' . $category['id'];
                            ?>
                            <a href="<?php echo $urlDetail ?>">
                                <i class="fas fa-eye"></i>
                            </a>&nbsp;
                            <a href="<?php echo $urlUpdate ?>">
                                <i class="fas fa-pencil-alt"></i>
                            </a>&nbsp;
                            <a href="<?php echo $urlDelete ?>"
                               onclick="return confirm('Bạn có định xóa bản ghi không, nhanh nào, nhà bao việc')">
                                <i class="fas fa-trash"></i>
                            </a>&nbsp;
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once 'views/layouts/footer.php' ?>
