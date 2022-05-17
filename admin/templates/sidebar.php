<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index2.php" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?=$companyName?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?=$companyName?> Admin</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="home" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Buyers
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../admin/verified-buyers" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Verified Buyers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../admin/pending-buyer-verifications" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pending Applications</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Sales
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../admin/verified-properties" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Verified Properties</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../admin/pending-property-verifications" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pending Property Verifications</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="../admin/all-properties" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            All Properties
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../admin/users" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>

                <!--          <li class="nav-header">EXAMPLES</li>-->
                <li class="nav-item">
                    <a href="logout" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>