<?php
$base_url=base_url();
?>
<style type="text/css">
    .footer
    {
        height:40px;
        background: #fff !important;
        clear: both;
    position: relative;
    z-index: 10;
    height: 3em;
    margin-top: -3em;
    bottom: 0;
    right:0;
    position:fixed;
    width:95%;
    }
</style>
<!-- <div class="footer" >   
<div class="col-sm-12"><p class='pull-right' style="padding: 10px">Copyright &copy;<?php echo date('Y')?> ProsellerListing.com </p></div>
</div> -->
</div>

    <!-- /#wrapper -->
    <!-- jQuery -->
    
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $base_url.'/asset/js/bootstrap.min.js'?>"></script>
    <script src="<?php echo $base_url.'/asset/js/jqueryblockUI.js'?>"></script>
    <!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> -->
   
<script type="text/javascript">
  </script>

    <!-- <script src="<?php echo $base_url.'/asset/js/plugins/morris/raphael.min.js'?>"></script>
    <script src="<?php echo $base_url.'/asset/js/plugins/morris/morris.min.js'?>"></script>
    <script src="<?php echo $base_url.'/asset/js/plugins/morris/morris-data.js'?>"></script> -->
    <script src="<?php echo $base_url.'/asset/js/jqueryblockUI.js'?>"></script>
    
    <script type="text/javascript">
            ;(function(){

          // Menu settings
          $('#menuToggle, .menu-close').on('click', function(){
            $('#menuToggle').removeClass('active');
            $('body').removeClass(' body-push-toleft');
            $('#theMenu').removeClass('menu-open');
          });
        })(jQuery)
    </script>
    <script>

    $(document).ready(function(){
        $(function () {
          $("body").tooltip({ selector: '[data-toggle=tooltip]' });
        });

        $('.show_hide').click(function () {
            // $(".main-menu").toggle("slide");
            $(".main-menu").slideToggle();
            $("page-container").css("margin-left:20px"); 
        });


    });

    </script>
    <script type="text/javascript">
      $(".sidebar").mouseover(function(){
        $(".main-content").css("margin-left","260px");
        $(".main-content").css("box-shadow","0 0 10px 0 #ddd");
      });
      $(".sidebar").mouseleave(function(){
        $(".main-content").css("margin-left","60px");
        $(".main-content").css("box-shadow","0 0 0");
      });
    </script>
</body>

</html>
