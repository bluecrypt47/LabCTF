<?php require '../../controllers/connection/connectionDB.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laptop Shop</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="eCommerce HTML Template Free Download" name="keywords">
    <meta content="eCommerce HTML Template Free Download" name="description">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Itim|Lobster|Montserrat:500|Noto+Serif|Nunito|Patrick+Hand|Roboto+Mono:100,100i,300,300i,400,400i,500,500i,700,700i|Roboto+Slab|Saira" rel="stylesheet">
    <!-- Favicon -->
    <link href="../../assets/client/img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="../../assets/client/lib/slick/slick.css" rel="stylesheet">
    <link href="../../assets/client/lib/slick/slick-theme.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../../assets/client/css/style.css" rel="stylesheet">
</head>

<body>
    <?php require '../layout/client/header.php'; ?>

    <!-- Main Slider Start -->
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <?php require '../layout/client/menu.php'; ?>
                <?php require '../layout/client/slide.php'; ?>
            </div>
        </div>
    </div>
    <!-- Main Slider End -->

    <?php
    $sqlHL = "SELECT * FROM products WHERE highLight = 1";
    $resultHL = mysqli_query($conn, $sqlHL);

    $sqlNew = "SELECT * FROM products WHERE new = 1";
    $resultNew = mysqli_query($conn, $sqlNew);
    ?>

    <!-- Featured Product Start -->
    <div class="featured-product product">
        <div class="container-fluid">
            <div class="section-header">
                <h1>Sản Phẩm Nổi Bật</h1>
            </div>
            <div class="row align-items-center product-slider product-slider-4">
                <?php while ($row = mysqli_fetch_assoc($resultHL)) { ?>
                    <div class="col-lg-3">
                        <div class="product-item">
                            <div class="product-title">
                                <a href="#"><?php echo $row['nameProduct']; ?></a>
                            </div>
                            <div class="product-image">
                                <a href="product-detail.html">
                                    <img src="<?php echo $row['imgProduct']; ?>" alt="Product Image" style="width:260px;height:250px;">
                                </a>
                                <div class=" product-action">
                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                    <a href="#"><i class="fa fa-heart"></i></a>
                                    <a href="#"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-price">
                                <h8 style="color: #4287ee;"><?php echo number_format($row['price']); ?><span>₫</span></h8>
                                <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Mua Ngay</a>
                            </div>
                        </div>
                    </div>
                <?php }  ?>
            </div>
        </div>
    </div>
    <!-- Featured Product End -->

    <!-- Recent Product Start -->
    <div class="recent-product product">
        <div class="container-fluid">
            <div class="section-header">
                <h1>Sản Phẩm Gần Đây</h1>
            </div>
            <div class="row align-items-center product-slider product-slider-4">
                <?php while ($row = mysqli_fetch_assoc($resultNew)) { ?>
                    <div class="col-lg-3">
                        <div class="product-item">
                            <div class="product-title">
                                <a href="#"><?php echo $row['nameProduct']; ?></a>
                            </div>
                            <div class="product-image">
                                <a href="product-detail.html">
                                    <img src="<?php echo $row['imgProduct']; ?>" alt="Product Image" style="width:260px;height:250px;">
                                </a>
                                <div class=" product-action">
                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                    <a href="#"><i class="fa fa-heart"></i></a>
                                    <a href="#"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-price">
                                <h8 style="color: #4287ee;"><?php echo number_format($row['price']); ?><span>₫</span></h8>
                                <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Mua Ngay</a>
                            </div>
                        </div>
                    </div>
                <?php }  ?>
            </div>
        </div>
    </div>
    <!-- Recent Product End -->

    <!-- Review Start -->
    <div class="review">
        <div class="container-fluid">
            <div class="row align-items-center review-slider normal-slider">
                <div class="col-md-6">
                    <div class="review-slider-item">
                        <div class="review-img">
                            <img src="img/review-1.jpg" alt="Image">
                        </div>
                        <div class="review-text">
                            <h2>Customer Name</h2>
                            <h3>Profession</h3>
                            <div class="ratting">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nunc eget leo finibus luctus et vitae lorem
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="review-slider-item">
                        <div class="review-img">
                            <img src="img/review-2.jpg" alt="Image">
                        </div>
                        <div class="review-text">
                            <h2>Customer Name</h2>
                            <h3>Profession</h3>
                            <div class="ratting">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nunc eget leo finibus luctus et vitae lorem
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="review-slider-item">
                        <div class="review-img">
                            <img src="img/review-3.jpg" alt="Image">
                        </div>
                        <div class="review-text">
                            <h2>Customer Name</h2>
                            <h3>Profession</h3>
                            <div class="ratting">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nunc eget leo finibus luctus et vitae lorem
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Review End -->

    <?php require '../layout/client/footer.php'; ?>

    <!-- Back to Top -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/slick/slick.min.js"></script>

    <!-- Template Javascript -->
    <script src="../../assets/client/js/main.js"></script>
</body>

</html>