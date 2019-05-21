<?php
$baseurl=base_url();
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<style type="text/css">
  img.drop {
	vertical-align: middle;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	text-align: center;
  }
</style>


<div class="row mb-3">
	<div class="col-md-12 text-center">
		<h1 class="mb-3"><i class="fa fa-amazon mr-2"></i>Amazon Tool 2.0</h1>
		<div class="row justify-content-center tool-search">
			<div class="input-group col-md-6 mb-2">
				<input type="text" placeholder="Search by Name" class="form-control" name='search' id="name">
				<input type="text" placeholder="Search by ASIN" class="form-control" name='search' id="search">
				<div class="input-group-append">
					<select id="markets">
						<?php foreach ($stores as $store) { ?>
							<option value="<?php echo $store['name']; ?>"><?php echo $store['name']; ?></option>
						<?php } ?> 
					</select>
					<button class="btn" id="findpro"><i class="fa fa-search"></i></button>
				</div>
			</div>
		</div>
		<p class="small text-muted">Remaining Tokens:<span id="keepa_tokens">9999</span></p>
	</div> 
</div>
<div class="row mb-3">
	<div class="col-md-3 text-center" id="loadedImage"></div>
	<div class="col-md-9" id="loadedStats" style="display: none;">
		<div class="table-responsive">
			<table border="0" class="table prod_detail_table box">
				<tbody>
					<tr>
						<th width="55%">Title</th>
						<th width="15%">Amazon Price</th>
						<th width="15%">Count</th>
						<th width="15%">Offers Data</th>
					</tr>
					<tr>
						<td>
							<p id="loadedTitle">The 4-Hour Workweek: Escape 9-5, Live Anywhere, and Join the New Rich</p>
						</td>
						<td>
							<p id="loadedAmazonPrice">$16.32</p>
						</td>
						<td>
							<p id="loadedCount">New: 0<br>Used: 0</p>
						</td>
						<td>
							<p id="loadedOffersData"></p>
						</td>
					</tr>
					<tr>
						<th colspan="2">Author</th>
						<th>New Price</th>
						<th>Weight</th>
					</tr>
					<tr>
						<td colspan="2">
							<p id="loadedAuthor">Timothy Ferriss</p>
						</td>
						<td>
							<p id="loadedNewPrice">$8.08</p>
						</td>
						<td>
							<p id="loadedWeight">0.65 Ounces.</p>
						</td>
					</tr>
					<tr>
						<th colspan="2">Manufacturer</th>
						<th colspan="2">Used Price</th>
					</tr>
					<tr>
						<td colspan="2">
							<p id="loadedManufacturer">Harmony</p>
						</td>
						<td colspan="2">
							
							<p id="loadedUsedPrice">$5.55</p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
		<!-- <table border=0 width="80%">
		  <tr>
			<td><h4>Title</h4>
			  <p id="loadedTitle">Dummmy Title</p>
			</td>
			<?php if ($this->session->amazon_price) { ?>
			  <td>
			  <?php } else  { ?>
				<td style="display: none;">
				<?php } ?>
				<h4>Amazon Price</h4>
				<p id="loadedAmazonPrice">$0.00</p>
			  </td>

			  <td style="padding-top: 20px;"><h4>Count</h4>
				<p id="loadedCount">
				</p>
			  </td>
			  <td style="padding-top: 20px;"><h4>Offers Data</h4>
				<p id="loadedOffersData">
				</p>
			  </td>
			</tr>
			<tr>
			  <td><h4>Author</h4>
				<p id="loadedAuthor">Author</p>
			  </td>
			  <?php if ($this->session->new_price) { ?>
				<td>
				<?php } else  { ?>
				  <td style="display: none;">
				  <?php } ?>
				  <h4>New Price</h4>
				  <p id="loadedNewPrice">$0.00</p>
				</td>
				<td><h4>Weight</h4>
				  <p id="loadedWeight">0 Grams</p>
				</td>
			  </tr>
			  <tr>
				<td><h4>Manufacturer</h4>
				  <p id="loadedManufacturer">Manu</p>
				</td>
				<?php if ($this->session->used_price) { ?>
				  <td>
				  <?php } else  { ?>
					<td style="display: none;">
					<?php } ?>
					<h4>Used Price</h4>
					<p id="loadedUsedPrice">$0.00</p>
				  </td>
				  <td></td>
				</tr>
			  </table>
			</div>
		  </div>
		</div> -->
		  <div id="dbLoader" style="display: none;" align="center" class="col-sm-12 col-md-12">
			<div class="loaderSmall"></div>
			Data Insertion in process. Please Wait !
		  </div>
		  <div id="dbSuccess" style="display: none;" align="center" class="col-sm-12 col-md-12">
			<div id="dbSuccessMsg" ></div>
		  </div>
		  <div id="dbFail" style="display: none;" align="center" class="col-sm-12 col-md-12">
			<div id="dbFailMsg" ></div>
		  </div>

<!-- <div class="row mb-3">
	<div class="col-md-4">
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<th colspan="3">Image</th>
					<td></td>
				</tr>
				<tr>
					<th colspan="3">ISBN</th>
					<td></td>
				</tr>
				<tr>
					<th colspan="3">Title</th>
					<td></td>
				</tr>
				<tr>
					<th colspan="3">Weight</th>
					<td></td>
				</tr>
				<tr>
					<th colspan="3">Buyback</th>
					<td></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="col-md-4">
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<th colspan="4" class="text-center">USA</th>
				</tr>
				<tr>
					<th width="25%" class="text-center" style="background: #74b9ff"><i class="fas fa-line-chart"></i></th>
					<td width="25%"></td>
					<th width="25%" class="text-center" style="background: #74b9ff"><i class="fas fa-usd"></i></th>
					<td width="25%"></td>
				</tr>
				<tr>
					<th colspan="4" class="text-center">Canada</th>
				</tr>
				<tr>
					<th width="25%" class="text-center" style="background: #ff7675"><i class="fas fa-line-chart"></i></th>
					<td width="25%"></td>
					<th width="25%" class="text-center" style="background: #ff7675"><i class="fas fa-usd"></i></th>
					<td width="25%"></td>
				</tr>
				<tr>
					<th colspan="4" class="text-center">UK Markets</th>
				</tr>
				<tr>
					<th width="25%" class="text-center" style="background: #fd79a8"><i class="fas fa-line-chart"></i></th>
					<td width="25%"></td>
					<th width="25%" class="text-center" style="background: #fd79a8"><i class="fas fa-usd"></i></th>
					<td width="25%"></td>
				</tr>
				<tr>
					<th colspan="4" class="text-center">Mexico</th>
				</tr>
				<tr>
					<th width="25%" class="text-center" style="background: #55efc4"><i class="fas fa-line-chart"></i></th>
					<td width="25%"></td>
					<th width="25%" class="text-center" style="background: #55efc4"><i class="fas fa-usd"></i></th>
					<td width="25%"></td>
				</tr>
				<tr>
					<th colspan="4" class="text-center">India</th>
				</tr>
				<tr>
					<th width="25%" class="text-center" style="background: #ffeaa7"><i class="fas fa-line-chart"></i></th>
					<td width="25%"></td>
					<th width="25%" class="text-center" style="background: #ffeaa7"><i class="fas fa-usd"></i></th>
					<td width="25%"></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="col-md-4">
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<th colspan="4" class="text-center">Japan</th>
				</tr>
				<tr>
					<th width="25%" class="text-center" style="background: #e17055"><i class="fas fa-line-chart"></i></th>
					<td width="25%"></td>
					<th width="25%" class="text-center" style="background: #e17055"><i class="fas fa-usd"></i></th>
					<td width="25%"></td>
				</tr>
				<tr>
					<th colspan="4" class="text-center">Brazil</th>
				</tr>
				<tr>
					<th width="25%" class="text-center" style="background: #a29bfe"><i class="fas fa-line-chart"></i></th>
					<td width="25%"></td>
					<th width="25%" class="text-center" style="background: #a29bfe"><i class="fas fa-usd"></i></th>
					<td width="25%"></td>
				</tr>
				<tr>
					<th colspan="4" class="text-center">China</th>
				</tr>
				<tr>
					<th width="25%" class="text-center" style="background: #d63031"><i class="fas fa-line-chart"></i></th>
					<td width="25%"></td>
					<th width="25%" class="text-center" style="background: #d63031"><i class="fas fa-usd"></i></th>
					<td width="25%"></td>
				</tr>
				<tr>
					<th colspan="4" class="text-center">Australia</th>
				</tr>
				<tr>
					<th width="25%" class="text-center" style="background: #81ecec"><i class="fas fa-line-chart"></i></th>
					<td width="25%"></td>
					<th width="25%" class="text-center" style="background: #81ecec"><i class="fas fa-usd"></i></th>
					<td width="25%"></td>
				</tr>
			</table>
		</div>
	</div>
