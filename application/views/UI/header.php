<?php
$base_url=base_url();

?>
<!DOCTYPE html>
<html lang="en" ng-app='crawler'>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Green Scourer - Dashboard</title>

	<link href="<?php echo $base_url.'/asset/css/bootstrap.min.css';?>" rel="stylesheet">
	<link href="<?php echo $base_url.'/asset/css/style.css';?>" rel="stylesheet">

	<!-- <link href="<?php echo $base_url.'/asset/css/custom.css'?>" rel="stylesheet"> -->
	<link href="<?php echo $base_url.'/asset/css/animate.css'?>" rel="stylesheet">
	<link href="<?php echo $base_url.'/asset/css/theme.css'?>" rel="stylesheet">
	<link href="<?php echo $base_url.'/asset/css/star-rating-svg.css'?>" rel="stylesheet">
	<link href="<?php echo $base_url.'/asset/css/plugins/morris.css'?>" rel="stylesheet">
	<link href="<?php echo $base_url.'asset/css1/sweetalert.css' ;?>" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
	

	<!-- Morris Charts CSS -->
	<!-- Custom Fonts -->
	<link href="<?php echo $base_url.'/asset/font-awesome/css/font-awesome.min.css'?>" rel="stylesheet" type="text/css">
	<script src="<?php echo $base_url.'/asset/ngapp/vendor/angular.min.js'?>"></script>
	<script src="<?php echo $base_url.'asset/ngapp/file_upload/ng-file-upload-shim.min.js' ;?>"></script>
	<script src="<?php echo $base_url.'asset/ngapp/file_upload/ng-file-upload.min.js' ;?>"></script>

	<script src="<?php echo $base_url.'/asset/ngapp/vendor/angular-animate.js'?>"></script>
	<script src="<?php echo $base_url.'/asset/ngapp/vendor/ui-bootstrap-tpls-1.3.2.min.js'?>"></script>
	<!-- <script src="<?php echo $base_url.'asset/ngapp/vendor/angular-file-upload.min.js' ;?>"></script>
	<script src="<?php echo $base_url.'asset/ngapp/vendor/angular-file-upload-shim.min.js' ;?>"></script>
 -->
	
	<script src="<?php echo $base_url.'/asset/ngapp/app.js'?>"></script>
	<script src="<?php echo $base_url.'/asset/ngapp/directive.js'?>"></script>
	<script src="<?php echo $base_url.'asset/js/sweetalert.min.js' ;?>"></script>
	<script src="<?php echo $base_url.'/asset/js/jquery.js'?>"></script>
	<script src="<?php echo $base_url.'/asset/js/jscolor.js'?>"></script>
	<script src="<?php echo $base_url.'/asset/js/jquery.star-rating-svg.js'?>"></script>
	<script src="<?php echo $base_url.'/asset/js/plugins/morris/raphael.min.js'?>"></script>
  <script src="<?php echo $base_url.'/asset/js/plugins/morris/morris.min.js'?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>


        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 

	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">
	.loader {
	border: 16px solid #f3f3f3; /* Light grey */
	border-top: 16px solid #3498db; /* Blue */
	border-radius: 50%;
	width: 120px;
	height: 120px;
	animation: spin 2s linear infinite;
}
.loaderSmall {
	border: 8px solid #f3f3f3; /* Light grey */
	border-top: 8px solid #3498db; /* Blue */
	border-radius: 50%;
	width: 40px;
	height: 40px;
	animation: spin 2s linear infinite;
}
.checkmark-circle {
  width: 130px;
  height: 130px;
  position: relative;
  display: inline-block;
  vertical-align: top;
}
.checkmark-circle .background {
  width: 130px;
  height: 130px;
  border-radius: 50%;
  background: #2EB150;
  position: absolute;
}
.checkmark-circle .checkmark {
  border-radius: 5px;
}
.checkmark-circle .checkmark.draw:after {
  -webkit-animation-delay: 100ms;
  -moz-animation-delay: 100ms;
  animation-delay: 100ms;
  -webkit-animation-duration: 1s;
  -moz-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-timing-function: ease;
  -moz-animation-timing-function: ease;
  animation-timing-function: ease;
  -webkit-animation-name: checkmark;
  -moz-animation-name: checkmark;
  animation-name: checkmark;
  -webkit-transform: scaleX(-1) rotate(135deg);
  -moz-transform: scaleX(-1) rotate(135deg);
  -ms-transform: scaleX(-1) rotate(135deg);
  -o-transform: scaleX(-1) rotate(135deg);
  transform: scaleX(-1) rotate(135deg);
  -webkit-animation-fill-mode: forwards;
  -moz-animation-fill-mode: forwards;
  animation-fill-mode: forwards;
}
.checkmark-circle .checkmark:after {
  opacity: 1;
  height: 75px;
  width: 37.5px;
  -webkit-transform-origin: left top;
  -moz-transform-origin: left top;
  -ms-transform-origin: left top;
  -o-transform-origin: left top;
  transform-origin: left top;
  border-right: 15px solid white;
  border-top: 15px solid white;
  border-radius: 2.5px !important;
  content: '';
  left: 25px;
  top: 75px;
  position: absolute;
}

