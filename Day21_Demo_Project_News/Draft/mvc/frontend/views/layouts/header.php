<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MVC Tin tức</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,600,700,900&amp;subset=latin-ext"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <!-- Tooltip plugin (zebra) css file -->
    <link rel="stylesheet" href="assets/css/zebra_tooltips.min.css"/>
    <!-- Owl Carousel plugin css file. only used pages -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css"/>
    <!-- Ideabox main theme css file. you have to add all pages -->
    <link rel="stylesheet" href="assets/css/main-style.css"/>
    <!-- Ideabox responsive css file -->
    <link rel="stylesheet" href="assets/css/responsive-style.css"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>

<body>

<!-- header start -->
<header class="header">
    <div class="header-wrapper">

        <!--sidebar menu toggler start -->
        <div class="toggle-sidebar material-button">
            <i class="material-icons">&#xE5D2;</i>
        </div>
        <!--sidebar menu toggler end -->

        <!--logo start -->
        <div class="logo-box">
            <h1>
                <a href="index.html" class="logo"></a>
            </h1>
        </div>
        <!--logo end -->

        <div class="header-menu">

            <!-- header left menu start -->
            <ul class="header-navigation" data-show-menu-on-mobile>
                <li>
                    <a href="#" class="material-button submenu-toggle">HOME</a>
                    <div class="header-submenu">
                        <ul>
                            <li><a href="index.html">Home demo 1</a></li>
                            <li><a href="index2.html">Home demo 2</a></li>
                            <li><a href="index3.html">Home demo 3</a></li>
                            <li><a href="index4.html">Home demo 4</a></li>
                            <li><a href="index5.html">Home demo 5</a></li>
                            <li><a href="index6.html">Home demo 6</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" class="material-button submenu-toggle">POSTS</a>
                    <div class="header-submenu">
                        <ul>
                            <li><a href="list-timeline.html">List timeline</a></li>
                            <li><a href="list-two-column.html">List column 2</a></li>
                            <li><a href="list-three-column.html">List column 3</a></li>
                            <li><a href="detail-standart.html">Detail standart</a></li>
                            <li><a href="detail-parallax.html">Detail parallax</a></li>
                            <li><a href="detail-with-large-adbox.html">Detail adbox 1</a></li>
                            <li><a href="detail-with-slim-adbox.html">Detail adbox 2</a></li>
                            <li><a href="detail-left-sidebar.html">Left sidebar</a></li>
                            <li><a href="detail-left-sidebar-adbox.html">Left sidebar adbox</a></li>
                            <li><a href="detail-full-width.html">Full width</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" class="material-button submenu-toggle">VIDEO</a>
                    <div class="header-submenu">
                        <ul>
                            <li><a href="video-standart.html">Video standart</a></li>
                            <li><a href="video-iframe.html">Video iframe</a></li>
                            <li><a href="video-custom-player.html">Video custom player</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" class="material-button submenu-toggle">EXTRA PAGES <i
                            class="material-icons">&#xE313;</i></a>
                    <div class="header-submenu">
                        <ul>
                            <li><a href="authors.html">Authors</a></li>
                            <li><a href="author-posts-1.html">Author posts-column</a></li>
                            <li><a href="author-posts-2.html">Author posts-timeline</a></li>
                            <li><a href="about-us.html">About us</a></li>
                            <li><a href="privacy-policy.html">Privacy policy</a></li>
                            <li><a href="contact.html">Contact</a></li>
                            <li><a href="error.html">Error</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <!-- header left menu end -->

        </div>
        <div class="header-right with-seperator">

            <!-- header right menu start -->
            <ul class="header-navigation">
                <li>
                    <a href="#" class="material-button search-toggle"><i class="material-icons">&#xE8B6;</i></a>
                </li>
                <li>
                    <a href="#" class="material-button submenu-toggle"><i class="material-icons">&#xE7FD;</i> <span
                            class="hide-on-tablet">Tài khoản</span></a>
                    <div class="header-submenu">
                        <ul>
                            <li><a href="#" data-modal="loginModal">Đăng nhập</a></li>
                            <li><a href="#" data-modal="registerModal">Đăng ký</a></li>
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="#">Logout</a></li>
                        </ul>
                    </div>
                </li>
                <li class="hide-on-mobile"><a href="#" class="material-button" data-modal="newsletterModal"><i
                            class="material-icons">&#xE0E1;</i></a></li>
            </ul>
            <!-- header right menu end -->

        </div>

        <!--header search panel start -->
        <div class="search-bar">
            <form class="search-form">
                <div class="search-input-wrapper">
                    <input type="text" name="qq" placeholder="Tìm kiếm..." class="search-input">
                    <button type="submit" name="search" class="search-submit"><i class="material-icons">&#xE5C8;</i>
                    </button>
                </div>
                <span class="search-close search-toggle">
						<i class="material-icons">&#xE5CD;</i>
					</span>
            </form>
        </div>
        <!--header search panel end -->

    </div>