</div> -->

<div class="row mb-3">
	<div class="col-md-12">
		<div class="table-responsive">
			<?php if ($this->session->show_price) { ?>
			  <input type="hidden" id="pricePerm" value="1">
			<?php } else  { ?>
			  <input type="hidden" id="pricePerm" value="0">
			<?php } ?> 
			<input type="hidden" id="variant-price" value="<?php echo $variant_price['value']?>">
			<table class="table table-bordered table-actions-bar prod_detail_table box bg-white">
				<thead >
					<tr style="border-color: #eee;" >
						<th style="vertical-align: inherit;text-align: center !important;width: 50px;" rowspan="4">Image</th>
						<th style="vertical-align: inherit;text-align: center !important;width: 80px;" rowspan="4">ISBN</th>
						<th style="vertical-align: inherit;text-align: center !important;width: 150px;" rowspan="4">Title</th>
						<th style="vertical-align: inherit;text-align: center !important;width: 50px;" rowspan="4">Weight</th>
						<th style="vertical-align: inherit;text-align: center !important;width: 150px !important;" rowspan="4">Buyback</th>
						<th style="vertical-align: inherit;text-align: center !important;" colspan="28">Amazon</th>
						<!-- <th style="vertical-align: inherit;text-align: center !important;width: 50px;" rowspan="3">Price</th> -->
						<!-- <th style="vertical-align: inherit;text-align: center !important;width: 50px;" rowspan="3">Keepa</th> -->
					</tr>
					<tr>
						<th colspan="2" rowspan="2" style="text-align: center !important;">USA</th>
						<th colspan="2" rowspan="2" style="text-align: center !important;">Canada</th>
						<th colspan="10" rowspan="2" style="text-align: center !important;">UK Markets</th>
						<th colspan="2" rowspan="2" style="text-align: center !important;">Mexico</th>
						<th colspan="2" rowspan="2" style="text-align: center !important;">India</th>
						<th colspan="2" rowspan="2" style="text-align: center !important;">Japan</th>
						<th colspan="2" rowspan="2" style="text-align: center !important;">Brazil</th>
						<th colspan="2" rowspan="2" style="text-align: center !important;">China</th>
						<th colspan="2" rowspan="2" style="text-align: center !important;">Australia</th>
					</tr>
					<tr>
					</tr>
					<tr>
						<th class="us_color" style="width: 50px;text-align: center !important;background-color: #<?php echo $colors['US'];?>;" ><i class="fa fa-line-chart"></i></th>
						<th class="us_color" style="width: 40px;text-align: center !important;background-color: #<?php echo $colors['US'];?>;" ><i class="fa fa-usd"></i></th>
						<th class="ca_color" style="width: 50px;text-align: center !important;background-color: #<?php echo $colors['CA'];?>;" ><i class="fa fa-line-chart"></i></th>
						<th class="ca_color" style="width: 40px;text-align: center !important;background-color: #<?php echo $colors['CA'];?>;" ><i class="fa fa-usd"></i></th>
						<th class="uk_color" style="width: 50px;text-align: center !important;background-color: #<?php echo $colors['UK'];?>;" ><a href="javascript:void(0);" data-toggle="tooltip" title="UK Rank"><i class="fa fa-line-chart"></i></a></th>
						<th class="uk_color" style="width: 40px;text-align: center !important;background-color: #<?php echo $colors['UK'];?>;" ><a href="javascript:void(0);" data-toggle="tooltip" title="UK Profit"><i class="fa fa-usd"></i></a></th>
						<th class="de_color" style="width: 50px;text-align: center !important;background-color: #<?php echo $colors['DE'];?>;" ><a href="javascript:void(0);" data-toggle="tooltip" title="Denmark Rank"><i class="fa fa-line-chart"></i></a></th>
						<th class="de_color" style="width: 40px;text-align: center !important;background-color: #<?php echo $colors['DE'];?>;" ><a href="javascript:void(0);" data-toggle="tooltip" title="Denmark Profit"><i class="fa fa-usd"></i></a></th>
						<th class="fr_color" style="width: 50px;text-align: center !important;background-color: #<?php echo $colors['FR'];?>;" ><a href="javascript:void(0);" data-toggle="tooltip" title="France Rank"><i class="fa fa-line-chart"></i></a></th>
						<th class="fr_color" style="width: 40px;text-align: center !important;background-color: #<?php echo $colors['FR'];?>;" ><a href="javascript:void(0);" data-toggle="tooltip" title="France Profit"><i class="fa fa-usd"></i></a></th>
						<th class="it_color" style="width: 50px;text-align: center !important;background-color: #<?php echo $colors['IT'];?>;" ><a href="javascript:void(0);" data-toggle="tooltip" title="Italy Rank"><i class="fa fa-line-chart"></i></a></th>
						<th class="it_color" style="width: 40px;text-align: center !important;background-color: #<?php echo $colors['IT'];?>;" ><a href="javascript:void(0);" data-toggle="tooltip" title="Italy Profit"><i class="fa fa-usd"></i></a></th>
						<th class="es_color" style="width: 50px;text-align: center !important;background-color: #<?php echo $colors['ES'];?>;" ><a href="javascript:void(0);" data-toggle="tooltip" title="Spain Rank"><i class="fa fa-line-chart"></i></a></th>
						<th class="es_color" style="width: 40px;text-align: center !important;background-color: #<?php echo $colors['ES'];?>;" ><a href="javascript:void(0);" data-toggle="tooltip" title="Spain Profit"><i class="fa fa-usd"></i></a></th>
						<th class="mx_color" style="width: 50px;text-align: center !important;background-color: #<?php echo $colors['MX'];?>;" ><i class="fa fa-line-chart"></i></th>
						<th class="mx_color" style="width: 40px;text-align: center !important;background-color: #<?php echo $colors['MX'];?>;" ><i class="fa fa-usd"></i></th>
						<th class="in_color" style="width: 50px;text-align: center !important;background-color: #<?php echo $colors['IN'];?>;" ><i class="fa fa-line-chart"></i></th>
						<th class="in_color" style="width: 40px;text-align: center !important;background-color: #<?php echo $colors['IN'];?>;" ><i class="fa fa-usd"></i></th>
						<th class="jp_color" style="width: 50px;text-align: center !important;background-color: #<?php echo $colors['JP'];?>;" ><i class="fa fa-line-chart"></i></th>
						<th class="jp_color" style="width: 40px;text-align: center !important;background-color: #<?php echo $colors['JP'];?>;" ><i class="fa fa-usd"></i></th>
						<th class="br_color" style="width: 50px;text-align: center !important;background-color: #<?php echo $colors['IN'];?>;" ><i class="fa fa-line-chart"></i></th>
						<th class="br_color" style="width: 40px;text-align: center !important;background-color: #<?php echo $colors['IN'];?>;" ><i class="fa fa-usd"></i></th>
						<th class="br_color" style="width: 50px;text-align: center !important;background-color: #<?php echo $colors['IN'];?>;" ><i class="fa fa-line-chart"></i></th>
						<th class="br_color" style="width: 40px;text-align: center !important;background-color: #<?php echo $colors['IN'];?>;" ><i class="fa fa-usd"></i></th>
						<th class="br_color" style="width: 50px;text-align: center !important;background-color: #<?php echo $colors['AU'];?>;" ><i class="fa fa-line-chart"></i></th>
						<th class="br_color" style="width: 40px;text-align: center !important;background-color: #<?php echo $colors['AU'];?>;" ><i class="fa fa-usd"></i></th>
					</tr>
				</thead>
				<input type="hidden" id="buyback-bwb-clr" value="<?php echo $colors['buyback_bwb'];?>">
				<input type="hidden" id="buyback-br-clr" value="<?php echo $colors['buyback_br'];?>">
				<?php foreach ($only_regions as $reg) { ?>
					<input type="hidden" value="<?php echo $reg['purchased_price'] ?>" id="<?php echo strtolower($reg['region_code'])?>_purchased_price" >
					<input type="hidden" value="<?php echo $reg['amazon_shipping_cost'] ?>" id="<?php echo strtolower($reg['region_code'])?>_amazon_shipping_cost" >
					<input type="hidden" value="<?php echo $reg['merchant_shipping_cost']?>" id="<?php echo strtolower($reg['region_code'])?>_merchant_shipping_cost">
					<input type="hidden" value="<?php echo $reg['merchant_price_per_pound']?>" id="<?php echo strtolower($reg['region_code'])?>_merchant_price_per_pound">
				<?php  } ?>
				<tbody id="productTable">
				</tbody>
			</table>
		</div>
	</div>  
