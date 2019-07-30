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
           href="index.php?controller=category&action=create">
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
                <th>Ation</th>
            </tr>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td>
                            <?php echo $category['id']; ?>
                        </td>
                        <td>
                            <?= $category['name']; ?>
                        </td>
<!--                        <td>-->
<!--                            --><?php //echo $category['description']; ?>
<!--                        </td>-->
                        <td>
                            <?php if (!empty($category['avatar'])): ?>
                                <img src="assets/uploads/<?php echo $category['avatar']?>"
                                     width="80px" />
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php
                            $statusText = '';
                            switch ($category['status']) {
                                case Category::STATUS_ENABLED: $statusText = 'Active';
                                break;
                                case Category::STATUS_DISABLED: $statusText = 'Disabled';
                                    break;
                            }
                            echo $statusText;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo date('d-m-Y H:i:s',
                                strtotime($category['created_at']));
                            ?>
                        </td>
                        <td>
                            <?php
                            $urlDetail = 'index.php?controller=category&action=detail&id=' . $category['id'];
                            $urlUpdate = 'index.php?controller=category&action=update&id=' . $category['id'];
                            $urlDelete = 'index.php?controller=category&action=delete&id=' . $category['id'];
                            ?>
                            <a href="<?php echo $urlDetail?>">
                                <span class="fa fa-eye"></span>
                            </a> &nbsp;
                            <a href="<?php echo $urlUpdate?>">
                                <span class="fa fa-pencil"></span>
                            </a> &nbsp;
                            <a href="<?php echo $urlDelete?>"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này hay không. Các bản ghi tin tức liên quan đến category này cũng sẽ bị xóa?');">
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
        //hiển thị phân trang
        echo $pages;
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once 'views/layouts/footer.php' ?>
