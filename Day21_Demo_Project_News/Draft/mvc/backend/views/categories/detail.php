
<?php include_once 'views/layouts/header.php' ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thông tin chi tiết
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
                <th>name</th>
                <th>Avatar</th>
                <th>Description</th>
                <th>status</th>
                <th>created_at</th>
            </tr>
            <tr>
                <td><?php echo $categories['id']; ?></td>
                <td><?php echo $categories['name']; ?></td>
                <td><?php if(!empty($categories['avatar'])): ?>
                        <img src="assets/uploads/<?php echo $categories['avatar']; ?>" width="80px">
                    <?php endif; ?>
                </td>
                <td><?php echo $categories['description']?></td>
                <td><?php if ($categories['status']==1){
                    echo "enable" ;
                    }
                    else{
                        echo "Disable";
                    }?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($categories['created_at'])); ?></td>
            </tr>
        </table>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once 'views/layouts/footer.php' ?>