</div>         
<div class="col-sm-12">

</div>

</div> 
</div>

</div>                 
</div>
</div>

</div>


</div>
</div>

</div>

</div>

</div>
</div>

</div>

</div>

</div>
</div>

<!-- The Modal -->



<div class="modal-container">
	<!-- <div id="dataload" class="modal fade" role="dialog" data-backdrop="false">
		<div class="modal-dialog modal-lg">
		  <div class="card panel ">
			<div class="panel-heading" style="margin: 5px;">
			  <button class="close" type="button" data-dismiss="modal">×</button>
			  <h5 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i>&nbsp;List of Searches</h5>
			  
			</div>
			<div class="panel-body ">
			  <div class="row">
				<div class="col-sm-12">
				  <table id="productres" class="table table-responsive table-striped">
					<thead>
							<th>Image</th>
							<th>Title</th>
							<th>Amazon</th>
							<th>New</th>
							<th>Used</th>
							<th>Edition</th>
							<th>Format</th>
							<th>ASIN</th>
					</thead>
					<tbody>
					</tbody>
				  </table>
				</div>
			  </div>
			</div>
			<div class="modal-footer">
			<button class="btn btn-success close" data-dismiss="modal" aria-hidden="true">Close</button>
			</div>
		  </div>
		</div>
	</div> -->


	<div class="modal " id="dataload">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">List of Searches</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body dataTables_wrapper d-flex justify-content-center" id="sample">
      	<div class="loaderSmall"></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



  <div id="export" class="modal fade" role="dialog">
	<div class="modal-dialog">
	  <div class="card panel ">
		<div class="panel-heading">
		  <button class="close" type="button" data-dismiss="modal">×</button>
		  <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Download Data</h3>
		  
		</div>
		<div class="panel-body ">
		  <div class="row">
			<div class="col-sm-12">
			  <a target='_blank' href='<?php echo $baseurl."asset/exportdata/" ?>{{file_name}}'>Download file</a>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div>


  <div id="import" class="modal fade" role="dialog">
	<div class="modal-dialog">
	  <div class="card panel ">
		<div class="panel-heading">
		  <button class="close" type="button" data-dismiss="modal">×</button>
		  <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Import Data</h3>
		  
		</div>
		<div class="panel-body ">
		  <div class="row">
			<div class="col-sm-12">
			  <div class="" >
				<div class="row">
				  <form class="form-horizontal" ng-submit="uploadImport(picFile)" novalidate>
					<div class="col-sm-12" >
					 <input type="file" ngf-select ng-model="picFile" name="file"  ngf-max-size="50MB"   ngf-model-invalid="errorFile">
					 <i ng-show="myForm.file.$error.maxSize">File too large 
					 {{errorFile.size / 1000000|number:1}}MB: max 50M</i><br>
					 <br>
					 <span class="progress" ng-show="picFile.progress >= 0">
					  <div style="width:{{picFile.progress}}%" 
					  ng-bind="picFile.progress + '%'"></div>
					</span>
					<span ng-show="picFile.result">Upload Successful</span>
					<span class="err" ng-show="errorMsg">{{errorMsg}}</span>
					<input type="reset" value="Reset"  class="btn btn-success"> <input type="submit" value="Save"  class="btn btn-success">
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




