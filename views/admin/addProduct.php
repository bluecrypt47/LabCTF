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

    <title>Add Product</title>

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
                if (isset($_POST['addProduct'])) {
                    $nameProduct = trim($_POST['name']);
                    $typeProduct = trim($_POST['type']);
                    $price = trim($_POST['price']);
                    $quantity = trim($_POST['quantity']);
                    $unit = trim($_POST['unit']);
                    $description = trim($_POST['description']);

                    $imgName = $_FILES['image']['name'];
                    $imagePath = "../../assets/img/products/" . $imgName;
                    $isUploaded = move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);

                    // Ki???m tra email c?? b??? tr??ng hay kh??ng
                    // $sql = "SELECT * FROM products WHERE name = '$email'";

                    // Th???c thi c??u truy v???n
                    $result = mysqli_query($conn, $sql);

                    // N???u k???t qu??? tr??? v??? l???n h??n 1 th?? ngh??a l?? email ???? t???n t???i trong DB
                    // if (mysqli_num_rows($result) > 0) {
                    //     echo '<div class="alert alert-danger">
                    //     Email has existed!
                    //             </div>';
                    //     echo $phoneNumber;
                    //     // D???ng ch????ng tr??nh
                    //     die();
                    // } else {
                    $sql = "INSERT INTO `products`(`idType`, `nameProduct`, `imgProduct`, `description`, `price`, `quantity`, `unit`) VALUES ('$typeProduct','$nameProduct','$imagePath','$description','$price','$quantity','$unit')";
                    echo '<script language="javascript">alert("Add Product Successfully!"); window.location="productManagement.php";</script>';

                    if (mysqli_query($conn, $sql)) {
                        echo "T??n: " . $_POST['name'] . "<br/>";
                        echo "Lo???i: " . $_POST['type'] . "<br/>";
                        echo "H??nh: " . $_POST['image'] . "<br/>";
                        echo "Gi??: " . $_POST['price'] . "<br/>";
                        echo "S??? l?????ng: " . $_POST['quantity'] . "<br/>";
                        echo "????n v???: " . $_POST['unit'] . "<br/>";
                        echo "M?? t???: " . $_POST['description'] . "<br/>";
                    } else {
                        echo '<div class="alert alert-danger">
                            Add Product Fail!
                                </div>';
                    }
                }

                $sqlType = "SELECT * FROM producttype";
                $resultType = mysqli_query($conn, $sqlType);
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add Product</h1>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-lg-12 col-md-9">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-10">
                                        <form method="post" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" class="user" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <img src="../../assets/img/undraw_posting_photo.svg" class="rounded mx-auto d-block" alt="Avatar" style="width:200px;height:300px;">
                                                <label>Image<label style="color: red;">*</label></label>
                                                <input class="rounded mx-auto" type="file" name="image" required>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label>Name Product<label style="color: red;">*</label></label>
                                                    <input type="text" class="form-control form-control-user" name="name" placeholder="Name product" required>
                                                </div>
                                                <div class="form-group">
                                                    <select name="type" class="form-select form-select-user" aria-label="Default select example" style=" position: absolute; top: 400px; border-radius: 10px; width: 150px; height: calc(1.5em + 0.75rem + 2px); text-align: center;">
                                                        <option selected value="0">Select Type<label style="color: red;">*</label></option>
                                                        <?php if ($resultType->num_rows > 0) {
                                                            while ($types = mysqli_fetch_assoc($resultType)) { ?>
                                                                <option value="<?php echo $types['idType']; ?>"><?php echo $types['nameType']; ?> </option>
                                                            <?php }
                                                        } else { ?>
                                                            <option selected value="0">None</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <label>Price<label style="color: red;">*</label></label>
                                                    <input type="text" class="form-control form-control-user" name="price" placeholder="Price" required>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>Quantity<label style="color: red;">*</label></label>
                                                    <input type="number" class="form-control form-control-user" name="quantity" placeholder="Quantity" required>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>Unit<label style="color: red;">*</label></label>
                                                    <input type="text" class="form-control form-control-user" name="unit" placeholder="Unit" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea type="textarea" class="form-control " name="description" rows="10" cols="50" placeholder="Description"></textarea>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <a class="btn btn-success btn-user btn-block" href="productManagement.php"><i class="fas fa-caret-left"></i> Back</a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="submit" name="addProduct" value="Add" class="btn btn-primary btn-user btn-block" />
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