<link href="css/sb-admin-2.min.css" rel="stylesheet">

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar"  style="height:100%;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">WiMSS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php 
    if($_GET['sess_user_role'] != "Manager"){
    ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-folder"></i>
                <span>Reports</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Reports:</h6>
                    <a class="collapse-item" href="manufacture_report.php">Manufacture Report</a>
                    <a class="collapse-item" href="category_report.php">Category Report</a>
                    <a class="collapse-item" href="revenue_compare_report.php">Revenue Compare Report</a>
                    <a class="collapse-item" href="store_revenue_report.php">Store Revenue Report</a>
                    <a class="collapse-item" href="outdoorFurniture_report.php">Outdoor Furniture</a>
                    <a class="collapse-item" href="stateHighest_report.php">State with Highest Volume</a>
                    <a class="collapse-item" href="revenuePopulation_report.php">Revenue by Population</a>
                    <a class="collapse-item" href="grand_showcase_store_revenue_comparison.php">Grand Store Revenue</a>
                    <a class="collapse-item" href="grand_showcase_store_category_comparison.php">Grand Store Category</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    <?php
    }
    ?>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>