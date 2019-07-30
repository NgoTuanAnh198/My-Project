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
                        <span class="post-list-title">Chi tiết bài viết</span>
                        <select class="frm-input">
                            <option value="1">Thể thao</option>
                            <option value="1">Công nghệ</option>
                            <option value="1">Trong nước</option>
                        </select>
                    </div>
                    <!--Timeline header area end -->
                    <!--Timeline items start -->
                    <div class="timeline-items">
                        <?php
                        $alias = Helper::alias($news['title']);
                        $id = $news['id'];
                        $urlNews = "tin-tuc/$alias/$id";
                        ?>
                        <div class="timeline-item">
                            <div class="timeline-left">
                                <div class="timeline-left-wrapper">
                                    <a href="<?php $urlNews ?>" class="timeline-category" data-zebra-tooltip
                                       title="Thể thao"><i
                                                class="material-icons">&#xE894;</i></a>
                                    <span class="timeline-date">
                                        <?php
                                        echo date('d-m-Y', strtotime($news['created_at']));
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="timeline-right">
                                <div class="timeline-post-image">
                                    <a href="<?php echo $urlNews; ?>">
                                        <img src="../backend/assets/uploads/<?php echo $news['avatar'] ?>"
                                             width="260">
                                    </a>
                                </div>
                                <div class="timeline-post-content">
                                    <a href="<?php echo $urlNews ?>" class="timeline-category-name">
                                        <?php echo $news['category_name']; ?>
                                    </a>
                                    <h3 class="timeline-post-title">
                                        <?php echo $news['title']?>
                                    </h3>
                                    <div class="timeline-post-info">
                                        <a href="<?php echo $urlNews ?>" class="author">
                                            <?php echo $news['admin_username']?>
                                        </a>
                                        <span class="dot"></span>
                                        <span class="comment">
                                            <?php echo $news['comment_total']?> comments
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!--Timeline items end -->
                    <div class="detail timeline-items">
                        <b class="detail-summary">
                            <?php echo $news['summary'] ?>
                        </b>
                        <div class="detail-description">
                            <?php echo $news['content']?>
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
