<?php
if (!isset($_SESSION)) {
    session_start();
}

header('Content-Type: text/html; charset=utf-8');
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'CTF') or die('Connection fail!');
mysqli_set_charset($conn, "utf8");


// Login
if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = md5(trim($_POST['password']));


    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // Kiểm tra email và password có trong DB không
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

    // Thực thi câu truy vấn
    $result1 = mysqli_query($conn, $sql);

    // Nếu kết quả trả về lớn hơn 1 thì nghĩa là username hoặc email đã tồn tại trong CSDL
    if (mysqli_num_rows($result1) > 0) {
        if (!empty($_POST['remember'])) {
            setcookie('login', $_POST['email'], time() + (10 * 365 * 24 * 60 * 60));
            setcookie('password', $_POST['password'], time() + (10 * 365 * 24 * 60 * 60));
        } else {
            if (isset($_COOKIE['login'])) {
                setcookie('login', "");
            }
            if (isset($_COOKIE['password'])) {
                setcookie('password', "");
            }
        }
        echo '<script language="javascript">alert("Login Successfully!"); window.location="index.php";</script>';
    } else {
        echo '<script language="javascript">alert("Email has existed!"); window.location="login.php";</script>';
        die();
    }
    $_SESSION['email'] = $email;
    echo "Xin chào " . $_SESSION['email'];
    die();
}


// Register
if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
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

    // Kiểm tra email có bị trùng hay không
    $sql = "SELECT * FROM users WHERE email = '$email'";

    // Thực thi câu truy vấn
    $result = mysqli_query($conn, $sql);

    // Nếu kết quả trả về lớn hơn 1 thì nghĩa là email đã tồn tại trong DB
    if (mysqli_num_rows($result) > 0) {
        echo '<script language="javascript">alert("Email has existed!"); window.location="register.php";</script>';
        // Dừng chương trình
        die();
    } else {
        $sql = "INSERT INTO users (username, email, phoneNumber, password) VALUES ('$name','$email','$phoneNumber', '$password')";
        echo '<script language="javascript">alert("Register Successfully!"); window.location="login.php";</script>';

        if (mysqli_query($conn, $sql)) {
            echo "Tên đăng nhập: " . $_POST['username'] . "<br/>";
            echo "Mật khẩu: " . $_POST['password'] . "<br/>";
            echo "Email đăng nhập: " . $_POST['email'] . "<br/>";
        } else {
            echo '<script language="javascript">alert("Register Fail!"); window.location="register.php";</script>';
        }
    }
}
