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

    <title>Create User</title>

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

                <?php

                // Register
                if (isset($_POST['create'])) {
                    $name = trim($_POST['name']);
                    $password = md5(trim($_POST['password']));
                    $rePassword = md5(trim($_POST['rePassword']));
                    $email = trim($_POST['email']);
                    $phoneNumber = trim($_Post['phoneNumber']);


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

                    // Kiểm tra email có bị trùng hay không
                    $sql = "SELECT * FROM users WHERE email = '$email'";

                    // Thực thi câu truy vấn
                    $result = mysqli_query($conn, $sql);

                    // Nếu kết quả trả về lớn hơn 1 thì nghĩa là email đã tồn tại trong DB
                    if (mysqli_num_rows($result) > 0) {
                        echo '<div class="alert alert-danger">
                        Email has existed!
                                </div>';
                        // Dừng chương trình
                        die();
                    } else {
                        $sql = "INSERT INTO users (name, email, phoneNumber, password) VALUES ('$name','$email','$phoneNumber', '$password')";
                        echo '<script language="javascript">alert("Create User Successfully!"); window.location="userManagement.php";</script>';

                        if (mysqli_query($conn, $sql)) {
                            echo "Tên đăng nhập: " . $_POST['username'] . "<br/>";
                            echo "Mật khẩu: " . $_POST['password'] . "<br/>";
                            echo "Email đăng nhập: " . $_POST['email'] . "<br/>";
                        } else {
                            echo '<div class="alert alert-danger">
                            Create User Fail!
                                </div>';
                        }
                    }
                }

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
                                                    <input type="text" class="form-control form-control-user" name="name" placeholder="Name" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-user" name="phoneNumber" placeholder="Phone Number">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address" required>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="password" class="form-control form-control-user" name="rePassword" placeholder="Repeat Password">
                                                </div>
                                            </div>
                                            <hr>
                                            <input type="submit" name="create" value="Create User" class="btn btn-primary btn-user btn-block" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <a class="btn btn-success" href="userManagement.php">Back</a>
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