<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index.php" class="brand-link">
        <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Logistic Team</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../dist/img/<?= $_SESSION['foto']; ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $_SESSION["full_name"]; ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                <!-- DASHBOARD -->
                <li class="nav-item <?= $dashboard; ?> ">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./in_user.php" class="nav-link <?= $sb_home; ?>">
                                <i class="fas fa-home nav-icon"></i>
                                <p>Home</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- [AKHIR] DASHBOARD -->


                <!-- MANAGE ACCOUNT -->
                <li class="nav-item <?= $mng_acc; ?>">
                    <a href="" class="nav-link active">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Manage Account
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./add_user.php" class="nav-link <?= $sb_add_user; ?>">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Add User Admin</p>
                            </a>
                        </li>
                    </ul>

                    <!-- LIST USER ADMIN -->
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./list_user.php" class="nav-link <?= $sb_list_user; ?> ">
                                <i class="fas fa-list-ul nav-icon"></i>
                                <p>List User Admin</p>
                            </a>
                        </li>
                    </ul>
                    <!-- [AKHIR] LIST USER ADMIN -->


                    <!-- LIST MEMBER -->
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./list_member.php" class="nav-link <?= $sb_list_member; ?> ">
                                <i class="fas fa-list-ul nav-icon"></i>
                                <p>List Member</p>
                            </a>
                        </li>
                    </ul>
                    <!-- [AKHIR] LIST MEMBER -->


                </li>
                <!-- [AKHIR] MANAGE ACCOUNT -->

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>