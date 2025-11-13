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
							<li class="active-bre"><a href="#"> Add Product</a>
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
										<h4 class="txt-center">Add Product</h4>
									</div>
									<div class="bor">
										<form action="include/add_product.php" method="post" enctype="multipart/form-data">
											<div class="row">
												<div class="input-field col s12">
													<input id="product_name" name="product_name" type="text" class="validate"
													       required>
													<label for="product_name">Product Name</label>
												</div>
												
												<!-- <div class="input-field col s12">
													<input id="product_code" name="product_code" type="text" class="validate"
													       required>
													<label for="product_code">Product Code</label>
												</div> -->
												
												<div class="input-field col s12">
													<input id="product_price" name="product_price" type="number" class="validate"
													       required>
													<label for="product_price">Price</label>
												</div>

												<div class="input-field col s12">
													<input id="stock" name="stock" type="text" class="validate"
													       required>
													<label for="stock">Stock</label>
												</div>

												

												
												<div class="input-field col s12">
													<label for="product_gst">GST</label>
													<br><br>
													<select name="product_gst" class="browser-default" id="product_gst">
														<option value="0">0%</option>
														<option value="5">5%</option>
														<option value="12">12%</option>
														<option value="18">18%</option>
														<option value="28">28%</option>
													</select>
												</div>

												
												
											
												
												<div class="input-field col s12">
													<input id="short_details" name="short_details" type="text" class="validate"
													       required>
													<label for="short_details">Short Details</label>
												</div>
												
												<div class="input-field col s12 main_category">
													<p>Select Main Category<span class="alert_astric">*</span></p>
													<select name="first_category" id="first_category" class="browser-default">
														<option value="">Choose Category</option>
														<?php $category = $connection->query("SELECT * FROM categories WHERE category_level = '1' AND parent_category_code = '0'");
														   while ($categoryRow = $category->fetch_array()) { ?>
                                                           <option value="<?php echo $categoryRow['category_code']; ?>"><?php echo stripslashes(stripslashes(stripslashes($categoryRow['name'])));?></option>
														<?php } ?>
													</select>
												</div>
												
													                                               
												<div class="input-field col s12 sub_category" style="display: none">
													<p>Select Sub Category<span class="alert_astric">*</span></p>
													<select name="secound_category" id="secound_category" class="browser-default">
														<option value="">Choose Category</option>
													</select>
												</div>

												<div class="input-field col s12 sub_sub_category" style="display: none">
													<p>Select Sub Sub Category<span class="alert_astric">*</span></p>
													<select name="product_category" id="product_category" class="browser-default">
														<option value="">Choose Category</option>
														
													</select>
												</div>

												<div class="input-field col s12">
													<p>Main Photo of Product</p>
													<input id="product_image" name="product_image" type="file" class="validate" required>
												</div>

												<div class="row">
												<div class="input-field col s12">
													<input type="submit" name="submit_button" class="waves-effect waves-light btn-large" value="Add Product">
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
		<script type="text/javascript">
			$(document).ready(function(){
				$('#first_category').on('change',function(){
					
					var top_category_code = $(this).val();
                    var cat = '';
                    cat += '<option value="">--Choose Sub Category--</option>';
                    console.log(top_category_code);
				    $.ajax({
                          
                         // url: 'http://localhost/kroyon/kroyon_new/appcode/admin/select_category_for_add_product.php',
                         url: 'http://localhost/phobos_demo_backend/stockManagement/select_category_for_add_product.php',
                          type: 'post',
                          data : {top_category_code: top_category_code},
                          dataType: 'json',

                          success: function(response){
                          	console.log(response);
                          	if(response.length == 0){
                          		$('.sub_category').hide();
                          		$('.sub_sub_category').hide();
                          	}else{
                          		$('.sub_category').show();
                              $.each(response,function(item,value){
                                var str = value.name;
                                  str = str.replace(/\\/g,'');
                               cat += "<option value="+value.category_code+">"+str+"</option>"

                            });

                            $('#secound_category').empty().append(cat);	
                          }
                          },
                          error: function(response){
                          	console.log(response);
                          }


				    });

				});

				$('#secound_category').on('change',function(){
					
                    var secound_category_code = $(this).val();
                    var cat1 = '';
                    cat1 += '<option value="">--Choose Sub Sub Category--</option>';
				    $.ajax({
                          
                         // url: 'http://localhost/kroyon/kroyon_new/appcode/admin/select_category_for_add_product.php',
                          url: 'http://localhost/phobos_demo_backend/stockManagement/select_category_for_add_product.php',
                          type: 'post',
                          data : {secound_category_code: secound_category_code},
                          dataType: 'json',

                          success: function(response){
                          	console.log(response);
                          	if(response.length == 0){
                          		//$('.sub_category').hide();
                          		$('.sub_sub_category').hide();
                          	}else{
                          		$('.sub_sub_category').show();
                              $.each(response,function(item,value){
                               var str1 = value.name;
                               str1 = str1.replace(/\\/g,'');
                               cat1 += "<option value="+value.category_code+">"+str1+"</option>"

                          });
                          // $('#product_category').empty().append(cat1);	
                        }
                          },
                          error: function(response){
                          	console.log(response);
                          }


				    });




				});
			});
		</script>
	</body>
	
	</html>
<?php } else {
	$_SESSION['error_msg'] = "<div class='alert alert-danger'>";
	$_SESSION['error_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
	$_SESSION['error_msg'] .= "Sorry, You need to login to view that page.</div>";
	header("Location: index.php");
}
?>
