<?php
include "lib/common.php";
include "stateHighest/stateHighest_manager.php";

session_start();
$session_username = $_SESSION["sess_username"];
if(!isset($session_username)){
    echo '<script type="text/javascript"> alert("Oops, you cannot access this page. It seems that you have not logged in yet. Please login and try again.");</script>';
?>
    <script>
        window.location = "login.html";
    </script>
<?php
} else {
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Will-Mart Sales System - State with Highest Volume for each Category</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar"></div>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
            
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$session_username;?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">State with Highest Volume for each Category Report</h1>
                    <p class="mb-4">This is State with Highest Volume for each Category Report</p>
                    <label for="start">Select year and month:</label>

                    <form action="stateHighest_report.php" method="POST">
                        <input type="month" id="date" name="date" min="2000-01" max="2012-07" />
                        <input type="submit" name="date_form">
                    </form>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">stateHighest DataTable</h6>
                            <?php
                            $year = null;
                            $month = null;
                            if(isset($_POST['date'])){
                                $year = (int) substr(htmlspecialchars($_POST['date']), 0, 4);
                                $month = (int) substr(htmlspecialchars($_POST['date']), -2, 2);
                            }
                            if(!is_null($year) && !is_null($month)){
                                echo "<h6>Year: " . $year . ";</h6>";
                                echo "<h6>Month: " . date("F", mktime(0, 0, 0, $month, 10)) . ";</h6>";
                            }
                            ?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="stateHighestReportDataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>State</th>
                                            <th>Number of sold units</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>State</th>
                                            <th>Number of sold units</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    $year = 0;
                                    $month = 0;
                                    if(isset($_POST['date'])){
                                        $year = (int) substr(htmlspecialchars($_POST['date']), 0, 4);
                                        $month = (int) substr(htmlspecialchars($_POST['date']), -2, 2);
                                    }
                                    $rows = get_state_report($year, $month);
                                    if(!mysqli_num_rows($rows) == 0){
                                        while($row = mysqli_fetch_array($rows)){
                                    ?>
                                        <tr>
                                        <td><?php echo $row['Category Name'] ?></td>
                                            <td><?php echo $row['State'] ?></td>
                                            <td><?php echo $row['Number of Sold Units'] ?></td>
                                        </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Team020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>


    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    
    <!-- Page level custom scripts -->
    <script src="js/datatables.js"></script>
    <script> 
        $(function(){
            $("#sidebar").load("sidebar.php?sess_user_role=<?php echo $_SESSION["sess_user_role"]; ?>"); 
        });
    </script> 

</body>

</html>

<?php
    }
?>