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
        <h2>Danh sách đơn hàng</h2>
        <table class="table table-bordered">
            <tr>
                <th>Mã đơn</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng đặt</th>
                <th>Giá</th>
                <th>Thành tiền</th>
            </tr>
          <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $order):
              ?>
                  <tr>
                      <td>
                        <?php echo $order['order_id']; ?>
                      </td>
                      <td>
                        <?php echo $order['product_name']; ?>
                      </td>
                      <td>
                        <?php echo $order['quality']; ?>
                      </td>
                      <td>
                        <?php echo number_format($order['product_price'], 0, '.', '.'); ?> VNĐ
                      </td>
                      <td>
                        <?php
                        $totalPrice = $order['quality'] * $order['product_price'];
                        echo number_format($totalPrice, 0, '.', '.'); ?> VNĐ
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
        echo $pages;
        ?>
        <a href="index.php?controller=order&action=index" class="btn btn-secondary">Back</a>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once 'views/layouts/footer.php' ?>
