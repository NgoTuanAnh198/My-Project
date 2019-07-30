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
        <h2>Chi tiết quyền #<?php echo $role['id']?></h2>
        <table class="table table-bordered">
            <tr>
                <td>ID</td>
                <td>
                    <?php echo $role['id']; ?>
                </td>
            </tr>
            <tr>
                <td>Name</td>
                <td>
                    <?php echo $role['name']; ?>
                </td>
            </tr>
            <tr>
                <td>Description</td>
                <td>
                    <?php echo $role['description']; ?>
                </td>
            </tr>
        </table>
        <a href="index.php?controller=role&action=index" class="btn btn-primary">Back</a>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once 'views/layouts/footer.php' ?>
