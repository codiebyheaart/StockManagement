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
							<li class="active-bre"><a href="#">All Categories</a>
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
									$sql = "SELECT * FROM categories WHERE parent_category_code = 0 AND category_level = '1' and vendor_email = '' order by order_id desc";
									$result = $connection->query($sql);
									if ($result->num_rows > 0) {
										?>
										<div class="inn-title">
											<h4 class="txt-center">All Categories</h4>
										</div>
										<div class="tab-inn">
											<div class="table-responsive table-desi">
												<table class="table table-hover">
													<thead>
													<tr>
													<!-- <th colspan="2">Set Order</th> -->
														<th>Category Name</th>
														<th>Image</th>
														<th>Replace Image</th>
														<th>Delete</th>
														<th>Save</th>
													</tr>
													</thead>
													<tbody>
													<?php while ($row = $result->fetch_array()) { ?>
														<tr id="myDIV">
															<!-- <th><i class="fa fa-sort-up sort_table" data-id="<?php echo $row['order_id'];?>" data-first="<?php echo $row['id'];?>" data-name="up"></i></th>
														<th><i class="fa fa-sort-down sort_table" data-id="<?php echo $row['order_id'];?>" data-first="<?php echo $row['id'];?>" data-name="down"></i></th> -->
														
															<form action="include/update_category.php" method="post" enctype="multipart/form-data">
																<td>
																	<input type="hidden" value="<?php echo $row['id']; ?>"
																	       name="category_id">
																	<input type="text" value="<?php echo $row['name']; ?>"
																	       size="3" name="category_name">
																</td>
																<td>
																	<img class="img-preview" src="../img/<?php echo $row['photo_link']; ?>">
																</td>
																<td>
																	<input type="file" name="newcatImage">
																</td>
																
																<td>
																	<a href="include/delete_category.php?id=<?php echo $row['id']; ?>">
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
		<script type="text/javascript">
		    $(document).ready(function(){
		    	//	alert();
		    	$('.sort_table').on('click',function(){
	//alert();
		        var sort_type = $(this).attr('data-name');
		        var sort_id = $(this).attr('data-id');		
		        var first_id = $(this).attr('data-first');		
                var type = 'cat';
                var level = 1;
                //console.log('click');
                	//console.log($(this).parent().parent().next()[0].cells[0].children[0].attributes[2].nodeValue);

                	if(sort_type=="up"){
                		var val =$(this).parent().parent().prev()[0].cells[0].children[0].attributes[1].nodeValue;
                		var second_id =$(this).parent().parent().prev()[0].cells[0].children[0].attributes[2].nodeValue;
                		
                	}else{
				var val = $(this).parent().parent().next()[0].cells[0].children[0].attributes[1].nodeValue; 
				var second_id = $(this).parent().parent().next()[0].cells[0].children[0].attributes[2].nodeValue; 
                	}

                var url = "http://dtuat.com/apps/hub_roti/admin/set_cat_item.php";
                var sort_detail = {
                	sort_type: sort_type,
                    sort_id: sort_id,
                    type: type,
                    level:level,
                    val:val,
                    first_id:first_id,
                    second_id:second_id
                     }
                  // console.log(sort_detail);  
                   $.ajax({
                     url: url,
                     type: 'post',
                     data: sort_detail,
                     dataType: 'json',
                     success: function(response) {
                     	console.log(response);
                     	if(response=='success'){

                     	window.location.reload();
                        }
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
