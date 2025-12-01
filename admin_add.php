<?php
include 'db.php';

// BẢO VỆ ADMIN (Thêm đoạn này nếu muốn bảo mật)
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
    header("Location: login.php"); exit();
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['description'];
    $category = $_POST['category']; // Lấy loại giày (Men/Women)
    
    // Xử lý ảnh
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    // Thêm cột category vào câu lệnh INSERT
    $sql = "INSERT INTO products (name, price, image, description, category) 
            VALUES ('$name', '$price', '$image', '$desc', '$category')";
            
    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Thêm thành công!'); window.location='admin_products.php';</script>";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm mới</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>.container{max-width: 600px; margin-top: 50px;}</style>
</head>
<body>
    <div class="container">
        <h3 class="text-center">👟 Thêm Giày Mới</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Tên giày:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Loại giày:</label>
                <select name="category" class="form-control">
                    <option value="Men">Giày Nam (Men)</option>
                    <option value="Women">Giày Nữ (Women)</option>
                </select>
            </div>
            <div class="form-group">
                <label>Giá tiền:</label>
                <input type="number" name="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Hình ảnh:</label>
                <input type="file" name="image" class="form-control-file" required>
            </div>
            <div class="form-group">
                <label>Mô tả:</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block">THÊM NGAY</button>
            <a href="admin_products.php" class="btn btn-secondary btn-block">Quay lại</a>
        </form>
    </div>
</body>
</html>