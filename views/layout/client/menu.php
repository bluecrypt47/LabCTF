<?php require '../../controllers/connection/connectionDB.php'; ?>

<?php
$sqlProductType = "SELECT * FROM producttype";
$result = mysqli_query($conn, $sqlProductType);
?>

<div class="col-md-3">
    <nav class="navbar bg-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-home"></i>TRANG CHỦ</a>
            </li>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-shopping-bag"></i><?php echo $row['nameType']; ?></a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>