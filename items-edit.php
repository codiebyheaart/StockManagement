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
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
		<![endif]-->
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
							<li class="active-bre"><a href="#"> Edit Products</a>
							</li>
						</ul>
					</div>
					<div class="sb2-2-add-blog sb2-2-1">
						<?php if (isset($_SESSION['error_msg'])) {
							echo $_SESSION['error_msg'];
							unset($_SESSION['error_msg']);
						}
						if (isset($_SESSION['success_msg'])) {
							echo $_SESSION['success_msg'];
							unset($_SESSION['success_msg']);
						} ?>
						<div class="tab-content">
							<div id="home" class="tab-pane fade in active">
								<div class="box-inn-sp">
									<div class="inn-title">
										<h4 class="txt-center">Edit Products</h4>
									</div>
									<?php
										$id = $_GET['id'];
											$sql = $connection->query("SELECT * FROM products WHERE id = '$id'");
										$query = $sql->fetch_assoc();
										$c1 = $query['category_code'];
                                       //print_r($c1);die;
										$sql1 = $connection->query("SELECT * FROM categories WHERE category_code = '$c1'");
										$query1 = $sql1->fetch_assoc();
										$c2 = $query1['parent_category_code'];

										$sql2 = $connection->query("SELECT * FROM categories WHERE category_code = '$c2'");
										$query2 = $sql2->fetch_assoc();
										$c3 = $query2['parent_category_code'];
										?>
									<div class="bor">
										<?php //$id = $_GET['id'];
										//$sql = $connection->query("SELECT * FROM products WHERE id = '$id'");
										//$query = $sql->fetch_assoc();
										?>
										
										<form action="include/update_product.php" method="post" enctype="multipart/form-data">
											<div class="row">
												<div class="input-field col s12">
													<input type="hidden" name="product_id" value="<?php echo $query['id']; ?>">
													<input id="product_name" type="text" class="validate" name="product_name"
													       value="<?php echo $query['name']; ?>" required>
													<label for="product_name">Product Name</label>
												</div>
												<!-- <div class="input-field col s12">
													<input id="product_code" type="text" class="validate" name="product_code"
													       value="<?php echo $query['product_code']; ?>" required>
													<label for="product_code">Product Code</label>
												</div> -->
												<div class="input-field col s12">
													<input id="product_price" type="number" class="validate" name="product_price" value="<?php echo $query['price']; ?>" required>
													<label for="product_price">Price</label>
												</div>

												<div class="input-field col s12">
													<input id="stock" name="stock" type="text" class="validate"
													      value="<?php echo $query['stock']; ?>" required>
													<label for="stock">Stock</label>
												</div>

												<div class="input-field col s12">
													<label for="product_gst">GST</label>
													<br><br>
													<select name="product_gst" id="product_gst" class="browser-default">
														<option value="0" <?php echo $query['gst'] == 0 ? "selected" : "" ?>>0%</option>
														<option value="5" <?php echo $query['gst'] == 5 ? "selected" : "" ?>>5%</option>
														<option value="12" <?php echo $query['gst'] == 12 ? "selected" : "" ?>>12%</option>
														<option value="18" <?php echo $query['gst'] == 18 ? "selected" : "" ?>>18%</option>
														<option value="28" <?php echo $query['gst'] == 28 ? "selected" : "" ?>>28%</option>
													</select>
												</div>
											<!--	<div class="input-field col s12">
													<input id="min_quantity" name="min_quantity" class="validate"
													       value="<?php //echo $query['min_quantity']; ?>" type="number" required>
													<label for="min_quantity">Min Quantity</label>
												</div>
												<div class="input-field col s12">
													<input type="text" name="units_per_box" id="units_per_box"
													       class="validate" value="<?php //echo $query['units_per_box']; ?>" required>
													<label for="units_per_box">Items Units Per Box</label>
												</div>-->
												<div class="input-field col s12">
													<input id="short_details" type="text" class="validate" name="short_details"
													       value="<?php echo $query['small_details']; ?>" required>
													<label for="short_details">Short Details</label>
												</div>
												
												<div class="input-field col s12 main_category">
													<p>Select Main Category</p>
													<select name="first_category" id="first_category" class="browser-default">
												
														<?php $category = $connection->query("SELECT * FROM categories WHERE parent_category_code = '0'");
														   while ($categoryRow = $category->fetch_array()) { ?>
                                                           <option value="<?php echo $categoryRow['category_code']; ?>" <?php echo $categoryRow['category_code']==$c3?"selected":"";?>><?php echo stripslashes(stripslashes(stripslashes($categoryRow['name'])));?></option>
														<?php } ?>
													</select>
												</div>
                                               
												<div class="input-field col s12 sub_category">
													<p>Select Sub Category</p>
													<select name="secound_category" id="secound_category" class="browser-default">
														
														<?php $category1 = $connection->query("SELECT * FROM categories WHERE parent_category_code = '$c3'");
														   while ($categoryRow1 = $category1->fetch_array()) { ?>
                                                           <option value="<?php echo $categoryRow1['category_code']; ?>" <?php echo $categoryRow1['category_code']==$c2?"selected":"";?>><?php echo stripslashes(stripslashes(stripslashes($categoryRow1['name'])));?></option>
														<?php } ?>
													</select>
												</div>

												<div class="input-field col s12 sub_sub_category">
													<p>Select Sub Sub Category</p>
													<select name="product_category" id="product_category" class="browser-default">
														
														<?php $category2 = $connection->query("SELECT * FROM categories WHERE parent_category_code = '$c2'");
														   while ($categoryRow2 = $category2->fetch_array()) { ?>
                                                           <option value="<?php echo $categoryRow2['category_code']; ?>" <?php echo $categoryRow2['category_code']==$c1?"selected":"";?>><?php echo stripslashes(stripslashes(stripslashes($categoryRow2['name'])));?></option>
														<?php } ?>
													</select>
												</div>
												
												
												<div class="input-field col s12">
													<p>Main Photo of Product</p>
													<input id="product_image" name="product_image" type="file" class="validate">
												</div>
												
												<!-- <div class="input-field col s12">
													<p>Second Photo of Product</p>
													<input id="product_image2" name="product_image2" type="file" class="validate">
												</div>
												
												<div class="input-field col s12">
													<p>Third Photo of Product</p>
													<input id="product_image3" name="product_image3" type="file" class="validate">
												</div>
												
												<div class="input-field col s12">
													<p>Fourth Photo of Product</p>
													<input id="product_image4" name="product_image4" type="file" class="validate">
												</div> -->
																																			
											</div>
											
											<div class="row">
												<div class="input-field col s12">
													<input type="submit" name="submit_button" class="waves-effect waves-light btn-large" value="Update Product">
												</div>
											</div>
										</form>
									</div>
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
			
		</div>
	</body>
	
	</html>
<?php } else {
	$_SESSION['error_msg'] = "<div class='alert alert-danger'>";
	$_SESSION['error_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
	$_SESSION['error_msg'] .= "Sorry, You need to login to view that page.</div>";
	header("Location: index.php");
}
?>