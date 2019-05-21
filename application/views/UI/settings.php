<?php
 $baseurl=base_url();
?>
<style type="text/css">
.tab-content > .tab-pane
{
    padding: 10px;
}
.ul.tab-bar li{
	padding:30px;
}
/*.cate > tbody > tr
{
  background: red;
}*/
</style>

<div class="main-container" ng-controller='invCtrl'>
<div class="padding-md" style="padding-right:3.5%;">
  <div class="row" >
    <div class="col-sm-1"></div>
   <div class="col-sm-11">
   <div class="col-sm-10">
   <br>
   </div>
    <div class="col-sm-12">
        <div class="card panel ">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-truck"></i>SETTINGS</h3>
            </div>
       <div class="modal-dialog" style="width:800px;">
              <div class="modal-content">
                  <!-- <div class="modal-header menu-bg txt-color-fff">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Product Details</h4>
                  </div> -->
                  <div class="modal-body no-padding">
                    <div class='row '>
                       <div class="col-sm-12 ">
                        
                 <!-- tabbed popup content starts-->

             <div class="smart-widget widget-blue">
            <!-- <div class="smart-widget-header">
              <h4>Product Detail</h4>
              
            </div> -->
            <div class="smart-widget-inner">
              <div class="widget-tab clearfix">
                <ul class="tab-bar">
                  <li class="active"><a href="#style3Tab1" data-toggle="tab"><i class="fa fa-home"></i>SETTINGS</a></li>
                  </ul>
              </div>
              <div class="smart-widget-body">
                <div class="tab-content">
                  <div class="tab-pane fade active in" id="style3Tab1">
<div class="row">
<div class="col-md-1"></div>
  <div class="col-md-9">
 <form class="form-horizontal" role="form"  ng-submit="addSpecInfo()" novalidate>
    
    <div class="form-group">
      <label class="control-label col-sm-4" for="email">Minimum Sales Rank</label>
      <div class="col-sm-7" ">
        <input type="text" ng-model='sproduct.specinfo.min_sales_rank' name='min_sales_rank' required class="form-control" id="email" placeholder="0">
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-4" for="email">Value Between</label>
      <div class="col-sm-7" 
       <p style="text-align:center;font-size:24px;"> <> </p>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="email">Maximum Sales Rank</label>
      <div class="col-sm-7" ng-class="{ 'has-error' : specForm.max_sales_rank.$invalid && submitted  }">
        <input type="text" ng-model='sproduct.specinfo.max_sales_rank' name='max_sales_rank' required class="form-control" id="email" placeholder="0">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="email">Minimum Net Payout</label>
      <div class="col-sm-7" ng-class="{ 'has-error' : specForm.net_amount.$invalid && submitted}">
        <input type="text" ng-model='sproduct.specinfo.net_amount' name='net_amount' required class="form-control" id="email" placeholder="0">
      </div>
    </div>
	
	<div class="form-group">
      <label class="control-label col-sm-4" for="email"><span style='color:#f00'></span>Color</label>
      <div class="col-sm-7" ng-class="{ 'has-error' : specForm.color.$invalid && submitted  }">
        <select ng-model='sproduct.specinfo.color' name ='color' class="form-control" required>
        <option ng-selected="true">color</option> 
        <option value="#FFCDD2">Red</option>
        <option value="#BBDEFB">Blue</option>
        <option value="#B2DFDB">Teal</option>
        <option value="#B2EBF2">Cyan</option>
        <option value="#C8E6C9">Green</option>
        <option value="#FFF9C4">Yellow</option>
		<option value="#FFE0B2">Orange</option>
        </select>
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-4" for="email"><span style='color:#f00'></span>Sound</label>
      <div class="col-sm-7" ng-class="{ 'has-error' : specForm.sound.$invalid && submitted  }">
        <select ng-model='sproduct.specinfo.sound' name ='sound' class="form-control" required>
        <option ng-selected="true">sound</option> 
        <option value="s1">SOUND 1</option>
        <option value="s2">SOUND 2</option>
        <option value="s3">SOUND 3</option>
        <option value="s4">SOUND 4</option>
        <option value="s5">SOUND 5</option>
        </select>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <!---<button type="button" class="btn btn-default" value='reset'>Clear</button> --->
        <button type="submit" class="btn btn-primary" ng-click="submitted=true">Add Rule </button>
      </div>
    </div>
  </form>
  </div>
</div>



                  </div><!-- ./tab-pane -->
          
                  
                </div><!-- ./tab-content -->
              </div>
            </div>
          </div><!-- ./smart-widget -->
		  
		  <div class="padding-md" style="padding-right:3.5%;">
  <div class="row" >
    <div class="col-sm-1"></div>
   <div class="col-sm-11">
   <div class="col-sm-10">
   <br>
   </div>
       <div class="col-lg-12 col-md-6 no-padding" style="margin-top:30px;">
