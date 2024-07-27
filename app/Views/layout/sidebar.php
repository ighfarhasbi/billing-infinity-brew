<aside class="main-sidebar sidebar-dark-warning elevation-4" style="position: fixed; overflow-y: scroll; top: 0; bottom: 0;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <i class="nav-icon fab fa-sellcast fa-2xl ml-2"></i>
        <span class="brand-text font-weight-light ml-1">Infinity Brew</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <a href="#" class="brand-link">
            <i class="nav-icon fas fa-circle-user fa-xl ml-1"></i>
            <span class="brand-text font-weight-light ml-2"><?= session()->get('nama_user') ?></span>
        </a>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/dashboard" <?= $menu == 'dashboard' ? 'class="nav-link active"' : 'class=nav-link' ?>>
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Penjualan" <?= $menu == 'penjualan' ? 'class="nav-link active"' : 'class=nav-link' ?>>
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>
                            Penjualan
                        </p>
                    </a>
                </li>
                <li <?= $menu == 'masterdata' ? 'class="nav-item menu-open"' : 'class=nav-item' ?>>
                    <a href="#" class="nav-link <?= $menu == 'masterdata' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/produk" <?= $submenu == 'produk' ? 'class="nav-link active"' : 'class=nav-link' ?>>
                                <i class="far fa-circle nav-icon"></i>
                                <p>Produk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/kategori" class="nav-link <?= $submenu == 'kategori' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/satuan" class="nav-link <?= $submenu == 'satuan' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Satuan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/user" class="nav-link <?= $submenu == 'user' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li <?= $menu == 'Transaksi' ? 'class="nav-item menu-open"' : 'class=nav-item' ?>>
                    <a href="#" class="nav-link <?= $menu == 'Transaksi' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-money-bill-transfer"></i>
                        <p>
                            Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/transaksi/transaksiPenjualan" <?= $submenu == 'Transaksi Penjualan' ? 'class="nav-link active"' : 'class=nav-link' ?>>
                                <i class="far fa-circle nav-icon"></i>
                                <p>Transaksi Penjualan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/transaksi/transaksiDetail" class="nav-link <?= $submenu == 'Transaksi Detail' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Transaksi Detail</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/transaksi/zakat" class="nav-link <?= $submenu == 'Zakat' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Zakat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/transaksi/pengeluaran" class="nav-link <?= $submenu == 'Pengeluaran' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengeluaran</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Login/logout') ?>" class="nav-link">
                        <i class="nav-icon fas fa-right-from-bracket"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>