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
                <th>Họ tên</th>
                <th>Địa chỉ</th>
                <th>SĐT</th>
                <th>Ghi chú</th>
                <th>Tổng tiền</th>
                <th>Trạng thái thanh toán</th>
                <th>Ngày tạo đơn</th>
                <th>Action</th>
            </tr>
          <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $order):
              $id = $order['id'];
              ?>
                  <tr>
                      <td>
                        <?php echo $order['id']; ?>
                      </td>
                      <td>
                        <?php echo $order['fullname']; ?>
                      </td>
                      <td>
                        <?php echo $order['address']; ?>
                      </td>
                      <td>
                        <?php echo $order['mobile']; ?>
                      </td>
                      <td>
                        <?php echo $order['note']; ?>
                      </td>
                      <td>
                        <?php echo number_format($order['price_total'], 0, '.', '.'); ?> VNĐ
                      </td>
                      <td>
                        <?php
                        $paymentText = '';
                        switch ($order['payment_status']) {
                          case Order::PAYMENT_STATUS_DONE:
                            $paymentText = Order::PAYMENT_STATUS_DONE_TEXT;
                            break;
                          case Order::PAYMENT_STATUS_UNDONE:
                            $paymentText = Order::PAYMENT_STATUS_UNDONE_TEXT;
                            break;
                        }
                        //                        trường hợp order chưa thành toán, sẽ có thêm 1 link để cho phép xác nhận thanh toán
                        if ($order['payment_status'] == Order::PAYMENT_STATUS_UNDONE) {
                          $paymentText .= " <a href='index.php?controller=payment&action=updatePaymentStatus&id=$id' class='payment-status' onclick='return confirm(\"Chắc chắn bạn muốn cập nhật trạng thái thành Đã thanh toán?\")'>Xác nhận thanh toán</a>";
                        }
                        echo $paymentText;
                        ?>
                      </td>
                      <td>
                        <?php
                        echo date('d-m-Y H:i:s', strtotime($order['created_at']));
                        ?>
                      </td>
                      <td>
                          <a href="index.php?controller=order&action=orderDetail&order_id=<?php echo $id; ?>" title="Chi tiết đơn hàng #<?php echo $id; ?>">
                              <span class="fa fa-eye"></span>
                          </a>
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
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once 'views/layouts/footer.php' ?>