<div class="row" >
                  
                
           
              <div class="col-sm-11 col-md-6 no-padding"  style="width:100%;margin-right:20px;">
                 <div class="table-responsive"> <br>   <br>  
                                <table class="table table-actions-bar" >
                                    <thead>
                                        <tr >
										 <th><div class="custom-checkbox">
              <input type='checkbox' id="iCheckbox" class="checkbox-green" ng-model="checkStatus" ng-change="statusCheck()" ng-true-value="'Y'" ng-false-value="'N'"/>
              <label for="iCheckbox"></label>
              </div></th>
			                                <th>S.No</th>
                                            <th>Minimum Sales Rank</th>
                                            <th>Maximum Sales Rank</th>
											<th>Net Amount</th>

                                            
											
											
											
											
											
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
									 <tr  ng-show='transactionList.length==0'>
                                          <td colspan="12" class="text-center"><h2>No Details found</h2></td>
                                        </tr>
                                        <tr  ng-repeat="tnx in transactionList track by $index  " ng-class="$index==0?'panel-info':'panel-default'">
                                        
										  <td><div class="custom-checkbox">
                   <input type="checkbox" checklist-value="tnx.rule_id" checklist-model="selectedProduct" class="checkbox-blue" id="inlineCheckbox{{$index+1}}">
                   <label for="inlineCheckbox{{$index+1}}"></label>
                 </div></td>
				                             <td>{{$index+1}}</td>
                                            <td>{{tnx.min_sales_rank}}</td>
                                            <td>{{tnx.max_sales_rank}}</td>
                                            <td>{{tnx.net_amount}}</td>
											<td ng-click="remove_product()" herf="" style="color:blue;font-weight:600">REMOVE</td>
                                            
                                             </tr>
										
										
                                        
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>  
                         <div class="col-sm-11">

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
						<div class="row">
    
       			
          
   </div>

   </div>

</div>
</div>
         
   </div>

   </div>

</div>
</div>
<script type="text/javascript">
crawlApp.factory('invFactory', ['$http', '$q','limitToFilter', 'Upload',function($http,$q,limitToFilter,Upload) {

    
    var inv_list_url        =   "<?php echo $baseurl."settings/get_product_list/" ;?>";
    
    
    var get_transaction_list = function (orderby,direction,offset,limit) 
    {
          var deferred = $q.defer();
          var path =inv_list_url+orderby+'/'+direction+'/'+offset+'/'+limit;
          $http.get(path)
          .success(function(data,status,headers,config){deferred.resolve(data);})
          .error(function(data, status, headers, config) { deferred.reject(status);});
          return deferred.promise;
    };
    
	var add_spec_info=function(specinfo)
    {
      var update_vital_path="<?php echo $baseurl.'settings/add_spec_info/';?>";
      var postData={
                    
                    'min_sales_rank': specinfo.min_sales_rank,
                    'max_sales_rank': specinfo.max_sales_rank,
                    'net_amount': specinfo.net_amount,
					'color': specinfo.color,
					'sound': specinfo.sound,
                    
                   };
         return $http({  method: "post",   url: update_vital_path,   data:postData  }); 
    };
	var remove_product=function(sku_set)
    {
       var dataset_path="<?php echo $baseurl.'settings/remove_products/';?>";
         return $http({
                      method: "post",
                      url: dataset_path,
                      data:{
                         sku_set:angular.toJson(sku_set)
                      }
                     }); 
      
    }
	
   
    return {
        get_transaction_list:get_transaction_list,
		add_spec_info:add_spec_info,
		remove_product:remove_product
        
    };
    
}]);
crawlApp.controller('invCtrl', ['$scope','$parse','$window','invFactory','$http','limitToFilter','$timeout',function($scope,$parse,$window,invFactory,$http,limitToFilter,$timeout) {
        $scope.transactionList=[];
        $scope.selectedProduct=[];
        $scope.checkStatus='N';
        $scope.reset=function()
      {
      $scope.min_sales_rank='';
      $scope.max_sales_rank='';
	  $scope.net_amount='';

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
      
    $scope.itemsPerPage = 10;
    $scope.currentPage = 0;
    $scope.sortorder='rule_id';
    $scope.direction='ASC';
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
     
   
   $scope.show_more_details=function(tnx)
   {
     $scope.prod_feature=tnx.lem_bullet;
     $scope.prod_desc=tnx.lem_desc;
     $('#desc').modal('show');

   }
   $scope.addSpecInfo=function()
      {
         $scope.block_site();
              invFactory.add_spec_info($scope.sproduct.specinfo)
                           .success(
                                    function( html )
                                     {
                                       $.unblockUI();
                                       if(html.status_code)
                                       {
                                         swal('Error!',html.status_text,'error');
                                       }
                                       if(html.status_code ==1)
                                       {
                                         swal('Success!',html.status_text,'success');
                                         
										window.setTimeout(function(){location.reload()},3000)
										$scope.block_site();
										 $scope.get_transaction_list($scope.currentPage);
                                       }
									    
                                       }
									   
                                  ) 
                           .error(
                                     function(data, status, headers, config)
                                          {
											  
                                          
                                           }
										   

                               );              
      }



     $scope.select_all=function()
   {
      $scope.showbar=true;
      console.log("Before Select");
      console.log($scope.selectedProduct);
      
      for(i=0;i< $scope.transactionList.length;i++)
      {
        // $scope.selected.push($scope.pagedItems[i].asin);
        $scope.addToArray($scope.selectedProduct,$scope.transactionList[i].rule_id)  
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
             swal('Error!',"Please select some Product",'error');
           }
   }         
    
   
  
    
   
   

}]);
</script>
