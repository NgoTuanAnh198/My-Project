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
        <h2>Chi tiết sản phẩm #<?php echo $product['id']?></h2>
        <table class="table table-bordered">
            <tr>
                <td>ID</td>
                <td>
                    <?php echo $product['id']; ?>
                </td>
            </tr>
            <tr>
                <td>Name</td>
                <td>
                    <?php echo $product['name']; ?>
                </td>
            </tr>
            <tr>
                <td>Categoy name</td>
                <td>
                    <?php echo $product['category_name']; ?>
                </td>
            </tr>
            <tr>
                <td>Admin name</td>
                <td>
                  <?php echo $product['admin_username']; ?>
                </td>
            </tr>
            <tr>
                <td>Avatar</td>
                <td>
                    <?php if(!empty($product['avatar'])): ?>
                    <img src="assets/uploads/<?php echo $product['avatar']?>"
                         width="80px" />
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Price</td>
                <td>
                    <?php echo number_format($product['price']); ?>VNĐ
                </td>
            </tr>
            <tr>
                <td>Summary</td>
                <td>
                  <?php echo $product['summary']; ?>
                </td>
            </tr>
            <tr>
                <td>Content</td>
                <td>
                  <?php echo $product['content']; ?>
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <?php
                    $statusText = '';
                    switch ($product['status']) {
                        case Category::STATUS_ENABLED: $statusText = 'Active';
                            break;
                        case Category::STATUS_DISABLED: $statusText = 'Disabled';
                            break;
                    }
                    echo $statusText;
                    ?>
                </td>
            </tr>
            <tr>
                <td>Created at</td>
                <td>
                    <?php
                    echo date('d-m-Y H:i:s',
                        strtotime($product['created_at']));
                    ?>
                </td>
            </tr>
        </table>
        <a href="index.php?controller=product&action=index" class="btn btn-primary">Back</a>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once 'views/layouts/footer.php' ?>
