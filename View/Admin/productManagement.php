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
                        <h1 class="h3 mb-0 text-gray-800">List Products</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <?php

                    $email = $_SESSION['email'];

                    $sql1 = "SELECT * FROM users WHERE email='$email'";
                    $result1 = mysqli_query($conn, $sql1);
                    $user1 = mysqli_fetch_assoc($result1);
                    // ===============================

                    // Get all user in DB and pagination
                    $count = 0;

                    $countUsers = mysqli_query($conn, "SELECT count(*) as total FROM products");
                    $rows = mysqli_fetch_assoc($countUsers);

                    $totalRows = $rows['total'];

                    $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
                    $limit = 3;

                    $sizePage = 2;
                    $totalPage = ceil($totalRows / $limit);;

                    if ($currentPage > $totalPage) {
                        $currentPage = $totalPage;
                    } else if ($currentPage < 1) {
                        $currentPage = 1;
                    }
                    $start = ($currentPage - 1) * $limit;

                    $result = mysqli_query($conn, "SELECT * FROM products , producttype  where products.idType = producttype.idType LIMIT $start, $limit");
                    ?>

                    <!-- Content Row -->
                    <div class="row">
                        <div>
                            <a class="btn btn-danger" href="addProduct.php"><i class="fas fa-plus"></i> Add Product</a>
                        </div>
                        <table class="table ">
                            <thead style="text-align: center;">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name product</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price / Unit</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Create at</th>
                                    <th scope="col">Update at</th>
                                    <th scope="col">Activity</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center;">
                                <?php $i = 1;
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $i++; ?></th>
                                        <td><img src="<?php echo $row['imgProduct']; ?>" style="width:60px;height:60px;"> </td>
                                        <td><?php echo $row['nameProduct']; ?></td>
                                        <td><?php echo $row['description']; ?></td>
                                        <td><?php echo number_format($row['price']); ?>₫ / <?php echo $row['unit']; ?></td>
                                        <td><?php echo $row['quantity']; ?></td>
                                        <td><?php echo $row['createDateProduct']; ?></td>
                                        <td><?php echo $row['updateDateProduct']; ?></td>
                                        <td><a class="btn btn-info" title="View" href="viewDetailProduct.php?id=<?php echo $row['idProduct']; ?>"><i class="fas fa-eye"></i></a>
                                            <?php if ($user1['roles'] == 1) { ?>
                                                <a class="btn btn-warning" title="Edit" href="updateProduct.php?id=<?php echo $row['idProduct']; ?>"><i class="fas fa-edit"></i></a>
                                                <a class="btn btn-danger" title="Delete" href="deleteProduct.php?id=<?php echo $row['idProduct']; ?>"><i class="fas fa-trash-alt"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>

                        <div>
                            <a class="btn btn-success" href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><i class="fas fa-caret-left"></i> Back</a>
                        </div>
                        <hr>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <?php if ($currentPage > 1 && $totalPage > 1) { ?>
                                        <a class="page-link" href="productManagement.php?currentPage=<?php $currentPage - 1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <?php
                                    }

                                    for ($i = 1; $i <= $totalPage; $i++) {
                                        if ($i == $currentPage) { ?>
                                <li class="page-item"><a class="page-link" href="#"><?php echo $i; ?></a></li>
                            <?php  } else { ?>

                                <li class="page-item"><a class="page-link" href="productManagement.php?currentPage=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php   }
                                    }
                                    if ($currentPage < $totalPage && $totalPage > 1) { ?>
                            <li class="page-item">
                                <a class="page-link" href="productManagement.php?currentPage=<?php echo $currentPage + 1; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        <?php  }
                        ?>
                        </li>
                            </ul>
                        </nav>

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