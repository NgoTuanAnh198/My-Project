<?php require_once 'views/layouts/header.php'; ?>
    <div class="container" id="main-content">
        <h2>Cập nhật bản ghi #<?php echo $news['id'] ?></h2>
        <form method="post" action="index.php?controller=home&action=update&id=<?php echo $news['id']?>">
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="title" value="<?php echo $news['title'] ?>"/>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
            <a href="index.php" class="btn btn-default">Hủy</a>
        </form>
    </div>
<?php require_once 'views/layouts/footer.php'; ?>