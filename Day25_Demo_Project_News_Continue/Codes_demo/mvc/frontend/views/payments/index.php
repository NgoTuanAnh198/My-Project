<?php include_once 'views/layouts/header.php' ?>
<!--Main container start -->
<!--Main container start -->
<main class="main-container">
    <section class="main-content">
        <div class="main-content-wrapper">
            <div class="content-timeline">
                <!--Timeline header area start -->
                <div class="post-list-header">
                    <span class="post-list-title">Giỏ hàng của bạn</span>
                </div>
                <form action="" method="post">
                    <div class="timeline-items">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <h5 class="center-align">Thông tin khách hàng</h5>
                                <div class="form-group">
                                    <label>Họ tên khách hàng</label>
                                    <input type="text" name="fullname" value=""  class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" name="address" value=""  class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>SĐT</label>
                                    <input type="number" min="0" name="mobile" value=""  class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Ghi chú thêm</label>
                                    <textarea name="note" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <h5 class="center-align">Thông tin đơn hàng của bạn</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="40%">Tên sản phẩm</th>
                                        <th width="12%">Số lượng</th>
                                        <th>Giá</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img class="product-avatar img-responsive"
                                                 src="../backend/assets/uploads/tivi.jpg" width="60"/>
                                            <div class="content-product">
                                                <a href="#" class="content-product-a">Tivi Samsung 4k</a>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="product-amount">2</span>
                                        </td>
                                        <td>
                                            <span class="product-price-payment">1.500.000 vnđ</span>
                                        </td>
                                        <td>
                                            <span class="product-price-payment">3.000.000 vnđ</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img class="product-avatar img-responsive"
                                                 src="../backend/assets/uploads/tivi.jpg" width="60"/>
                                            <div class="content-product">
                                                <a href="#" class="content-product-a">Tivi Samsung 4k 2</a>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="product-amount">1</span>
                                        </td>
                                        <td>
                                            <span class="product-payment">2.500.000 vnđ</span>
                                        </td>
                                        <td>
                                            <span class="product-price-payment">2.500.000 vnđ</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="product-total">
                                            Tổng giá trị đơn hàng: <span class="product-price">5.500.000đ</span>
                                        </td>
                                    </tr>

                                </table>

                                        <input type="submit" name="submit" value="Thanh toán" class="btn btn-primary" />
                                        <a href="gio-hang-cua-ban" class="btn btn-secondary">Về trang giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

</main>
<?php include_once 'views/layouts/footer.php' ?>
