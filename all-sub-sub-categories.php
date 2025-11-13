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
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->        <!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>        <![endif]-->
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
							<li class="active-bre"><a href="#">All Sub Sub Categories</a>
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
								} ?>
								<div class="box-inn-sp">
									<?php
									$sql = "SELECT * FROM categories WHERE parent_category_code != '0' AND category_level = '3'";
									$result = $connection->query($sql);
									if ($result->num_rows > 0) { ?>
										<div class="inn-title">
											<h4 class="txt-center">All Sub Sub Categories</h4>
										</div>
										<div class="tab-inn">
											<div class="table-responsive table-desi">
												<table class="table table-hover">
													<thead>
													<tr>
														<th>Category Name</th>
														<th>Sub Category Name</th>
														<th>Sub Sub Category Name</th>
														<th>Image</th>
														<th>Replace Image</th>
														<th>Homepage</th>
														<!-- <th>GST</th> -->
														<th>Delete</th>
														<th>Save</th>
													</tr>
													</thead>
													<tbody>
													<?php while ($row = $result->fetch_array()) { ?>
														<?php
														$parentCategory = $connection->query("SELECT * FROM categories WHERE
																category_code = '$row[parent_category_code]'")->fetch_assoc();
														
														$parentParentCategory = $connection->query("SELECT * FROM categories WHERE
																category_code = '$parentCategory[parent_category_code]'")->fetch_assoc();
														?>
														<tr id="myDIV">
															<form action="include/update_sub_sub_category.php" method="post" enctype="multipart/form-data">
																<td>
																	<?php echo $parentParentCategory['name']; ?>
																</td>
																<td>
																	<?php echo $parentCategory['name']; ?>
																</td>
																<td>
																	<input type="hidden" value="<?php echo $row['id']; ?>"
																	       name="sub_sub_category_id">
																	<input type="text" value="<?php echo $row['name']; ?>"
																	       size="3" name="sub_sub_category_name">
																</td>
																<td>
																	<?php if ($row['photo_link']) { ?>
																		<img class="img-preview" src="../img/<?php echo $row['photo_link']; ?>">
																	<?php } else { ?>
																		NO Image Set
																	<?php } ?>
																</td>
																<td>
																	<input type="file" name="newcatImage">
																</td>
																<td>
																	<select name="homepage" id="homepage" class="browser-default">
																		<option value="Y" <?php echo $row['show_on_home'] == "Y" ? "Selected" : ""; ?>>
																			Yes
																		</option>
																		<option value="N" <?php echo $row['show_on_home'] == "N" ? "Selected" : ""; ?>>
																			No
																		</option>
																	</select>
																</td>
															<!-- 	<td>
																	<select name="gst" id="gst" class="browser-default">
																		<option value="0" <?php echo $row['gst'] == "0" ? "selected" : "selected"; ?>>
																			0%
																		</option>
																		<option value="5" <?php echo $row['gst'] == "5" ? "selected" : ""; ?>>
																			5%
																		</option>
																		<option value="12" <?php echo $row['gst'] == "12" ? "selected" : ""; ?>>
																			12%
																		</option>
																		<option value="18" <?php echo $row['gst'] == "18" ? "selected" : ""; ?>>
																			18%
																		</option>
																		<option value="28" <?php echo $row['gst'] == "28" ? "selected" : ""; ?>>
																			28%
																		</option>
																	</select>
																	<?php ?>
																</td> -->
																<td>
																	<a href="include/delete_sub_sub_category.php?id=<?php echo $row['id']; ?>">
																		<i class="fa fa-trash-o" aria-hidden="true"></i>
																	</a>
																</td>
																<td>
																	<input type="submit" name="submit_button" value="Save"
																	       class="btn waves-button-input">
																</td>
															</form>
														</tr>
													<?php } ?>
													</tbody>
												</table>
											</div>
										</div>
									<?php } else { ?>
										<h3 class="text-center">Sorry, there are no categories to display to create one
											<a href="add-category.php">click here</a>.
										</h3>
									<?php } ?>
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
