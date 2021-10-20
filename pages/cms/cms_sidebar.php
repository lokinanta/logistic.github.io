<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./in_cms.php" class="brand-link" data-toggle="tooltip" title="Container Management System">
        <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">CMS</span>
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
                            <a href="./in_port.php" class="nav-link <?= $sb_home; ?>">
                                <i class="fas fa-home nav-icon"></i>
                                <p>Home</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- [AKHIR] DASHBOARD -->


                <!-- Based Data -->
                <li class="nav-item <?= $bsd; ?>">
                    <a href="" class="nav-link active">
                        <i class="fas fa-database nav-icon"></i>
                        <!-- <i class="nav-icon fas fa-users"></i> -->
                        <p>
                            Based Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./add_vendor.php" class="nav-link <?= $add_vendor; ?>">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Add Vendor</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./add_vessel.php" class="nav-link <?= $add_barge; ?>">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Adding Vessel</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./list_user.php" class="nav-link <?= $list_vendor; ?> ">
                                <i class="fas fa-list-ul nav-icon"></i>
                                <p>List Vendor</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- [AKHIR] Based data -->



                <!-- Shipment -->
                <li class="nav-item <?= $shp; ?>">
                    <a href="" class="nav-link active">
                        <i class="fas fa-ship nav-icon"></i>
                        <p>
                            Shipment
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./add_shipment.php" class="nav-link <?= $sb_add_shipment; ?>">
                                <i class="fas fa-plus-square nav-icon"></i>
                                <!-- <i class="fas fa-user-plus nav-icon"></i> -->
                                <p>Add Shipment</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./ls_shipment.php" class="nav-link <?= $sb_list_open_shipment; ?> ">
                                <i class="fas fa-list-ul nav-icon"></i>
                                <p>List Shipment</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- [AKHIR] Shipment -->


                <!-- Inbound -->
                <li class="nav-item <?= $shp; ?>">
                    <a href="" class="nav-link active">
                        <i class="fab fa-btc nav-icon"></i>
                        <!-- <i class="fas fa-ship nav-icon"></i> -->
                        <p>
                            Data Inbound
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./add_shipment.php" class="nav-link <?= $sb_add_shipment; ?>">
                                <i class="fas fa-plus-square nav-icon"></i>
                                <!-- <i class="fas fa-user-plus nav-icon"></i> -->
                                <p>Autority Member</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./inbound.php" class="nav-link <?= $sb_list_open_shipment; ?> ">
                                <i class="fas fa-list-ul nav-icon"></i>
                                <p>Planning Inbound</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- [AKHIR] Data Inbound -->

            </ul>


            <ul class="nav nav-footer nav-sidebar flex-column" data-widget="footer" data-accordion="false">
                <footer>
                    <li class="nav-item">
                        <a href="../../logout.php" class="nav-link active bg-red">
                            <i class="fas fa-sign-out-alt"></i>
                            <p> Sign Out</p>
                        </a>
                    </li>
                </footer>
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>