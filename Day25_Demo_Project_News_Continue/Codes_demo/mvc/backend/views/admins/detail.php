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
        <h2>Chi tiết admin #<?php echo $admin['id']?></h2>
        <table class="table table-bordered">
            <tr>
                <td>ID</td>
                <td>
                    <?php echo $admin['id']; ?>
                </td>
            </tr>
            <tr>
                <td>Role name</td>
                <td>
                    <?php echo $admin['role_name']; ?>
                </td>
            </tr>
            <tr>
                <td>Username</td>
                <td>
                    <?php echo $admin['username']; ?>
                </td>
            </tr>
            <tr>
                <td>Created at</td>
                <td>
                    <?php
                    echo date('d-m-Y H:i:s',
                        strtotime($admin['created_at']));
                    ?>
                </td>
            </tr>
        </table>
        <a href="index.php?controller=admin&action=index" class="btn btn-primary">Back</a>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once 'views/layouts/footer.php' ?>
