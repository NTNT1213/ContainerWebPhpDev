<?php
session_start();

// Kiểm tra xem người dùng đã gửi dữ liệu đăng nhập chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form đăng nhập
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Kiểm tra dữ liệu đăng nhập với cơ sở dữ liệu
    if ($username && $password) {
        // Kết nối đến cơ sở dữ liệu
        require_once 'C:\Users\DELL\OneDrive\Tài liệu\Web#\Model\index.php';

        // Truy vấn để kiểm tra thông tin đăng nhập
        $query = "SELECT * FROM User WHERE TenUser = :username AND MatKhau = :password";
        $statement = $db->prepare($query);
        $statement->execute(array(':username' => $username, ':password' => $password));
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        // Nếu có người dùng với thông tin đăng nhập hợp lệ, chuyển hướng đến trang chính
        if ($user) {
            $_SESSION['username'] = $username;
            header("Location: Sach.php"); // Thay đổi main.php thành trang bạn muốn chuyển hướng sau khi đăng nhập thành công
            exit();
        } else {
            echo "<script>alert('Thông tin đăng nhập không chính xác. Vui lòng thử lại!');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin đăng nhập!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center">Sách</h1>
        <form action="" method="post">
            <input type="text" id="username" name="username" placeholder="Please enter your Phone Number or Email" required>
            <input type="password" id="password" name="password" placeholder="Please enter your password" required>
            <input type="submit" value="Đăng nhập">
        </form>
    </div>
</body>
</html>
