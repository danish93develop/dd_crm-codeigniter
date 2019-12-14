<div class="col-md-9">
	<div class="panel panel-default">		
			<div class="panel-heading">View Campaigns</div>
        	<table class="table">
        		<thead>
        			<tr>
        				<th>#</th>        				
        				<th>Client Name</th>	
        				<th>GST No.</th>
        				<th>Address</th>
        				<th>Contact No.</th>        				
        				<th>Email</th>        				
        				<th>Action</th>
        			</tr>			        			
        		</thead>			        		
        		<tbody id="tblListData">
        			<?php //echo"<pre>"; print_r($campaignData);  die(); ?>
        			<?php $i=1; foreach($rowData as $row): ?>
        			<tr>
        				<th scope="row"><?=$i;?></th>
        				<td><?=$row->clientName;?></td>
        				<td><?=$row->gstNumber;?></td>
        				<td><?=$row->address;?></td>
        				<td><?=$row->contactNumber;?></td>
        				<td><?=$row->emailAddress;?></td>        				
        				<td>
        					<a href="<?=base_url();?>client/edit/<?=$row->id;?>" class="btn btn-info a-btn-slide-text">
						        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						    </a>
							<a href="#" class="btn btn-danger a-btn-slide-text" onclick="deleteFun('<?=base_url().'client/delete/'.$row->id;?>')">
						       <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						    </a>
						</td>
        			</tr>
        		<?php $i++; endforeach; ?>
        		</tbody>
        	</table>
        </div>
	</div>
	<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header" style="background-color: #e85252; color: #fff;">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
	      </div>
	      <div class="modal-body">
	        Are You Sure to Delete!
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <a href="" class="btn btn-danger getdeleteurl">Yes, Delete!</a>
	      </div>
	    </div>
	  </div>
	</div>
<script>
	function deleteFun(url) {
		jQuery('.getdeleteurl').attr('href', url);
		jQuery('#deleteModel').modal('show');
	}
</script>