<?php
      include APP_DIR.'views/templates/header.php';
    ?>
<body class="light-mode">
    <aside id="sidebar">
    <div class="logo-section">
        <div class="logo-left">
        <i class="fas fa-microchip"></i>
        <span>TechStore</span>
        </div>
    </div>

    <nav class="main-menu">
        <ul>
        <li data-section="dashboard"><i class="fas fa-chart-line"></i> <span>Dashboard</span></li>
        <li class="active">
                <i class="fas fa-box-open"></i>
                <span>Products</span>
        </li>
        <li data-section="inventory"><i class="fas fa-boxes"></i> <span>Inventory</span></li>
        <li data-section="users"><i class="fas fa-users"></i> <span>Users</span></li>
        <li data-section="transactions"><i class="fas fa-receipt"></i> <span>Transactions</span></li>
        <li data-section="reports"><i class="fas fa-file-alt"></i> <span>Reports</span></li>
        </ul>
    </nav>

    <div class="settings-menu">
        <ul>
        <li data-section="settings"><i class="fas fa-cog"></i> <span>Settings</span></li>
        <li>
            <button id="logout-btn"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></button>
        </li>
        </ul>
    </div>
    </aside>


    <main id="main-content">
        <header id="top-navbar">
            <div class="nav-left">
                <button id="sidebar-toggle" title="Toggle Menu"><i class="fas fa-bars"></i></button>
                <span class="page-title">Dashboard Overview</span>
            </div>
            <div class="nav-right nav-icons">
                <button id="theme-toggle" title="Toggle Theme">
                    <i class="fas fa-moon"></i>
                </button>
        
                <div class="user-profile">
                    <span class="user-name">Admin</span>
                    <i class="fas fa-user-circle"></i>
                </div>
            </div>
        </header>

        <section id="content-area">
            <div id="products" class="content-section active">
                <div class="toolbar">
                    <button class="action-btn primary-btn" onclick="openAddProductModal()"><i class="fas fa-plus-circle"></i> Add Product</button>
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" placeholder="Search Products...">
                    </div>
                </div>

                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Unit Price (₱)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach(html_escape($all) as $char): ?>
                                <tr>
                                    <td><?= $char['id']; ?></td>
                                    <td><?= $char['name']; ?></td>
                                    <td><?= $char['category']; ?></td>
                                    <td>₱<?= $char['price']; ?></td>
                                    <td>
                                        <a href="<?= site_url('update/'.$char['id']); ?>" class="action-icon edit-btn"><i class="fas fa-pen"></i></a>
                                        <a href="<?= site_url('soft-delete/'.$char['id']); ?>" class="action-icon delete-btn"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <?php
      include APP_DIR.'views/modals/product.php';
    ?>
    <script src="<?= base_url();?>public/js/script.js"></script>
</body>
</html>