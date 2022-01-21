<?php
include "lib/common.php";
include "main_screen/main_page.php";

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

    <title>Will-Mart Sales System - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Count of Stores -->
                        <div class="col-xl-4 col-md-8 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Count of Stores: 
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                $rows = get_count_store();
                                                echo mysqli_fetch_array($rows)[0];
                                            ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-store fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Count of Grand showcase store -->
                        <div class="col-xl-4 col-md-8 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Count of Grand Showcase Stores: </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                $rows = get_count_showcase();
                                                echo mysqli_fetch_array($rows)[0];
                                            ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-landmark fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Count of Manufacturers -->
                        <div class="col-xl-4 col-md-8 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Count of Manufacturers: 
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php
                                                $rows = get_count_manufacturer();
                                                echo mysqli_fetch_array($rows)[0];
                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-warehouse fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Count of Products: -->
                        <div class="col-xl-4 col-md-4 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Count of Products:</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                $rows = get_count_product();
                                                echo mysqli_fetch_array($rows)[0];
                                            ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-industry fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Count of Special Savings Days: -->
                        <div class="col-xl-4 col-md-4 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                            Count of Special Savings Days:</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                $rows = get_count_ssd();
                                                echo mysqli_fetch_array($rows)[0];
                                            ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-industry fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php  
                            if($_SESSION['sess_user_role'] == "Manager"){
                                $rows = mysqli_fetch_array(get_count_storemanaged($session_username));
                                ?>
                                <div class="col-xl-4 col-md-4 mb-4">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                    Count of Stores Managed: </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                        echo $rows[0];
                                                    ?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="text-xs font-weight-bold mr-2">
                                                            <a href="store_detail_page.php" class="button">Visit Store Details</a >
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-home fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        ?>
                    </div>
                    <?php  
                        if($_SESSION['sess_user_role'] == "Marketing"){
                        ?>
                        <!-- Content Row -->
                        <div class="row">
                            <div class="col-xl-8 col-lg-3">
                                <div class="card shadow mb-4">
                                    <!-- Card Header-->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Population</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-5 col-md-1 mb-4">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">State</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="state">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-5 col-md-1 mb-4">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">City</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="city">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-md-1 mb-4">
                                                <br>
                                                <a href="#" class="btn btn-primary btn-icon-split" id="searchButton">
                                                    <span class="text"> Search </span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-4 col-md-1 mb-4">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                            Population</div>
                                                            <div class="h5 mb-2 font-weight-bold text-gray-800" id="population">N/a</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-md-1 mb-4">
                                                <br>
                                                <a href="#" class="btn btn-primary btn-icon-split" style="display: none;" id="editButton" href="#" data-toggle="modal" data-target="#editModal">
                                                    <span class="text"> Edit </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
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
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Please enter the new population value for <a id=cityEdit></a>, <a id=stateEdit></a> below</p>
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Population</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" id="populationEdit" onkeydown="if(event.key==='.'){event.preventDefault();}"  oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" id="saveButton">Save</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script> 
        $(function(){
            $("#sidebar").load("sidebar.php?sess_user_role=<?php echo $_SESSION["sess_user_role"]; ?>");
            $("#searchButton").click(function() {
                let stateVal = "";
                let cityVal = "";
                let error = 0;
                if($("#state").val() == ""){
                    alert("State cannot be empty");
                    $("#state").addClass("border-danger");
                    error++;
                }else{
                    stateVal = $("#state").val();
                    $("#stateEdit").text(stateVal);
                    $("#state").removeClass("border-danger");
                }

                if($("#city").val() == ""){
                    alert("City cannot be empty");
                    $("#city").addClass("border-danger");
                    error++;
                }else{
                    cityVal = $("#city").val();
                    $("#cityEdit").text(cityVal);
                    $("#city").removeClass("border-danger");
                }

                if(error == 0){
                    $.ajax({
                        method: "POST",
                        url: "main_screen/get_population.php",
                        data: { state: stateVal, city: cityVal }
                    })
                    .done(function( response ) {
                        if(response == -1){
                            window.location = "404.php";
                        }else{
                            $("#population").text(response);
                            $("#populationEdit").attr("placeholder", response);
                            $("#editButton").show();
                        }
                    });
                }
            });
            $("#saveButton").click(function() {
                let stateVal = $("#state").val();
                let cityVal = $("#city").val();
                let new_population = $("#populationEdit").val();

                $.ajax({
                    method: "POST",
                    url: "main_screen/update_population.php",
                    data: { state: stateVal, city: cityVal, population: new_population }
                })
                .done(function( response ) {
                    if(response == 0){
                        alert("Failed to update the population, please try again later.");
                    }else{
                        alert("Population updated successfully.")
                        $("#populationEdit").attr("placeholder", new_population);
                        $("#population").text(new_population);
                        $("#editButton").hide();
                        $('#editModal').modal('hide');
                    }
                });
            });
        });
    </script> 
</body>
</html>
<?php
    }
?>