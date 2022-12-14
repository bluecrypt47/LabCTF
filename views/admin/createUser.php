<?php session_start() ?>
<?php require '../../controllers/connection/connectionDB.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Create User</title>

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
                // Create 
                if (isset($_POST['create'])) {
                    $name = trim($_POST['name']);
                    $role = trim($_POST['role']);
                    $password = md5(trim($_POST['password']));
                    $rePassword = md5(trim($_POST['rePassword']));
                    $email = trim($_POST['email']);
                    $phoneNumber = trim($_POST['phoneNumber']);


                    if (empty($name)) {
                        array_push($errors, "Name is required");
                    }
                    if (empty($email)) {
                        array_push($errors, "Email is required");
                    }
                    if (empty($password)) {
                        array_push($errors, "Password is required");
                    } else {
                        if ($rePassword != $password) {
                            array_push($errors, "Repeat password and Password don't match");
                        }
                    }

                    // Ki???m tra email c?? b??? tr??ng hay kh??ng
                    $sql = "SELECT * FROM users WHERE email = '$email'";

                    // Th???c thi c??u truy v???n
                    $result = mysqli_query($conn, $sql);

                    // N???u k???t qu??? tr??? v??? l???n h??n 1 th?? ngh??a l?? email ???? t???n t???i trong DB
                    if (mysqli_num_rows($result) > 0) {
                        echo '<div class="alert alert-danger">
                            Email has existed!
                                    </div>';
                        // D???ng ch????ng tr??nh
                        die();
                    } else {
                        $sql = "INSERT INTO users (username, email, phoneNumber, password, roles) VALUES ('$name','$email','$phoneNumber', '$password', $role)";
                        echo '<script language="javascript">alert("Create User Successfully!"); window.location="userManagement.php";</script>';

                        if (mysqli_query($conn, $sql)) {
                            echo "T??n ????ng nh???p: " . $_POST['username'] . "<br/>";
                            echo "M???t kh???u: " . $_POST['password'] . "<br/>";
                            echo "Email ????ng nh???p: " . $_POST['email'] . "<br/>";
                            echo "S??? ??i???n tho???i: " . $_POST['phoneNumber'] . "<br/>";
                            echo "Quy???n: " . $_POST['role'] . "<br/>";
                        } else {
                            echo '<div class="alert alert-danger">
                            Create User Fail!
                                </div>';
                        }
                    }
                }
                $sqlRole = "SELECT * FROM roles";
                $resultRoles = mysqli_query($conn, $sqlRole);
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Create User</h1>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-lg-12 col-md-9">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-10">
                                        <form method="post" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" class="user">
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label>Username<label style="color: red;">*</label></label>
                                                    <input type="text" class="form-control form-control-user" name="name" placeholder="Name" required>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>Phone Number<label style="color: red; visibility: hidden;">*</label></label>
                                                    <input type="text" class="form-control form-control-user" name="phoneNumber" placeholder="Phone Number">
                                                </div>
                                                <div class="col-sm-3">
                                                    <select name="role" style=" position: absolute; top: 40px; border-radius: 10px; width: 150px; height: calc(1.5em + 0.75rem + 2px); text-align: center;" class="form-select form-select-user" aria-label="Default select example">
                                                        <option selected value="0">Select Type<label style="color: red;">*</label></option>
                                                        <?php if ($resultRoles->num_rows > 0) {
                                                            while ($roles = mysqli_fetch_assoc($resultRoles)) { ?>
                                                                <option value="<?php echo $roles['idRole']; ?>"><?php echo $roles['roleName']; ?> </option>
                                                            <?php }
                                                        } else { ?>
                                                            <option selected value="0">None</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email<label style="color: red;">*</label></label>
                                                <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address" required>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label>Password<label style="color: red;">*</label></label>
                                                    <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Re-Password<label style="color: red;">*</label></label>
                                                    <input type="password" class="form-control form-control-user" name="rePassword" placeholder="Repeat Password">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <a class="btn btn-success btn-user btn-block" href="userManagement.php"><i class="fas fa-caret-left"></i> Back</a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="submit" name="create" value="Create User" class="btn btn-primary btn-user btn-block" />
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