</header>

<!-- Left sidebar menu start -->
<div class="sidebar">
    <div class="sidebar-wrapper">

        <!-- side menu logo start -->
        <div class="sidebar-logo">
            <a href="#"></a>
            <div class="sidebar-toggle-button">
                <i class="material-icons">&#xE317;</i>
            </div>
        </div>
        <!-- side menu logo end -->

        <!-- showing on mobile screen sizes -->
        <!-- mobile menu start -->
        <div id="mobileMenu">
            <div class="sidebar-seperate"></div>
        </div>
        <!-- mobile menu end -->

        <!-- sidebar menu start -->
        <ul class="sidebar-menu">
            <li class="active">
                <a href="#" class="material-button">
                    <span class="menu-icon"><i class="material-icons">&#xE88A;</i></span>
                    <span class="menu-label">Home</span>
                </a>
            </li>
            <li>
                <a href="#" class="material-button">
                    <span class="menu-icon"><i class="material-icons">&#xE038;</i></span>
                    <span class="menu-label">Videos</span>
                </a>
            </li>
            <li>
                <a href="#" class="material-button">
                    <span class="menu-icon"><i class="material-icons">&#xE0BF;</i></span>
                    <span class="menu-label">Posts</span>
                </a>
            </li>
            <li>
                <a href="#" class="material-button">
                    <span class="menu-icon"><i class="material-icons">&#xE866;</i></span>
                    <span class="menu-label">Contact</span>
                </a>
            </li>
            <li>
                <a href="#" class="material-button">
                    <span class="menu-icon"><i class="material-icons">&#xE8B0;</i></span>
                    <span class="menu-label">Multi Menu</span>
                    <span class="multimenu-icon"><i class="material-icons">&#xE313;</i></span>
                </a>
                <ul>
                    <li>
                        <a href="#"><span class="menu-label">Menu Level 1</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="menu-label">Menu Level 2</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="menu-label">Menu Level 3</span></a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- sidebar menu end -->

        <div class="sidebar-seperate"></div>

        <!-- sidebar menu start -->
        <ul class="sidebar-menu">
            <li>
                <a href="#" class="material-button">
                    <span class="menu-icon"><i class="material-icons">&#xE88A;</i></span>
                    <span class="menu-label">Extra Menu One</span>
                </a>
            </li>
            <li>
                <a href="#" class="material-button">
                    <span class="menu-icon"><i class="material-icons">&#xE8B0;</i></span>
                    <span class="menu-label">Extra Menu Two</span>
                </a>
            </li>
            <li>
                <a href="#" class="material-button">
                    <span class="menu-icon"><i class="material-icons">&#xE038;</i></span>
                    <span class="menu-label">Extra Menu Three</span>
                </a>
            </li>
        </ul>
        <!-- sidebar menu end -->

        <div class="sidebar-seperate"></div>

        <!-- sidebar menu start -->
        <ul class="sidebar-menu">
            <li>
                <a href="#" class="facebook material-button">
                    <span class="menu-label">Facebook</span>
                </a>
            </li>
            <li>
                <a href="#" class="twitter material-button">
                    <span class="menu-label">Twitter</span>
                </a>
            </li>
            <li>
                <a href="#" class="google-plus material-button">
                    <span class="menu-label">Google +</span>
                </a>
            </li>
        </ul>
        <!-- sidebar menu end -->
    </div>