<div id="desc" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<div class="card panel ">
	  <div class="panel-heading">
		<button class="close" type="button" data-dismiss="modal">×</button>
		<h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Import Data</h3>
		
	  </div>
	  <div class="panel-body ">
		<div class="row">
		  <div class="col-sm-12">
			<div class="" >
			  <div class="row">
				<form class="form-horizontal" ng-submit="upload_barcode()">
				  <div class="col-sm-12" >
				   <input type="text" style="width:60%;height:60px;margin-left:90px;" ng-model='filter.barcode' name="barcode"><br><br>
				   <input type="reset" value="Reset" style="margin-left:175px;"  class="btn btn-success"> <input type="submit" value="Save"  class="btn btn-success">
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
<script type="text/javascript">
  $(document).ready(function(){

  	$(".table").click(function(){
  		var aat =$(this).closest('tr').html();
  		//console.log(aat);

  	});

	 
	$('[data-toggle="tooltip"]').tooltip();  

	$("#search").on('change',function(){
				//console.log($("#search").val());
				search = $("#search").val();
				keepa(search);
		
	});

	$("#findpro").click(function(){
		if(($("#search").val())!= ''){

				//console.log($("#search").val());
				search = $("#search").val();
				keepa(search);
				//localsearch(search);
			   

		}
		else{

			$("#dataload").modal('show');
			  $.ajax({
				   //url: "<?php echo $baseurl."/asset/try2.json" ?>",
				   url : "https://api.keepa.com/search?key=f4srik0llhm63as1p4bgv4j0vu1m985lbikjeo7btf231h2gvtqjmkf5kq9ahssk&domain=1&type=product&term="+$("#name").val()+"",
				   dataType: 'json',
				   success: function(data) {
				
				   	$('#keepa_tokens').html(data['tokensLeft']);
				   	$("#productres_wrapper").remove();
				   	//$("#productres").dataTable().fnDestroy();
				   	var table = "<table class=\"table table-responsive\" id=\"productres\"><thead><th>Action</th><th>Image</th><th>Title</th><th>Amazon</th><th>New</th><th>Used</th><th>Edition</th><th>Format</th><th>ASIN</th></thead><tbody>";
					  var row = '';
					  $.each(data.products, function(key, val) {
						var temp = new Array();
						// this will return an array with strings "1", "2", etc.
						temp = data['products'][key]['imagesCSV'].split(",");
	var amazonPrice = '$'+parseFloat(data['products'][key]['csv'][0][data['products'][key]['csv'][0].length-1]/100).toFixed(2);
	var newPrice = '$'+parseFloat(data['products'][key]['csv'][1][data['products'][key]['csv'][1].length-1]/100).toFixed(2);
	var usedPrice = '$'+parseFloat(data['products'][key]['csv'][2][data['products'][key]['csv'][2].length-1]/100).toFixed(2);
						var edition = ' - ';
						var format = ' - ';
						if(data.products[key].edition!=null){
							var edition = data.products[key].edition;
						}
						if(data.products[key].format!=null){
							var format = data.products[key].format;
						}
							//console.log(data.products[key].asin);
						 table += "<tr>\n\
						 <td><button class=\"btn btn-xs\" onclick=\"codeSearch('"+data.products[key].asin+"');\"><i class=\"fa fa-check\"></i></button></td>\n\
						<td><img class='drop' src=\"https://images-na.ssl-images-amazon.com/images/I/"+temp[0]+"\" width=\"50\" height=\"75\"></td>\n\
						<td>"+data.products[key].title+"</td>\n\
						<td>"+amazonPrice+"</td>\n\
						<td>"+newPrice+"</td>\n\
						<td>"+usedPrice+"</td>\n\
						<td>"+edition+"</td>\n\
						<td>"+format+"</td>\n\
						<td>"+data.products[key].asin+"</td>\n\
						</tr>";
						//items.push('<tr><td id="' + key + '">' + val + '</td></tr>');  
					  });
						table += "</tbody></table>"; 
						$(".loaderSmall").hide();
						$("#sample").append(table);
						$("#productres").DataTable();

				   },
				  statusCode: {
					 404: function() {
					   alert('There was a problem with the server.  Try again soon!');
					 }
				   }
				});



		}

		});
		//console.log("AAAAA");
		  // $("#productres>tbody").click(function(){

		  // 	console.log($(this).attr('id'));
		  // });

  });

  


</script>
<script>  
  var ranksAndProfits= {};
  var weightLbcheck = 0;
  var sellingAmazonFee = {
	"us":[{"referralFee":0.15,"varClosingFee":1.80}],
	"uk":[{"referralFee":0.15,"varClosingFee":0.50}],
	"mx":[{"referralFee":8.62,"varClosingFee":0.00}],
	"ca":[{"referralFee":0.15,"varClosingFee":1.80}],
	"it":[{"referralFee":0.15,"varClosingFee":1.01}],
	"es":[{"referralFee":0.15,"varClosingFee":1.01}],
	"fr":[{"referralFee":0.15,"varClosingFee":0.61}],
	"de":[{"referralFee":0.15,"varClosingFee":1.01}],
	"jp":[{"referralFee":0,"varClosingFee":80}],
	"au":[{"referralFee":0,"varClosingFee":80}],
	"br":[{"referralFee":0,"varClosingFee":80}],
	"cn":[{"referralFee":0,"varClosingFee":80}],
	"in":[{"referralFee":0.13,"varClosingFee":15}]
  };
  var itemCat = '';


    function codeSearch(id){  
    	keepa(id);
    }
  
  
  function autoSave(id){  

   var search = $('#search').val(id);  

   if(search != ''){  
	$("#dataload").modal('hide');
	keepa(search);
	}               
}  

