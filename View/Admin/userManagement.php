<?php session_start() ?>
<?php require 'D:\DVWA\ProjectCTF\Controller\connection\ConnectionDB.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Management</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require 'D:\DVWA\ProjectCTF\View\Layout\menu.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require 'D:\DVWA\ProjectCTF\View\Layout\header.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">List Users</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <?php
                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($conn, $sql);
                    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    ?>

                    <!-- Content Row -->
                    <div class="row">
                        <table class="table ">
                            <thead style="text-align: center;">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Update at</th>
                                    <th scope="col">Activity</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center;">
                                <?php $i = 1;
                                foreach ($users as $user) :
                                    $phoneNumber = $user['phoneNumber'];
                                    if ($phoneNumber == null) {
                                        $phoneNumber = 'N/A';
                                    }
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $i++; ?></th>
                                        <td><?php echo $user['name']; ?></td>
                                        <td><?php echo $user['email']; ?></td>
                                        <td><?php echo $phoneNumber ?></td>
                                        <td><?php if ($user['roles'] == 0) {
                                                echo 'Admin';
                                            } else {
                                                echo 'User';
                                            } ?></td>
                                        <td><?php echo $user['updateDate']; ?></td>
                                        <td><a class="btn btn-info" href="updateUser.php?id=<?php echo $user['id']; ?>">View</a>
                                            <a class="btn btn-danger" href="#">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div>
                            <a class="btn btn-success" href="index.php">Back</a>
                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php require 'D:\DVWA\ProjectCTF\View\Layout\footer.php'; ?>
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
    <?php require 'D:\DVWA\ProjectCTF\View\Layout\logoutModal.php' ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>