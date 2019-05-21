<?php $baseurl=base_url(); ?>

<?php if(isset($error)) { ?>
  	<div id="access-container">
  		<h1 id="access-header">Access Denied</h1>
  		<p id="access-content"><?= $error ?></p>
  	</div>
<?php } else { ?>

<div class="row mb-3">
  	<div class="col-md-12 text-center">
		<h1 class="mb-3"><i class="fa fa-cog mr-2"></i>Configuration Module</h1>
		<p class="small text-muted">Total Items:<span id="keepa_tokens"><?php echo number_format($item_count);?></span></p>
  	</div> 
</div>
<div class="row mb-3">
  	<div class="col-md-12">
		<div class="accordion" id="accordionExample">
	  		<div class="card mb-3 border-bottom">
				<div class="card-header">
					<p class="lead mb-0">
						<a href="javascript:;" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							Sales Rank Configuration
						</a>
					</p>
				</div>
				<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
					<div class="card-body">
						<h4>Configurations</h4>
						<ul class="nav nav-tabs border-0" id="pills-tab" role="tablist">
				  			<li class="nav-item">
								<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#sales_rank" role="tab" aria-controls="pills-home" aria-selected="true">New Sales Rank</a>
				  			</li>
				  			<li class="nav-item">
								<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#product_category" role="tab" aria-controls="pills-profile" aria-selected="false">Product Category</a>
				  			</li>
						</ul>
						<div class="tab-content border p-3" id="pills-tabContent">
				  			<div class="tab-pane fade show active" id="sales_rank" role="tabpanel" aria-labelledby="sales_rank-tab">
								<form action="sales_rank_conf/updateSalesRankConf" method="post">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Category:</label>
							  					<select name="category" required class="form-control">
							  						<option value="">Select One</option>
							  						<?php foreach ($product_category as $key => $data){?>
													<option value="<?php echo $data['product_name']?>"><?php echo $data['product_name']?></option>
							  						<?php } ?>
							  					</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Profit Category:</label>
							  					<select name="profit_category" class="form-control" required>
								  					<option value="FBA">FBA</option>
					  								<option value="FBM">FBM</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Minimum:</label>
												<input required type="text" name="floorValue" class="form-control" onkeypress="return isNumberOnly(event)" title="Only Numbers are accepted">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Maximum:</label>
												<input required type="text" name="ceilValue" class="form-control" onkeypress=" return isNumberOnly(event)" title="Only Numbers are accepted">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Profit:</label>
												<input required type="text" name="profit" class="form-control" onkeypress=" return isDecimal(event)" title="Only Numbers are accepted">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Region:</label>
												<select name="region" required class="form-control">
													<option value="">Select One</option>
													<?php foreach ($available_regions as $data) { ?>
													<option value="<?php echo $data['region_code']; ?>"><?php echo $data['region_name']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-md-12">
					  						<input  class="btn btn-success" type="submit" value="Add Configuration" name="submit">
										</div>
									</div>
				  				</form>
				  			</div>
				  			<div class="tab-pane fade" id="product_category" role="tabpanel" aria-labelledby="product_category-tab">
								<form action="sales_rank_conf/saveProductCategory" method="post">
									<div class="row">
										<div class="col-md-6">
											<label for="product_name">Product Name:</label>
											<div class="input-group mb-3">
												<input type="text" name="product_name" id="product_name" class="form-control" required>
												<div class="input-group-append">
													<input type="submit" name="saveProduct" value="Save" class="btn btn-success save__btn">
												</div>
											</div>
										</div>
									</div>
									<div class="table-responsive">
						  				<table class="table table-scroll table-striped">
							  				<thead>
												<tr>
													<th>#</th>
													<th>Product Name</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
													<?php foreach ($product_category as $key => $data) { ?>
													<tr>
														<td>
															<?php echo $key + 1;?>
														</td>
														<td>
															<?php echo $data['product_name'];?>
														</td>
														<td><a href="#" onclick="deleteThisProduct('<?php echo $data['id'];?>');">Delete</a></td>
													</tr>
													<?php  } ?>
											</tbody>
										</table>
									</div>
								</form>
							</div>
						</div>
						<!-- form to delete the product category -->
						<form id="deleteProductForm" action="sales_rank_conf/deleteProductCategory" method="post">
							<input type="hidden" id="deleteProductId" name="deleteProductId" value="">
							<input id="productDeleter" style="display: none;" type="submit" value="Delete" name="submit">
						</form>
					</div>
				</div>
	  		</div>
		  	<div class="card mb-3 border-bottom">
				<div class="card-header">
					<p class="lead mb-0">
						<a href="javascript:;" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
							Pricing Configuration
						</a>
					</p>
				</div>
				<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
					<div class="card-body">
						<form action="<?= $baseurl?>sales_rank_conf/updatePriceConfiguration" method="post">
							<div class="form-group">
								<label class="block-label">Item Purchased Price:</label>
								<input type="text" name="purchasedPrice" id="purchasedPrice" class="form-control" value="<?php echo $available_regions[0]['purchased_price'] ?>" onkeypress="return isDecimal(event)" title="Only Numbers are accepted" required>
							</div>
							<div class="form-group">
								<label class="block-label">FBM Expense:</label>
						  		<input type="text" name="fbmvariantPrice" id="fbmvariantPrice" class="form-control" value="<?php echo $variant_price_threshold[0]['value'] ?>" onkeypress="return isDecimal(event)" title="Only Numbers are accepted" required>
							</div>
							<div class="form-group">
								<label class="block-label">FBM Drop Ship Price:</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<input name="dropShipColor" class="jscolor input-color form-control" value="<?php echo $variant_price_threshold[3]['color']; ?>">
									</div>
									<input type="text" name="fbmDropShipPrice" id="fbmDropShipPrice" class="form-control" value="<?php echo $variant_price_threshold[3]['value'] ?>" onkeypress="return isDecimal(event)" title="Only Numbers are accepted" required>
								</div>
							</div>
							<div class="form-group">
								<label class="block-label">FBA Threshold Price:</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<input name="fbaThresholdColor" class="jscolor input-color form-control" value="<?php echo $variant_price_threshold[1]['color']; ?>">
									</div>
									<input type="text" name="fbaThresholdPrice" id="fbaThresholdPrice" class="form-control" value="<?php echo $variant_price_threshold[1]['value'] ?>" onkeypress="return isNumberKey(event)" title="Only Numbers are accepted" required>
								</div>
							</div>
							<div class="form-group">
								<label class="block-label">FBM Threshold Price:</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<input name="fbmThresholdColor" class="jscolor input-color form-control" value="<?php echo $variant_price_threshold[2]['color']; ?>">
									</div>
									<input type="text" name="fbmThresholdPrice" id="fbmThresholdPrice" class="form-control" value="<?php echo $variant_price_threshold[2]['value'] ?>" onkeypress="return isNumberKey(event)" title="Only Numbers are accepted" required>
								</div>
							</div>
							<div class="form-group">
								<?php foreach ($permissions as $perm) {?>
							  		<label>
							  			<input value="<?php echo $perm['perm_name']; ?>" type="checkbox" <?php if($perm['status'] === '1'){ echo 'checked=""'; }?> name="perms[]" >
						  				<?php echo ucfirst(str_replace("_"," ",$perm['perm_name'])) ?>
						  			</label>
								<?php } ?>
							</div>
					  		<input class="btn btn-success" type="submit" value="Update" name="submit">
					  	</form>
					</div>
				</div>
			</div>
			<div class="card mb-3 border-bottom">
				<div class="card-header">
					<p class="lead mb-0">
						<a href="javascript:;" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
							Markets Configuration
						</a>
					</p>
				</div>
				<div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
					<div class="card-body">
						<form action="sales_rank_conf/updateMarkets" method="post">
							<!-- <div style="text-align: left;width: 170px; padding-top: 20px;">
								<?php foreach ($stores as $market) { ?>
								<input value="<?php echo $market['store_id']; ?>" type="checkbox" <?php if($market['status'] === '1'){ echo 'checked=""'; }?> name="stores[]" >&nbsp&nbsp&nbsp<?php echo $market['name'] ?>
								<?php } ?>
								<input type="text" name="marketAdd" placeholder="Enter New Marketplace">
							</div> -->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group market__place">
										<label for="markets">Market Name:</label>
										<div class="input-group">
											<input type="text" id="marketName" name="marketAdd" placeholder="Enter New Marketplace" class="form-control">
											<input type="hidden" name="marketId" id="marketId">
											<div class="input-group-append">
												<input class="btn btn-success update__btn" type="submit" value="Update/Add" name="submit">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="table-responsive market__place_table">
								<table class="table table-scroll table-striped">
									<thead style="background-color: #ccc">
										<tr>
											<th>#</th>
											<th>Market Name</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $count=1; foreach ($stores as $market ) { ?>
										<tr>
											<td><?php echo $count;?></td>
											<td>
											<input value="<?php echo $market['store_id']; ?>" type="checkbox" <?php if($market['status'] === '1'){ echo 'checked=""'; }?> name="stores[]" >&nbsp&nbsp&nbsp<?php echo $market['name'] ?>
											</td>
											<td>
											<a href="#" onclick="editThisMarket('<?php echo $market['store_id'];?>','<?php echo $market['name'];?>');">Edit</a>|<a href="#" onclick="deleteThisMarket('<?php echo $market['store_id'];?>');">Delete</a>
											</td>
										</tr>
										<?php $count++; } ?>
									</tbody>
								</table>
							</div>
						</form>
						<form action="sales_rank_conf/deleteMarket" method="post">
							<input type="hidden" name="marketid" id="marketid">
							<input id="marketDeleter" style="display: none;" type="submit" value="Delete" name="submit">
						</form>
					</div>
				</div>
			</div>
		  	<div class="card mb-3 border-bottom">
				<div class="card-header">
					<p class="lead mb-0">
						<a href="javascript:;" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
							Region Configuration
						</a>
					</p>
				</div>
				<div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordionExample">
					<div class="card-body">
						<form action="sales_rank_conf/updateRegion" method="post">
							<div style="text-align: left;width: inherit; padding-top: 20px; padding-left: 20px;">
								<div class="row">
									<?php foreach ($available_regions_buybacks as $region) {?>
								  	<div class="col-sm-4">
								  		<div class="form-group">
							  				<label><?php echo $region['region_name']?></label>
								  			<div class="input-group">
									  			<input name="regionColor[<?php echo $region['region_code']; ?>]" value="<?php echo $region['color']; ?>" class="jscolor form-control">
									  			<div class="input-group-append">
									  				<span class="input-group-text" id="basic-addon2">
									  					<input value="<?php echo $region['region_code']; ?>" type="checkbox" <?php if($region['status'] === '1'){ echo 'checked=""'; }?> name="availableRegion[]" >
									  				</span>
									  			</div>
									  		</div>
									  	</div>
								  	</div>
									<?php } ?>
								</div>
							  	<input class="btn btn-success" type="submit" value="Update" name="submit">
							</div>
						</form>
					</div>
				</div>
			</div>
		  	<div class="card mb-3 border-bottom">
				<div class="card-header">
					<p class="lead mb-0">
						<a href="javascript:;" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
							Shipping Free Configuration
						</a>
					</p>
				</div>
				<div id="collapseFive" class="collapse show" aria-labelledby="headingFive" data-parent="#accordionExample">
					<div class="card-body">
		  				<h2>Configurations</h2>
		  				<ul class="nav nav-tabs border-0" id="pills-tab" role="tablist">
				  			<li class="nav-item">
								<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#amazon_shipping" role="tab" aria-controls="pills-home" aria-selected="true">Amazon Shipping Fee</a>
				  			</li>
				  			<li class="nav-item">
								<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#usps_fee" role="tab" aria-controls="pills-profile" aria-selected="false">USPS Shipping Fee</a>
				  			</li>
						</ul>
						<div class="tab-content border p-3" id="pills-tabContent">
				  			<div class="tab-pane fade show active" id="amazon_shipping" role="tabpanel">
			 					<form action="sales_rank_conf/updateAmazonShippingFee" method="post" style="padding-top: 20px;">
			  						<div class="row">
			  							<?php foreach ($available_regions as $data) { ?>
										<div class="col-sm-4" style="margin-bottom: 5px;">
											<div class="form-group">
												<label><?php echo $data['region_code']; ?>:</label>
												<input type="text" value="<?php echo $data['amazon_shipping_cost']; ?>" name="amazonShippings[<?php echo $data['region_code']; ?>]" onkeypress="return isDecimal(event)" title="Only Numbers are accepted" class="form-control">
											</div>
										</div>
			  							<?php } ?>
			  						</div>
									<input class="btn btn-success" type="submit" value="Update" name="submit">
								</form>
		  					</div>
		  					<div class="tab-pane fade" id="usps_fee" role="tabpanel">
		  						<ul class="nav nav-tabs border-0" id="pills-tab" role="tablist">
									<li class="nav-item active"><a class="nav-link active" href="#us_usps_config" data-toggle="pill" role="tab" aria-controls="pills-home" aria-selected="true" >USA</a></li>
									<li class="nav-item"><a class="nav-link" href="#ca_usps_config" data-toggle="pill" role="tab" aria-controls="pills-home" aria-selected="true">Canada</a></li>
									<li class="nav-item"><a class="nav-link" href="#uk_usps_config" data-toggle="pill" role="tab" aria-controls="pills-home" aria-selected="true">UK</a></li>
									<li class="nav-item"><a class="nav-link" href="#mx_usps_config" data-toggle="pill" role="tab" aria-controls="pills-home" aria-selected="true">Mexico</a></li>
									<li class="nav-item"><a class="nav-link" href="#in_usps_config" data-toggle="pill" role="tab" aria-controls="pills-home" aria-selected="true">India</a></li>
									<li class="nav-item"><a class="nav-link" href="#jp_usps_config" data-toggle="pill" role="tab" aria-controls="pills-home" aria-selected="true">Japan</a></li>
									<li class="nav-item"><a class="nav-link" href="#de_usps_config" data-toggle="pill" role="tab" aria-controls="pills-home" aria-selected="true">Denmark</a></li>
									<li class="nav-item"><a class="nav-link" href="#fr_usps_config" data-toggle="pill" role="tab" aria-controls="pills-home" aria-selected="true">France</a></li>
									<li class="nav-item"><a class="nav-link" href="#it_usps_config" data-toggle="pill" role="tab" aria-controls="pills-home" aria-selected="true">Italy</a></li>
									<li class="nav-item"><a class="nav-link" href="#es_usps_config" data-toggle="pill" role="tab" aria-controls="pills-home" aria-selected="true">Spain</a></li>
			  					</ul>
		  						<div class="tab-content border p-3" id="pills-tabContent">
									<?php foreach ($available_regions as $key => $value) {?>
									<?php if($value['region_code'] == 'US'){?>
				  					<div id="<?php echo strtolower($value['region_code'])?>_usps_config" class="tab-pane fade show active">
					  					<form action="sales_rank_conf/updateUspsShippingFee" method="post">
					  						<div class="form-group">
												<label for="merchant_shipping_cost">Merchant Shipping Cost:</label>
												<input type="text" name="merchant_shipping_cost" placeholder="Enter Merchant Shipping Cost" value="<?php echo $value['merchant_shipping_cost']?>" onkeypress="return isDecimal(event)" title="Only Numbers are accepted" >
				  							</div>
				  							<div class="form-group">
												<label for="merchant_price_per_pound">Merchant Price Per Pound:</label>
												<input type="text" name="merchant_price_per_pound" placeholder="Enter Merchant Price Per Pound" value="<?php echo $value['merchant_price_per_pound']?>" onkeypress="return isDecimal(event)" title="Only Numbers are accepted" >
										  	</div>
										  	<input type="hidden" name="region_code" value="<?php echo $value['domain_id']?>">
										  	<input type="submit" name="usps_shipping_config" class="btn btn-success" value="Update">
					  					</form>
									</div>
									<?php } else { ?>
						 			<!--  <h2>in else <?php strtolower($value['region_code'])?> </h2> -->
						  			<div id="<?php echo strtolower($value['region_code'])?>_usps_config" class="tab-pane fade">
										<form action="sales_rank_conf/updateUspsShippingFee" method="post">
							  				<div class="form-group">
							  					<label for="merchant_shipping_cost">Merchant Shipping Cost:</label>
							  					<input type="text" name="merchant_shipping_cost" placeholder="Enter Merchant Shipping Cost" value="<?php echo $value['merchant_shipping_cost']?>" onkeypress="return isDecimal(event)" title="Only Numbers are accepted">
							  				</div>
							  				<div class="form-group">
							  					<label for="merchant_price_per_pound">Merchant Price Per Pound:</label>
						  						<input type="text" name="merchant_price_per_pound" placeholder="Enter Merchant Price Per Pound" value="<?php echo $value['merchant_price_per_pound']?>" onkeypress="return isDecimal(event)" title="Only Numbers are accepted" >
							  				</div>
							  				<input type="hidden" name="region_code" value="<?php echo $value['domain_id']?>">
							  				<input type="submit" name="usps_shipping_config" class="btn btn-success" value="Update">
										</form>
									</div>
									<?php }?>
					  				<?php } ?>
			  					</div>
							</div>
						</div>
						<!-- form to delete the product category -->
						<form id="deleteProductForm" action="sales_rank_conf/deleteProductCategory" method="post">
							<input type="hidden" id="deleteProductId" name="deleteProductId" value="">
							<input id="productDeleter" style="display: none;" type="submit" value="Delete" name="submit">
						</form>
		  			</div>
				</div> 
			</div>
		  	<div class="card mb-3 border-bottom">
				<div class="card-header">
					<p class="lead mb-0">
						<a href="javascript:;" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
							Special ISBN Configuration
						</a>
					</p>
				</div>
				<div id="collapseSix" class="collapse show" aria-labelledby="headingSix" data-parent="#accordionExample">
					<div class="card-body">
						<form action="sales_rank_conf/updateSpecialList" method="post">
							<div class="form-group">
						  		<textarea name="list" class="form-control"><?php print_r($special_list[0]['isbn_list']); ?></textarea>
						  	</div>
						  	<div class="form-group">
						  		<input  class="btn btn-success" type="submit" value="Update" name="submit" class="form-control">
						  	</div>
						</form>
					</div>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-body">
					<h2>Configurations</h2>
					<div class="tab-pane">
						<ul class="nav nav-tabs border-0" id="pills-tab" role="tablist">
							<li class="nav-item active"><a class="nav-link active" href="#us_config" data-toggle="pill" role="tab"  >USA</a></li>
							<li class="nav-item"><a class="nav-link" href="#ca_config" data-toggle="pill" role="tab" >Canada</a></li>
							<li class="nav-item"><a class="nav-link" href="#uk_config" data-toggle="pill" role="tab" >UK</a></li>
							<li class="nav-item"><a class="nav-link" href="#mx_config" data-toggle="pill" role="tab" >Mexico</a></li>
							<li class="nav-item"><a class="nav-link" href="#in_config" data-toggle="pill" role="tab" >India</a></li>
							<li class="nav-item"><a class="nav-link" href="#jp_config" data-toggle="pill" role="tab" >Japan</a></li>
							<li class="nav-item"><a class="nav-link" href="#de_config" data-toggle="pill" role="tab" >Denmark</a></li>
							<li class="nav-item"><a class="nav-link" href="#fr_config" data-toggle="pill" role="tab" >France</a></li>
							<li class="nav-item"><a class="nav-link" href="#it_config" data-toggle="pill" role="tab" >Italy</a></li>
							<li class="nav-item"><a class="nav-link" href="#es_config" data-toggle="pill" role="tab" >Spain</a></li>
						</ul>
						<div class="tab-content border p-3">
  							<div id="us_config" class="tab-pane fade show active">
	  							<div class="table-responsive">
	  								<table class="table table-scroll table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>Minimum</th>
												<th>Maximum</th>
												<th>Profit</th>
												<th>Region</th>
												<th>Category</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; foreach ($configuration['US'] as $key => $data) { ?>
	  										<tr>
												<td><?php echo $i;?></td>
												<td><?php echo number_format($data['min_sales_rank']);?></td>
												<td><?php echo number_format($data['max_sales_rank']);?></td>
												<td><?php echo $data['profit'];?></td>
												<td><?php echo $data['region'];?></td>
												<td><?php echo $data['category']?$data['category'] : 'N/A';?> - (<?php echo $data['profit_category']?$data['profit_category'] : 'N/A';?>)</td>
												<td><a href="#" onclick="deleteThis('<?php echo $data['id'];?>');">Delete</a></td>
											</tr>
  											<?php $i++; } ?>
										</tbody>
									</table>
	  							</div>
	  						</div>
		  					<div id="ca_config" class="tab-pane fade">
			  					<div class="table-responsive">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>Minimum</th>
												<th>Maximum</th>
												<th>Profit</th>
												<th>Region</th>
												<th>Category</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
				  							<?php $i=1; foreach ($configuration['CA'] as $key => $data) { ?>
										  	<tr>
												<td><?php echo $i;?></td>
												<td><?php echo number_format($data['min_sales_rank']);?></td>
												<td><?php echo number_format($data['max_sales_rank']);?></td>
												<td><?php echo $data['profit'];?></td>
												<td><?php echo $data['region'];?></td>
												<td><?php echo $data['category']?$data['category'] : 'N/A';?> - (<?php echo $data['profit_category']?$data['profit_category'] : 'N/A';?>)</td>
												<td><a href="#" onclick="deleteThis('<?php echo $data['id'];?>');" onclick="deleteThis('<?php echo $data['id'];?>');">Delete</a></td>
										  	</tr>
				  							<?php $i++; } ?>
				  						</tbody>
									</table>
								</div>
			  				</div>
							<div id="uk_config" class="tab-pane fade">
								<div class="table-responsive">
									<table class="table table-striped">
			  							<thead>
										  	<tr>
												<th>#</th>
												<th>Minimum</th>
												<th>Maximum</th>
												<th>Profit</th>
												<th>Region</th>
												<th>Category</th>
												<th>Action</th>
										  	</tr>
			  							</thead>
			  							<tbody>
			  								<?php $i=1; foreach ($configuration['UK'] as $key => $data) { ?>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo number_format($data['min_sales_rank']);?></td>
												<td><?php echo number_format($data['max_sales_rank']);?></td>
												<td><?php echo $data['profit'];?></td>
												<td><?php echo $data['region'];?></td>
												<td><?php echo $data['category']?$data['category'] : 'N/A';?> - (<?php echo $data['profit_category']?$data['profit_category'] : 'N/A';?>)</td>
												<td><a href="#" onclick="deleteThis('<?php echo $data['id'];?>');" onclick="deleteThis('<?php echo $data['id'];?>');">Delete</a></td>
											</tr>
											<?php $i++; } ?>
			  							</tbody>
			  						</table>
								</div>
							</div>
							<div id="mx_config" class="tab-pane fade">
								<div class="table-responsive" style="overflow-y: auto;">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>Minimum</th>
												<th>Maximum</th>
												<th>Profit</th>
												<th>Region</th>
												<th>Category</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; foreach ($configuration['MX'] as $key => $data) { ?>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo number_format($data['min_sales_rank']);?></td>
												<td><?php echo number_format($data['max_sales_rank']);?></td>
												<td><?php echo $data['profit'];?></td>
												<td><?php echo $data['region'];?></td>
												<td><?php echo $data['category']?$data['category'] : 'N/A';?> - (<?php echo $data['profit_category']?$data['profit_category'] : 'N/A';?>)</td>
												<td><a href="#" onclick="deleteThis('<?php echo $data['id'];?>');" onclick="deleteThis('<?php echo $data['id'];?>');">Delete</a></td>
											</tr>
											<?php $i++; } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div id="in_config" class="tab-pane fade">
								<div class="table-responsive" style="overflow-y: auto;">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>Minimum</th>
												<th>Maximum</th>
												<th>Profit</th>
												<th>Region</th>
												<th>Category</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; foreach ($configuration['IN'] as $key => $data) { ?>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo number_format($data['min_sales_rank']);?></td>
												<td><?php echo number_format($data['max_sales_rank']);?></td>
												<td><?php echo $data['profit'];?></td>
												<td><?php echo $data['region'];?></td>
												<td><?php echo $data['category']?$data['category'] : 'N/A';?> - (<?php echo $data['profit_category']?$data['profit_category'] : 'N/A';?>)</td>
												<td><a href="#" onclick="deleteThis('<?php echo $data['id'];?>');" onclick="deleteThis('<?php echo $data['id'];?>');">Delete</a></td>
											</tr>
											<?php $i++; } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div id="jp_config" class="tab-pane fade">
								<div class="table-responsive" style="overflow-y: auto;">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>Minimum</th>
												<th>Maximum</th>
												<th>Profit</th>
												<th>Region</th>
												<th>Category</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php $i=1; foreach ($configuration['JP'] as $key => $data) { ?>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo number_format($data['min_sales_rank']);?></td>
												<td><?php echo number_format($data['max_sales_rank']);?></td>
												<td><?php echo $data['profit'];?></td>
												<td><?php echo $data['region'];?></td>
												<td><?php echo $data['category']?$data['category'] : 'N/A';?> - (<?php echo $data['profit_category']?$data['profit_category'] : 'N/A';?>)</td>
												<td><a href="#" onclick="deleteThis('<?php echo $data['id'];?>');" onclick="deleteThis('<?php echo $data['id'];?>');">Delete</a></td>
											</tr>
										<?php $i++; } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div id="de_config" class="tab-pane fade">
								<div class="table-responsive" style="overflow-y: auto;">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>Minimum</th>
												<th>Maximum</th>
												<th>Profit</th>
												<th>Region</th>
												<th>Category</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php $i=1; foreach ($configuration['DE'] as $key => $data) { ?>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo number_format($data['min_sales_rank']);?></td>
												<td><?php echo number_format($data['max_sales_rank']);?></td>
												<td><?php echo $data['profit'];?></td>
												<td><?php echo $data['region'];?></td>
												<td><?php echo $data['category']?$data['category'] : 'N/A';?> - (<?php echo $data['profit_category']?$data['profit_category'] : 'N/A';?>)</td>
												<td><a href="#" onclick="deleteThis('<?php echo $data['id'];?>');" onclick="deleteThis('<?php echo $data['id'];?>');">Delete</a></td>
											</tr>
										<?php $i++; } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div id="fr_config" class="tab-pane fade">
								<div class="table-responsive" style="overflow-y: auto;">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>Minimum</th>
												<th>Maximum</th>
												<th>Profit</th>
												<th>Region</th>
												<th>Category</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; foreach ($configuration['FR'] as $key => $data) { ?>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo number_format($data['min_sales_rank']);?></td>
												<td><?php echo number_format($data['max_sales_rank']);?></td>
												<td><?php echo $data['profit'];?></td>
												<td><?php echo $data['region'];?></td>
												<td><?php echo $data['category']?$data['category'] : 'N/A';?> - (<?php echo $data['profit_category']?$data['profit_category'] : 'N/A';?>)</td>
												<td><a href="#" onclick="deleteThis('<?php echo $data['id'];?>');" onclick="deleteThis('<?php echo $data['id'];?>');">Delete</a></td>
											</tr>
										<?php $i++; } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div id="it_config" class="tab-pane fade">
								<div class="table-responsive" style="overflow-y: auto;">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>Minimum</th>
												<th>Maximum</th>
												<th>Profit</th>
												<th>Region</th>
												<th>Category</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php $i=1; foreach ($configuration['IT'] as $key => $data) { ?>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo number_format($data['min_sales_rank']);?></td>
												<td><?php echo number_format($data['max_sales_rank']);?></td>
												<td><?php echo $data['profit'];?></td>
												<td><?php echo $data['region'];?></td>
												<td><?php echo $data['category']?$data['category'] : 'N/A';?> - (<?php echo $data['profit_category']?$data['profit_category'] : 'N/A';?>)</td>
												<td><a href="#" onclick="deleteThis('<?php echo $data['id'];?>');" onclick="deleteThis('<?php echo $data['id'];?>');">Delete</a></td>
											</tr>
										<?php $i++; } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div id="es_config" class="tab-pane fade">
								<div class="table-responsive" style="overflow-y: auto;">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>Minimum</th>
												<th>Maximum</th>
												<th>Profit</th>
												<th>Region</th>
												<th>Category</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php $i=1; foreach ($configuration['ES'] as $key => $data) { ?>

											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo number_format($data['min_sales_rank']);?></td>
												<td><?php echo number_format($data['max_sales_rank']);?></td>
												<td><?php echo $data['profit'];?></td>
												<td><?php echo $data['region'];?></td>
												<td><?php echo $data['category']?$data['category'] : 'N/A';?> - (<?php echo $data['profit_category']?$data['profit_category'] : 'N/A';?>)</td>
												<td><a href="#" onclick="deleteThis('<?php echo $data['id'];?>');" onclick="deleteThis('<?php echo $data['id'];?>');">Delete</a></td>
												</tr>
										<?php $i++; } ?>
										</tbody>
									</table>
								</div>
							</div>

							<!-- form to delete the configuration -->
							<form id="deleteForm" action="sales_rank_conf/deleteConfiguration" method="post">
								<input type="hidden" id="deleteId" name="deleteId" value="">
								<input id="deleter" style="display: none;" type="submit" value="Delete" name="submit">
							</form>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	

		  <script type="text/javascript">
		  $('.numberFormat').keyup(function(event) {

  // skip for arrow keys
  if(event.which >= 37 && event.which <= 40) return;

  // format number
  $(this).val(function(index, value) {
  return value
  .replace(/\D/g, "")
  .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
  ;
  });
});
		  function deleteThis(id){
			if (confirm("Would you like to delete this configuration?")) {
			$("#deleteId").val(id);
			$("#deleter").click();
			}
		  }
		  function deleteThisProduct(id){
			if (confirm("Would you like to delete this product?")) {
			$("#deleteProductId").val(id);
			$("#productDeleter").click();
			}
			
			
		  /*  if(window.location.hash != "") {
			$('a[href="' + window.location.hash + '"]').click()
			}*/
			var hash = document.location.hash;
			var prefix = "tab_";
			console.log(hash+'');
			/*if (hash) {
			$('.nav-tabs a[href='+hash.replace(prefix,"")+']').tab('show');
			} */
		  }
		  function deleteThisMarket(id){
		   if (confirm("Would you like to delete this Market?")) {
			$("#marketid").val(id);
			$("#marketDeleter").click();
		  }
		  }
		  function editThisMarket(id,name){
		  $("#marketName").val(name);
		  $("#marketId").val(id);
		  }

// Change hash for page-reload
$('.nav-tabs a').on('shown.bs.tab', function (e) {
  window.location.hash = e.target.hash.replace("#", "#" + prefix);
});
</script>
<script type="text/javascript" >
  var acc = document.getElementsByClassName("accordion");
  var i;
  for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
	this.classList.toggle("active");
	var panel = this.nextElementSibling;
	if (panel.style.maxHeight){
	panel.style.maxHeight = null;
	} else {
	panel.style.maxHeight = panel.scrollHeight + "px";
	panel.style.visibility = "visible";
	} 
  });
  }
</script>
<script type="text/javascript">
  $(document).ready(function(){
  $(".nav-tabs a").click(function(){
	$(this).tab('show');
  });
  });

  function validateForm(element){
  if (element.value < 0) {
	swal("Error", "Value must be greater then zero", "error");
	$("#"+element.id).val('');
  }
  }
  function isNumberOnly(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	return false;
  }
  return true;
  }

  function isNumberKey(evt){
  var charCode = (evt.which) ? evt.which : event.keyCode
  if ((charCode > 31 && charCode < 45) || (charCode >45  && charCode > 57 ) || (charCode < 110 && charCode > 110) ){
	console.log(charCode);
	return false;
  }
  return true;
  }

  function isDecimal(evt){
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 46 || charCode > 57)) {
	return false;
  }
  return true;
  }  

</script>
