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

// Xử lý Xóa đơn hàng (nếu đơn hủy)
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM order_details WHERE order_id=$id"); // Xóa chi tiết trước
    mysqli_query($conn, "DELETE FROM orders WHERE id=$id"); // Xóa đơn chính
    echo "<script>alert('Đã xóa đơn hàng!'); window.location='admin_orders.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý đơn hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">📋 DANH SÁCH ĐƠN ĐẶT HÀNG</h2>
        <div class="text-right mb-3">
            <a href="admin_add.php" class="btn btn-success">+ Thêm sản phẩm</a>
            <a href="index.php" class="btn btn-secondary">Về trang chủ</a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>SĐT</th>
                    <th>Tổng tiền</th>
                    <th>Thanh toán</th>
                    <th>Ngày đặt</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Lấy danh sách đơn hàng, mới nhất lên đầu
                $sql = "SELECT * FROM orders ORDER BY id DESC";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td>#<?php echo $row['id']; ?></td>
                        <td>
                            <strong><?php echo $row['fullname']; ?></strong><br>
                            <small><?php echo $row['address']; ?></small>
                        </td>
                        <td><?php echo $row['phone']; ?></td>
                        <td class="text-danger font-weight-bold"><?php echo number_format($row['total_money']); ?> đ</td>
                        <td>
                            <?php if($row['payment_method'] == 'BANK'): ?>
                                <span class="badge badge-primary">Chuyển khoản</span>
                            <?php else: ?>
                                <span class="badge badge-secondary">COD</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo date("d/m/Y H:i", strtotime($row['created_at'])); ?></td>
                        <td>
                            <a href="admin_orders.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn chắc chắn muốn xóa đơn này?');">Xóa</a>
                        </td>
                    </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Chưa có đơn hàng nào.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>