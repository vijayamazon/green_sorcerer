<?php
$baseurl=base_url();
if (isset($_GET['keyword'])) {
  $keyword = $_GET['keyword'];
} else {
  $keyword = '';
}
if (isset($_GET['min_rank'])) {
  $min_rank = $_GET['min_rank'];
} else {
  $min_rank = '';
}
if (isset($_GET['max_rank'])) {
  $max_rank = $_GET['max_rank'];
} else {
  $max_rank = '';
}
if (isset($_GET['min_profit'])) {
  $min_profit = $_GET['min_profit'];
} else {
  $min_profit = '';
}
if (isset($_GET['max_profit'])) {
  $max_profit = $_GET['max_profit'];
} else {
  $max_profit = '';
}
if (isset($_GET['source'])) {
  $source = $_GET['source'];
} else {
  $source = '';
}
?>
<div class="row mb-3">
	<div class="col-md-12 text-center">
		<h1 class="mb-3"><i class="fa fa-book mr-2"></i>Products Catalog</h1>
		<form action="product_catalog" method="get">
			<div class="row justify-content-center tool-search">
				<div class="col-12">
					<div class="input-group mb-2">
						<input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="Keyword" class="form-control">
						<input type="text" name="min_rank" value="<?php echo $min_rank; ?>" placeholder="Min Rank" class="form-control">
						<input type="text" name="max_rank" value="<?php echo $max_rank; ?>" placeholder="Max Rank" class="form-control">
						<input type="text" name="min_profit" value="<?php echo $min_profit; ?>" placeholder="Min Profit" class="form-control">
						<input type="text" name="max_profit" value="<?php echo $max_profit; ?>" placeholder="Max Profit" class="form-control">
						<div class="input-group-append">
							<select id="markets">
								<?php foreach ($stores as $store) { ?>
									<option value="<?php echo $store['name']; ?>"><?php echo $store['name']; ?></option>
								<?php } ?> 
							</select>
							<button type="submit" name="search" class="btn"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div> 
</div>
<!-- <div class="padding-md" style="padding-right:3.5%;">
  <div class="row" >
	<div class="col-sm-1"></div>
	<div class="col-sm-11">
	 <div class="col-sm-10">
	   <br>
	 </div>
	 <div align="center" class="col-lg-12 col-md-6 no-padding" >
	  <h1><i class="fa fa-book"></i>  Products Catalog</h1>
	</div>  
	<div align="center" class="col-lg-12 col-md-6 no-padding" >
	  <form action="product_catalog" method="get">
		<table style="width: 100%;margin: 0 auto;" class="table table-actions-bar" border="0">
		  <tr>
			<td align="center">
			  <strong style="padding-right: 10px;">Keyword</strong><input type="text" name="keyword" value="<?php echo $keyword; ?>">
			</td>
			<td align="center">
			  <strong style="padding-right: 10px;">Min Rank</strong><input type="text" name="min_rank" value="<?php echo $min_rank; ?>">
			</td>
			<td align="center">
			  <strong style="padding-right: 10px;">Max Rank</strong><input type="text" name="max_rank" value="<?php echo $max_rank; ?>">
			</td>
			<td align="center">
			  <strong style="padding-right: 10px;">Min Profit</strong><input type="text" name="min_profit" value="<?php echo $min_profit; ?>">
			</td>
			<td align="center">
			  <strong style="padding-right: 10px;">Max Profit</strong><input type="text" name="max_profit" value="<?php echo $max_profit; ?>">
			</td>
			<td align="center">
			  <strong style="padding-right: 10px;">Source</strong>
			  <select name="source">
				<option></option>
				<?php foreach ($stores as $store) { ?>
				  <option value="<?php echo str_replace(' ', '_', $store['name']); ?>" <?php if($source == str_replace(' ', '_', $store['name'])){ echo 'selected'; }?> ><?php echo $store['name']; ?></option>
				<?php } ?>
				<option value="File_Item" <?php if($source == 'File_Item'){ echo 'selected'; }?>>File Item</option>
			  </select>
			</td>
			<td align="center">
			  <input type="submit" name="search" class="btn btn-success" value="Search">
			</td>
		  </tr>
		</table>
	  </form>
	</div> -->
	<div class="col-sm-12 col-md-12 no-padding" style="margin-right:20px; text-align: center;">
	  <!-- Show pagination links -->
	  <?php if (isset($links)) { ?>
	  <?php //echo $links ?>
	  <?php } ?>
	</div>
<div class="row mb-3">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table">
		  		<thead >
					<tr style="border-color: #eee;" >
					  <th style="vertical-align: inherit;text-align: center !important;width: 50px;" rowspan="4">Image</th>
					  <th style="vertical-align: inherit;text-align: center !important;width: 80px;" rowspan="4">ISBN</th>
					  <th style="vertical-align: inherit;text-align: center !important;width: 150px;" rowspan="4">Title</th>
					  <th style="vertical-align: inherit;text-align: center !important;width: 50px;" rowspan="4">Author</th>
					  <th style="vertical-align: inherit;text-align: center !important;width: 50px;" rowspan="4">QTY</th>
					  <th style="vertical-align: inherit;text-align: center !important;" colspan="22">Amazon</th>
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
				</tr>
				<tr>

				</tr>
				<tr >
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

				</tr>
			  </thead>
			<tbody>
			  <?php if (isset($files)) {
				foreach ($files as $key => $item) { ?>
			  <tr>
				<td align="center"><img src="<?php echo $item['image']; ?>" alt="" width="50" height="60"></td>
				<td align="center"><?php echo $item['isbn']; ?></td>
				<td align="center"><?php echo substr($item['book_title'],0,20); ?> ..</td>
				<td align="center"><?php echo $item['author']; ?></td>
				<td align="center"><?php echo $item['quantity']; ?></td>
				<td align="center"><?php echo $item['us_rank']; ?></td>
				<td align="center"><?php echo $item['us_price']; ?></td>
				<td align="center"><?php echo $item['ca_rank']; ?></td>
				<td align="center"><?php echo $item['ca_price']; ?></td>
				<td align="center"><?php echo $item['uk_rank']; ?></td>
				<td align="center"><?php echo $item['uk_price']; ?></td>
				<td align="center"><?php echo $item['de_rank']; ?></td>
				<td align="center"><?php echo $item['de_price']; ?></td>
				<td align="center"><?php echo $item['fr_rank']; ?></td>
				<td align="center"><?php echo $item['fr_price']; ?></td>
				<td align="center"><?php echo $item['it_rank']; ?></td>
				<td align="center"><?php echo $item['it_price']; ?></td>
				<td align="center"><?php echo $item['es_rank']; ?></td>
				<td align="center"><?php echo $item['es_price']; ?></td>
				<td align="center"><?php echo $item['mx_rank']; ?></td>
				<td align="center"><?php echo $item['mx_price']; ?></td>
				<td align="center"><?php echo $item['in_rank']; ?></td>
				<td align="center"><?php echo $item['in_price']; ?></td>
				<td align="center"><?php echo $item['jp_rank']; ?></td>
				<td align="center"><?php echo $item['jp_price']; ?></td>
			  </tr>
			  <?php } 
			} else {?>
			<tr>
			  <td colspan="25" align="center"><h3>No Items Found</h3></td>
			</tr>
			<?php } ?>
			</tbody>
		  </table><br><br>
		</div>
	  </div>  
	</div>         
  </div>
</div>
<script type="text/javascript">
  function getWords(str) {
  return str.split(/\s+/).slice(0,3).join(" ");
}
</script>
