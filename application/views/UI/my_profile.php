<?php
$baseurl=base_url();

?>
<style type="text/css">
  .nav-tabs { border-bottom: 2px solid #DDD; }
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
    .nav-tabs > li > a { border: none; color: #666; }
        .nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none; color: #4285F4 !important; background: transparent; }
        .nav-tabs > li > a::after { content: ""; background: #4285F4; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }
    .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }
.tab-nav > li > a::after { background: #21527d none repeat scroll 0% 0%; color: #fff; }
.tab-pane { padding: 15px 0; }
.tab-content{padding:20px}

.profile-card {background: #FFF none repeat scroll 0% 0%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3); margin-bottom: 30px; }

</style>
<div class="page-container contanier" ng-controller='profileCtrl'>   
  <div class="row">
  <!-- <div class="col-sm-1">
    
  </div> 
  <div class="col-sm-10 ">
  <div class="card panel">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-2">
                                <img height='60' src="<?php echo $baseurl."asset/img/logo.png"?>" >
                        
                    </div > 
                    <div class="col-xs-10 text-right">
                    <h3 class="">
                 My Profile
            </h3>    
                    </div>

                </div>
            </div>
   </div>
   </div>

   -->
  </div>   
    <div class="row">
    <div class="col-sm-3"></div>
      <div class="col-md-6" >
      <?php if($this->session->flashdata('msg'))
      {

        ?>
      <div class="alert alert-info alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <p><b><?php echo$this->session->flashdata('msg') ?></b></p>
  </div>
  <?php
}
?>
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">{{usr.fname}} {{usr.lname}}</h3>
              <h5 class="widget-user-desc">Joined: {{usr.joined}}</h5>
            </div>
            <div class="widget-user-image">
              <img alt="User Avatar" src="<?php echo $baseurl.'asset/profile_img/' ; ?>{{usr.pro_img}}" class="img-circle">
            </div>
            <div class="box-footer" >
              <div class="row">
              <!--  <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">10</h5>
                    <span class="description-text">I-SEARCH</span>
                  </div>
                </div>
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">25</h5>
                    <span class="description-text">W-SEARCH</span>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">{{usr.credits}}</h5>
                    <span class="description-text">CREDITS</span>
                  </div>
                </div>
              </div>-->
              
            </div>
          </div>
          <!-- /.widget-user -->
                                    <div class="col-md-12 no-padding" style=" margin-top: 20px">
                                    <!-- Nav tabs --><div class="profile-card">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Amazon MWS API</a></li>
                                        <!-- <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">INDEX HISTORY</a></li>
                                        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">PAYMENT HISTORY</a></li> -->
                                        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">PROFILE DETAILS</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                   <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="home">
                                          <div class="row">
                                          <div class="col-md-12">
                                    <form novalidate="" name="amzForm" ng-submit="update_amazon_api()" class="ng-pristine ng-valid ng-valid-required">
                              <div class="pad"><b>Seller ID</b></div>
                              <div ng-class="{ 'has-error' : amzForm.seller_id.$invalid &amp;&amp; amz_submitted  }" class="pad">
                              <input type="text" required="" ng-model="amz_api.seller_id" placeholder="Seller ID" name="seller_id" class="form-control ng-pristine ng-untouched ng-not-empty ng-valid ng-valid-required">
                              </div>
                              <div class="pad"><b>Auth Token</b></div>
                              <div ng-class="{ 'has-error' : amzForm.auth_token.$invalid &amp;&amp; amz_submitted  }" class="pad">
                              <input type="text" required="" ng-model="amz_api.tokenid" placeholder="Token" name="auth_token" class="form-control ng-pristine ng-untouched ng-not-empty ng-valid ng-valid-required">
                              </div>
                              <div class="pad"><b>Access Key</b></div>
                              <div ng-class="{ 'has-error' : amzForm.access_key.$invalid &amp;&amp; amz_submitted  }" class="pad">
                              <input type="text" required="" ng-model="amz_api.access_key" placeholder="Access Key" name="access_key" class="form-control ng-pristine ng-untouched ng-not-empty ng-valid ng-valid-required">
                              </div>
                              <div class="pad"><b>Secret Key</b></div>
                              <div ng-class="{ 'has-error' : amzForm.secret_key.$invalid &amp;&amp; amz_submitted  }" class="pad">
                              <input type="text" required="" ng-model="amz_api.secret_key" placeholder="Secret Key" name="secret_key" class="form-control ng-pristine ng-untouched ng-not-empty ng-valid ng-valid-required">
                              </div>
                              <div class="pad"><b>Market Place ID</b></div>
                              <div ng-class="{ 'has-error' : amzForm.market_id.$invalid &amp;&amp; amz_submitted  }" class="pad">
                              <input type="text" required="" ng-model="amz_api.market_id" placeholder="Market Place ID" name="market_id" class="form-control ng-pristine ng-untouched ng-not-empty ng-valid ng-valid-required">
                              </div>


                              
                              <div class="pad">  
                              <input type="submit" class="btn btn-warning" ng-click="amz_submitted=true" value="Update API Details" name="submit">
                              </div>
                           </form>
                                </div>
                                          </div>
                                        </div> 
                                        <div role="tabpanel" class="tab-pane" id="profile">
                                        
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="settings"><div class="row">
                                          <div class="col-sm-12">
                                            <div class=" table-responsive">
                  <table class="table">
                    <tr><td>EMAIL</td><td class="text-right">{{usr.email}}</td></tr>
                    <tr><td>Change Profile </td><td align="right"><input type="file" ngf-select ng-model="picFile" name="file"  ngf-max-size="2MB"   ngf-model-invalid="errorFile">
      <i ng-show="myForm.file.$error.maxSize">File too large 
          {{errorFile.size / 1000000|number:1}}MB: max 2M</i><br>
      <img width='100' height='100' ng-show="myForm.file.$valid" ngf-thumbnail="picFile" class="thumb"> <button ng-click="picFile = null" ng-show="picFile">Remove</button>
      <br>
      <button style="margin-top: 10px;" class='btn btn-info'
              ng-click="send_message(picFile)">Submit</button>
      <span class="progress" ng-show="picFile.progress >= 0">
        <div style="width:{{picFile.progress}}%" 
            ng-bind="picFile.progress + '%'"></div>
      </span>
      <span ng-show="picFile.result">Upload Successful</span>
      <span class="err" ng-show="errorMsg">{{errorMsg}}</span>
      <!-- <div class="fileUpload btn btn-info">
    <span>Upload</span>
    <input type="file" class="upload" />
</div>
 -->
</td></tr>
<!-- <tr><td></td><td class="text-right"><input type="submit" class='btn btn-primary' name="" value="Update"></td></tr> -->
                  </table>
                </div>
                                          </div>
                                        </div></div>
                                    </div>
</div>
                                </div>
  
        </div>
    </div>
    </div>

</div>
<script type="text/javascript">

crawlApp.factory("profileFactory", function($http,$q) {
    var get_profile_info = function () {
        var deferred = $q.defer();
        var path ="<?php echo $baseurl.'my_profile/get_profile_info'?>";
        $http.get(path)
        .success(function(data,status,headers,config){deferred.resolve(data);})
        .error(function(data, status, headers, config) { deferred.reject(status);});
        return deferred.promise;
    };
     var update_amazon_api=function(api)
    {
       return $http({
                      method: "post",
                      url: "<?php echo $baseurl.'my_profile/update_amazon_api'?>",
                      data:{
                          api_detail:angular.toJson(api)
                      }
                     }); 
                   
    };
    var update_account=function(usr)
    {
       return $http({
                      method: "post",
                      url: "<?php echo $baseurl.'my_profile/update_account'?>",
                      data:{
                          email:usr.email,
                          old_pwd:usr.old_pwd,
                          new_pwd:usr.new_pwd,
                          rew_pwd:usr.rew_pwd,
                      }
                     }); 
                   
    };
    
    return {
       get_profile_info:get_profile_info,
       update_amazon_api:update_amazon_api,
       update_account:update_account
    };

});
  crawlApp.controller("profileCtrl",function profileCtrl($window,$scope,profileFactory,$sce,$q,$timeout,Upload) 
  {
     $scope.update_amazon_api=function()
      {
         if($scope.amzForm.$valid) 
          {
              profileFactory.update_amazon_api($scope.amz_api)
                          .success(
                                    function( html )
                                    {
                                      console.log(html);
                                        if(html.status_code==0)
                                        {
                                            swal("Error!",html.status_text,'error');  
                                        }                    
                                        else if(html.status_code==1)
                                        {
                                            swal("Success!",html.status_text,'success');  
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
            console.log("Fomr error ");
           }                       
      }
      $scope.update_account=function()
      {
              profileFactory.update_account($scope.usr)
                          .success(
                                    function( html )
                                    {
                                      console.log(html);
                                        if(html.status_code==0)
                                        {
                                            swal("Error!",html.status_text,'error');  
                                        }                    
                                        else if(html.status_code==1)
                                        {
                                            swal("Success!",html.status_text,'success');  
                                        }
                                    }
                          )
                          .error(
                                 function(data, status, headers, config)
                                      {
                                           
                                       }

                          );              
                                
      }
    $scope.get_profile_info=function()
    {
        var promise=profileFactory.get_profile_info();
            promise.then(function(response){
              $scope.usr=response.details[0];
              $scope.amz_api=response.api_details[0];

                 }, 
           function(reason) {
            console.log("Reason"+reason);
         });
    }
    $scope.get_profile_info();
    $scope.send_message = function(file) 
     {
        var upload = Upload.upload({
          url: '<?php echo $baseurl.'my_profile/update_profile/';?>',
          data: {attached_file: file},
        });

        upload.then(function (response) {
          if(angular.isDefined(file))
          {
            $timeout(function () {
            file.result = response.data;

            });
            
          }
          if(response.data.status_code == '1')
           {
             swal('Success!','profile updated','success');
           }
           else
           {
             swal("Error!",response.data.status_text,'error');
           }
        }, function (response) {
          if (response.status > 0)
            $scope.errorMsg = response.status + ': ' + response.data;
        }, function (evt) {
          if(angular.isDefined(file))
          file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
        });
    }
   
});
</script>