@-webkit-keyframes checkmark {
  0% {
	height: 0;
	width: 0;
	opacity: 1;
  }
  20% {
	height: 0;
	width: 37.5px;
	opacity: 1;
  }
  40% {
	height: 75px;
	width: 37.5px;
	opacity: 1;
  }
  100% {
	height: 75px;
	width: 37.5px;
	opacity: 1;
  }
}
@-moz-keyframes checkmark {
  0% {
	height: 0;
	width: 0;
	opacity: 1;
  }
  20% {
	height: 0;
	width: 37.5px;
	opacity: 1;
  }
  40% {
	height: 75px;
	width: 37.5px;
	opacity: 1;
  }
  100% {
	height: 75px;
	width: 37.5px;
	opacity: 1;
  }
}
@keyframes checkmark {
  0% {
	height: 0;
	width: 0;
	opacity: 1;
  }
  20% {
	height: 0;
	width: 37.5px;
	opacity: 1;
  }
  40% {
	height: 75px;
	width: 37.5px;
	opacity: 1;
  }
  100% {
	height: 75px;
	width: 37.5px;
	opacity: 1;
  }
}



@keyframes spin {
	0% { transform: rotate(0deg); }
	100% { transform: rotate(360deg); }
}
 html, body, #container {
	height: 100%;
	margin:0;
	padding:0;
}
body > #container {
	height: auto;
	min-height: 100%;
}
	   
	</style>
	<style type="text/css">
	.menulist
	{
		padding:12px 40px;
	}
	.fa-2x {
font-size: 2em;
}
.icn {
position: relative;
display: table-cell;
width: 75px;
height: 56px;
text-align: center;
vertical-align: middle;
font-size:20px;
}

.main-menu:hover,nav.main-menu.expanded {
width:250px;
overflow:visible;
}

.main-menu {
background:#fbfbfb;
box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
border-right:1px solid #e5e5e5;
position:absolute;
top:0;
bottom:0;
height:100%;
left:0;
width:60px;
float:left;
overflow:hidden;
-webkit-transition:width .05s linear;
transition:width .05s linear;
-webkit-transform:translateZ(0) scale(1,1);
z-index:1000;
}

.main-menu>ul {
margin:7px 0;
}

.main-menu li {
position:relative;
display:block;
width:250px;
}

.main-menu li>a {
position:relative;
display:table;
border-collapse:collapse;
border-spacing:0;
color:#999;
 font-family: arial;
font-size: 14px;
text-decoration:none;
-webkit-transform:translateZ(0) scale(1,1);
-webkit-transition:all .1s linear;
transition:all .1s linear;
  
}

.main-menu .nav-icon {
position:relative;
display:table-cell;
width:60px;
height:36px;
text-align:center;
vertical-align:middle;
font-size:18px;
}

.main-menu .nav-text {
position:relative;
display:table-cell;
vertical-align:middle;
width:190px;
  font-family: 'Titillium Web', sans-serif;
  color:#333;
}

.main-menu>ul.logout {
position:absolute;
left:0;
bottom:0;
}

.no-touch .scrollable.hover {
overflow-y:hidden;
}

.no-touch .scrollable.hover:hover {
overflow-y:auto;
overflow:visible;
}

