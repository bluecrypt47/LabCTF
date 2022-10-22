<?php session_start() ?>
<?php require '../../controllers/connection/connectionDB.php'; ?>
<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Detail</title>

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

                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM users WHERE id=$id";
                    $result = mysqli_query($conn, $sql);
                    $user = mysqli_fetch_assoc($result);
                    $updateDate = date("Y-m-d H:i:s");

                    if (isset($_REQUEST['updateUser'])) {
                        $id = $user['id'];
                        $name = trim($_REQUEST['name']);
                        $phoneNumber = trim($_REQUEST['phoneNumber']);
                        $role = trim($_REQUEST['roles']);

                        if (!empty($name) && !empty($phoneNumber)) {
                            $query = "UPDATE users SET username='$name', phoneNumber='$phoneNumber', roles='$role', updateDate='$updateDate' WHERE id='$id'";
                            mysqli_query($conn, $query);
                            echo '<script language="javascript"> window.location="userManagement.php";</script>';
                        } else {
                            echo '<div class="alert alert-danger">
                            Update Failed!
                                </div>';
                        }
                    }

                    $sqlRole = "SELECT * FROM roles";
                    $resultRole = mysqli_query($conn, $sqlRole);
                }
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">User <strong><?php echo $user['username']; ?></strong></h1>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-lg-12 col-md-9">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-10">
                                        <form method="post" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])) ?>" class="user">
                                            <div class="form-group">
                                                <img src="<?php echo $user['img']; ?>" class="rounded mx-auto d-block" alt="Avatar" style="width:200px;height:300px;">
                                            </div>
                                            <div class="form-group">
                                                <label>Email<label style="color: red;">*</label></label>
                                                <input type="email" class="form-control form-control-user" name="email" aria-describedby="emailHelp" value="<?php echo $user['email']; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Username<label style="color: red;">*</label></label>
                                                <input type="text" class="form-control form-control-user" name="name" value="<?php echo $user['username']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Phone Number<label style="color: red; visibility: hidden;">*</label></label>
                                                <input type="text" class="form-control form-control-user" name="phoneNumber" value="<?php echo $user['phoneNumber']; ?>" placeholder="Phone number..." required>
                                            </div>
                                            <div class="form-group">
                                                <label>Role<label style="color: red;">*</label></label>
                                                <select name="roles" class="form-select form-select-user" aria-label="Default select example" style="border-radius: 10px;">
                                                    <?php while ($roles = mysqli_fetch_assoc($resultRole)) {
                                                        if ($roles['idRole'] == $user['roles']) { ?>
                                                            <option selected value="<?php echo $roles['idRole']; ?>"><?php echo $roles['roleName']; ?></option>
                                                        <?php  } else { ?>
                                                            <option value="<?php echo $roles['idRole']; ?>"><?php echo $roles['roleName']; ?></option>
                                                    <?php   }
                                                    } ?>
                                                </select>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <a class="btn btn-success btn-user btn-block" href="userManagement.php"><i class="fas fa-caret-left"></i> Back</a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="submit" name="updateUser" value="Update User" class="btn btn-primary btn-user btn-block" />
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