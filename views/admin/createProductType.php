<?php session_start() ?>
<?php require 'D:\DVWA\ProjectCTF\controllers\connection\connectionDB.php'; ?>
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

                // Create Role
                if (isset($_POST['createType'])) {
                    $name = trim($_POST['name']);


                    if (empty($name)) {
                        array_push($errors, "Name is required");
                    }

                    // Kiểm tra role có bị trùng hay không
                    $sql = "SELECT * FROM producttype WHERE nameType = '$name'";

                    // Thực thi câu truy vấn
                    $result = mysqli_query($conn, $sql);

                    // Nếu kết quả trả về lớn hơn 1 thì nghĩa là email đã tồn tại trong DB
                    if (mysqli_num_rows($result) > 0) {
                        echo '<div class="alert alert-danger">
                        Product Type has existed!
                                </div>';
                        // Dừng chương trình
                        die();
                    } else {
                        $sql = "INSERT INTO producttype (`nameType`) VALUES ('$name')";
                        echo '<script language="javascript">alert("Create Product Type Successfully!"); window.location="productTypeManagement.php";</script>';

                        if (mysqli_query($conn, $sql)) {
                            echo "Tên: " . $_POST['name'] . "<br/>";
                        } else {
                            echo '<div class="alert alert-danger">
                            Create Product Type Fail!
                                </div>';
                        }
                    }
                }

                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Create Product Type</h1>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-lg-12 col-md-9">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-10">
                                        <form method="post" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" class="user">
                                            <div class="form-group">
                                                <label>Name Product Type<label style="color: red;">*</label></label>
                                                <input type="text" class="form-control form-control-user" name="name" placeholder="Name" required>
                                            </div>
                                            <hr>
                                            <input type="submit" name="createType" value="Create Product Type" class="btn btn-primary btn-user btn-block" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <a class="btn btn-success" href="productTypeManagement.php"><i class="fas fa-caret-left"></i> Back</a>
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