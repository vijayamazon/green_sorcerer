<?php
 $baseurl=base_url();
?>
<link href="<?php echo $baseurl.'/asset/css/datepicker.css'?>" rel="stylesheet">
<script src="<?php echo $baseurl.'/asset/js/jquery_ui_core_1_10.js'?>"></script>
<script src="<?php echo $baseurl.'/asset/js/jq_datepicker_1_10.js'?>"></script>
<script>
  $( function() {
    $(".date_selector").datepicker({minDate:0, dateFormat: "yy-mm-dd",});
  } );
</script>


<style type="text/css">
.pad_filter 
{
  padding:20px 20px;
}


  .morris-hover{position:absolute;z-index:300}.morris-hover.morris-default-style{border-radius:10px;padding:6px;color:#666;background:rgba(255,255,255,0.8);border:solid 2px rgba(230,230,230,0.8);font-family:sans-serif;font-size:12px;text-align:center}.morris-hover.morris-default-style .morris-hover-row-label{font-weight:bold;margin:0.25em 0}
.morris-hover.morris-default-style .morris-hover-point{white-space:nowrap;margin:0.1em 0}
</style>
<div class="main-container" ng-controller='dashCtrl'>


   <div class="padding-md">
<div class="row">
<div class="col-sm-1"></div>
   <div class="col-sm-10">
   <div class="row">
   <div class="col-sm-12" style="margin-top: 10px;">
    <div class="col-sm-9">
     <a href='#' class='pad_filter' ng-click='get_filter_data("today")'>Today</a>
     <a href='#' class='pad_filter' ng-click='get_filter_data("7 days")'>Last 7 Days</a>
     <a href='#' class='pad_filter' ng-click='get_filter_data("30 days")'>Last 30 Days</a>
     <a href='#' class='pad_filter' ng-click='get_filter_data("this month")'>This month</a>
     <a href='#' class='pad_filter' ng-click='get_filter_data("last month")'>Last Month</a>
     <!-- <a href='#' class='pad_filter' ng-click='get_filter_data("this quarter")'>This Quarter</a> -->
     <!-- <a href='#' class='pad_filter' ng-click='get_filter_data()'>Last Quarter</a> -->
   </div>
   <div class="col-sm-1 no-padding">  
     <input type='text' class='form-control date_selector'  jqdatepicker name='from' placeholder='From' ng-model='cpn.frm_date'>
   </div>
   <div class="col-sm-1 no-padding">  
     <input type='text' class='form-control date_selector'  jqdatepicker name='to' placeholder='To' ng-model='cpn.to_date'>
   </div>
   <div class="col-sm-1">  
     <a href='#' class="btn btn-info" ng-click='filter_data()'>Filter</a>
   </div>


   </div>
   </div>

   <div class="col-sm-12">
   <br>
   </div>



                    <div class="col-lg-2 col-md-2">
                        <div class="card panel">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div><b>{{confirmed.confirmed_total}}</b></div>
                                        <div>Confirmed Order</div>
                                        <div>{{confirmed.confirmed_count}}</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="card panel">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div><b>{{canceled.canceled_total}}</b></div>
                                        <div class="text-danger"><b>Canceled Order</b></div>
                                        <div>{{canceled.canceled_count}}</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>       
                    <div class="col-lg-2 col-md-2">
                        <div class="card panel ">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div><b>{{unshipped.unshipped_total}}</b></div>
                                        <div class="text-warning"><b>Unshipped Order</b></div>
                                        <div>{{unshipped.unshipped_count}}</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>       
                    <div class="col-lg-2 col-md-2">
                        <div class="card panel">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div><b>{{ttl_cat.ttl}}</b></div>
                                        <div>Total Catalogue</div>
                                        <div>&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>       
                    <div class="col-lg-2 col-md-2">
                        <div class="card panel">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div><b>{{asin_matched.ttl}}</b></div>
                                        <div>ASIN Matched</div>
                                        <div>&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>       
                    <div class="col-lg-2 col-md-2">
                        <div class="card panel">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div><b>{{total_active.ttl}}</b></div>
                                        <div>Active Products</div>
                                        <div>&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>       
                           
                    <!--<div class="col-lg-4 col-md-6">
                        <div class="card panel">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-eye fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">20</div>
                                        <div>Mail opened</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>       
                    <div class="col-lg-4 col-md-6">
                        <div class="card panel">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-thumbs-up fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">18</div>
                                        <div>Mail clicked!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->

       <div class="col-sm-12">
       <div class="col-md-8 " style="background: #fff">
                         <div id="area-example"></div>
                    </div> 
        <div class="col-md-4 " style="background: #fff">
                         <div id="donut-chart"></div>
                    </div> 
                   
                    
       </div>
       <div class="col-sm-12">
   <br>
   </div>

       <div class="col-sm-12">
       <div class="col-md-8 " style="background: #fff">
       <h3 class="text-center">TOP 10 PRODUCTS</h3>
       <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>SKU</th>
                                            <th>Title</th>
                                            <th>Price</th>
                                            <th>Sold Qty</th>
                                            
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr  ng-repeat="tnx in top_10 " >
                                            <td  >{{tnx.prod_sku}}</td>
                                            <td>{{tnx.prod_title | limitTo:25}}</td>
                                            <td>{{tnx.itm_price}}</td>
                                            <td>{{tnx.sold_qty}}</td>
                                         </tr>
                                    </tbody>
                              </table>              
                                
         </div> 
         <div class="col-md-4 " style="background: #fff">
         <h3 class="text-center">TOP 10 CITES</h3>
       <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>City</th>
                                            <th>Orders</th>
                                            
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr  ng-repeat="tnx in top_10_city" >
                                            <td  >{{tnx.shipping_city}}</td>
                                            <td>{{tnx.sold_qty}}</td>
                                         </tr>
                                    </tbody>
                              </table>              
                                
         </div> 

       </div>
       <div class="col-sm-12"><br></div>
       <div class="col-sm-12">
       </div>
       

   </div>                 
</div><!--first row ends-->

</div>
</div>

<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->
    <!-- <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script> -->
      <!-- <script src="http://cdn.oesmith.co.uk/morris-0.4.1.min.js"></script> -->

<script type="text/javascript">
</script>
<script type="text/javascript">

crawlApp.factory("dashFactory", function($http,$q) {
   
   var get_data = function () {
        var dataset_path="<?php echo $baseurl.'dashboard/get_pre_data'?>";
        var deferred = $q.defer();
        var path =dataset_path;
        
        $http.get(path)
        .success(function(data,status,headers,config){deferred.resolve(data);})
        .error(function(data, status, headers, config) { deferred.reject(status);});
        
        return deferred.promise;
    };

    var filter_data=function(frm_date,to_date)
    {
       var search_path="<?php echo $baseurl.'dashboard/filter_data/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data: 
                      {
                        from_date:frm_date,
                        to_date:to_date
                        
                      }
                     }); 
                   
    };
    var get_filter_data=function(cntxt)
    {
       var search_path="<?php echo $baseurl.'dashboard/get_filter_data/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data: 
                      {
                        cntxt:cntxt,
                      }
                     }); 
                   
    };


  return {
    get_data:get_data,
    filter_data:filter_data,
    get_filter_data:get_filter_data
  };
});
  crawlApp.controller("dashCtrl",function dashCtrl($window,$scope,dashFactory,$sce,$q,$timeout,Upload) 
  {
       $scope.cpn={};
       $scope.top_10=[];
      
      
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
            }});

        }
       $scope.get_predata = function()
         {
            var promise=dashFactory.get_data();
              promise.then(
                             function(response)
                             {
                                if(response.status_code == '1')
                                {
                                    $scope.confirmed=response.confirmed[0]; 
                                    $scope.canceled=response.canceled[0];
                                    $scope.unshipped=response.unshipped[0];
                                    $scope.ttl_cat=response.total_catalogue[0];
                                    $scope.asin_matched=response.asin_matched[0];
                                    $scope.total_active=response.total_active[0];
                                    // $scope.returned=response.returned[0];
                                    // $scope.revenue=response.revenue[0];

                                    $scope.top_10=response.top_10;
                                    $scope.top_10_city=response.top_10_cities;
                                    $scope.draw_graph(response.graph_data,response.donut_data);
                                    
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
        $scope.filter_data=function()
        {
             if($scope.cpn.frm_date.length > 0 && $scope.cpn.to_date.length > 0)
             {
                dashFactory.filter_data($scope.cpn.frm_date,$scope.cpn.to_date)
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
                                           $scope.confirmed=html.confirmed[0]; 
                                           $scope.canceled=html.canceled[0];
                                           $scope.returned=html.returned[0];
                                           $scope.revenue=html.revenue[0];
                                           $scope.top_10=response.top_10;
                                           $scope.top_10_city=response.top_10_cities;
                                           $scope.draw_graph(html.graph_data,html.donut_data);
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
        $scope.get_filter_data=function(cntxt)
        {
             if(cntxt.length > 0 && cntxt.length > 0)
             {
                dashFactory.get_filter_data(cntxt)
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
                                           $scope.confirmed=html.confirmed[0]; 
                                           $scope.canceled=html.canceled[0];
                                           $scope.returned=html.returned[0];
                                           $scope.revenue=html.revenue[0];
                                           $scope.top_10=html.top_10;
                                           $scope.top_10_city=html.top_10_cities;

                                           $scope.draw_graph(html.graph_data,html.donut_data);
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
       $scope.draw_graph=function(graph_data,donut_data)
       {
          $("#area-example").empty();
          $("#donut-chart").empty();
                         setTimeout(function(){
            Morris.Bar({
              element: 'area-example',
              data: graph_data,
              xkey: 'order_date',
              ykeys: ['order_count'],
              labels: ['Order'],
            });
            Morris.Donut({
  element: 'donut-chart',
  data: donut_data
});
            console.log(donut_data);

        if($('#area-example').find('svg').length > 1){
            $('#area-example svg:first').remove();
                $(".morris-hover:last").remove();
        }
        if($('#donut-chart').find('svg').length > 1){
            $('#donut-chart svg:first').remove();
                $(".morris-hover:last").remove();
        }
            $('.js-loading').addClass('hidden');
      },100);
       }

     
       

});
</script>
