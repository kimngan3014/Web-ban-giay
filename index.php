<?php 
include 'db.php';     // Kết nối database
include 'header.php'; // Gọi phần đầu trang
?>
		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url(images/img_bg_1.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-sm-6 offset-sm-3 text-center slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">Men's</h1>
					   					<h2 class="head-2">Shoes</h2>
					   					<h2 class="head-3">Collection</h2>
					   					<p class="category"><span>New trending shoes</span></p>
					   					<p><a href="men.php" class="btn btn-primary">Shop Collection</a></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(images/img_bg_2.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-sm-6 offset-sm-3 text-center slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">Huge</h1>
					   					<h2 class="head-2">Sale</h2>
					   					<h2 class="head-3"><strong class="font-weight-bold">50%</strong> Off</h2>
					   					<p class="category"><span>Big sale sandals</span></p>
					   					<p><a href="women.php" class="btn btn-primary">Shop Collection</a></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(images/img_bg_3.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-sm-6 offset-sm-3 text-center slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">New</h1>
					   					<h2 class="head-2">Arrival</h2>
					   					<h2 class="head-3">up to <strong class="font-weight-bold">30%</strong> off</h2>
					   					<p class="category"><span>New stylish shoes for men</span></p>
					   					<p><a href="men.php" class="btn btn-primary">Shop Collection</a></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>
		<div class="colorlib-intro">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h2 class="intro">It started with a simple idea: Create quality, well-designed products that I wanted myself.</h2>
					</div>
				</div>
			</div>
		</div>
		<div class="colorlib-product">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6 text-center">
						<div class="featured">
							<a href="#" class="featured-img" style="background-image: url(images/men.jpg);"></a>
							<div class="desc">
								<h2><a href="men.php">Shop Men's Collection</a></h2>
							</div>
						</div>
					</div>
					<div class="col-sm-6 text-center">
						<div class="featured">
							<a href="#" class="featured-img" style="background-image: url(images/women.jpg);"></a>
							<div class="desc">
								<h2><a href="women.php">Shop Women's Collection</a></h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="colorlib-product">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
						<h2>Best Sellers</h2>
					</div>
				</div>
				<!-- BẮT ĐẦU ĐOẠN CODE PHP -->
        <div class="row row-pb-md">
            <?php
            // 1. Viết câu lệnh SQL lấy tất cả sản phẩm, cái mới nhất lên đầu
            $sql = "SELECT * FROM products ORDER BY id DESC";
            
            // 2. Thực thi câu lệnh
            $result = mysqli_query($conn, $sql);
            
            // 3. Kiểm tra xem có sản phẩm nào không
            if(mysqli_num_rows($result) > 0){
                // 4. Nếu có, chạy vòng lặp while để in từng sản phẩm ra
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            
                <!-- Đây là 1 khối sản phẩm (sẽ được lặp lại) -->
                <div class="col-lg-3 mb-4 text-center">
                    <div class="product-entry border">
                        <a href="#" class="prod-img">
                            <!-- Ảnh lấy từ thư mục uploads -->
                            <img src="uploads/<?php echo $row['image']; ?>" class="img-fluid" alt="<?php echo $row['name']; ?>" style="height: 200px; object-fit: cover;">
                        </a>
                        <div class="desc">
                            <!-- Tên sản phẩm -->
							<h2><a href="product-detail.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></h2>                            <!-- Giá tiền -->
                            <span class="price"><?php echo number_format($row['price']); ?> VNĐ</span>
                            
                            <!-- Nút Thêm vào giỏ (Quan trọng: link trỏ về cart.php) -->
                            <p>
                                <a href="cart.php?add_id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Thêm vào giỏ</a>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Kết thúc 1 khối sản phẩm -->

            <?php 
                } // Kết thúc vòng lặp while
            } else {
                // Nếu database chưa có gì
                echo "<p class='text-center col-12'>Chưa có sản phẩm nào trong cửa hàng.</p>";
            }
            ?>
        </div>
        <!-- KẾT THÚC ĐOẠN CODE PHP -->
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
		
