<?php
include 'db.php'; // Đã bao gồm session_start()

// KIỂM TRA QUYỀN ADMIN
// 1. Chưa đăng nhập -> Đuổi về trang login
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Vui lòng đăng nhập!'); window.location='login.php';</script>";
    exit();
}

// 2. Đã đăng nhập nhưng không phải Admin (role != 1) -> Đuổi về trang chủ
if ($_SESSION['user_role'] != 1) {
    echo "<script>alert('Bạn không có quyền truy cập trang này!'); window.location='index.php';</script>";
    exit();
}
// Xử lý khi bấm nút "Thêm sản phẩm"
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['description'];
    
    // Xử lý ảnh
    $file_name = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file_name);

    // Kiểm tra và di chuyển ảnh vào thư mục uploads
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        // Lưu vào Database (Sửa tên bảng 'products' cho khớp với bảng bạn tạo)
        $sql = "INSERT INTO products (name, price, image, description) VALUES ('$name', '$price', '$file_name', '$desc')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('✅ Thêm thành công!'); window.location='index.php';</script>";
        } else {
            echo "Lỗi SQL: " . mysqli_error($conn);
        }
    } else {
        echo "❌ Lỗi: Không upload được ảnh. Hãy kiểm tra lại thư mục 'uploads'.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm mới</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style> .container { max-width: 600px; margin-top: 50px; } </style>
</head>
<body>
    <div class="container">
        <h3 class="text-center mb-4">👟 Thêm Giày Mới</h3>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Tên giày:</label>
                <input type="text" name="name" class="form-control" required placeholder="Ví dụ: Nike Air Force 1">
            </div>
            
            <div class="form-group">
                <label>Giá tiền (VNĐ):</label>
                <input type="number" name="price" class="form-control" required placeholder="Ví dụ: 200.000">
            </div>

            <div class="form-group">
                <label>Hình ảnh:</label>
                <input type="file" name="image" class="form-control-file" required>
            </div>

            <div class="form-group">
                <label>Mô tả chi tiết:</label>
                <textarea name="description" class="form-control" rows="4"></textarea>
            </div>

            <button type="submit" name="submit" class="btn btn-primary btn-block">THÊM SẢN PHẨM</button>
            <br>
            <a href="index.php" class="btn btn-secondary btn-block">Quay lại trang chủ</a>
        </form>
    </div>
</body>
</html>