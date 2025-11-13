<?php
ob_flush();
require_once "include/config.php";
session_start();
if ($_SESSION['user_status'] == "A" && $_SESSION['user_type'] == "A") {
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
		<style type="text/css">
			.stock{
			    background: #58b392!important;
			    text-align: center;
			    padding: 5px;
			    border-radius: 5px;
			    color: #fff;
			}
			.stockblink{
				/*background: red!important;*/
			    text-align: center;
			    padding: 5px;
			    border-radius: 5px;
			    color: #fff;
			    animation-name: blink;
			    animation-duration: 1s;
			    animation-iteration-count: infinite;
			    animation-timing-function: linear;
			}
			@keyframes blink{
               0% {background-color: red;}
               /*50% {opacity: .5;}*/
               50% {background-color: #ff8d00;}
               100% {background-color: red;}
			}
		</style>
	</head>
	
	<body>
		<?php include_once "include/header.php"; ?>
		
		<!--== BODY CONTNAINER ==-->
		<div class="container-fluid sb2">
			<div class="row">
				<?php include_once "include/sidebar.php"; ?>
				
				<div class="sb2-2">
					<div class="sb2-2-2">
						<ul>
							<li><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
							</li>
							<li class="active-bre"><a href="#">All Products</a>
							</li>
						</ul>
					</div>
					<div class="sb2-2-3">
						<div class="row">
							<div class="col-md-12">
								<?php if (isset($_SESSION['error_msg'])) {
									echo $_SESSION['error_msg'];
									unset($_SESSION['error_msg']);
								}
								if (isset($_SESSION['success_msg'])) {
									echo $_SESSION['success_msg'];
									unset($_SESSION['success_msg']);
								}
								$result = $connection->query("SELECT * FROM products");
								if ($result->num_rows > 0) {
									?>
									<div class="box-inn-sp">
										<div class="inn-title">
											<h4 class="txt-center">All Products</h4>
										</div>
										<div class="tab-inn">
											<div class="table-responsive table-desi">
												<table class="table table-hover">
													<thead>
													<tr>
														<th>Id</th>
														<th>Stock</th>
														<th>Update Stock</th>
														<th>Category</th>
														<!-- <th>Product Code</th> -->
														<th>Product Name</th>
														<th>Image</th>
														<th>Price</th>
														<th>GST</th>
														<th>Delete</th>
														<th>Update</th>
													</tr>
													</thead>
													<tbody>
													<?php
													$i = 0;
													while ($row = $result->fetch_array()) {
														$i++; ?>
														<tr>
															<th><?php echo $i; ?></th>

													<?php if($row['stock'] <= 10){ ?>

														    <td>
																<p class="stockblink"><?php echo $row['stock']; ?></p>
															</td>

													<?php }else{ ?>

															<td>
																<p class="stock"><?php echo $row['stock']; ?></p>
															</td>
													<?php } ?>

													       <td>
													       	<form action="include/update_stock.php" method="post">
														       	<div>
														       		<input type="hidden" name="id"
														       		value="<?php echo $row['id']; ?>">
														       		<input type="number" name="updatestock" style="width: 80px;">
														       	</div>


														       	<button class="btn" type="submit" name="sbtn" style="padding:0 5px; ">UPDATE</button>
													       	</form>

													       </td>




															<td><?php
																$innerSql = "SELECT * FROM categories WHERE category_code = '$row[category_code]'";
																$inner = mysqli_query($connection, $innerSql)->fetch_assoc();
																echo $inner['name']; ?></td>
															<td><?php echo $row['name']; ?></td>
															<td><img src="../img/<?php echo $row['image']; ?>" style="width: 100px;height: 100px;"></td>
															
															<td><?php echo $row['price']; ?></td>
															<td><?php echo $row['gst']."%"; ?></td>
															<td>
																<a href="include/delete_product.php?id=<?php echo $row['id']; ?>">
																	<i class="fa fa-trash-o" aria-hidden="true"></i></a>
															</td>
															<td>
																<a href="items-edit.php?id=<?php echo $row['id']; ?>">
																	<i class="fa fa-wrench" aria-hidden="true"></i></a>
															</td>
														</tr>
													<?php } ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								<?php } else { ?>
									<h3 class="text-center">Sorry, There are no products to display.</h3>
								<?php } ?>
							</div>
						</div>
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