<?php

$uri = "mysql://avnadmin:AVNS_i2MaTwSN27P-m-dvd3e@mysql-10d8980f-mizu-hime2612.l.aivencloud.com:24491/defaultdb?ssl-mode=REQUIRED";

$fields = parse_url($uri);

// Build the DSN including SSL settings
$conn = "mysql:";
$conn .= "host=" . $fields["host"];
$conn .= ";port=" . $fields["port"];
$conn .= ";dbname=defaultdb";
$conn .= ";sslmode=verify-ca;sslrootcert=ca.pem";

try {
  $db = new PDO($conn, $fields["user"], $fields["pass"]);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Tạo bảng Sach
  $db->exec("CREATE TABLE IF NOT EXISTS Sach (
      MaSach INT AUTO_INCREMENT PRIMARY KEY,
      TenSach VARCHAR(255) NOT NULL,
      SoLuong INT NOT NULL
    )");

  // Tạo bảng User
  $db->exec("CREATE TABLE IF NOT EXISTS User (
      MaUser INT AUTO_INCREMENT PRIMARY KEY,
      TenUser VARCHAR(255) NOT NULL,
      MatKhau VARCHAR(255) NOT NULL
    )");

  // Chèn dữ liệu vào bảng Sach
  $db->exec("INSERT INTO Sach (TenSach, SoLuong) VALUES 
    ('Sách 1', 10),
    ('Sách 2', 20),
    ('Sách 3', 20),
    ('Sách 4', 30),
    ('Sách 5', 50)");

  // Chèn dữ liệu vào bảng User
  $db->exec("INSERT INTO User (TenUser, MatKhau) VALUES 
    ('User1', '1'),
    ('User 2', 'password2'),
    ('User 3', 'password3'),
    ('User 4', 'password4'),
    ('User 5', 'password5')");

  echo "Thành công!";
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}
?>
