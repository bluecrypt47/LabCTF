<?php
require '../../controllers/connection/connectionDB.php';

$sqlHL = "SELECT * FROM products WHERE highLight = 1";
$resultHL = mysqli_query($conn, $sqlHL);


while ($row = mysqli_fetch_assoc($resultHL)) {
    echo $row['nameProduct'];
}