</div>
<!-- Left sidebar menu end -->

<!-- Register popup html source start -->
<div class="m-modal-box" id="registerModal">
    <div class="m-modal-overlay"></div>
    <div class="m-modal-content small">
        <div class="m-modal-header">
            <h3 class="m-modal-title">Register</h3>
            <span class="m-modal-close"><i class="material-icons">&#xE5CD;</i></span>
        </div>
        <div class="m-modal-body">
            <div class="m-modal-social-logins">
                <div class="columns column-2">
                    <button class="frm-button facebook material-button full" type="button">Facebook</button>
                </div>
                <div class="columns column-2">
                    <button class="frm-button twitter material-button full" type="button">Twitter</button>
                </div>
                <div class="columns column-2">
                    <button class="frm-button google material-button full" type="button">Google</button>
                </div>
            </div>

            <div class="m-modal-seperator"><span>OR</span></div>

            <form>
                <div class="frm-row">
                    <input class="frm-input" type="text" name="name" placeholder="Name">
                </div>
                <div class="frm-row">
                    <input class="frm-input" type="text" name="username" placeholder="Username">
                </div>
                <div class="frm-row">
                    <input class="frm-input" type="text" name="email" placeholder="Email">
                </div>
                <div class="frm-row">
                    <input class="frm-input" type="text" name="password" placeholder="Password">
                </div>
                <div class="frm-row">
                    <label class="frm-check-radio-label"><input type="checkbox" name="test"> <span>I accept your <a
                                href="#">register policy</a>.</span></label>
                </div>
                <div class="frm-row">
                    <button class="frm-button material-button full" type="button">Register</button>
                </div>
            </form>
            <div class="frm-row">
                <p class="txt-center">Bạn đã có tài khoản? <a href="#" data-modal="loginModal">Đăng nhập</a></p>
            </div>
        </div>
    </div>
</div>
<!-- Register popup html source end ---->

<!-- Login popup html source start -->
<div class="m-modal-box" id="loginModal">
    <div class="m-modal-overlay"></div>
    <div class="m-modal-content small">
        <div class="m-modal-header">
            <h3 class="m-modal-title">Đăng nhập</h3>
            <span class="m-modal-close"><i class="material-icons">&#xE5CD;</i></span>
        </div>
        <div class="m-modal-body">
            <div class="m-modal-social-logins">
                <div class="columns column-3">
                    <button class="frm-button facebook material-button full" type="button">Facebook</button>
                </div>
                <div class="columns column-3">
                    <button class="frm-button google material-button full" type="button">Google</button>
                </div>
            </div>

            <div class="m-modal-seperator"><span>OR</span></div>

            <form>
                <div class="frm-row">
                    <input class="frm-input" type="text" name="email" placeholder="Email">
                </div>
                <div class="frm-row">
                    <input class="frm-input" type="text" name="password" placeholder="Password">
                </div>
                <div class="frm-row">
                    <button class="frm-button material-button full" type="button">Login</button>
                </div>
            </form>
            <div class="frm-row">
                <p class="txt-center">Bạn chưa có tài khoản? <a href="#" data-modal="registerModal">Đăng ký ngay</a>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Login popup html source end -->

<!-- Newsletter popup html source start -->
<div class="m-modal-box" id="newsletterModal">
    <div class="m-modal-overlay"></div>
    <div class="m-modal-content small">
        <div class="m-modal-header">
            <h3 class="m-modal-title">Theo dõi</h3>
            <span class="m-modal-close"><i class="material-icons">&#xE5CD;</i></span>
        </div>
        <div class="m-modal-body">
            <p>Nhận thông báo mỗi khi có bài mới thông qua mail của bạn!</p>
            <form>
                <div class="frm-row">
                    <input class="frm-input" type="text" name="email" placeholder="Email address">
                </div>
                <div class="frm-row">
                    <button class="frm-button material-button full" type="button">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Newsletter popup html source end -->