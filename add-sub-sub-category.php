<?php
require_once "include/config.php";
session_start();
if ($_SESSION['user_status'] == "A" && $_SESSION['user_type'] == "A") { ?>
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
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// --><!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>    <![endif]-->
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
							<li class="active-bre"><a href="#"> Add Sub Category</a>
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
						}
						?>
						<div class="tab-content">
							<div id="home" class="tab-pane fade in active">
								<div class="box-inn-sp">
									<div class="inn-title">
										<h4 class="txt-center">Add Sub Category</h4>
									</div>
									<div class="bor">
										<form action="include/add_sub_sub_category.php" method="post" enctype="multipart/form-data">
											<div class="row">
												<div class="input-field col s12">
													<p>Select Sub Category(Parent Category)</p>
													<select name="sub_category_code" id="sub_category_code" class="browser-default">
														<?php $catSql = "SELECT * FROM categories WHERE parent_category_code = '0'
 															AND category_level = '1'";
														$catQuery = $connection->query($catSql);
														while ($category = $catQuery->fetch_array()) {
															$subCat = $connection->query("SELECT * FROM categories WHERE parent_category_code
																= '$category[category_code]' AND category_level = '2'");
															
															while ($subCategory = $subCat->fetch_array()) { ?>
																<option value="<?php echo $subCategory['category_code']; ?>">
																	<?php echo $category['name'] ?> >> <?php echo $subCategory['name'] ?>
																</option>
															<?php } ?>
														<?php } ?>
													</select>
												</div>
												
												<div class="input-field col s12">
													<input id="sub_sub_category_name" name="sub_sub_category_name" type="text"
													       class="validate" required>
													<label for="sub_category_name">Sub Sub Category Name</label>
												</div>
												
												<div class="input-field col s6">
													<p>Select Category Image</p>
													<input id="category_image" name="category_image" type="file" class="validate" required>
												</div>
												
												<div class="input-field col s6">
													<p>Show on Homepage</p>
													<select name="homepage" class="browser-default" id="homepage">
														<option value="Y">Yes</option>
														<option value="N" selected>No</option>
													</select>
												</div>
												
												<!-- <div class="input-field col s12">
													<p>GST Tax</p>
													<select name="gst" id="gst" class="browser-default">
														<option value="0">0%</option>
														<option value="5">5%</option>
														<option value="12">12%</option>
														<option value="18">18%</option>
														<option value="28">28%</option>
													</select>
												</div> -->
												
												<div class="input-field col s12">
													<input type="submit" name="submit_button" class="waves-effect waves-light btn-large"
													       value="Add Sub Sub Category">
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
