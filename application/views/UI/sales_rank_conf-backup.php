<?php $baseurl=base_url(); ?>

<?php if(isset($error)) { ?>
  <div id="access-container">
    <h1 id="access-header">Access Denied</h1>
    <p id="access-content"><?= $error ?></p>
  </div>
<?php } else { ?>
  <div align="center" style="padding-top: 10px;padding-left: 100px;padding-bottom: 60px;" class="col-sm-12">
    <h3>Configuration Module</h3>
    <h4 style="color: #1C7AFF;">Total Items: <?php echo number_format($item_count);?></h4>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="content">
            <button class="accordion">Sales Rank Configuration</button>
            <div class="panel">
              <div class="container" style="margin-top: 0px;">
                <h2>Configurations</h2>
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#sales_rank" data-toggle="tab" role="tab">New Sales Rank</a></li>
                  <li><a href="#product_category" data-toggle="tab" role="tab">Product Category</a></li>
                </ul>
                <div class="tab-content">
                  <div id="sales_rank" class="tab-pane fade in active">
                    <center>
                      <form action="sales_rank_conf/updateSalesRankConf" method="post">
                        <table style="width: 20%;" class="table">
                          <tr>
                            <td>
                              Category:
                              <select name="category" required style="width: 100%;height: 25px;">
                                <option value="">Select One</option>
                                <?php foreach ($product_category as $key => $data){?>
                                  <option value="<?php echo $data['product_name']?>"><?php echo $data['product_name']?></option>
                                <?php } ?>
                              </select>
                            </td>
                            <td>
                              Profit Category:
                              <select name="profit_category" required style="width: 100%;height: 25px;">
                                <option value="FBA">FBA</option>
                                <option value="FBM">FBM</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td>Minimum: <input required type="text" name="floorValue" onkeypress="return isNumberOnly(event)" title="Only Numbers are accepted"></td>
                            <td>Maximum: <input required type="text" name="ceilValue"  onkeypress=" return isNumberOnly(event)" title="Only Numbers are accepted" style="width: 100%;"></td>
                          </tr>
                          <tr>
                            <td>Profit: <input required type="text" name="profit" onkeypress=" return isDecimal(event)" title="Only Numbers are accepted"></td>
                            <td>
                              Region:
                              <select name="region" required style="height: 25px;">
                                <option value="">Select One</option>
                                <?php foreach ($available_regions as $data) { ?>
                                  <option value="<?php echo $data['region_code']; ?>"><?php echo $data['region_name']; ?></option>
                                <?php } ?>
                              </select>
                            </td>
                          </tr>
                        </table>
                        <input  class="btn btn-success" type="submit" value="Add Configuration" name="submit">
                      </form>
                    </center>
                  </div>
                  <div id="product_category" class="tab-pane fade in ">
                    <center>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="table-responsive">
                            <table class="table-scroll table-striped">
                              <thead style="background-color: #ccc">
                                <tr>
                                  <th>#</th>
                                  <th>Product Name</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <form action="sales_rank_conf/saveProductCategory" method="post">
                                  <div class="form-group">
                                    <label for="product_name">Product Name:</label>
                                    <input type="text" name="product_name" id="product_name" required>
                                    <input type="submit" name="saveProduct" value="Save" class="btn btn-success save__btn">

                                  </div>
                                  <?php foreach ($product_category as $key => $data) { ?>
                                    <tr>
                                      <td><?php echo $key + 1;?></td>
                                      <td><?php echo $data['product_name'];?></td>
                                      <td><a href="#" onclick="deleteThisProduct('<?php echo $data['id'];?>');">Delete</a></td>
                                    </tr>
                                  <?php  } ?>
                                </form>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </center>
                    <!-- form to delete the product category -->
                    <form id="deleteProductForm" action="sales_rank_conf/deleteProductCategory" method="post">
                      <input type="hidden" id="deleteProductId" name="deleteProductId" value="">
                      <input id="productDeleter" style="display: none;" type="submit" value="Delete" name="submit">
                    </form>



                  </div>
                </div> 





              </div>
            </div>
            <div class="content">
              <button class="accordion">Pricing Configuration</button>
              <div class="panel">
                <center>
                  <form action="<?= $baseurl?>sales_rank_conf/updatePriceConfiguration" method="post" class="form-inline">
                    <table style="width:auto;" class="table">
                      <tr>
                        <td>
                          <div class="row">
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
                              <input name="dropShipColor" class="jscolor input-color" value="<?php echo $variant_price_threshold[3]['color']; ?>">
                              <input type="text" name="fbmDropShipPrice" id="fbmDropShipPrice" class="form-control" value="<?php echo $variant_price_threshold[3]['value'] ?>" onkeypress="return isDecimal(event)" title="Only Numbers are accepted" required>
                            </div>
                            <div class="form-group">
                              <label class="block-label">FBA Threshold Price:</label>
                              <input name="fbaThresholdColor" class="jscolor input-color" value="<?php echo $variant_price_threshold[1]['color']; ?>">
                              <input type="text" name="fbaThresholdPrice" id="fbaThresholdPrice" class="form-control" value="<?php echo $variant_price_threshold[1]['value'] ?>" onkeypress="return isNumberKey(event)" title="Only Numbers are accepted" required>
                            </div>
                            <div class="form-group">
                              <label class="block-label">FBM Threshold Price:</label>
                              <input name="fbmThresholdColor" class="jscolor input-color" value="<?php echo $variant_price_threshold[2]['color']; ?>">
                              <input type="text" name="fbmThresholdPrice" id="fbmThresholdPrice" class="form-control" value="<?php echo $variant_price_threshold[2]['value'] ?>" onkeypress="return isNumberKey(event)" title="Only Numbers are accepted" required>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <?php foreach ($permissions as $perm) {?>
                              <div class="form-group">
                                <input value="<?php echo $perm['perm_name']; ?>" type="checkbox" <?php if($perm['status'] === '1'){ echo 'checked=""'; }?> name="perms[]" >&nbsp&nbsp&nbsp<?php echo ucfirst(str_replace("_"," ",$perm['perm_name'])) ?>
                              </div>
                            <?php } ?>
                          </div>
                        </td>
                      </tr>
                    </table><br>
                    <input class="btn btn-success" type="submit" value="Update" name="submit">
                  </form>
                </center>
              </div>
            </div>

            <div class="content">
              <button class="accordion">Markets Configuration</button>
              <div class="panel">
                <center>
                  <form action="sales_rank_conf/updateMarkets" method="post">
                    <!-- <div style="text-align: left;width: 170px; padding-top: 20px;">
                      <?php foreach ($stores as $market) { ?>
                        <input value="<?php echo $market['store_id']; ?>" type="checkbox" <?php if($market['status'] === '1'){ echo 'checked=""'; }?> name="stores[]" >&nbsp&nbsp&nbsp<?php echo $market['name'] ?>
                        <br>
                      <?php } ?>
                      <br>
                      <input type="text" name="marketAdd" placeholder="Enter New Marketplace">
                    </div> -->
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group market__place">
                          <label for="markets">Market Name:</label>
                          <input type="text" id="marketName" name="marketAdd" placeholder="Enter New Marketplace">
                          <input type="hidden" name="marketId" id="marketId">
                          <input class="btn btn-success update__btn" type="submit" value="Update/Add" name="submit">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="table-responsive market__place_table">
                          <table class="table-scroll table-striped">
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
                        </div>
                      </div> 
                    </form>
                    <form action="sales_rank_conf/deleteMarket" method="post">
                      <input type="hidden" name="marketid" id="marketid">
                      <input id="marketDeleter" style="display: none;" type="submit" value="Delete" name="submit">
                    </form>
                  </center>
                </div>
              </div>
              <div class="content">
                <button class="accordion">Region Configuration</button>
                <div class="panel">
                  <form action="sales_rank_conf/updateRegion" method="post">
                    <div style="text-align: left;width: inherit; padding-top: 20px; padding-left: 20px;">
                      <div class="row">
                        <?php foreach ($available_regions_buybacks as $region) {?>
                          <div class="col-sm-4">
                            <input style="width: 40px;" name="regionColor[<?php echo $region['region_code']; ?>]" value="<?php echo $region['color']; ?>" class="jscolor"><input value="<?php echo $region['region_code']; ?>" type="checkbox" <?php if($region['status'] === '1'){ echo 'checked=""'; }?> name="availableRegion[]" >&nbsp&nbsp&nbsp<?php echo $region['region_name']?>
                          </div>

                        <?php } ?>
                      </div>
                      <div class="row">
                        <center>
                          <input class="btn btn-success" type="submit" value="Update" name="submit">
                        </center>
                      </div>
                      <br>
                    </div>
                  </form>
                </div>
              </div>
              <div class="content">
                <button class="accordion">Shipping Fee Configuration</button>
                <div class="panel">
                  <div class="container" style="margin-top: 0px;">
                    <h2>Configurations</h2>
                    <ul class="nav nav-tabs">
                      <li class="active">
                        <a href="#amazon_shipping" data-toggle="tab" role="tab">Amazon Shipping Fee</a>
                      </li>
                      <li>
                        <a href="#usps_fee" data-toggle="tab" role="tab">USPS Shipping Fee
                        </a>
                      </li>
                    </ul>
                    <div class="tab-content">
                      <div id="amazon_shipping" class="tab-pane fade in active">
                        <center>
                         <form action="sales_rank_conf/updateAmazonShippingFee" method="post" style="padding-top: 20px;">
                          <div class="row">
                            <?php foreach ($available_regions as $data) { ?>
                              <div class="col-sm-4" style="margin-bottom: 5px;">
                                <div class="col-sm-3"><?php echo $data['region_code']; ?>:</div>
                                <div class="col-sm-9"><input style="width:inherit;" type="text" value="<?php echo $data['amazon_shipping_cost']; ?>" name="amazonShippings[<?php echo $data['region_code']; ?>]" onkeypress="return isDecimal(event)" title="Only Numbers are accepted"></div>
                              </div>
                            <?php } ?>
                          </div>
                          <div class="row" style="padding: 10px; ">
                            <center>
                              <input class="btn btn-success" type="submit" value="Update" name="submit">
                            </center>
                          </div>
                        </form>
                      </center>
                    </div>
                    <div id="usps_fee" class="tab-pane fade">
                      <center>
                        <div class="row">
                          <div class="col-sm-12">
                            <ul class="nav nav-tabs nav-justified">
                              <li class="active"><a href="#us_usps_config" data-toggle="tab" role="tab" >USA</a></li>
                              <li><a href="#ca_usps_config" data-toggle="tab" role="tab">Canada</a></li>
                              <li><a href="#uk_usps_config" data-toggle="tab" role="tab">UK</a></li>
                              <li><a href="#mx_usps_config" data-toggle="tab" role="tab">Mexico</a></li>
                              <li><a href="#in_usps_config" data-toggle="tab" role="tab">India</a></li>
                              <li><a href="#jp_usps_config" data-toggle="tab" role="tab">Japan</a></li>
                              <li><a href="#de_usps_config" data-toggle="tab" role="tab">Denmark</a></li>
                              <li><a href="#fr_usps_config" data-toggle="tab" role="tab">France</a></li>
                              <li><a href="#it_usps_config" data-toggle="tab" role="tab">Italy</a></li>
                              <li><a href="#es_usps_config" data-toggle="tab" role="tab">Spain</a></li>
                            </ul>
                            <div class="tab-content">
                              <?php foreach ($available_regions as $key => $value) {?>

                                <?php if($value['region_code'] == 'US'){?>
                                  <div id="<?php echo strtolower($value['region_code'])?>_usps_config" class="tab-pane fade in active">
                                    <center>
                                      <div class="row">
                                        <div class="col-sm-12">
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
                                      </div>
                                    </center>
                                  </div>
                                <?php } else { ?>
                                 <!--  <h2>in else <?php strtolower($value['region_code'])?> </h2> -->
                                 <div id="<?php echo strtolower($value['region_code'])?>_usps_config" class="tab-pane fade">
                                  <center>
                                    <div class="row">
                                      <div class="col-sm-12">
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
                                    </div>
                                  </center>
                                </div>
                              <?php }?>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </center>
                    <!-- form to delete the product category -->
                    <form id="deleteProductForm" action="sales_rank_conf/deleteProductCategory" method="post">
                      <input type="hidden" id="deleteProductId" name="deleteProductId" value="">
                      <input id="productDeleter" style="display: none;" type="submit" value="Delete" name="submit">
                    </form>



                  </div>
                </div> 





              </div>
            </div>
            <div class="content">
              <button class="accordion">Special ISBN List</button>
              <div class="panel">
                <form action="sales_rank_conf/updateSpecialList" method="post">
                  <textarea name="list" style="width: 95%; height: 150px; margin-top: 10px;"><?php print_r($special_list[0]['isbn_list']); ?></textarea><br><br>
                  <input  class="btn btn-success" type="submit" value="Update" name="submit" style="margin-bottom: 20px;">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <br><br>
      <div class="container" style="margin-top: 0px;">
        <h2>Configurations</h2>
        <ul class="nav nav-tabs nav-justified">
          <li class="active"><a href="#us_config" data-toggle="tab" role="tab" >USA</a></li>
          <li><a href="#ca_config" data-toggle="tab" role="tab">Canada</a></li>
          <li><a href="#uk_config" data-toggle="tab" role="tab">UK</a></li>
          <li><a href="#mx_config" data-toggle="tab" role="tab">Mexico</a></li>
          <li><a href="#in_config" data-toggle="tab" role="tab">India</a></li>
          <li><a href="#jp_config" data-toggle="tab" role="tab">Japan</a></li>
          <li><a href="#de_config" data-toggle="tab" role="tab">Denmark</a></li>
          <li><a href="#fr_config" data-toggle="tab" role="tab">France</a></li>
          <li><a href="#it_config" data-toggle="tab" role="tab">Italy</a></li>
          <li><a href="#es_config" data-toggle="tab" role="tab">Spain</a></li>
        </ul>
        <div class="tab-content">
          <div id="us_config" class="tab-pane fade in active">
            <center>
              <div class="row">
                <div class="col-sm-12">
                  <div class="table-responsive">
                    <table class="table-scroll table-striped">
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
                </div>
              </center>
            </div>
            <div id="ca_config" class="tab-pane fade">
              <center>
                <div class="row">
                  <div class="col-sm-12">
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
                  </div>
                </center>
              </div>
              <div id="uk_config" class="tab-pane fade">
                <center>
                  <div class="row">
                    <div class="col-sm-12">
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
                    </div>
                  </center>
                </div>
                <div id="mx_config" class="tab-pane fade">
                  <center>
                    <div class="row">
                      <div class="col-sm-12">
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
                      </div>
                    </center>
                  </div>
                  <div id="in_config" class="tab-pane fade">
                   <center>
                    <div class="row">
                      <div class="col-sm-12">
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
                      </div>
                    </center>
                  </div>
                  <div id="jp_config" class="tab-pane fade">
                    <center>
                      <div class="row">
                        <div class="col-sm-12">
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
                        </div>
                      </center>
                    </div>

                    <div id="de_config" class="tab-pane fade">
                      <center>
                        <div class="row">
                          <div class="col-sm-12">
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
                          </div>
                        </center>
                      </div>
                      <div id="fr_config" class="tab-pane fade">
                       <center>
                        <div class="row">
                          <div class="col-sm-12">
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
                          </div>
                        </center>
                      </div>
                      <div id="it_config" class="tab-pane fade">
                       <center>
                        <div class="row">
                          <div class="col-sm-12">
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
                          </div>
                        </center>
                      </div>
                      <div id="es_config" class="tab-pane fade">
                        <center>
                          <div class="row">
                            <div class="col-sm-12">
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
                            </div>
                          </center>
                        </div>
                      </div>

                      <!-- form to delete the configuration -->
                      <form id="deleteForm" action="sales_rank_conf/deleteConfiguration" method="post">
                        <input type="hidden" id="deleteId" name="deleteId" value="">
                        <input id="deleter" style="display: none;" type="submit" value="Delete" name="submit">
                      </form>
                    </div>
                  <?php } ?>

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
