<?php
ob_flush();
require_once "include/config.php";
session_start();
if ($_SESSION['user_status'] == "A" && $_SESSION['user_type'] == "A") {
	date_default_timezone_set('Asia/Calcutta');
	$date = date("Y-m-d");
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<title>Admin Panel</title>
		<!--== META TAGS ==-->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<!--== FAV ICON ==-->
		<link rel="shortcut icon" href="images/fav.ico">
		<!-- GOOGLE FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,600,700" rel="stylesheet">
		<!-- FONT-AWESOME ICON CSS -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!--== ALL CSS FILES ==-->
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/mob.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/materialize.css"/>
		
	</head>
	
	<body>
		
		<?php include_once "include/header.php"; ?>
		
		<!--== BODY CONTNAINER ==-->
		<div class="container-fluid sb2">
			<div class="row">
				
				<?php include_once "include/sidebar.php"; ?>
				
				<!--== BODY INNER CONTAINER ==-->
				<div class="sb2-2">
					<!--== breadcrumbs ==-->
					<div class="sb2-2-2">
						<ul>
							<li><a href="main.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
							</li>
							<li class="active-bre"><a href="#"> Dashboard</a>
							</li>
						</ul>
					</div>
					<!--== DASHBOARD INFO ==-->
					<div class="sb2-2-1">
						<?php if (isset($_SESSION['error_msg'])) {
							echo $_SESSION['error_msg'];
							unset($_SESSION['error_msg']);
						}
						if (isset($_SESSION['success_msg'])) {
							echo $_SESSION['success_msg'];
							unset($_SESSION['success_msg']);
						}
						?>
						<h2>Admin Dashboard</h2>
						<p></p>
						<div class="db-2">
							<ul>
								<!-- <li>
									<div class="dash-book dash-b-1">
										
										<?php $orderResult = $connection->query("SELECT * FROM temporder"); ?>
										<h5>Orders</h5>
										<h4><?php echo $orderResult->num_rows; ?></h4>
										<a href="all-orders.php">View order</a>
									</div>
								</li> -->
								<li>
									<div class="dash-book dash-b-3">
										<?php
										$catQuery = "SELECT * FROM categories WHERE parent_category_code = '0' AND category_level = '1' and vendor_email = '';";
										$categoryResult = $connection->query($catQuery); ?>
										<h5>Categories</h5>
										<h4><?php echo $categoryResult->num_rows; ?></h4>
										<a href="all-categories.php">View more</a>
									</div>
								</li>
								<li>
									<div class="dash-book dash-b-4">
										<?php $productResult = $connection->query("SELECT * FROM products WHERE 1=1"); ?>
										<h5>Products</h5>
										<h4><?php echo $productResult->num_rows; ?></h4>
										<a href="all-products.php">View more</a>
									</div>
								</li>
								<!-- <li>
									<div class="dash-book dash-b-2">
										<?php //$bannerResult = $connection->query("SELECT * FROM vendor"); ?>
										<h5>Vendors</h5>
										<h4>
											<?php echo $bannerResult->num_rows; ?></h4>
										<a href="all-vendor.php">View more</a>
									</div>
								</li> -->
							</ul>
						</div>
						<br>
						<!-- <h2>Today Details</h2>
						<div class="db-2">
							<ul>
								<li>
									<div class="dash-book dash-b-1">
										
										<?php $orderResult = $connection->query("SELECT * FROM temporder where order_date = '$date'" ); ?>
										<h5>Orders</h5>
										<h4><?php echo $orderResult->num_rows; ?></h4>
										<a href="all-orders.php?order=&date=<?php echo $date;?>">View order</a>
									</div>
								</li>
								<li>
									<div class="dash-book dash-b-3">
										<?php
										$catQuery = "SELECT * FROM temporder WHERE order_date = '$date' and( order_status='Order Conform' or order_status='Your Order has been assign to de')";
										$categoryResult = $connection->query($catQuery); ?>
										<h5>Ongoing</h5>
										<h4><?php echo $categoryResult->num_rows; ?></h4>
										<a href="all-orders.php?order=Order Conform&date=<?php echo$date;?>">View more</a>
									</div>
								</li>
								<li>
									<div class="dash-book dash-b-4">
										<?php $productResult = $connection->query("SELECT * FROM temporder WHERE order_date = '$date' and order_status='Parcel Delivered'"); ?>
										<h5>Completed</h5>
										<h4><?php echo $productResult->num_rows; ?></h4>
										<a href="all-orders.php?order=Parcel Delivered&date=<?php echo$date;?>">View more</a>
									</div>
								</li>
								<li>
									<div class="dash-book dash-b-2">
										<?php $bannerResult = $connection->query("SELECT * FROM temporder WHERE order_date = '$date' and order_status='In Progress'"); ?>
										<h5>Pending</h5>
										<h4>
											<?php echo $bannerResult->num_rows; ?></h4>
										<a href="all-orders.php?order=In Progress&date=<?php echo$date;?>">View more</a>
									</div>
								</li>
							</ul>
						</div> -->
					</div>
				</div>
			</div>
		</div>
		
		<!--== BOTTOM FLOAT ICON ==-->
		
		
		<!--======== SCRIPT FILES =========-->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/materialize.min.js"></script>
		<script src="js/custom.js"></script>
	</body>
	</html>
<?php } else {
	$_SESSION['error_msg'] = "<div class='alert alert-danger'>";
	$_SESSION['error_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
	$_SESSION['error_msg'] .= "Sorry, You need to login to view that page.</div>";
	header("Location: index.php");
}
?>