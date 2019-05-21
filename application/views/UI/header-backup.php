<?php
$base_url=base_url();

?>
<!DOCTYPE html>
<html lang="en" ng-app='crawler'>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Green Scourer - Dashboard</title>
    <link rel="icon" type="image/png" href=""/>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $base_url.'/asset/css/-bootstrap.min.css';?>" rel="stylesheet">
    <!-- Custom CSS -->
    <!-- <link href="css/sb-admin.css" rel="stylesheet"> -->
    <link href="<?php echo $base_url.'/asset/css/custom.css'?>" rel="stylesheet">
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
 <nav class="top-bar navbar theme_bgcolor navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" style="padding:5px">
			<a href="<?php echo $base_url.'products_tool'?> " ><p style="font-weight:600;font-size:30px;color:white;margin-top:2px;margin-left:8px;">Green Sorcerer</p></a>
                 
                <!-- <a href="<?php echo $base_url.'index_test'?> " ><p style="margin-top: 7px;color: #fff;"><span style='font-weight:900;font-size:20px;color:#f00'>PRO</span><span style="font-size: 15px;">SELLER LISTING</span></p></a> -->
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <!-- <li><a data-toggle='modal' data-target='#feedback' href='#'><i class="fa fa-edit">&nbsp;</i><span class='hidden-xs'> FeedBack </span></a></li> -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                        <?php
                           $user=$this->session->userdata('user_logged_in');
                           echo $user['fname'];
                        ?>
                                    
                    <b class="caret"></b></a>
                    <ul class="dropdown-menu flipInX animated">

                        <li>
                            <a href="<?php echo $base_url.'my_profile'?>"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo $base_url.'user_auth/logout'?> "><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <!-- /.navbar-collapse -->
            
            
        </nav>
<div class='wrapper'>        
<div class="area"></div>

<nav class="main-menu">
            <ul>
                
             <li>
                    <a href="<?php echo $base_url.'amazon_price_list'?> ">
                       <i class="icn fa fa-line-chart fa-2x "></i>
                        <span class="nav-text">
                          Amazon Price Tool
                        </span>
                    </a>
                  
                </li>	
                <li>
                    <a href="<?php echo $base_url.'products_tool'?> ">
                       <i class="icn fa fa-amazon fa-2x "></i>
                        <span class="nav-text">
                          Amazon Tool Version 2.0
                        </span>
                    </a>
                  
                </li>
                <li>
                    <a href="<?php echo $base_url.'file_handler'?> ">
                       <i class="icn fa fa-file fa-2x "></i>
                        <span class="nav-text">
                          File Uploader
                        </span>
                    </a>
                  
                </li>
                <li>
                    <a href="<?php echo $base_url.'product_catalog'?>">
                       <i class="icn fa fa-book fa-2x "></i>
                        <span class="nav-text">
                          Product Catalog
                        </span>
                    </a>
                  
                </li>
                <li>
                    <a href="<?php echo $base_url.'sales_rank_conf'?> ">
                       <i class="icn fa fa-cog fa-2x "></i>
                        <span class="nav-text">
                          Configuration Module
                        </span>
                    </a>
                  
                </li>
                <li>
                    <a href="<?php echo $base_url.'ProUpdate'?> ">
                       <i class="icn fa fa-download fa-2x "></i>
                        <span class="nav-text">
                          Product Updation 
                        </span>
                    </a>
                  
                </li>
<?php
                     if($this->login_model->adminLoginCheck())
                      {
                   ?>				
                <!--  <li>
                    <a href="<?php echo $base_url.'settings'?> ">
                       <i class="icn fa fa-slack fa-2x "></i>
                        <span class="nav-text">
                        Settings
                        </span>
                    </a>
                  
                </li>	-->

				<li class="has-subnav">
                    <a href="<?php echo $base_url.'manage_users'?> ">
                        <i class="icn fa fa-users fa-2x"></i>
                        <span class="nav-text">
                            Manage Users
                        </span>
                    </a>
                </li> 

               
<?php
               }
                   ?>				

               
          </ul>     

            
        </nav>