function localsearch(id) {
  $('#loadedImage').html("");
  $('#loadedStats').hide();
  
  $("#dataload").modal('hide');
  //alert(id.length);
  // if (id.length<=10) {
  //   var path = "https://api.keepa.com/product?key=9uuqu3qdmfttr1al5o3v8t6rbh9gqlqqhgb9952htq0mmev9nvf5mtt3lt0do6mf&rating=1&offers=20&domain=1&asin="+id;
  // } else {
  //   var path = "https://api.keepa.com/product?key=9uuqu3qdmfttr1al5o3v8t6rbh9gqlqqhgb9952htq0mmev9nvf5mtt3lt0do6mf&rating=1&offers=20&domain=1&code="+id;
  // }
  var path = "<?php echo $baseurl."products_tool/get_pro/"?>"+id;
  $.ajax({  
   url:path,
   method:"GET",    
   dataType:"json",
   beforeSend: function() {
	$('.loader').show();
  },  
  success:function(data)  
  { 
	$('.loader').hide();
	if (data[0]) {
	//console.log(data[0]['image']);
	  var img = '<img class="drop" src="'+data[0]['image']+'" alt="" width="200" height="300">';
	  var amazonPrice = '$'+parseFloat(data[0]['keepa_amazon_price']).toFixed(2);
	  var newPrice = '$'+parseFloat(data[0]['keepa_new_price']).toFixed(2);
	  var usedPrice = '$'+parseFloat(data[0]['keepa_used_price']).toFixed(2);
	  // if (data['products']) {
	  //   var rating = parseFloat(data['products'][0]['csv'][16][data['products'][0]['csv'][16].length-1]/10);
	  // } else {
	  // }
	  // if (data['products']) {
	  //   var countNew = data['products'][0]['csv'][11][data['products'][0]['csv'][11].length-1];
	  // } else {
	  // }
	  // if (data['products']) {
	  //   var countUsed = data['products'][0]['csv'][12][data['products'][0]['csv'][12].length-1];
	  // } else {
	  // }
		var countNew = 0;
		var rating = 0;
		var countUsed = 0;
	  var countHtml = 'New: '+countNew+'<br>Used: '+countUsed;
	  var salesRankUsa = data[0]['us_rank'].toLocaleString();
	  if (salesRankUsa == '-1') { salesRankUsa = '0';}
	  weightLbcheck = parseFloat(data[0]['weight']) * 0.00220462;
	  if (amazonPrice == '$-0.01') { amazonPrice = 'N/A';}
	  if (newPrice == '$-0.01') { newPrice = 'N/A';}
	  if (usedPrice == '$-0.01') { usedPrice = 'N/A';}  
	  // if (data['products'][0]['categoryTree'][0]) {itemCat = data['products'][0]['categoryTree'][0]['name'];}
	  $('#loadedImage').html(img);
	  $('#loadedTitle').html(data[0]['book_title']);
	  $('#loadedAuthor').html(data[0]['author']);
	  $('#loadedManufacturer').html(data[0]['manufacturer']);
	  $('#loadedWeight').html(parseFloat(data[0]['weight']*0.035274).toFixed(2)+' Ounces.');
	  $('#loadedAmazonPrice').html(amazonPrice);
	  $('#loadedNewPrice').html(newPrice);
	  $('#loadedUsedPrice').html(usedPrice);
	  $('#loadedCount').html(countHtml);
	  $('#loadedStats').show();
	  //console.log(data[0]['us_rank']);
	  var row  = '<tr><td align="center"><img class="shadow" src="'+data[0]['image']+'" alt="" width="50" height="50"></td>';
	  row  += '<td align="center" id="_'+data[0]['isbn']+'">'+data[0]['isbn']+'<br><div class="my-rating"></div></td>';
	  row  += '<td align="center">'+(data[0]['book_title'])+' ...</td>';
	  row  += '<td align="center">'+(data[0]['weight']*0.035274).toFixed(2)+' Oz</td>';
	  row  += '<td align="center" id="buyback_'+data[0]['us_rank']+'"><div class="loaderSmall"></div></td>';

	  row  += '<td align="center" id="us_rank_'+data[0]['us_rank']+'" class="row_'+data[0]['us_rank']+'">'+data[0]['us_rank']+'</td><td align="center" id="us_profit_'+data[0]['us_fbm_price']+'" class="row_'+data[0]['us_rank']+'"><div class="loaderSmall"></div></td>';
	  row  += '<td align="center" id="ca_rank_'+data[0]['ca_rank']+'" class="row_'+data[0]['ca_rank']+'"><div class="loaderSmall"></div></td><td align="center" id="ca_profit_'+data[0]['ca_fbm_price']+'" class="row_'+data[0]['ca_rank']+'"><div class="loaderSmall"></div></td>';
	  row  += '<td align="center" id="uk_rank_'+data[0]['uk_rank']+'" class="row_'+data[0]['uk_rank']+'"><div class="loaderSmall"></div></td><td align="center" id="uk_profit_'+data[0]['uk_fbm_price']+'" class="row_'+data[0]['uk_rank']+'"><div class="loaderSmall"></div></td>';
	  row  += '<td align="center" id="de_rank_'+data[0]['de_rank']+'" class="row_'+data[0]['de_rank']+'"><div class="loaderSmall"></div></td><td align="center" id="de_profit_'+data[0]['de_fbm_price']+'" class="row_'+data[0]['de_rank']+'"><div class="loaderSmall"></div></td>';
	  row  += '<td align="center" id="fr_rank_'+data[0]['fr_rank']+'" class="row_'+data[0]['fr_rank']+'"><div class="loaderSmall"></div></td><td align="center" id="fr_profit_'+data[0]['fr_fbm_price']+'" class="row_'+data[0]['fr_rank']+'"><div class="loaderSmall"></div></td>';
	  row  += '<td align="center" id="it_rank_'+data[0]['it_rank']+'" class="row_'+data[0]['it_rank']+'"><div class="loaderSmall"></div></td><td align="center" id="it_profit_'+data[0]['it_fbm_price']+'" class="row_'+data[0]['it_rank']+'"><div class="loaderSmall"></div></td>';
	  row  += '<td align="center" id="es_rank_'+data[0]['es_rank']+'" class="row_'+data[0]['es_rank']+'"><div class="loaderSmall"></div></td><td align="center" id="es_profit_'+data[0]['es_fbm_price']+'" class="row_'+data[0]['es_rank']+'"><div class="loaderSmall"></div></td>';
	  
	  // temporary disable for MEXICO
	  
	  row  += '<td align="center" id="mx_rank_'+data[0]['mx_rank']+'" class="row_'+data[0]['mx_rank']+'"><div class="loaderSmall"></div></td><td align="center" id="mx_profit_'+data[0]['mx_fbm_price']+'" class="row_'+data[0]['mx_rank']+'"><div class="loaderSmall"></div></td>';


	  //row  += '<td align="center" id="mx_rank_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'">On Hold</td><td align="center" id="mx_profit_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'">On Hold</td>';
	  // temporary disable for INDIA

	  row  += '<td align="center" id="in_rank_'+data[0]['in_rank']+'" class="row_'+data[0]['in_rank']+'"><div class="loaderSmall"></div></td><td align="center" id="in_profit_'+data[0]['in_fbm_price']+'" class="row_'+data[0]['in_rank']+'"><div class="loaderSmall"></div></td>';



	  //row  += '<td align="center" id="in_rank_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'">On Hold</td><td align="center" id="in_profit_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'">On Hold</td>';
	
	  row  += '<td align="center" id="jp_rank_'+data[0]['jp_rank']+'" class="row_'+data[0]['jp_rank']+'"><div class="loaderSmall"></div></td><td align="center" id="jp_profit_'+data[0]['jp_fbm_price']+'" class="row_'+data[0]['jp_rank']+'"><div class="loaderSmall"></div></td>';

	
	  $('#productTable').prepend(row);
	  $(".my-rating").starRating({
		starSize:15,
		// callback: function(currentRating, $el){
		// }
	  });
	  $('.my-rating').starRating('setRating', rating);
	  // insertProduct(data['products'][0]['eanList'][0]);
	  // buybackCall(data['products'][0]['eanList'][0]);
	  // //threads(data['products'][0]['eanList'][0]);
	  // //FetchSalesRankAll(data['products'][0]['eanList'][0],data['products'][0]['asin'],flag);
	  // fetchRankAndProfit(data['products'][0]['eanList'][0],'us');
	  // fetchRankAndProfit(data['products'][0]['eanList'][0],'uk');
	  // fetchRankAndProfit(data['products'][0]['eanList'][0],'de');
	  // fetchRankAndProfit(data['products'][0]['eanList'][0],'fr');
	  // //temprary restrict for india and mexico
	  // fetchRankAndProfit(data['products'][0]['eanList'][0],'in');
	  // fetchRankAndProfit(data['products'][0]['eanList'][0],'mx');
	  // fetchRankAndProfit(data['products'][0]['eanList'][0],'jp');
	  // fetchRankAndProfit(data['products'][0]['eanList'][0],'ca');
	  // fetchRankAndProfit(data['products'][0]['eanList'][0],'es');
	  // fetchRankAndProfit(data['products'][0]['eanList'][0],'it');
	} else {
	  $('#dbFailMsg').html('<i class="fa fa-close" style="font-size:48px;color:red"></i> Incorrect ISBN.');
	  $('#dbFail').show();
	  $('#dbFail').fadeOut(2000);
	} 
  }  
  
});
}





