<!-- [ navigation menu ] start -->
<?php
/*$loginID = $_SESSION['loginId'];
$RETURN_DATA = userProfileFun($loginID);
$PERSONAL_DATA_RESULT = $RETURN_DATA['personalDetailData'];*/

$loginID = $_SESSION['loginId'];
$RETURN_DATA = userProfileFun($loginID);
//echo "<pre>"; print_r($RETURN_DATA); die;
$PERSONAL_DATA_RESULT = $RETURN_DATA['personalDetailData'];

$BANK_DATA_RESULT = $RETURN_DATA['bankDetailData'];
?>


<nav class="pcoded-navbar theme-horizontal menu-light <?php echo $freezPanel; ?>">
    <div class="navbar-wrapper container">
        <div class="navbar-content sidenav-horizontal" id="layout-sidenav">
            <ul class="nav pcoded-inner-navbar sidenav-inner">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li class="nav-item <?php if($activepage == 'dashboard'){ ?> active <?php } ?>">
                    <a href="?page=dashboard" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Home</span></a>
                </li>
                <li class="nav-item <?php if($activepage == 'watchlist'){ ?> active <?php } ?>">
                    <a href="?page=watchlist" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Watchlist</span></a>
                </li>
                <li class="nav-item <?php if($activepage == 'portfolio'){ ?> active <?php } ?>">
                    <a href="?page=portfolio" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Portfolio</span></a>
                </li>
                <li class="nav-item <?php if($activepage == 'orderbook'){ ?> active <?php } ?>">
                    <a href="?page=orderbook" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Order Book</span></a>
                </li>
                <li class="nav-item <?php if($activepage == 'fund'){ ?> active <?php } ?>">
                    <a href="?page=fund" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Fund</span></a>
                </li>
                <li class="nav-item <?php if(($activepage == 'profile') || ($activepage == 'profileEdit')){ ?> active <?php } ?>">
                    <a href="?page=profile" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Profile</span></a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- [ Header ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
    <div class="container">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <a href="#!" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="<?php echo "templates/assets/images/logo.png"; ?>" alt="" class="logo">
                <img src="<?php echo "templates/assets/images/logo.png"; ?>" alt="" class="logo-thumb">
            </a>
            <a href="javascript:void(0)" class="mob-toggler">
                <i class="feather icon-more-vertical"></i>
            </a>
        </div>
        <div class="collapse navbar-collapse">            
            <ul class="navbar-nav ml-auto">
                <li class="clientIdCls">
                    <button type="button" title="Your client-Id" class="btn  btn-warning"><?php echo $loginShortData['clientId']; ?></button>
                </li>
                <li style="display:none;">
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                            <i class="icon feather icon-bell"></i>
                            <span class="badge badge-pill badge-danger">5</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0">Notifications</h6>
                                <div class="float-right">
                                    <a href="#!" class="m-r-10">mark as read</a>
                                    <a href="#!">clear all</a>
                                </div>
                            </div>
                            <ul class="noti-body">
                                <li class="n-title">
                                    <p class="m-b-0">NEW</p>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="templates/assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>John Doe</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5 min</span></p>
                                            <p>New ticket Added</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="n-title">
                                    <p class="m-b-0">EARLIER</p>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="templates/assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>10 min</span></p>
                                            <p>Prchace New Theme and make payment</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="templates/assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>12 min</span></p>
                                            <p>currently login</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="templates/assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                            <p>Prchace New Theme and make payment</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="noti-footer">
                                <a href="#!">show all</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="<?php echo $loginShortData['photo']; ?>" class="img-radius" alt="User-Profile-Image">
                                <span><?php echo $loginShortData['fname']." ".$loginShortData['lname']; ?></span>
                                <a href="model/logout.php" class="dud-logout" title="Logout">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </div>
                            <ul class="pro-body">
                                <li><a href="javascript:void(0)" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>
                                <li><a href="javascript:void(0)" class="dropdown-item"><i class="feather icon-lock"></i> Lock Screen</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
<!-- [ Header ] end -->
