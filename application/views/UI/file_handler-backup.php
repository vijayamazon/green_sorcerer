<div class="padding-md" style="padding-right:3.5%;">
  <div class="row" >
	<div class="col-sm-1"></div>
	<div class="col-sm-11">
	 <div class="col-sm-10">
	   <br>
	 </div>
	 <div align="center" class="col-lg-12 col-md-6 no-padding" >
	  <h1><i class="fa fa-file"></i>  File Uploader</h1>
	  <?php if (isset($this->session->alert)) {
		echo $this->session->alert;
		$this->session->unset_userdata('alert');
	  } ?><br><br>
	  <?php echo form_open_multipart('file_handler/uploadFile');?>

	  <input type="file" name="userfile" size="20" />

	  <br />

	  <input type="submit" class="btn btn-success" value="Upload" />

	</form>

	<form id="deleteForm" action="<?php echo base_url().'file_handler/deleteFile'; ?>" method="post">
	  <input type="hidden" id="deleteId" name="deleteId" value="">
	  <input type="hidden" id="path" name="path" value="">
	  <input id="deleter" style="display: none;" type="submit" value="Delete" name="submit">
	</form>
  </div>  
  <div class="col-sm-12 col-md-12 no-padding" style="margin-right:20px; text-align: center;">

	<!-- Show pagination links -->
	<?php if (isset($links)) { ?>
	<?php echo $links ?>
	<?php } ?>

  </div>