function keepa(id) {
  $('#loadedImage').html("");
  $('#loadedStats').hide();
  $("#dataload").modal('hide');
  
  	  if (id.length<=10) {
		var path = "https://api.keepa.com/product?key=f4srik0llhm63as1p4bgv4j0vu1m985lbikjeo7btf231h2gvtqjmkf5kq9ahssk&rating=1&offers=20&domain=1&asin="+id;
	  } else {
		var path = "https://api.keepa.com/product?key=f4srik0llhm63as1p4bgv4j0vu1m985lbikjeo7btf231h2gvtqjmkf5kq9ahssk&rating=1&offers=20&domain=1&code="+id;
	  }
	  $.ajax({  
   url:path,
   method:"GET",    
   dataType:"json",
   beforeSend: function() {
	$('.loader').show();
  },  
  success:function(data)  
  { 
	//console.log(data);
	$('.loader').hide();
	if (data['products'][0]) {
	  var img = '<img class="shadow" src="https://images-na.ssl-images-amazon.com/images/I/'+data['products'][0]['imagesCSV']+'" alt="" width="200" height="300">';
	  var amazonPrice = '$'+parseFloat(data['products'][0]['csv'][0][data['products'][0]['csv'][0].length-1]/100).toFixed(2);
	  var newPrice = '$'+parseFloat(data['products'][0]['csv'][1][data['products'][0]['csv'][1].length-1]/100).toFixed(2);
	  var usedPrice = '$'+parseFloat(data['products'][0]['csv'][2][data['products'][0]['csv'][2].length-1]/100).toFixed(2);
	  if (data['products'][0]['csv'][16]) {
		var rating = parseFloat(data['products'][0]['csv'][16][data['products'][0]['csv'][16].length-1]/10);
	  } else {
		var rating = 0;
	  }
	  if (data['products'][0]['csv'][11]) {
		var countNew = data['products'][0]['csv'][11][data['products'][0]['csv'][11].length-1];
	  } else {
		var countNew = 0;
	  }
	  if (data['products'][0]['csv'][12]) {
		var countUsed = data['products'][0]['csv'][12][data['products'][0]['csv'][12].length-1];
	  } else {
		var countUsed = 0;
	  }
	  var countHtml = 'New: '+countNew+'<br>Used: '+countUsed;
	  var salesRankUsa = data['products'][0]['csv'][3][data['products'][0]['csv'][3].length-1].toLocaleString();
	  if (salesRankUsa == '-1') { salesRankUsa = '0';}
	  weightLbcheck = parseFloat(data['products'][0]['packageWeight']) * 0.00220462;
	  if (amazonPrice == '$-0.01') { amazonPrice = 'N/A';}
	  if (newPrice == '$-0.01') { newPrice = 'N/A';}
	  if (usedPrice == '$-0.01') { usedPrice = 'N/A';}  
	  if (data['products'][0]['categoryTree'][0]) {itemCat = data['products'][0]['categoryTree'][0]['name'];}
	  $('#loadedImage').html(img);
	  $('#loadedTitle').html(data['products'][0]['title']);
	  $('#loadedAuthor').html(data['products'][0]['author']);
	  $('#loadedManufacturer').html(data['products'][0]['manufacturer']);
	  $('#loadedWeight').html(parseFloat(data['products'][0]['packageWeight']*0.035274).toFixed(2)+' Ounces.');
	  $('#loadedAmazonPrice').html(amazonPrice);
	  $('#loadedNewPrice').html(newPrice);
	  $('#loadedUsedPrice').html(usedPrice);
	  $('#loadedCount').html(countHtml);
	  $('#loadedStats').show();
	  var row  = '<tr><td align="center"><img src="https://images-na.ssl-images-amazon.com/images/I/'+data['products'][0]['imagesCSV']+'" alt="" width="50" height="50"></td>';
	  row  += '<td align="center" id="_'+data['products'][0]['eanList'][0]+'">'+data['products'][0]['eanList'][0]+'<br><div class="my-rating"></div></td>';
	  row  += '<td align="center">'+getWords(data['products'][0]['title'])+' ...</td>';
	  row  += '<td align="center">'+(data['products'][0]['packageWeight']*0.035274).toFixed(2)+' Oz</td>';
	  row  += '<td align="center" id="buyback_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td>';
	  row  += '<td align="center" id="us_rank_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td><td align="center" id="us_profit_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td>';
	  row  += '<td align="center" id="ca_rank_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td><td align="center" id="ca_profit_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td>';
	  row  += '<td align="center" id="uk_rank_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td><td align="center" id="uk_profit_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td>';
	  row  += '<td align="center" id="de_rank_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td><td align="center" id="de_profit_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td>';
	  row  += '<td align="center" id="fr_rank_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td><td align="center" id="fr_profit_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td>';
	  row  += '<td align="center" id="it_rank_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td><td align="center" id="it_profit_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td>';
	  row  += '<td align="center" id="es_rank_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td><td align="center" id="es_profit_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td>';
	  // temporary disable for MEXICO
	  row  += '<td align="center" id="mx_rank_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td><td align="center" id="mx_profit_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td>';
	  //row  += '<td align="center" id="mx_rank_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'">On Hold</td><td align="center" id="mx_profit_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'">On Hold</td>';
	  // temporary disable for INDIA
	  row  += '<td align="center" id="in_rank_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td><td align="center" id="in_profit_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td>';
	  //row  += '<td align="center" id="in_rank_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'">On Hold</td><td align="center" id="in_profit_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'">On Hold</td>';
	  row  += '<td align="center" id="jp_rank_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td><td align="center" id="jp_profit_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td>';

	  row  += '<td align="center" id="br_rank_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td><td align="center" id="br_profit_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td>';
	  row  += '<td align="center" id="cn_rank_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td><td align="center" id="cn_profit_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td>';
	  row  += '<td align="center" id="au_rank_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td><td align="center" id="au_profit_'+data['products'][0]['eanList'][0]+'" class="row_'+data['products'][0]['eanList'][0]+'"><div class="loaderSmall"></div></td></tr>';


	  $('#productTable>tr').closest("tr:last").remove();
	  $('#productTable').prepend(row);
	  $(".my-rating").starRating({
		starSize:15,
		callback: function(currentRating, $el){
		}
	  });
	  $('.my-rating').starRating('setRating', rating);
	  insertProduct(data['products'][0]['eanList'][0]);
	  buybackCall(data['products'][0]['eanList'][0]);
	  //threads(data['products'][0]['eanList'][0]);
	  //FetchSalesRankAll(data['products'][0]['eanList'][0],data['products'][0]['asin'],flag);
	  fetchRankAndProfit(data['products'][0]['eanList'][0],'us');
	  fetchRankAndProfit(data['products'][0]['eanList'][0],'uk');
	  fetchRankAndProfit(data['products'][0]['eanList'][0],'de');
	  fetchRankAndProfit(data['products'][0]['eanList'][0],'fr');
	  fetchRankAndProfit(data['products'][0]['eanList'][0],'au');
	  fetchRankAndProfit(data['products'][0]['eanList'][0],'cn');
	  fetchRankAndProfit(data['products'][0]['eanList'][0],'br');
	  //temprary restrict for india and mexico
	  fetchRankAndProfit(data['products'][0]['eanList'][0],'in');
	  fetchRankAndProfit(data['products'][0]['eanList'][0],'mx');
	  fetchRankAndProfit(data['products'][0]['eanList'][0],'jp');
	  fetchRankAndProfit(data['products'][0]['eanList'][0],'ca');
	  fetchRankAndProfit(data['products'][0]['eanList'][0],'es');
	  fetchRankAndProfit(data['products'][0]['eanList'][0],'it');
	} else {
	  $('#dbFailMsg').html('<i class="fa fa-close" style="font-size:48px;color:red"></i> Incorrect ISBN.');
	  $('#dbFail').show();
	  $('#dbFail').fadeOut(2000);
	} 
  }  
});

  
}


