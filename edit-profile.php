<?php
ob_flush();
require_once "include/config.php";
session_start();
if ($_SESSION['user_type'] == "A" && $_SESSION['user_status'] == "A") {
	$current_email = $_SESSION['email'];
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
							<li class="active-bre"><a href="#"> Edit Profile</a>
							</li>
						</ul>
					</div>
					<div class="sb2-2-add-blog sb2-2-1">
						<?php
						if (isset($_SESSION['error_msg'])) {
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
										<h4 class="txt-center">Edit Profile</h4>
									</div>
									<div class="bor">
										<form action="include/update_profile.php" method="post">
											<div class="row">
												<?php $result = $connection->query("SELECT * FROM admin_panel
													WHERE E_Mail = '$current_email'")->fetch_assoc(); ?>
												<div class="input-field col s12">
													<input id="username" type="text" class="validate" name="username"
														value="<?php echo $result['username']; ?>">
													<label for="username">New Username</label>
												</div>
												<div class="input-field col s12">
													<input id="email" type="email" class="validate" name="email"
														value="<?php echo $result['E_Mail']; ?>" readonly>
													<label for="email">New Email</label>
												</div>
												<div class="input-field col s12">
													<input id="password" type="password" class="validate" name="password" value="<?php echo $result['Password'];?>" required>
													<label for="password">New Password</label>
												</div>

												<div class="input-field col s12">
													<input type="text" name="phone" id="phone" class="validate" value="<?php echo $result['phone'];?>" required>
													<label for="phone">Phone No.</label>
												</div>
											</div>
											<div class="row">
												<div class="input-field col s12">
													<input type="submit" name="submit_button" value="Update Profile"
													       class="waves-effect waves-light btn-large">
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
	$_SESSION['error_msg'] .= "<a href='#' class='close' data-dismiss='close'>&times;</a>";
	$_SESSION['error_msg'] .= "Sorry, you needed to be logged in for accessing this page</div>";
	header("Location: index.php");
}