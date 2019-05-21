<?php
$baseurl=base_url();

?>
<div class="row mb-3">
	<div class="col-md-12 text-center">
		<h1 class="mb-3"><i class="fa fa-file mr-2"></i>File Uploader</h1>
		<div class="row justify-content-center tool-search">
		 	<?php if (isset($this->session->alert)) {
				echo $this->session->alert;
				$this->session->unset_userdata('alert');
		  	} ?>
	  		<?php //echo form_open_multipart('file_handler/uploadFile');?>
			<div class="input-group col-md-6 mb-2">
			  	<input type="file" name="userfile" id="userfile" class="form-control" hidden="">
			  	<label class="custom-file-upload" for="userfile">Select your File</label>
				<div class="input-group-append">
					<button class="btn" id="findpro"><i class="fa fa-upload"></i></button>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<?php if (isset($links)) { ?>
			<?php //echo $links ?>
			<?php } ?>
		</div>
	</div> 
</div>
<div class="row mb-3"></div>
<div class="row mb-3">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered bg-white">
				<thead>
		  			<tr>
						<th>#</th>
						<th>Date Added</th>
						<th>Filename</th>
						<th>Status</th>
						<th>Action</th>
		  			</tr>
				</thead>
				<tbody>
		  			<?php if (isset($files)) {          
					   	foreach ($files as $key => $file) { 
						$rawurl = explode('.csv',$file['url']);
						$downloadable = $rawurl[0].'Updated.xls';
					?>
					<tr style="display: none;">
						<td><?php echo $key+1; ?></td>
						<td><?php echo date( 'm/d/Y H:i:s',strtotime($file['date_added'])); ?></td>
						<td><?php echo $file['filename']; ?></td>
						<td style="color:<?php echo $file['status']==1?'green':'red'?>;" ><?php echo $file['status'] == 1 ? 'Available':'Under Process' ; ?></td>
						<td><a href="<?php echo $downloadable; ?>"><i class="fas fa-download"></i></a> | <a href="#" onclick="deleteThis('<?php echo $file['file_id'];?>','<?php echo $file['file_path'];?>');"><i class="fas fa-trash"></i></a></td>
					</tr>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td><?php echo date( 'm/d/Y H:i:s',strtotime($file['date_added'])); ?></td>
						<td><?php echo $file['filename']; ?></td>
						<?php if($file['status'] == 1 ){?>
			  			<td><p style="color: green;">Available</p></td>
			  			<td><a href="<?php echo $downloadable; ?>"><i class="fas fa-download"></i></a> | <a href="#" onclick="deleteThis('<?php echo $file['file_id'];?>','<?php echo $file['file_path'];?>');"><i class="fas fa-trash"></i></a></td>
						<?php } else { ?>
			  			<td><p style="color: red;">Under Process</p></td>
			  			<td><a href="#" onclick="deleteThis('<?php echo $file['file_id'];?>','<?php echo $file['file_path'];?>');"><i class="fas fa-trash"></i></a></td>
						<?php }?>
		  			</tr>
		  			<?php } 
		  			} else { ?>
					<tr>
			  			<td colspan="5"><h4>No Files Found</h4></td>
					</tr>
		 			<?php  }
		  			?>
				</tbody>
	  		</table>
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
</div>

</div>

</div>

</div>
</div>
<script type="text/javascript">
  function deleteThis(id,path){
  if (confirm("Would you like to delete this File?")) {
	$("#deleteId").val(id);
	$("#path").val(path);
	$("#deleter").click();
  }
}
</script>

