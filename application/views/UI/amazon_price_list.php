<?php
$baseurl=base_url();
//print_r($this->session);exit;
?>
<div class="main-container" ng-controller='invCtrl'>
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

<div class="padding-md" style="padding-right:3.5%;">
  <div class="row" >
    <div class="col-sm-1"></div>
    <div class="col-sm-11">
     <div class="col-sm-10">
       <br>
     </div>
     <div class="col-lg-12 col-md-6 no-padding" style="margin-top:30px;">
      <div class="row" >
        <div class="col-sm-6" id='campaign_list'><h4><i class="fa fa-line-chart"></i> Amazon Multiple Country Price Details</h4></div>
        <div class="col-sm-12">
          <div class="col-sm-3 pagination">
            <form role="form">
              <div class="form-group contact-search m-b-30">
                <input type="text" placeholder="Search..." ng-model = 'filter.search' class="form-control" name='search' id="search">
              </div>
              <!-- form-group -->
            </form>
            <div class="form-group">  
             <div id="autoSave"></div>  
           </div> 
         </div>
         
         
         <div class="col-sm-8">

           <a href='#' class="btn btn-warning" style="margin-top:20px;margin-left:5px" data-toggle="modal" data-target="#import">Import EAN</a> 
           <a href='#' class="btn btn-warning"  style="margin-top:20px;margin-left:5px" data-toggle="modal" data-target="#desc">Scan Barcode</a> 
           <a href='#' ng-click='export_data()' class="btn btn-success" style="margin-top:20px;margin-left:8px;">Export Data</a> 


           <ul class="pagination pull-right ">
            <li ng-class="prevPageDisabled()">
              <a href="javascript:void(0)" ng-click="prevPage()">« Prev</a>
            </li>
            <li ng-repeat="n in range()" ng-class="{active: n == currentPage}" ng-click="setPage(n)">
              <a href="javascript:void(0)">{{n+1}}</a>
            </li>
            <li ng-class="nextPageDisabled()">
              <a href="javascript:void(0)" ng-click="nextPage()">Next »</a>
            </li>
          </ul>
        </div>
      </div>

    </div>  
    <div style="margin-left: 700px;" class="col-sm-12 col-md-12">
      <select id="markets">
        <?php foreach ($stores as $store) { ?>
        <option value="<?php echo $store['name']; ?>"><?php echo $store['name']; ?></option>
        <?php } ?> 
      </select>
    </div>
    <div style="margin-left: 700px; display: none;" class="loader col-sm-12 col-md-12"></div> 
    <div class="col-sm-12 col-md-12">
      <div style="padding-left: 185px;" class="col-sm-3" id="loadedImage"></div>
      <div class="col-sm-9" id="loadedStats" style="display: none;">
        <table border=0 width="70%">
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
    <div id="dbLoader" style="display: none;" align="center" class="col-sm-12 col-md-12">
      <div class="loaderSmall"></div>
      Data Insertion in process. Please Wait !
    </div>
    <div id="dbSuccess" style="display: none;" align="center" class="col-sm-12 col-md-12">
      <div id="dbSuccessMsg" ></div>
      <div class="checkmark-circle">
        <div class="background"></div>
        <div class="checkmark draw"></div>
      </div>
    </div>


    <div class="col-sm-11 col-md-6 no-padding" style="width:100%;margin-right:20px;">
     <div class="table-responsive"> <br>   <br>  
      <table class="table table-actions-bar" border="1">
        <thead >
          <tr style="border-color: #eee;" >
            <th style="vertical-align: inherit;text-align: center !important;width: 50px;" rowspan="3">Image</th>
            <th style="vertical-align: inherit;text-align: center !important;width: 80px;" rowspan="3">ISBN</th>
            <th style="vertical-align: inherit;text-align: center !important;width: 200px;" rowspan="3">Title</th>
            <th style="vertical-align: inherit;text-align: center !important;width: 50px;" rowspan="3">Weight</th>
            <th style="vertical-align: inherit;text-align: center !important;" colspan="14">Amazon</th>
            <!-- <th style="vertical-align: inherit;text-align: center !important;width: 50px;" rowspan="3">Price</th> -->
            <th style="vertical-align: inherit;text-align: center !important;width: 50px;" rowspan="3">Keepa</th>
          </tr>
          <tr>
            <th colspan="2" style="text-align: center !important;">USA</th>
            <th colspan="2" style="text-align: center !important;">Canada</th>
            <th colspan="2" style="text-align: center !important;">UK</th>
            <th colspan="2" style="text-align: center !important;">Mexico</th>
            <th colspan="2" style="text-align: center !important;">India</th>
            <th colspan="2" style="text-align: center !important;">Japan</th>
            <th colspan="2" style="text-align: center !important;">Australia</th>
          </tr>
          <tr >
            <th style="width: 60px;text-align: center !important;" ><i class="fa fa-line-chart"></i></th>
            <th style="width: 60px;text-align: center !important;" ><i class="fa fa-usd"></i></th>
            <th style="width: 60px;text-align: center !important;" ><i class="fa fa-line-chart"></i></th>
            <th style="width: 60px;text-align: center !important;" ><i class="fa fa-usd"></i></th>
            <th style="width: 60px;text-align: center !important;" ><i class="fa fa-line-chart"></i></th>
            <th style="width: 60px;text-align: center !important;" ><i class="fa fa-usd"></i></th>
            <th style="width: 60px;text-align: center !important;" ><i class="fa fa-line-chart"></i></th>
            <th style="width: 60px;text-align: center !important;" ><i class="fa fa-usd"></i></th>
            <th style="width: 60px;text-align: center !important;" ><i class="fa fa-line-chart"></i></th>
            <th style="width: 60px;text-align: center !important;" ><i class="fa fa-usd"></i></th>
            <th style="width: 60px;text-align: center !important;" ><i class="fa fa-line-chart"></i></th>
            <th style="width: 60px;text-align: center !important;" ><i class="fa fa-usd"></i></th>
            <th style="width: 60px;text-align: center !important;" ><i class="fa fa-line-chart"></i></th>
            <th style="width: 60px;text-align: center !important;" ><i class="fa fa-usd"></i></th>
          </tr>
            <!-- <th>Amz US Rank</th>
            <th>Amz US Price</th>
            <th>Amz CA Rank</th>
            <th>Amz CA Price</th>
            <th>Amz UK Rank</th>
            <th>Amz UK Price</th>
            <th>Amz MX Rank</th>
            <th>Amz MX Price</th>
            <th>Amz IN Rank</th>
            <th>Amz IN Price</th>
            <th>Amz JP Rank</th>
            <th>Amz JP Price</th>
            <th>Amz AS Rank</th>
            <th>Amz AS Price</th> -->
        </thead>

        <tbody >
          <tr  ng-show='transactionList.length==0' >
            <td colspan="18" class="text-center"><h2>No Product details found</h2></td>
          </tr>
          <tr  ng-repeat="tnx in transactionList " ng-style="{'background-color':tnx.pro_color }">
            <div  ng-if="tnx.pro_sound==s1">
              <audio  ng-if="tnx.pro_sound ==s1"  id="myAudio" >

                <source    src="<?php echo base_url()."asset/sound/s7.mp3"?>" type="audio/mpeg">
                </audio> </div>

                <td>
                  <img ng-if="tnx.pro_image.length > 0" src="{{tnx.pro_image}}" alt="" width='50' height="50">
                  <img ng-if="tnx.pro_image==''" src="<?php echo base_url().'asset/img/no_image.gif'?>" width='50' height='50' alt="">
                </td> 
                <td align="center">{{tnx.pro_isbn}}</td>
                <td align="center">{{tnx.pro_title | limitTo:50}}</td>
                <td align="center">{{tnx.pro_weight}}</td>
                <td align="center">{{tnx.pro_us_rank}}</td>
                <td align="center">{{tnx.pro_us_price}}</td>
                <td align="center">{{tnx.pro_ca_rank}}</td>
                <td align="center">{{tnx.pro_ca_price}}</td>
                <td align="center">{{tnx.pro_uk_rank}}</td>
                <td align="center">{{tnx.pro_uk_price}}</td>
                <td align="center">{{tnx.pro_mx_rank}}</td>
                <td align="center">{{tnx.pro_mx_price}}</td>
                <td align="center">{{tnx.pro_in_rank}}</td>
                <td align="center">{{tnx.pro_in_price}}</td>
                <td align="center">{{tnx.pro_jp_rank}}</td>
                <td align="center">{{tnx.pro_jp_price}}</td>
                <td align="center">{{tnx.pro_as_rank}}</td>
                <td align="center">{{tnx.pro_as_price}}</td>
                <!-- <td align="center"><input style="width: 50px;" id="price_{{tnx.pro_id}}" type="number" value="{{tnx.purchased_price}}"><br>
                  <span id="tick{{tnx.pro_id}}" style="display: none;">&#10003;</span>
                  <a href="#" ng-click="updatePrice(tnx.pro_id)" >Update</a>
                </td> -->
                <td><a href="#"  ng-click="keepa(tnx.pro_isbn)" >Keepa</a></td>
              </tr>



            </tbody>
          </table>

        </div>
      </div>  
      <div class="col-sm-11">
       <a href='#' ng-click='remove_all()' class="btn btn-danger" style="margin-top:20px;margin-left:100px;">Remove Data</a> 
       <ul class="pagination pull-right">
        <li ng-class="prevPageDisabled()">
          <a href="javascript:void(0)" ng-click="prevPage()">« Prev</a>
        </li>
        <li ng-repeat="n in range()" ng-class="{active: n == currentPage}" ng-click="setPage(n)">
          <a href="javascript:void(0)">{{n+1}}</a>
        </li>
        <li ng-class="nextPageDisabled()">
          <a href="javascript:void(0)" ng-click="nextPage()">Next »</a>
        </li>
      </ul>


    </div>

  </div>         

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
<script>
  var x = document.getElementById("myAudio").play();