a:hover,a:focus {
text-decoration:none;
}

nav {
/*-webkit-user-select:none;
-moz-user-select:none;
-ms-user-select:none;
-o-user-select:none;
user-select:none;*/
}

nav ul,nav li {
outline:0;
margin:0;
padding:0;
}
.main-menu li:hover>a,nav.main-menu li.active>a,.dropdown-menu>li>a:hover,.dropdown-menu>li>a:focus,.dropdown-menu>.active>a,.dropdown-menu>.active>a:hover,.dropdown-menu>.active>a:focus,.no-touch .dashboard-page nav.dashboard-menu ul li:hover a,.dashboard-page nav.dashboard-menu ul li.active a {
color:#fff;
background-color:#5fa2db;
}
.area {
float: left;
background: #e2e2e2;
width: 100%;
height: 100%;
}
@font-face {
  font-family: 'Titillium Web';
  font-style: normal;
  font-weight: 300;
  src: local('Titillium WebLight'), local('TitilliumWeb-Light'), url(http://themes.googleusercontent.com/static/fonts/titilliumweb/v2/anMUvcNT0H1YN4FII8wpr24bNCNEoFTpS2BTjF6FB5E.woff) format('woff');
}

	</style>
	<script type="text/javascript">
	   function block_site()
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
	  
	</script>
</head>
<body>
  	<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
  		<a class="navbar-brand" href="javascript:;">Green Sorcerer</a>
		<ul class="navbar-nav ml-auto">
	  		<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="javascript:;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		  			<i class="fas fa-user"></i>
		  			<?php
                       $user=$this->session->userdata('user_logged_in');
                       echo $user['fname'];
                    ?>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="<?php echo $base_url.'my_profile'?>"><i class="fas fa-user mr-1"></i> Profile</a>
					<a class="dropdown-item" href="<?php echo $base_url.'user_auth/logout'?> "><i class="fas fa-power-off mr-1"></i> Log Out</a>
				</div>
	  		</li>
		</ul>
	</nav>
	<div class="sidebar py-3">
		<ul class="nav flex-column">
			<li>
				<a href="javascript:;" class="nav-link">
					<span class="nav-icon">
						<i class="fas fa-line-chart sidebar-icon"></i>
					</span>
					<span class="nav-text">
				  		Amazon Price Tool
					</span>
				</a>
			</li>
			<li>
				<a href="<?php echo $base_url.'products_tool'?>" class="nav-link">
					<span class="nav-icon">
				   		<i class="fab fa-amazon"></i>
				   	</span>
					<span class="nav-text">
					  Amazon Tool Version 2.0
					</span>
				</a>
			</li>
			<li>
				<a href="<?php echo $base_url.'file_handler'?>" class="nav-link">
					<span class="nav-icon">
				   		<i class="fas fa-file"></i>
				   	</span>
					<span class="nav-text">
					  File Uploader
					</span>
				</a>
			</li>
			<li>
				<a href="<?php echo $base_url.'product_catalog'?>" class="nav-link">
					<span class="nav-icon">
				   		<i class="fas fa-book"></i>
				   	</span>
					<span class="nav-text">
					  Product Catalog
					</span>
				</a>
			</li>
			<li>
				<a href="<?php echo $base_url.'sales_rank_conf'?>" class="nav-link">
					<span class="nav-icon">
				   		<i class="fas fa-cog"></i>
				   	</span>
					<span class="nav-text">
					  Configuration Module
					</span>
				</a>
			</li>
			<li>
				<a href="<?php echo $base_url.'ProUpdate'?>" class="nav-link">
					<span class="nav-icon">
				   		<i class="fas fa-download"></i>
				   	</span>
					<span class="nav-text">
					 Database Manage
					</span>
				</a>
			</li>
			<?php if($this->login_model->adminLoginCheck()){ ?>
			<li class="has-subnav">
				<a href="<?php echo $base_url.'manage_users'?>" class="nav-link">
					<span class="nav-icon">
						<i class="fas fa-users"></i>
					</span>
					<span class="nav-text">
						Manage Users
					</span>
				</a>
			</li> 
			<?php } ?>
		</ul>
	</div>
	<div class="main-content py-3 px-md-5 px-3">