<?php
$baseurl=base_url();

?>
<div class="row mb-3">
	<div class="col-md-12 text-center">
		<h1 class="mb-3"><i class="fa fa-users mr-2"></i>Manage Users</h1>
	</div> 
</div>
<div class="row mb-3" ng-controller='userCtrl'>   
	<div class="col-md-12 mb-3">
		<h3>User Manage</h3>
	</div>
	<div class="col-md-9 mb-3">
		<a href="<?php echo $baseurl.'user_auth/signup' ; ?>" class="btn btn-sm btn-success float-right"><i class="fas fa-plus"></i> Add User</a>
	 	<h5 class="mb-3"><i class="fa fa-users fa-fw"></i> User List</h5>
	  	<div class="table-responsive" >
			<table class='table table-bordered bg-white'>
		 		<thead>
		   			<tr><th>SL.No</th><th>Profile</th><th>Name</th><th>Email</th><th>Password</th><th>Admin/User</th><!---<th>credits</th><th>Verify Status</th>---><th>Status</th><th>Action</th><!---<th>Amount Paid</th><th>Action</th>---></tr>
		 		</thead>
		 		<tbody>
		  			<tr ng-repeat='usr in user_list'>
						<td width='5%'>{{$index+1}}</td>
						<td width='10%'><img alt="User Avatar" width='30' height='30' src="<?php echo $baseurl.'asset/profile_img/' ; ?>{{usr.pro_img}}" ></td>
						<td>{{usr.fname}} </td>
						<td>{{usr.email}}</td>
						<td>{{usr.password}}</td>
						<td><span ng-if='usr.is_admin==1' class="label label-info">Admin</span>
							<span ng-if='usr.is_admin==2' class="label label-primary">User</span></td>
						<!--- <td>{{usr.credits}}</td> --->
						<!---  <td><span ng-if='usr.is_verified==1' class="label label-info">Verified</span><span ng-if='usr.is_verified==0' class="label label-danger">Not Verified</span></td>&nbsp; ---><td><span ng-if='usr.is_active==1' class="label label-success">Active</span><span ng-if='usr.is_active==0 ' ng-click='trigger_active(usr)' style="cursor: pointer; cursor: hand;" class="label label-danger">Deactive</span></td> 
						<!--- <td>{{usr.total_amt}}</td>  --->
						<td><a href='' class="label label-danger" ng-click='trigger_delete(usr)'><i class="fas fa-user-slash text-danger" data-toggle="tooltip" data-placement="top" title="Deactivate User"></i></a> | <a href='' class="label label-info" ng-click='trigger_edit(usr)'><i class="fas fa-edit text-info" data-toggle="tooltip" data-placement="top" title="Edit User"></i></a></td> 
		  			</tr>
	 			</tbody>
			</table>
	  	</div>
   	</div>     
	<div class="col-md-3 mb-3">
		<h5 class="mb-3"><i class="fa fa-user fa-fw"></i> Update User &amp; Password</h5>
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
  	<div class="col-md-12 mb-3">
  		<div class="row">
			<div class="col-lg-4 col-md-6" ng-repeat='usr in user_list'>
				<div class="card profile-card mb-3 rounded-0">
					<div class="card-header position-relative">
						<div class="d-flex">
						  	<div class="profile-img mr-3 border">
						  		<img alt="User Avatar" src="<?php echo $baseurl.'asset/profile_img/' ; ?>{{usr.pro_img}}" class="rounded-circle img-fluid">
						  	</div>
						  	<div>
							  	<h3 class="text-capitalize">{{usr.fname}} {{usr.lname}}</h3>
							  	<p class="mb-0">Joined: {{usr.joined}}</p>
						  	</div>
						</div>
					</div>
					<div class="card-body">
						<div class="row no-gutters text-center mb-3">
							<div class="col-4">
								<h5>10</h5>
								<span>I-SEARCH</span>
							</div>
							<div class="col-4">
								<h5>25</h5>
								<span>W-SEARCH</span>
							</div>
							<div class="col-4">
								<h5>{{usr.credits}}</h5>
								<span>CREDITS</span>
							</div>
						</div>
						<div class="table-responsive">
						  	<table class="table">
								<tr><td>EMAIL</td><td class="text-right">{{usr.email}}</td></tr>
								<tr><td>STATUS</td><td class="text-right"><span ng-if='usr.is_verified==1' class="label label-info">Verified</span><span ng-if='usr.is_verified==0' class="label label-danger">Not Verified</span>&nbsp;<span ng-if='usr.is_active==1' class="label label-info">Active</span><span ng-if='usr.is_active==0' class="label label-danger">Deactive</span></td></tr>
								<tr><td>AMT Paid</td><td class="text-right"><span ng-if='usr.total_amt>0'>${{usr.total_amt}}</span><span ng-if='usr.total_amt==null'>Nil</span></td></tr>
						  	</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

  crawlApp.factory("userFactory", function($http,$q) {
   
   var get_users = function () {
		var dataset_path="<?php echo $baseurl.'manage_users/get_user_list'?>";
		var deferred = $q.defer();
		var path =dataset_path;
		
		$http.get(path)
		.success(function(data,status,headers,config){deferred.resolve(data);})
		.error(function(data, status, headers, config) { deferred.reject(status);});
		
		return deferred.promise;
	};
	var send_credit=function(user,credit,notes)
	{
	   var search_path="<?php echo $baseurl.'manage_users/add_credits/';?>";
		 return $http({
					  method: "post",
					  url: search_path,
					  data: 
					  {
						user_id:user,
						credit:credit,
						note:notes
					  }
					 }); 
				   
	};
	var update_amazon_api=function(api)
	{
	   return $http({
					  method: "post",
					  url:"<?php echo $baseurl.'manage_users/update_amazon_api'?>",
					  data:{
						  api_detail:angular.toJson(api)
					  }
					 }); 
				   
	};
	var delete_amazon_api=function(user)
	{
	   return $http({
					  method: "post",
					  url:"<?php echo $baseurl.'manage_users/delete_amazon_api'?>",
					  data:{
						  user_id:user
					  }
					 }); 
				   
	};
var activate_user=function(user)
	{
	   return $http({
					  method: "post",
					  url:"<?php echo $baseurl.'manage_users/activate_user'?>",
					  data:{
						  user_id:user
					  }
					 }); 
				   
	};

  return {
	send_credit:send_credit,
	update_amazon_api:update_amazon_api,
	delete_amazon_api:delete_amazon_api,
	activate_user:activate_user,
	get_users:get_users
	
  };
});
  
  crawlApp.controller("userCtrl",function userCtrl($window,$scope,userFactory,$timeout,$q,$rootScope) 
  {
	$scope.amz_api={};
	$scope.amz_api.seller_id='';
	$scope.amz_api.access_key='';
	$scope.amz_api.secret_key='';
	$scope.amz_api.key_id=null;
	$scope.add_new=function()
	{
	  $scope.amz_api.seller_id='';
	$scope.amz_api.access_key='';
	$scope.amz_api.secret_key='';
	$scope.amz_api.key_id=null;
	}
	   $scope.get_users = function()
		 {
		   
			var promise=userFactory.get_users();
			  promise.then(
							 function(response)
							 {
								
								if(response.status_code == '1')
								{
									// $rootScope.free_usage=response.free_usage;
									$scope.user_list=response.payload;
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
		$scope.get_users(); 
		$scope.selected_user='';
		$scope.show_credit=function(usr)
		{
			$scope.selected_user=usr.uid;
			$('#popup1').modal('show');
		} 
		$scope.send_credit=function()
		{
			  if($scope.selected_user.length > 0) 
			  {
				  userFactory.send_credit($scope.selected_user)
						.success(
								   function( html ) {
								   if(html.status_code == '1')
								   {
									$scope.user_list=html.payload;
									swal("Succes!","Credit has been added",'success');
								   }
								   else
								   {
									 swal("Error!",html.status_text,'error');
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
			   else
			   {
				swal('Error!','Something went wrong please refresh and try again','error');
			   }   
		}
		$scope.trigger_edit=function(usr) 
	{
	  $scope.amz_api.seller_id=usr.fname;
	  $scope.amz_api.access_key=usr.email;
	  $scope.amz_api.secret_key=usr.password;
	  $scope.amz_api.key_id=usr.uid;
	  $('#myModal').modal('show');
	}
		$scope.trigger_delete=function(usr)
	  {
		 if(usr.uid > 0) 
		  {
			  swal({
				title: "Are you sure?",
				text: "You want to deactivate the user account!",
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
				  userFactory.delete_amazon_api(usr.uid)
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
										$scope.get_users(); 
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
			 swal('Error!',"Input error please try again",'error');
		   }                       
	  }      
	  $scope.trigger_active=function(usr)
	  {
		 if(usr.uid > 0) 
		  {
			  swal({
				title: "Are you sure?",
				text: "You want to Activate the user account!",
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
				  userFactory.activate_user(usr.uid)
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
										$scope.get_users(); 
									}
						  )
						  .error(
								 function(data, status, headers, config)
									  {
										   
									   }

						  );              
					
				} else {
					swal("Cancelled", "Activation of user cancelled:)", "error");
				}
			}); 
		   }
		   else
		   {
			 swal('Error!',"Input error please try again",'error');
		   }                       
	  }      
		$scope.update_amazon_api=function()
	  {
		 if($scope.amzForm.$valid) 
		  {
			  userFactory.update_amazon_api($scope.amz_api)
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
									   $scope.get_users(); 
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
  

 
});
</script>
