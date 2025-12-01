<?php 
include 'db.php'; 
include 'header.php'; 
?>

<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="index.php">Home</a></span> / <span>Women</span></p>
            </div>
        </div>
    </div>
</div>

<div class="breadcrumbs-two">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumbs-img" style="background-image: url(images/cover-img-1.jpg);">
                    <h2>Women's</h2>
                </div>
                <div class="menu text-center">
                    <p><a href="#">New Arrivals</a> <a href="#">Best Sellers</a> <a href="#">Extended Widths</a> <a href="#">Sale</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="colorlib-featured">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 text-center">
                <div class="featured">
                    <div class="featured-img featured-img-2" style="background-image: url(images/img_bg_2.jpg);">
                        <h2>Casuals</h2>
                        <p><a href="#" class="btn btn-primary btn-lg">Shop now</a></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-center">
                <div class="featured">
                    <div class="featured-img featured-img-2" style="background-image: url(images/women.jpg);">
                        <h2>Dress</h2>
                        <p><a href="#" class="btn btn-primary btn-lg">Shop now</a></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-center">
                <div class="featured">
                    <div class="featured-img featured-img-2" style="background-image: url(images/item-11.jpg);">
                        <h2>Sports</h2>
                        <p><a href="#" class="btn btn-primary btn-lg">Shop now</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="colorlib-product">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                <h2>View All Products</h2>
            </div>
        </div>
        
        <div class="row row-pb-md">
            <?php
            // Lấy danh sách sản phẩm (Ở đây lấy hết, nếu phân loại thì thêm WHERE)
            $sql = "SELECT * FROM products WHERE category = 'Women' ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-md-3 col-lg-3 mb-4 text-center">
                    <div class="product-entry border">
                        <a href="#" class="prod-img">
                            <img src="uploads/<?php echo $row['image']; ?>" class="img-fluid" alt="<?php echo $row['name']; ?>" style="height: 200px; object-fit: cover;">
                        </a>
                        <div class="desc">
                            <h2><a href="product-detail.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></h2>
                            <span class="price"><?php echo number_format($row['price']); ?> VNĐ</span>
                            <p><a href="cart.php?add_id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Thêm vào giỏ</a></p>
                        </div>
                    </div>
                </div>
            <?php 
                }
            } else {
                echo "<p class='col-12 text-center'>Chưa có sản phẩm nào.</p>";
            }
            ?>
        </div>
    </div>
</div>

<div class="colorlib-partner">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                <h2>Trusted Partners</h2>
            </div>
        </div>
        <div class="row">
            <div class="col partner-col text-center">
                <img src="images/brand-1.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
            </div>
            <div class="col partner-col text-center">
                <img src="images/brand-2.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
            </div>
            <div class="col partner-col text-center">
                <img src="images/brand-3.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
            </div>
            <div class="col partner-col text-center">
                <img src="images/brand-4.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
            </div>
            <div class="col partner-col text-center">
                <img src="images/brand-5.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>