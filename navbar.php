<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="./index.php" class="navbar-brand">
            <img src="./dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Logistic Perawang</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <!-- Messages Dropdown Menu -->

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="./index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $link; ?>" class="nav-link"><?= $caption; ?></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Inbound</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li><a href="./req_inbound.php" class="dropdown-item">Request Inbound </a></li>
                            <li><a href="./logout.php" class="dropdown-item">Log out</a></li>

                            <li class="dropdown-divider"></li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-widget="<?= $sidebar; ?>" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>

                </ul>
            </div>
        </ul>
    </div>
</nav> <!-- /.navbar -->