function insertProduct(id){
  var store = $('#markets').val();
  $.ajax({  
   url:"<?php echo $baseurl ."products_tool/insertProduct/"?>",
   method:"POST",  
   data:{isbn:id,storeName:store},    
   dataType:"json",
   beforeSend: function() {
	$('#dbLoader').show();
  },  
  success:function(json)  
  {  
	$('#dbLoader').hide();
	$('#dbSuccess').show();
	$('#dbSuccess').fadeOut(1500);
	if (json['success']) {
	  $('#dbSuccessMsg').html('Successfully saved.');
	} else {
	  $('#dbSuccessMsg').html('Incorrect ISBN.');
	}
	$('#search').val('');

  }
});
}
function FetchSalesRankAll(id, asin,flag){
  if (flag == 'asin') { var id_index = asin; } else { var id_index = id; }
  $.ajax({  
   url:"<?php echo $baseurl ."products_tool/FetchSalesRankAll/"?>",
   method:"POST",  
   data:{isbn:id, asin:asin},    
   dataType:"json",
   beforeSend: function() {

   },  
   success:function(json)  
   { 

	$.each(json, function( index, value ) {

	  if (value['rank'] < 1) {value['rank'] = 0;}
	  $('#'+index+'_rank_'+id_index).html(value['rank'].toLocaleString());
	  if (value['rank_validation']!= 1) {

	  } else {
		var color = $('.'+index+'_color').css("background-color");
		$('#'+index+'_profit_'+id_index).css('background',color);
	  }
	  if ($('#pricePerm').val() == '1') {
		$('#'+index+'_profit_'+id_index).html(value['profit'].toFixed(2));
	  } else {
		$('#'+index+'_profit_'+id_index).html('');
	  }
	  
	});
  }
}); 
}

function buybackCall(id){
  $.ajax({  
   url:"<?php echo $baseurl ."products_tool/buyBackCalls/"?>",
   method:"POST",  
   data:{isbn:id},   
   dataType:"json",
   beforeSend: function() {

   },  
   success:function(json)  
   { 

	if (json['isAccepted']) {
	  $('#buyback_'+id).html(' <span style="color:#'+$('#buyback-bwb-clr').val()+'">BetterWorld (Yes)</span><br>');
	} else {
	  $('#buyback_'+id).html('BetterWorld (N/A)<br>');
	}

	if (json['result']['text']['Average']!= 0 && typeof(json['result']['text']['Average']) != "undefined") {
	  $('#buyback_'+id).append('<span style="color:#'+$('#buyback-br-clr').val()+'"> Books Run ('+json['result']['text']['Average']+')</span>');
	} else {
	  $('#buyback_'+id).append('Books Run (N/A)');
	}

	saveRanksProfits(id,JSON.stringify(ranksAndProfits));
	//console.log(ranksAndProfits);
	
	
  }
});
}

function saveRanksProfits(isbn,data){
  $.ajax({  
   url:"<?php echo $baseurl ."products_tool/saveRanksProfits/"?>",
   method:"POST",  
   data:{isbn:isbn, data:data,itemCat:itemCat,weightLb:weightLbcheck},   
   dataType:"json",
   beforeSend: function() {

   },  
   success:function(json)  
   { 
	if (json['special_verification'] == 1) {
	  // first priority config fall i.e special list of isbns
	  $('.row_'+isbn).css('background','#FFD700');
	} else {
	  var store_material = true;
	  $.each(json['withprofit'], function( index, value ) {
		if (value == 1) {   
		  // second priority config fall i.e profit in marketplace
		  store_material = false;
		  var region = index.split('_');
		   // if ($('#'+region[0]+'_profit_'+isbn).hasClass('grey-area') == false) {
			var color = $('.'+region[0]+'_color').css("background-color");
			$('#'+region[0]+'_profit_'+isbn).css('background',color);
			$('#'+region[0]+'_rank_'+isbn).css('background',color);
		   // }
		 }
	   });
	  // third priority config fall i.e only rank config for bookstore
	  if (store_material) {
		$.each(json['onlyrank'], function( index, value ) {
		  if (value == 1) {   
			var region = index.split('_');
		   // if ($('#'+region[0]+'_profit_'+isbn).hasClass('grey-area') == false) {  
			var color = $('.'+region[0]+'_color').css("background-color");
			$('#'+region[0]+'_rank_'+isbn).append('<i class="fas fa-store-alt" style="font-size:28px;color:green"></i>');
		   // }
		 }

	   });
	  }
	  if (json['rank_special_conf']['us_rank_conf']) {
		$('#_'+isbn).css('background',json['rank_special_conf']['us_rank_color']);
	  } 
	  
	}

  }
});
}

function fetchRankAndProfit(id,region){

  var areas = {};
  areas['us'] = 1;
  areas['uk'] = 2;
  areas['de'] = 3;
  areas['fr'] = 4;
  areas['cn'] = 7;
  areas['it'] = 8;
  areas['es'] = 9;
  areas['jp'] = 5;
  areas['ca'] = 6;
  areas['in'] = 10;
  areas['mx'] = 11;
  areas['br'] = 12;
  areas['au'] = 13;
  var path = "https://api.keepa.com/product?key=f4srik0llhm63as1p4bgv4j0vu1m985lbikjeo7btf231h2gvtqjmkf5kq9ahssk&stats=90&offers=20&domain="+areas[region]+"&code="+id;
  $.ajax({  
   url:path,
   method:"GET",    
   dataType:"json",  
   success:function(data)  
   { 

	var fbaOffersPriceList = [];
	var fbmOffersPriceList = [];
	if (data['products'][0]) {
	  ranksAndProfits[region+'_rank'] = data['products'][0]['stats']['avg90'][3];
		// Ranks
		var rank;
		if (data['products'][0]['stats']['avg90'][3] == '-1') {
		  rank = 'N/A';
		} else {
		  rank = data['products'][0]['stats']['avg90'][3].toLocaleString();
		}
		$('#'+region+'_rank_'+id).html(rank);


		// ********** Calculations For Profit *************** 

		//Sale price
		var salePrice = 0;
		if (data['products'][0]['csv'][0][data['products'][0]['csv'][0].length-1]) {
		  salePrice = parseFloat(data['products'][0]['csv'][0][data['products'][0]['csv'][0].length-1]/100).toFixed(2);
		}
		// if (salePrice == '-0.01') {
		//   $('#'+region+'_profit_'+id).css('background','#A9A9A9');
		//   $('#'+region+'_rank_'+id).css('background','#A9A9A9');
		//   $('#'+region+'_rank_'+id).addClass('grey-area');
		//   $('#'+region+'_profit_'+id).addClass('grey-area');
		// }
		// Height
		var height = 0;
		if (data['products'][0]['packageHeight']) {height = data['products'][0]['packageHeight']*0.0393701;}
		// length
		var len = 0;
		if (data['products'][0]['packageLength']) {len = data['products'][0]['packageLength']*0.0393701;}
		// width
		var width = 0;
		if (data['products'][0]['packageWidth']) {width = data['products'][0]['packageWidth']*0.0393701;}
		// weight
		var weight = 0;
		if (data['products'][0]['packageWeight']) {weight = data['products'][0]['packageWeight'];}

		var fbaCount = 0,fbmCount = 0,fbaOfferPrice = 0,fbmOfferPrice = 0;

		if (data['products'][0]['liveOffersOrder']){
		  $.each(data['products'][0]['liveOffersOrder'],function(index,value){
			if (data['products'][0]['offers'][value]['isFBA'] === true) {
			  fbaCount += 1;
			  fbaOfferPrice = parseFloat(data['products'][0]['offers'][value]['offerCSV'][data['products'][0]['offers'][value]['offerCSV'].length-2]/100);
			  fbaOffersPriceList.push(fbaOfferPrice);
			}else{
			  fbmCount += 1;
			  fbmOfferPrice = parseFloat(data['products'][0]['offers'][value]['offerCSV'][data['products'][0]['offers'][value]['offerCSV'].length-2]/100);
			  fbmOffersPriceList.push(fbmOfferPrice);
			}
		  });
		}

		if (fbaOffersPriceList.length == 0) {
		  var profit = 0;
		  var avgFbaOfferPrice = 0.00;
		}else{
		  if (fbaOffersPriceList.length >=5) {
		   var res = fbaOffersPriceList.sort((a,b) => a - b).slice(0, 5);
		   var avgFbaOfferPrice = (res.reduce((a,b) => a + b, 0) / res.length).toFixed(2) ;
		   var profit =calcProfit(avgFbaOfferPrice,height,length,width,weight,region);
		 }else{
		  var avgFbaOfferPrice = (fbaOffersPriceList.reduce((a,b) => a + b, 0) / fbaOffersPriceList.length).toFixed(2) ;
		  var profit =calcProfit(avgFbaOfferPrice,height,length,width,weight,region);
		}
	  }
	  var variant_price = parseFloat($('#variant-price').val());
	  if (fbmOffersPriceList.length == 0) {
		var fbmProfit = 0;
		var avgFbmOfferPrice = 0.00;
	  }else{
		if (fbmOffersPriceList.length >=5) {
		 var res = fbmOffersPriceList.sort((a,b) => a - b).slice(0, 5);
		 var avgFbmOfferPrice = (res.reduce((a,b) => a + b, 0) / res.length).toFixed(2) ;
		 //console.log("avgFbmOfferPrice is "+avgFbmOfferPrice+"\n");
		 var fbmProfit =calcFbmProfit(avgFbmOfferPrice,variant_price,weight,region);
	   }else{
		var avgFbmOfferPrice = (fbmOffersPriceList.reduce((a,b) => a + b, 0) / fbmOffersPriceList.length).toFixed(2) ;
		var fbmProfit =calcFbmProfit(avgFbmOfferPrice,variant_price,weight,region);
	  }
	}


	

	var offersHtml = 'FBA Average: '+avgFbaOfferPrice+' ('+fbaCount+')<br>FBM Average: '+avgFbmOfferPrice+' ('+fbmCount+')';
	if (region == 'us') {
	  $('#loadedOffersData').html(offersHtml);  
	}


	ranksAndProfits[region+'_price'] = profit;
	ranksAndProfits[region+'_fbm_price'] = fbmProfit;

	if ($('#pricePerm').val() == '1') {
	  $('#'+region+'_profit_'+id).html(' (FBA) $'+profit+'{'+fbaCount+'}'+'<br>'+' (MF) $'+fbmProfit+'{'+fbmCount+'}');

	} else {
	  $('#'+region+'_profit_'+id).html('');
	}

  } else {
	$('#'+region+'_rank_'+id).html('N/A');
	$('#'+region+'_profit_'+id).html('$0.00');
	ranksAndProfits[region+'_rank'] = -1;
	ranksAndProfits[region+'_price'] = 0.00;
	ranksAndProfits[region+'_fbm_price'] = 0.00;
  }
  if (data['tokensLeft'] < parseInt($('#keepa_tokens').html())) {
	$('#keepa_tokens').html(data['tokensLeft']);
  }
}  
});

}

