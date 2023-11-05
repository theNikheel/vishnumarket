<!-- [ navigation menu ] start -->

<?php
$ADMIN_LOGIN_SQL = mysqli_query($con,"SELECT * FROM adminuser");
$ADMIN_LOGIN_FETCH = mysqli_fetch_assoc($ADMIN_LOGIN_SQL);
?>

<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-content scroll-div">
            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="templates/assets/images/user/avatar-2.jpg" alt="User-Profile-Image">
                    <div class="user-details">
                        <span><?php echo $ADMIN_LOGIN_FETCH['fullname']; ?></span>
                        <div id="more-details"><?php echo $ADMIN_LOGIN_FETCH['role']; ?><i class="fa fa-chevron-down m-l-5"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href="?page=myProfile"><i class="feather icon-user m-r-5"></i>View Profile</a></li>
                        <!--<li class="list-group-item"><a href="#!"><i class="feather icon-settings m-r-5"></i>Settings</a></li>-->
                        <li class="list-group-item"><a href="model/logout.php"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li class="nav-item <?php if($activePage=='dashboard'){ ?> active <?php } ?>">
                    <a href="?page=dashboard" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                <li class="nav-item <?php if($activePage=='userList'){ ?> active <?php } ?>">
                    <a href="?page=userList" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Users</span></a>
                </li>
                <li class="nav-item <?php if($activePage=='userTransactionList'){ ?> active <?php } ?>">
                    <a href="?page=userTransactionList" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">User Transaction</span></a>
                </li>
                <li class="nav-item <?php if($activePage=='websiteInfo'){ ?> active <?php } ?>">
                    <a href="?page=websiteInfo" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Website Information</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->

<!-- [ Header ] start -->
    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
        
            
                <div class="m-header">
                    <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
                    <a href="#!" class="b-brand">
                        <!-- ========   change your logo hear   ============ -->
                        <img src="templates/assets/images/logo.png" alt="" class="logo">
                        <img src="templates/assets/images/logo-icon.png" alt="" class="logo-thumb">
                    </a>
                    <a href="#!" class="mob-toggler">
                        <i class="feather icon-more-vertical"></i>
                    </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li>
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                    <i class="icon feather icon-bell"></i>
                                    <!-- <span class="badge badge-pill badge-danger">5</span> -->
                                </a>
                                <!-- <div class="dropdown-menu dropdown-menu-right notification">
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
                                                <img class="img-radius" src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
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
                                                <img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>10 min</span></p>
                                                    <p>Prchace New Theme and make payment</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="notification">
                                            <div class="media">
                                                <img class="img-radius" src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>12 min</span></p>
                                                    <p>currently login</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="notification">
                                            <div class="media">
                                                <img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
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
                                </div> -->
                            </div>
                        </li>
                        <li>
                            <div class="dropdown drp-user">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="feather icon-user"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-notification">
                                    <div class="pro-head">
                                        <img src="templates/assets/images/user/avatar-2.jpg" class="img-radius" alt="User-Profile-Image">
                                        <span><?php echo $ADMIN_LOGIN_FETCH['fullname']; ?></span>
                                        <a href="model/logout.php" class="dud-logout" title="Logout">
                                            <i class="feather icon-log-out"></i>
                                        </a>
                                    </div>
                                    <ul class="pro-body">
                                        <li><a href="?page=myProfile" class="dropdown-item"><i class="feather icon-user"></i> My Profile</a></li>
                                        <!-- <li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>
                                        <li><a href="auth-signin.html" class="dropdown-item"><i class="feather icon-lock"></i> Lock Screen</a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                
            
    </header>