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
        <h2>Update admin #<?php echo $admin['id']?></h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Chọn quyền cho admin</label>
                <select class="form-control" name="role_id">
                    <?php if (!empty($roles)):
                        $role_id = isset($_POST['role_id']) ? $_POST['role_id'] : $admin['role_id'];
                        ?>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?php echo $role['id'] ?>" <?php echo $role['id'] == $role_id ? "selected=true" : null ?>>
                                <?php echo $role['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username"
                       value="<?php echo isset($_POST['username']) ? $_POST['username'] : $admin['username']; ?>"
                       class="form-control"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password"
                       value="<?php echo isset($_POST['password']) ? $_POST['password'] : $admin['password']; ?>"
                       class="form-control"/>
            </div>
            <div class="form-group">
                <label>Nhập lại Password</label>
                <input type="password" name="password_confirm" class="form-control"/>
            </div>
            <div class="form-group">
                <input type="submit" name="submit"
                       class="btn btn-success" value="Save"/>
                <a href="index.php?controller=admin&action=index"
                   class="btn btn-secondary">Back</a>
            </div>
        </form>
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once 'views/layouts/footer.php' ?>
