<?php
$baseurl=base_url();
//print_r($this->session);exit;
?>


<div class="card mb-3 border-bottom">
				<div class="card-header">
					<p class="lead mb-0">
						<a href="javascript:;" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							Add New User
						</a>
					</p>
				</div>
				<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
					<div class="card-body">
						<h4>Fill User Details and Rigths </h4>
						<ul class="nav nav-tabs border-0" id="pills-tab" role="tablist">
				  			<li class="nav-item">
								<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#sales_rank" role="tab" aria-controls="pills-home" aria-selected="true">User Details</a>
				  			</li>
				  			<li class="nav-item">
								<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#product_category" role="tab" aria-controls="pills-profile" aria-selected="false">User Rigths</a>
				  			</li>
						</ul>
						<div class="tab-content border p-3" id="pills-tabContent">
				  			<div class="tab-pane fade show active" id="sales_rank" role="tabpanel" aria-labelledby="sales_rank-tab">
								<form  ng-submit="update_amazon_api()" name='amzForm' novalidate>
									<div class="form-group mb-1">
								  		<label class="mb-0">Name</label>
									  	<div ng-class="{ 'has-error' : amzForm.seller_id.$invalid && amz_submitted  }" >
									  		<input type='text' class='form-control' name='seller_id' placeholder='Name' ng-model='amz_api.seller_id' required>
									  	</div>
								  	</div>
								  	<div class="form-group mb-1">
									  	<label class="mb-0">Email</label>
									  	<div class="pad" ng-class="{ 'has-error' : amzForm.access_key.$invalid && amz_submitted  }" >
										  	<input type='text' class='form-control' name='access_key' placeholder='User name' ng-model='amz_api.access_key' required>
									  	</div>
									</div>
									<div class="form-group mb-2">
									  	<label class="mb-0">Password</label>
									  	<div class="pad" ng-class="{ 'has-error' : amzForm.secret_key.$invalid && amz_submitted  }" >
										  	<input type='text' class='form-control' name='secret_key' placeholder='password' ng-model='amz_api.secret_key' required>
									  	</div>
								  	</div>
								  	<div class="form-group">
									  	<input  type='reset' name='reset'  value='Reset' ng-click="add_new()" class='btn btn-danger'>
									  	<input type='submit' name='submit'  value='Update' ng-click="amz_submitted=true" class='btn btn-info'>
								  	</div>
							  	</form>
				  			</div>
				  			<div class="tab-pane fade" id="product_category" role="tabpanel" aria-labelledby="product_category-tab">
								<form action="sales_rank_conf/saveProductCategory" method="post">
									<div class="row">
										<div class="col-md-3">
											<ul>
												<li>Amazon Tool</li>
												<li>Flie uploader</li>
												<li>Product Catalouge</li>
												<li>Configration Module</li>
												<li>Product Updation</li>
											</ul>
										</div>
										<div class="col-md-6">
											<ul>
												<input type="checkbox" name=""><br/>
												<input type="checkbox" name=""><br/>
												<input type="checkbox" name=""><br/>
												<input type="checkbox" name=""><br/>
												<input type="checkbox" name=""><br/>
												
											</ul>
										</div>
									</div>
									<div class="table-responsive">
						  				
									</div>
								</form>
							</div>
						</div>
						<!-- form to delete the product category -->
						<!-- <form id="deleteProductForm" action="sales_rank_conf/deleteProductCategory" method="post">
							<input type="hidden" id="deleteProductId" name="deleteProductId" value="">
							<input id="productDeleter" style="display: none;" type="submit" value="Delete" name="submit">
						</form> -->
					</div>
				</div>
	  		</div>