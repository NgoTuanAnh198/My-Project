<?php require_once 'views/layouts/header.php'; ?>
    <div id="main-container" class="container">
        <?php if (!empty($news)): ?>
            <h3>Thông tin bản ghi <b>#<?php echo $news['id']; ?></b></h3>
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category_id</th>
                    <th>user_id</th>
                    <th>summary</th>
                    <th>content</th>
                    <th>comment_total</th>
                    <th>like_total</th>
                    <th>status</th>
                    <th>create_at</th>
                </tr>
                <tr>
                    <td><?php echo $news['id']; ?></td>
                    <td><?php echo $news['title']; ?></td>
                    <td><?php echo $news['Category_id']; ?></td>
                    <td><?php echo $news['user_id']; ?></td>
                    <td><?php echo $news['summary']; ?></td>
                    <td><?php echo $news['content']; ?></td>
                    <td><?php echo $news['comment_total']; ?></td>
                    <td><?php echo $news['like_total']; ?></td>
                    <td><?php echo $news['status']; ?></td>
                    <td><?php echo date('d-m-Y H:i:s', strtotime($news['created_at'])); ?></td>
                    <td></td>
                </tr>
            </table>
        <?php else: ?>
            <h3>Không tìm thấy thông tin bản khi</h3>
        <?php endif; ?>
        <a href="index.php" class="btn btn-primary">Back</a>
    </div>
<?php require_once 'views/layouts/footer.php'; ?>