</script> 
<script>  
 $(document).ready(function(){  
  function autoSave()  
  {  
   var search = $('#search').val();  

   if(search != '')  
   {  
    $.ajax({  
     url:"<?php echo $baseurl ."amazon_price_list/upload_barcode/"?>",
     method:"POST",  
     data:{search:search},  
     dataType:"text",  
     success:function(data)  
     {  
       $('#autoSave').text("Scccess!"); 
       window.setTimeout(function(){location.reload()},1000)
       setInterval(function(){  
         $('#autoSave').text("Scccess!")  
       }, 2000); 

     }  
   });  
  }             	
}  
setInterval(function(){   
 autoSave();   
}, 500);  

}); 

 $(document).ready(function(){
  $.ajax({ url: "<?php echo $baseurl ."amazon_price_list/cron_run/"?>",
    context: document.body,
    success: function(){

    }});

});		     



</script>

<script type="text/javascript">
  crawlApp.factory('invFactory', ['$http', '$q','limitToFilter', 'Upload',function($http,$q,limitToFilter,Upload) {


    var inv_list_url  ="<?php echo $baseurl ."amazon_price_list/get_product_list/"?>";
    var p_path        =   "<?php echo $baseurl."amazon_price_list/import_data/"?>";
    var d_path        =   "<?php echo $baseurl."amazon_price_list/export_data/"?>";
    var r_path        =   "<?php echo $baseurl."amazon_price_list/remove_data/"?>"; 
    var c_path        =   "<?php echo $baseurl."amazon_price_list/cron_run/"?>";
    
    var import_data=function(file)
    {
     return Upload.upload({
      url: p_path,
      data: {import_file: file},
    });

   }
   var download_data=function(file)
   {
    return $http({
      method: "post",
      url:d_path,
      data:{
        export_id:1
      }
    }); 


  }
  var cron_run=function(file)
  {
    return $http({
      method: "post",
      url:c_path,
      data:{
        cron_id:1
      }
    }); 


  }
  var update_amazon_api=function(api)
  {
   return $http({
    method: "post",
    url:"<?php echo $baseurl.'amazon_price_list/update_amazon_api'?>",
    data:{
      api_detail:angular.toJson(api)
    }
  }); 

 };

 var remove_data=function(file)
 {
  return $http({
    method: "post",
    url:r_path,
    data:{
      remove_id:1
    }
  }); 


}

var get_transaction_list = function (orderby,direction,offset,limit,search) 
{
  var deferred = $q.defer();
  var path =inv_list_url+orderby+'/'+direction+'/'+offset+'/'+limit+'/'+search;
  $http.get(path)
  .success(function(data,status,headers,config){deferred.resolve(data);})
  .error(function(data, status, headers, config) { deferred.reject(status);});
  return deferred.promise;
};
var get_data = function () {
  var dataset_path="<?php echo $baseurl.'amazon_price_list/get_pre_data'?>";
  var deferred = $q.defer();
  var path =dataset_path;

  $http.get(path)
  .success(function(data,status,headers,config){deferred.resolve(data);})
  .error(function(data, status, headers, config) { deferred.reject(status);});

  return deferred.promise;
};

return {
  get_transaction_list:get_transaction_list,
  get_data:get_data,
  update_amazon_api:update_amazon_api,
  import_data:import_data,
  download_data:download_data,
  cron_run:cron_run,
  remove_data:remove_data

};

}]);
  crawlApp.controller('invCtrl', ['$scope','$parse','$window','invFactory','$http','limitToFilter','$timeout',function($scope,$parse,$window,invFactory,$http,limitToFilter,$timeout) {
    $scope.transactionList=[];
    $scope.orderList=[];
    $scope.filter={};
    $scope.filter.search='';
    $scope.amz_api={};
    $scope.amz_api.seller_id='';
    $scope.amz_api.access_key='';
    $scope.filter.upload='CSV';
    $scope.selectedProduct=[];
    $scope.checkStatus='N';
    $scope.add_new=function()
    {
      $scope.amz_api.seller_id='';

    }
    $scope.add_new1=function()
    {
      $scope.amz_api.access_key='';

    }
    // $scope.updatePrice=function(id)
    // {
    //   $.ajax({  
    //     url:"<?php echo $baseurl ."sales_rank_conf/updatePriceAll/"?>",
    //    method:"POST",    
    //    dataType:"json",  
    //    success:function(data)  
    //    {  
    //     alert("Updated Successfully");
    //     $("#tick"+id).show();
    //    }  
    //  });

    // }
    $scope.keepa=function(id)
    {
      $('#loadedImage').html("");
      $('#loadedStats').hide();
      $.ajax({  
       url:"https://api.keepa.com/product?key=9uuqu3qdmfttr1al5o3v8t6rbh9gqlqqhgb9952htq0mmev9nvf5mtt3lt0do6mf&domain=1&code="+id,
       method:"GET",    
       dataType:"json",
       beforeSend: function() {
        $('.loader').show();
       },  
       success:function(data)  
       {  
        $('.loader').hide();
        var img = '<img src="https://images-na.ssl-images-amazon.com/images/I/'+data['products'][0]['imagesCSV']+'" alt="" width="200" height="300">';
        var amazonPrice = '$'+parseFloat(data['products'][0]['csv'][0][data['products'][0]['csv'][0].length-1]/100).toFixed(2);
        var newPrice = '$'+parseFloat(data['products'][0]['csv'][1][data['products'][0]['csv'][1].length-1]/100).toFixed(2);
        var usedPrice = '$'+parseFloat(data['products'][0]['csv'][2][data['products'][0]['csv'][2].length-1]/100).toFixed(2);
        var countNew = data['products'][0]['csv'][11][data['products'][0]['csv'][11].length-1];
        var countUsed = data['products'][0]['csv'][12][data['products'][0]['csv'][12].length-1];
        var countHtml = 'New: '+countNew+'<br>Used: '+countUsed;
        if (amazonPrice == '$-0.01') { amazonPrice = 'N/A';}
        if (newPrice == '$-0.01') { newPrice = 'N/A';}
        if (usedPrice == '$-0.01') { usedPrice = 'N/A';}  
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
        $scope.insertProduct(id);
       }  
     });
      
    }
    $scope.insertProduct=function(id)
    {
      var store = $('#markets').val();
      $.ajax({  
       url:"<?php echo $baseurl ."amazon_price_list/insertProduct/"?>",
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
        $('#dbSuccess').fadeOut(2000);
        $('#dbSuccessMsg').html(json['msg']);

       }
     });

    }
    $scope.ord={};
    $scope.show_order_details=function(tnx)
    {
      $scope.ord=tnx;

    }

    $scope.reset=function()
    {
      $scope.filter={};
      $scope.filter.barcode='';
    }
    $scope.reset();


    $scope.block_site=function()
    {
      $.blockUI({ css: { 
        border: 'none', 
        padding: '3px', 
        backgroundColor: '#000', 
        '-webkit-border-radius': '10px', 
        '-moz-border-radius': '10px', 
        opacity: .5, 
        color: '#fff'

      },baseZ:9999});

    }

    $scope.itemsPerPage = 25;
    $scope.currentPage = 0;
    $scope.sortorder='pro_asin';
    $scope.direction='DESC';
    $scope.searchJSON=[];
    $scope.filterquery=[];
    $scope.order={};

    
    $scope.range = function()
    {
      var rangeSize = 6;
      var ret = [];
      var start;

      start = $scope.currentPage;

      if ( start > $scope.pageCount()-rangeSize ) {
        start = $scope.pageCount()-rangeSize;
      }

      for (var i=start; i<start+rangeSize; i++) {
        if(i>0)
          ret.push(i);
      }
      return ret;
    };

    $scope.prevPage = function()
    {
      if ($scope.currentPage > 0) 
      {
        $scope.currentPage--;
      }
    };

    $scope.prevPageDisabled = function()
    {
      return $scope.currentPage === 0 ? "disabled" : "";
    };

    $scope.nextPage = function()
    {
      if ($scope.currentPage < $scope.pageCount() - 1)
      {
        $scope.currentPage++;
      }
    };

    $scope.nextPageDisabled = function()
    {
      return $scope.currentPage === $scope.pageCount() - 1 ? "disabled" : "";
    };

    $scope.pageCount = function() 
    {
      return Math.ceil($scope.total/$scope.itemsPerPage);
    };

    $scope.setPage = function(n)
    {
      if (n > 0 && n < $scope.pageCount()) 
      {
        $scope.currentPage = n;
      }
    };

    $scope.$watch("currentPage",function(newValue, oldValue) 
    {
     $scope.get_transaction_list(newValue);
   });

    $scope.get_transaction_list=function(currentPage)
    {
      $scope.block_site();
      var promise= invFactory.get_transaction_list($scope.sortorder,$scope.direction,currentPage*$scope.itemsPerPage,$scope.itemsPerPage,$scope.searchJSON);
      promise.then(function(value){
        $.unblockUI();
        if(value.status_code==1)
        {

          $scope.transactionList=value.datalist;
          $scope.total=value.total;
          $scope.outstanding=value.outstanding;

        }
        else
        {
          $scope.transactionList=[];
          $scope.total=0;
          $scope.outstanding=value.outstanding;
          console.log(value);

        }     
      }, 
      function(reason) 
      {
        console.log("Reason"+reason);
      });
    }

    $scope.filtergrid=function()
    {
     $scope.filterquery=[
     {searchtext:$scope.filter.search}

     ];
     var argum=JSON.stringify($scope.filterquery);
     $scope.searchJSON=encodeURIComponent(argum);
     $scope.get_transaction_list(0);

   }

   $scope.show_more_details=function(tnx)
   {
     $scope.prod_feature=tnx.lem_bullet;
     $scope.prod_desc=tnx.lem_desc;
     $('#desc').modal('show');

   }

   $scope.update_product_info=function()
   {
     if($scope.amzForm.$valid) 
     {

      $scope.block_site();
      invFactory.update_product_info($scope.cpn)
      .success(
        function( html )
        {
          $.unblockUI();
          console.log(html);
          if(html.status_code==0)
          {
           swal('Error!',html.status_text,'error');
         }                    
         else if(html.status_code==1)
         {
           swal('Success!',html.status_text,'success');
         }
         $scope.currentPage=0;
       }
       )
      .error(
       function(data, status, headers, config)
       {

       }

       );              
    }
    else
    {
      swal('Error!',"Input error please try again",'error');
    }                       
  }
  $scope.search_product=function()
  {

   $scope.block_site();
   invFactory.search_amazon_product($scope.cpn)
   .success(
    function( html )
    {
     $.unblockUI(); 
     if(html.status_code=='0')
     {
       swal('Error!',html.status_text,'error');
     }
     if(html.status_code == '1')
     {
      $scope.items=html.items;
    }
  }
  )
   .error(
     function(data, status, headers, config) {
       if(status == 404)
       {
        alert("Page Missing");
      }
    }

    );  


 }

 $scope.calc_profit=function()
 {
  if(parseFloat($scope.cpn.act_price) > 0 && parseFloat($scope.cpn.itm_price) > 0 )
  {
    var act_price = parseFloat($scope.cpn.act_price);
    var sl_price = parseFloat($scope.cpn.itm_price);
    var amz_fee=sl_price * (15/100);
    var amazon_fee_deducted=sl_price-amz_fee;
    var earnings=amazon_fee_deducted-act_price;
    $scope.cpn.profit=earnings;
  }
  else
  {
    $scope.cpn.profit=''; 
  }
}

$scope.select_all=function()
{
  $scope.showbar=true;
  console.log("Before Select");
  console.log($scope.selectedProduct);

  for(i=0;i< $scope.transactionList.length;i++)
  {
        // $scope.selected.push($scope.pagedItems[i].asin);
        $scope.addToArray($scope.selectedProduct,$scope.transactionList[i].pro_id)  
      }
      $scope.selectcount=$scope.selectedProduct.length;
      $scope.totalcount=$scope.total;
      console.log("After Select");
      console.log($scope.selectedProduct);
      
    }

    $scope.clear_all=function()
    {
      console.log("Before Cleared");
      console.log($scope.selectedProduct);
      
      $scope.clearArray($scope.selectedProduct);
      console.log("After Cleared");
      console.log($scope.selectedProduct);
      
    }

    $scope.checkExist=function(arr,item)
    {
      if (angular.isArray(arr)) {
        for (var i = arr.length; i--;) {
          if (angular.equals(arr[i], item)) {
            return true;
          }
        }
      }
      return false;
    }

    $scope.addToArray=function(arr,item)
    {
      arr = angular.isArray(arr) ? arr : [];
      if(!$scope.checkExist(arr, item)) 
      {
        arr.push(item);
      }
    }
    $scope.removeFromArray=function(arr,item)
    {
      arr = angular.isArray(arr) ? arr : [];
      for (var i = arr.length; i--;) 
      {
        if (angular.equals(arr[i], item)) 
        {
          arr.splice(i, 1); 
        }
      }
    }

    $scope.clearArray=function(arr)
    {
     if (angular.isArray(arr)) 
     {
       for (var i = arr.length; i--;)
       {
         arr.splice(i, 1);
       }
     }
   }

   $scope.$watch("selectedProduct.length",
     function(newValue, oldValue) 
     {
      console.log($scope.selectedProduct);
      if(newValue < $scope.transactionList.length)
      {
        $scope.checkStatus='N';
      }
    });

       // $scope.changeSelectAllstatus=function()
       // {
       //  alert($scope.selectedProduct.length);
       // }
       $scope.statusCheck=function()
       {

         console.log("checkStatus");
         console.log($scope.checkStatus);

         if($scope.checkStatus=='Y')
         {
          $scope.select_all();
        }
        else if($scope.checkStatus=='N')
        {
          $scope.clear_all();
        }
      }        


      $scope.change_order=function(col)
      {
       console.log('roder');
       $scope.sortorder=col;

       if($scope.direction=='ASC')
        $scope.direction='DESC';
      else if($scope.direction=='DESC')
        $scope.direction='ASC';  
      $scope.currentPage=0;
      $scope.get_transaction_list($scope.currentPage);

    }
    $scope.show_graph=function(asn)
    {
      console.log(asn);

      $scope.graph={};
      $scope.graph.sku=asn.prod_sku;





      invFactory.get_graph_data(asn.prod_sku)
      .success(
        function( html )
        {
          console.log(html);
          if(html.status_code==0)
          {

           swal('Error!',html.status_text,'error');
         }                    
         else if(html.status_code==1)
         {
          $('#chart').modal('show');
          $scope.draw_graph(html.payload);
        }
      }
      )
      .error(
       function(data, status, headers, config)
       {

       }

       );              


    }
    $scope.draw_graph=function(graph_data)
    {
      $("#area-example").empty();
      setTimeout(function(){

        Morris.Bar({
          element: 'area-example',
          data: graph_data,
          xkey: 'order_date',
          ykeys: ['order_count'],
          labels: ['Order'],
        });
            // When you open modal several times Morris charts over loading. So this is for destory to over loades Morris charts.
            // If you have better way please share it. 
            if($('#area-example').find('svg').length > 1){
                // Morris Charts creates svg by append, you need to remove first SVG
                $('#area-example svg:first').remove();
                // Also Morris Charts created for hover div by prepend, you need to remove last DIV
                $(".morris-hover:last").remove();
              }
            // Smooth Loading
            $('.js-loading').addClass('hidden');
          },400);
    }
    $scope.upload_barcode=function()
    {
     if($scope.filter.barcode.lenght<=0 )
     {
      swal('Error!',"EANs are Empty",'error');
    }
    else
    {
      invFactory.upload_barcode($scope.filter)
      .success(
        function( html )
        {
          console.log(html);
          if(html.status_code==0)
          {
           swal('Error!',html.status_text,'error');
         }                    
         else if(html.status_code==1)
         {

           swal('Success!',html.status_text,'success');

         }

       }
       )
      .error(
       function(data, status, headers, config)
       {

       }

       );              
    }  

  }
  $scope.get_predata = function()
  {
    var promise=invFactory.get_data();
    promise.then(
     function(response)
     {
      if(response.status_code == '1')
      {

        $scope.total_imported=response.total_imported[0];

      }
      else
      {
       swal('Error!',response.status_text,'error');
     }
   }, 
   function(reason)
   {
     $scope.serverErrorHandler(reason);
   }
   );
  }        
  $scope.get_predata();
  $scope.remove_product=function()
  {
    if($scope.selectedProduct.length > 0) 
    {

      swal({
        title: "Are you sure remove product?",
        text: "You will not be able to undo!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, I am sure!',
        cancelButtonText: "No, cancel it!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {
          $scope.block_site();
          invFactory.remove_product($scope.selectedProduct)
          .success(
            function( html )
            {
              console.log(html);
              $.unblockUI(); 
              if(html.status_code==0)
              {
               swal('Error!',html.status_text,'error');
             }                    
             else if(html.status_code==1)
             {
               swal('Success!',html.status_text,'success');
             }
             $scope.get_transaction_list($scope.currentPage);
           }
           )
          .error(
           function(data, status, headers, config)
           {

           }

           );              

        } else {
          swal("Cancelled", "Delete cancelled:)", "error");
        }
      }); 
    }
    else
    {
     swal('Error!',"Please select some SKU",'error');
   }
 }

 $scope.update_amazon_api=function()
 {
   if($scope.amzForm.$valid) 
   {
    invFactory.update_amazon_api($scope.amz_api)
    .success(
      function( html )
      {
        console.log(html);
        if(html.status_code==0)
        {
         swal('Error!',html.status_text,'error');
       }                    
       else if(html.status_code==1)
       {
         swal('Success!',html.status_text,'success');
       }

     }
     )
    .error(
     function(data, status, headers, config)
     {

     }

     );              
  }
  else
  {
    swal('Error!',"Input error please try again",'error');
  }                       
}




$scope.uploadImport = function(file) 
{
  $scope.block_site();
  invFactory.import_data(file)
  .then(function (response)
  {
    $.unblockUI(); 
    if(angular.isDefined(file))
    {
      $timeout(function () {
        file.result = response.data;
      });

    }
    if(response.data.status_code == '1')
    {
     swal('Success!',response.data.status_text,'success');
   }
   else
   {
     swal("Error!",response.data.status_text,'error');
   }
 },
 function (response) 
 {
  if (response.status > 0)
    $scope.errorMsg = response.status + ': ' + response.data;
},
function (evt)
{
  if(angular.isDefined(file))
    file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
});
}


$scope.export_data=function()
{
  swal({
    title: "Export data",
    text: "Are you ready to export?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Yes, I am sure!',
    cancelButtonText: "No, cancel it!",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm) {
    if (isConfirm) {
      $scope.block_site();
      invFactory.download_data()
      .success(
        function( html )
        {
          console.log(html);
          $.unblockUI(); 
          if(html.status_code==0)
          {
           swal('Error!',html.status_text,'error');
         }                    
         else if(html.status_code==1)
         {
          swal('Success!',html.status_text,'success');
          $scope.file_name=html.download_url;
          $('#export').modal('show');

        }

      }
      )
      .error(
       function(data, status, headers, config)
       {

       }

       );              

    } else {
      swal("Cancelled", "The job has been cancelled.", "error");
    }
  }); 
}

$scope.cron_run=function()
{
  swal({
    title: "Run ",
    text: "Are you ready to process ISBNs?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Yes, I am sure!',
    cancelButtonText: "No, cancel it!",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm) {
    if (isConfirm) {
      $scope.block_site();
      invFactory.cron_run()
      .success(
        function( html )
        {
          console.log(html);
          $.unblockUI(); 
          if(html.status_code==0)
          {
           swal('Error!',html.status_text,'error');
         }                    
         else if(html.status_code==1)
         {
          swal('Success!',html.status_text,'success');
        }

      }
      )
      .error(
       function(data, status, headers, config)
       {

       }

       );              

    } else {
      swal("Cancelled", "The job has been cancelled.", "error");
    }
  }); 
}


$scope.remove_all=function()
{
  swal({
    title: "Remove Data",
    text: "Are you sure you want to remove all data?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Yes, I am sure!',
    cancelButtonText: "No, cancel it!",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm) {
    if (isConfirm) {
      $scope.block_site();
      invFactory.remove_data()
      .success(
        function( html )
        {
          console.log(html);
          $.unblockUI(); 
          if(html.status_code==0)
          {
           swal('Error!',html.status_text,'error');
         }                    
         else if(html.status_code==1)
         {
          swal('Success!',html.status_text,'success');
          $scope.get_transaction_list($scope.currentPage);
        }

      }
      )
      .error(
       function(data, status, headers, config)
       {

       }

       );              

    } else {
      swal("Cancelled", "No data has been removed.", "error");
    }
  }); 
}




}]);
</script>
