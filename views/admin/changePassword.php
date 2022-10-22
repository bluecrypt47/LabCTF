<?php session_start() ?>
<?php require 'D:\DVWA\ProjectCTF\controllers\connection\connectionDB.php'; ?>
<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Change Password</title>

    <!-- Custom fonts for this template-->
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require 'D:\DVWA\ProjectCTF\views\layout\menu.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require 'D:\DVWA\ProjectCTF\views\layout\header.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Change Password</h1>
                    </div>

                    <?php
                    $email = $_SESSION['email'];

                    $sql = "SELECT * FROM users WHERE email='$email'";
                    $result = mysqli_query($conn, $sql);
                    $user = mysqli_fetch_assoc($result);
                    $updateDate = date("Y-m-d H:i:s");

                    if (isset($user['id'])) {
                        // Update profile
                        if (isset($_REQUEST['changePassword'])) {
                            $idUser = $user['id'];
                            $currentPassword = md5(trim($_POST['currentPassword']));
                            $newPassword = md5(trim($_POST['newPassword']));
                            $reNewPassword = md5(trim($_POST['reNewPassword']));

                            if (!empty($currentPassword) && !empty($newPassword) && !empty($reNewPassword)) {
                                if ($reNewPassword != $newPassword) {
                                    echo '<div class="alert alert-danger">
                                        Repeat new password incorrect!
                                    </div>';
                                } else if ($currentPassword != $user['password']) {
                                    echo '<div class="alert alert-danger">
                                        Current password incorrect!
                                    </div>';
                                } else {
                                    $update = "UPDATE users SET password='$newPassword', updateDate='$updateDate' WHERE id='$idUser'";
                                    $result = mysqli_query($conn, $update);
                                    echo '<script language="javascript">alert("Change password Successfully!"); window.location="logout.php";</script>';
                                }
                            } else {
                                echo '<div class="alert alert-danger">
                                        Not required!
                                    </div>';
                            }
                        }
                    }

                    ?>

                    <!-- Begin Page Content -->

                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-lg-12 col-md-9">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-10">
                                        <form method="post" action="changePassword.php" class="user">
                                            <div class="form-group">
                                                <label>Current Password<label style="color: red;">*</label></label>
                                                <input type="password" class="form-control form-control-user" name="currentPassword" aria-describedby="emailHelp" placeholder="Enter Current Password...">
                                            </div>
                                            <div class="form-group">
                                                <label>New Passwordd<label style="color: red;">*</label></label>
                                                <input type="password" class="form-control form-control-user" name="newPassword" placeholder="Enter New Password...">
                                            </div>
                                            <div class="form-group">
                                                <label>Re-New Password<label style="color: red;">*</label></label>
                                                <input type="password" class="form-control form-control-user" name="reNewPassword" placeholder="Enter Repeat New Password...">
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <a class="btn btn-success btn-user btn-block" href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><i class="fas fa-caret-left"></i> Back</a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="submit" name="changePassword" value="Change Password" class="btn btn-primary btn-user btn-block" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php require 'D:\DVWA\ProjectCTF\views\layout\footer.php'; ?>
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
    <?php require 'D:\DVWA\ProjectCTF\views\layout\logoutModal.php' ?>

    <!-- Bootstrap core JavaScript-->
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../assets/js/demo/chart-area-demo.js"></script>
    <script src="../../assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>