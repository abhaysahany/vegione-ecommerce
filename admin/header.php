  <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- third party css -->
    <link href="assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
    <!-- third party css -->
    <link href="assets/css/vendor/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/vendor/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/vendor/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/vendor/select.bootstrap4.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
    <!-- App css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
    <link href="assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

</head>

<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">

            <!-- LOGO -->
            <a href="index.html" class="logo text-center logo-light">
                <span class="logo-lg">
                    <img src="assets/images/logo.png" alt="" height="16">
                </span>
                <span class="logo-sm">
                    <img src="assets/images/logo_sm.png" alt="" height="16">
                </span>
            </a>

            <!-- LOGO -->
            <a href="index.html" class="logo text-center logo-dark">
                <span class="logo-lg">
                    <img src="assets/images/logo-dark.png" alt="" height="16">
                </span>
                <span class="logo-sm">
                    <img src="assets/images/logo_sm_dark.png" alt="" height="16">
                </span>
            </a>

            <div class="h-100" id="leftside-menu-container" data-simplebar>

                <!--- Sidemenu -->
                <ul class="side-nav">

                    <li class="side-nav-title side-nav-item">Navigation</li>

                    <li class="side-nav-item">
                        <a  href="dashboard.php"  class="side-nav-link">
                            <i class="uil-focus-target"></i>
                            <span> Dashboards </span>
                        </a>
                        
                    </li>

                    <!-- <li class="side-nav-item">
                        <a href="apps-calendar.html" class="side-nav-link">
                            <i class="uil-calender"></i>
                            <span> Calendar </span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a href="apps-chat.html" class="side-nav-link">
                            <i class="uil-comments-alt"></i>
                            <span> Chat </span>
                        </a>
                    </li> -->
                    <?php 
                              
                      if ($type=='Superadmin') {
                          
                          ?>
                          <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#admincreation" aria-expanded="false" aria-controls="admincreation" class="side-nav-link">
                                <i class=" uil-edit"></i>
                                <span> Admin Management </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="admincreation">
                                <ul class="side-nav-second-level">
                                    <li> 
                                        <a href="create_admin.php">Create Admin Users</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                          <?php
                      }

                    ?>
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#storecreation" aria-expanded="false" aria-controls="storecreation" class="side-nav-link">
                            <i class=" uil-edit"></i>
                            <span> Store Contents </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="storecreation">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="store_details.php">Store Details</a>
                                </li>
                                <li>
                                    <a href="front_products.php">Front Products</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#mastercreation" aria-expanded="false" aria-controls="mastercreation" class="side-nav-link">
                            <i class=" uil-edit"></i>
                            <span> Create Contents </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="mastercreation">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="create_category.php">Create Categories</a>
                                </li>
                                <li>
                                    <a href="create_product.php">Create Products</a>
                                </li>
                                <li>
                                    <a href="create_attrib.php">Create Attributes</a>
                                </li>
                                <li>
                                    <a href="create_m_unit.php">Create Measure Units</a>
                                </li>
                                <!-- <li>
                                    <a href="apps-ecommerce-orders.html">Create Tax</a>
                                </li> -->
                            </ul>
                        </div>
                    </li>
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#productcreation" aria-expanded="false" aria-controls="productcreation" class="side-nav-link">
                            <i class=" uil-layer-group"></i>
                            <span> Products Listings </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="productcreation">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="manage_products.php">Product Catalog</a>
                                </li>
                                <li>
                                    <a href="upload_product.php">Upload Product</a>
                                </li>
                                <li>
                                    <a href="cross_and_upsale.php">Cross & Upsale </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#orders" aria-expanded="false" aria-controls="orders" class="side-nav-link">
                            <i class="uil-shopping-cart-alt"></i>
                            <span> Orders </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="orders">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="new_orders.php">New Orders</a>
                                </li>
                                <li>
                                    <a href="manage_orders.php">Manage Orders</a>
                                </li>
                                <li>
                                    <a href="shipped_orders.php">Shipped Orders</a>
                                </li>
                                <li>
                                    <a href="completed_orders.php">Completed Orders</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                     <!-- <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#ordersstat" aria-expanded="false" aria-controls="ordersstat" class="side-nav-link">
                            <i class="uil-chart"></i>
                            <span> Orders Statatics</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="ordersstat">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="apps-ecommerce-products.html">New Orders</a>
                                </li>
                                <li>
                                    <a href="apps-ecommerce-products-details.html">Manage Orders</a>
                                </li>
                                <li>
                                    <a href="apps-ecommerce-orders.html">Return Management</a>
                                </li>
                            </ul>
                        </div>
                    </li> -->
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#customers" aria-expanded="false" aria-controls="customers" class="side-nav-link">
                            <i class="uil-users-alt"></i>
                            <span> Customers </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="customers">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="customer_details.php">Customer Details</a>
                                </li><!-- 
                                <li>
                                    <a href="apps-ecommerce-products-details.html">Customer Statatics</a>
                                </li>
                                <li>
                                    <a href="apps-ecommerce-orders.html">Communication</a>
                                </li> -->
                            </ul>
                        </div>
                    </li>
                    <!-- <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#support" aria-expanded="false" aria-controls="support" class="side-nav-link">
                            <i class="uil-map-pin"></i>
                            <span> Customers Support </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="support">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="supports_tickets.php">Support Tickets</a>
                                </li>
                                <li>
                                    <a href="tickets_history.php">Tickets History</a>
                                </li>
                                <li>
                                    <a href="apps-ecommerce-orders.html">Support Database</a>
                                </li>
                            </ul>
                        </div>
                    </li> -->

                    <li class="side-nav-item">
                        <a href="web_message.php" class="side-nav-link">
                            <i class="uil-comments-alt"></i>
                            <span> Website Messages </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="admin_details.php" class="side-nav-link">
                            <i class="uil-comment-heart"></i>
                            <span> Admin Details </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="logout.php" class="side-nav-link">
                            <i class="uil-sign-out-alt"></i>
                            <span> Logout </span>
                        </a>
                    </li>
                    

                    
                </ul>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                <div class="navbar-custom">
                    <ul class="list-unstyled topbar-menu float-end mb-0">
                        <li class="dropdown notification-list d-lg-none">
                            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="dripicons-search noti-icon"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                                <form class="p-3">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                </form>
                            </div>
                        </li>
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="assets/images/users/<?php echo $data['admin_image'] ?>" alt="Admin-Image" class="me-0 me-sm-1" style="height:40px ; width:40px; "> 
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu">

                                <!-- item-->
                                <a href="edit_admin" class="dropdown-item notify-item">
                                     <i class="uil-bright"></i><span class="align-middle">&nbsp;&nbsp; Settings</span>
                                </a>
                                
                                <!-- item-->
                                <a href="edit_admin" class="dropdown-item notify-item">
                                     <i class="uil-key-skeleton"></i><span class="align-middle">&nbsp;&nbsp; Change Password</span>
                                </a>

                                <!-- item-->
                                <a href="logout" class="dropdown-item notify-item">
                                      <i class="uil-sign-out-alt"></i> <span class="align-middle">&nbsp;&nbsp; Logout</span>
                                </a>

                            </div>
                        </li>

                        <li class="notification-list">
                            <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                                <i class="dripicons-gear noti-icon"></i>
                            </a>
                        </li>

                        

                    </ul>
                    <button class="button-menu-mobile open-left">
                        <i class="mdi mdi-menu"></i>
                    </button>
                    <div class="app-search dropdown d-none d-lg-block">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control dropdown-toggle"  placeholder="Search..." id="top-search">
                                <span class="mdi mdi-magnify search-icon"></span>
                                <button class="input-group-text btn-primary" type="submit">Search</button>
                            </div>
                        </form>

                        <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h5 class="text-overflow mb-2">Found <span class="text-danger">17</span> results</h5>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="uil-notes font-16 me-1"></i>
                                <span>Analytics Report</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="uil-life-ring font-16 me-1"></i>
                                <span>How can I help you?</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="uil-cog font-16 me-1"></i>
                                <span>User profile settings</span>
                            </a>

                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                            </div>

                            <div class="notification-list">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="d-flex">
                                        <img class="d-flex me-2 rounded-circle" src="assets/images/users/avatar-2.jpg" alt="Generic placeholder image" height="32">
                                        <div class="w-100">
                                            <h5 class="m-0 font-14">Erwin Brown</h5>
                                            <span class="font-12 mb-0">UI Designer</span>
                                        </div>
                                    </div>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="d-flex">
                                        <img class="d-flex me-2 rounded-circle" src="assets/images/users/avatar-5.jpg" alt="Generic placeholder image" height="32">
                                        <div class="w-100">
                                            <h5 class="m-0 font-14">Jacob Deo</h5>
                                            <span class="font-12 mb-0">Developer</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Topbar -->