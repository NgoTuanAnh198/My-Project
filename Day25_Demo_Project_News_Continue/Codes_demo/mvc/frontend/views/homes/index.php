<?php include_once 'views/layouts/header.php' ?>
<!--Main container start -->
<main class="main-container">
    <?php include_once 'views/layouts/slide.php'; ?>
    <section class="main-content">
        <div class="main-content-wrapper">
            <div class="content-body">
                <div class="content-timeline">
                    <!--Timeline header area start -->
                    <div class="post-list-header">
                        <span class="post-list-title">Bài viết mới</span>
                        <select class="frm-input">
                            <option value="1">Thể thao</option>
                            <option value="1">Book</option>
                            <option value="1">Cinema</option>
                        </select>
                    </div>
                    <!--Timeline header area end -->


                    <!--Timeline items start -->
                    <div class="timeline-items">
                        <?php if (!empty($news)): ?>
                            <?php foreach ($news as $new):
//                                slug, alias
                                $alias = Helper::alias($new['title']);
                                $id = $new['id'];
                                $urlNew = "tin-tuc/$alias/$id";
                                ?>
                                <div class="timeline-item">
                                    <div class="timeline-left">
                                        <div class="timeline-left-wrapper">
                                            <a href="<?php echo $urlNew; ?>" class="timeline-category"
                                               data-zebra-tooltip title="Thể thao"><i
                                                        class="material-icons">&#xE894;</i></a>
                                            <span class="timeline-date">
                                                <?php echo date('d-m-Y', strtotime($new['created_at'])) ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="timeline-right">
                                        <div class="timeline-post-image">
                                            <a href="<?php echo $urlNew; ?>">
                                                <img src="../backend/assets/uploads/<?php echo $new['avatar'] ?>"
                                                     width="260">
                                            </a>
                                        </div>
                                        <div class="timeline-post-content">
                                            <a href="<?php echo $urlNew; ?>"
                                               class="timeline-category-name">
                                                <?php echo $new['category_name'] ?>
                                            </a>
                                            <a href="<?php echo $urlNew; ?>">
                                                <h3 class="timeline-post-title">
                                                    <?php echo $new['title'] ?>
                                                </h3>
                                            </a>
                                            <div class="timeline-post-info">
                                                <a href="<?php echo $urlNew; ?>" class="author">
                                                    <?php echo $new['admin_username'] ?>
                                                </a>
                                                <span class="dot"></span>
                                                <span class="comment">
                                                    <?php echo $new['comment_total'] ?> comments
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>


                    </div>
                    <!--Timeline items end -->

                    <!--Data load more button start  -->
                    <div class="load-more">
                        <button class="load-more-button material-button" type="button">
                            <i class="material-icons">&#xE5D5;</i>
                            <span>Load More</span>
                        </button>
                    </div>
                    <!--Data load more button start  -->
                </div>

            </div>
            <div class="content-sidebar">
                <div class="sidebar_inner">
                    <div class="widget-item">
                        <div class="w-header">
                            <div class="w-title">Sản phẩm mới nhất</div>
                            <div class="w-seperator"></div>
                        </div>
                        <?php if (!empty($products)): ?>
                            <div class="w-boxed-post">
                                <ul>
                                    <?php foreach ($products as $product):
                                        //set url chi tiết của sản phẩm,
                                        //đã được rewrite lại trong file .htaccess
                                        //có dạng sau: san-pham/<text>/<id>
                                        $productAlias = Helper::alias($product['name']);
                                        $productId = $product['id'];
                                        $productUrl = "san-pham/$productAlias/$productId";
                                        $productAvatar = !empty($product['avatar']) ? $product['avatar'] : '';
                                        //link thêm vào giỏ hàng
                                        //do đang demo nên sử dụng link mỗi khi thêm sản phẩm vào giỏ hàng
                                        //các ứng dụng thực tế sẽ sử dụng ajax để tiện cho user
                                        //url thêm vào giỏ hàng cũng sẽ đc rewrite lại trong file .htaccess
                                        $productCartUrl = "them-gio-hang/$productId";
                                        ?>
                                        <li class="">
                                            <a href="<?php echo $productUrl ?>" title="<?php echo $product['name']; ?>"
                                               >
                                                <div class="box-wrapper" style="    width: 100%;">
                                                    <div class="box-left" style="width: 100px">
                                                        <!--                                                        <span>-->
                                                            <img src="../backend/assets/uploads/<?php echo $productAvatar ?>"
                                                                 width="100%"/>
                                                        <!--                                                        </span>-->
                                                    </div>
                                                    <div class="box-right">
                                                        <h3 class="p-title">
                                                            <?php echo $product['name'] ?>
                                                        </h3>
                                                        <div class="p-icons">
                                                            <?php echo number_format($product['price'], 0, '.', '.'); ?> VND
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="<?php echo $productCartUrl ?>" class="add-to-cart">Add to cart</a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
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