// function calcProfit(salePrice,height,length,width,weight,region){

//   var purchasedPrice  = parseFloat($('#'+region+'_purchased_price').val());
//   var shippingFee  = parseFloat($('#'+region+'_amazon_shipping_cost').val());
//   var weightLb = weight * 0.00220462; 
//   var baseVal = 0;
//   if (weightLb <= 0.75 && length <= 15 && width <= 12 && height <= 0.75) {
//     baseVal = 2.41;
//   } else if (weightLb <= 1.25 && length <= 18 && width <= 14 && height <= 8){
//     baseVal = 3.19;
//   } else if (weightLb <= 1.5 && length <= 18 && width <= 14 && height <= 8){
//     baseVal = 4.71;
//   } else {
//     baseVal = (Math.ceil(weightLb - 2) * 0.38 ) + 4.71;
//   }
//   var x1 = (0.15*salePrice) + 1.80;
//   var x2 = baseVal+ shippingFee*weightLb;
//   var profit = ((salePrice - x1) - x2) - purchasedPrice;
//   return profit; 
// }
function calcProfit(salePrice,height,length,width,weight,region){
  var purchasedPrice  = parseFloat($('#'+region+'_purchased_price').val());
  var shippingFee  = parseFloat($('#'+region+'_amazon_shipping_cost').val());
  var weightLb = weight * 0.00220462; 
  var baseVal = 0;
  
  if (weightLb <= 0.625 && length <= 15 && width <= 12 && height <= 0.75) {
	baseVal = 2.41;
  } else if (weightLb > 0.625 && weightLb < 1 && length <= 15 && width <= 12 && height <= 0.75){
	baseVal = 2.48;
  } else if (weightLb <= 0.625 && length <= 18 && width <= 14 && height <= 8){
	baseVal = 3.19;
  } else if (weightLb > 0.625 && weightLb < 1 && length <= 18 && width <= 14 && height <= 8){
	baseVal = 3.28;
  } else if (weightLb > 1 && weightLb < 2 && length <= 18 && width <= 14 && height <= 8){
	baseVal = 4.76;
  } else if (weightLb >= 2 && weightLb < 3 && length <= 18 && width <= 14 && height <= 8){
	baseVal = 5.26;
  } else {
	if (weightLb > 3 ) {
	  var costOverWeight = Math.ceil( weightLb - 3) * 0.38 ;
	  baseVal =  costOverWeight + 5.26 ;
	}else{
	  baseVal = 5.26;
	}
  }
  
  var referralFee = sellingAmazonFee[region][0]['referralFee'];
  var variableClosingFee = sellingAmazonFee[region][0]['varClosingFee'];

  var x1 = (referralFee * salePrice ) + variableClosingFee;
  // add 0.05 monthly storage
  var x2 = (baseVal + shippingFee * weightLb) + 0.05;
  var profit = ((salePrice - x1) - x2) - purchasedPrice;
  return profit.toFixed(2); 
}
function calcFbmProfit(salesPrice,fbmVariantPrice,weight,region) {
  var weightLb = weight * 0.00220462;
  var purchasedPrice  = parseFloat($('#'+region+'_purchased_price').val());
  var referralFee = sellingAmazonFee[region][0]['referralFee'];
  var variableClosingFee = sellingAmazonFee[region][0]['varClosingFee'];
  var shippingCost = parseFloat($('#'+region+'_merchant_shipping_cost').val());
  var perPoundCost = parseFloat($('#'+region+'_merchant_price_per_pound').val());
  // for usps 
  if (weightLb < 1) {
	var shippingFee = perPoundCost;
  }else{
	var shippingFee = weightLb * perPoundCost ;
  }
  shippingFee = shippingFee + shippingCost;
  var x1 = (referralFee * salesPrice ) + variableClosingFee;
  var profit = ((((salesPrice - x1)-fbmVariantPrice)-purchasedPrice) - shippingFee ) ;
  //console.log(" fbm purchasedPrice is "+purchasedPrice+" and variant price is "+fbmVariantPrice);
  //console.log(" fbm testing  referralFee is "+referralFee+" and variableClosingFee is "+variableClosingFee+" and x1 is "+x1+" and fbmprofit is "+profit+" and weight is "+weight+" <br> shippingFee "+shippingFee+" and shippingCost "+shippingCost);
  return profit.toFixed(2);
}
function getWords(str) {
  return str.split(/\s+/).slice(0,3).join(" ");
}
</script>