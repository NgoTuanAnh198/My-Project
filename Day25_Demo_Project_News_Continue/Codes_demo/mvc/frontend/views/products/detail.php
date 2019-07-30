<?php include_once 'views/layouts/header.php' ?>
<!--Main container start -->
<!--Main container start -->
<main class="main-container">
    <section class="main-content">
        <div class="main-content-wrapper">
            <div class="content-body">
                <div class="content-timeline">
                    <!--Timeline header area start -->
                    <div class="post-list-header">
                        <span class="post-list-title">Chi tiết sản phẩm</span>
<!--
-->
                    </div>
                    <!--Timeline header area end -->
                    <!--Timeline items start -->
                    <div class="timeline-items">
                        <?php
                        $alias = Helper::alias($product['name']);
                        $id = $product['id'];
                        $urlProduct = "san-pham/$alias/$id";
                        $productCartUrl = "them-gio-hang/$id";
                        ?>
                        <div class="timeline-item">
                            <div class="timeline-left">
                                <div class="timeline-left-wrapper">
                                    <a href="<?php $urlProduct ?>" class="timeline-category" data-zebra-tooltip
                                       title="<?php echo $product['name']; ?>"><i
                                                class="material-icons">&#xE894;</i></a>
                                    <span class="timeline-date">
                                        <?php
                                        echo date('d-m-Y', strtotime($product['created_at']));
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="timeline-right">
                                <div class="timeline-post-image">
                                    <a href="<?php echo $urlProduct; ?>">
                                        <img src="../backend/assets/uploads/<?php echo $product['avatar'] ?>"
                                             width="260">
                                    </a>
                                </div>
                                <div class="timeline-post-content">
                                    <a href="<?php echo $urlProduct ?>" class="timeline-category-name">
                                        <?php echo $product['category_name']; ?>
                                    </a>
                                    <h3 class="timeline-post-title">
                                        <?php echo $product['name'] ?>
                                    </h3>
                                    <div class="timeline-post-info">
                                        <a href="<?php echo $urlProduct ?>" class="author">
                                            <?php echo $product['admin_username'] ?>
                                        </a>
                                        <span class="dot"></span>
                                        <span class="comment">
                                            <?php echo number_format($product['price'], 0, '.', '.'); ?> VNĐ
                                        </span>
                                    </div>
                                    <a href="<?php echo $productCartUrl ?>" class="add-to-cart">Add to cart</a>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!--Timeline items end -->
                    <div class="detail timeline-items">
                        <b class="detail-summary">
                            <?php echo $product['summary'] ?>
                        </b>
                        <div class="detail-description">
                            <?php echo $product['content'] ?>
                        </div>
                    </div>
                    <div class="detail-comment">
                        <div class="fb-comments" data-href="https://sukien.net" data-width="" data-numposts="5"></div>
                    </div>
                </div>

            </div>
            <div class="content-sidebar">
                <div class="sidebar_inner">

                    <div class="widget-item">
                        <div class="w-header">
                            <div class="w-title">Đọc nhiều nhất</div>
                            <div class="w-seperator"></div>
                        </div>
                        <div class="w-boxed-post">
                            <ul>
                                <li class="active">
                                    <a href="detail.html"
                                       style="background-image: url(http://tevratgundogdu.com/works/ideabox-html-template/img/news-test-images/news-img7.jpg);">
                                        <div class="box-wrapper">
                                            <div class="box-left">
                                                <span>1</span>
                                            </div>
                                            <div class="box-right">
                                                <h3 class="p-title">Things to Consider When Choosing City Moving
                                                    Companies</h3>
                                                <div class="p-icons">
                                                    213 likes . 124 comments
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="detail.html"
                                       style="background-image: url(http://tevratgundogdu.com/works/ideabox-html-template/img/news-test-images/news-img5.jpg);">
                                        <div class="box-wrapper">
                                            <div class="box-left">
                                                <span>2</span>
                                            </div>
                                            <div class="box-right">
                                                <h3 class="p-title">Things to Consider When Choosing City Moving
                                                    Companies</h3>
                                                <div class="p-icons">
                                                    213 likes . 124 comments
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="detail.html"
                                       style="background-image: url(http://tevratgundogdu.com/works/ideabox-html-template/img/news-test-images/news-img6.jpg);">
                                        <div class="box-wrapper">
                                            <div class="box-left">
                                                <span>3</span>
                                            </div>
                                            <div class="box-right">
                                                <h3 class="p-title">Things to Consider When Choosing City Moving
                                                    Companies</h3>
                                                <div class="p-icons">
                                                    213 likes . 124 comments
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="detail.html"
                                       style="background-image: url(http://tevratgundogdu.com/works/ideabox-html-template/img/news-test-images/news-img3.jpg);">
                                        <div class="box-wrapper">
                                            <div class="box-left">
                                                <span>4</span>
                                            </div>
                                            <div class="box-right">
                                                <h3 class="p-title">Things to Consider When Choosing City Moving
                                                    Companies</h3>
                                                <div class="p-icons">
                                                    213 likes . 124 comments
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <div class="widget-item">
                        <div class="w-header">
                            <div class="w-title">Carousel Posts</div>
                            <div class="w-seperator"></div>
                        </div>
                        <div class="w-carousel-post">
                            <div class="owl-carousel" id="widgetCarousel">
                                <div class="item">
                                    <a href="#">
                                        <div class="w-play-img">
                                            <img src="http://tevratgundogdu.com/works/ideabox-html-template/img/news-test-images/news-img4.jpg"
                                                 width="300">
                                            <span class="w-video-icon"><i class="material-icons">&#xE038;</i></span>
                                        </div>
                                        <span class="w-post-title">It has roots in a piece of classical Latin literature from</span>

                                    </a>
                                </div>
                                <div class="item">
                                    <a href="#">
                                        <img src="http://tevratgundogdu.com/works/ideabox-html-template/img/news-test-images/news-img5.jpg"
                                             width="300">
                                        <span class="w-post-title">Lorem Ipsum used since</span>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="#">
                                        <img src="http://tevratgundogdu.com/works/ideabox-html-template/img/news-test-images/news-img6.jpg"
                                             width="300">
                                        <span class="w-post-title">English versions from the 1914 translation</span>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="#">
                                        <img src="http://tevratgundogdu.com/works/ideabox-html-template/img/news-test-images/news-img7.jpg"
                                             width="300">
                                        <span class="w-post-title">The standard chunk of Lorem Ipsum used since</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="seperator"></div>

                    <a href="#" class="widget-ad-box">
                        <img src="http://tevratgundogdu.com/works/ideabox-html-template/img/adbox300x250.png"
                             width="300" height="250">
                    </a>

                </div>
            </div>
        </div>
    </section>

</main>
<?php include_once 'views/layouts/footer.php' ?>
