<div id="container" class="col-md-9"> 
	    <div class="row">   	
	        <h1>Payment Processing </h1>
	        <form method="post" id="invoiceForm" enctype="multipart/form-data">
                <div class="statusMsg"></div>
	        <div id="body" class="col-md-6">
	            <div class="content-frm">                
	                
	                    <?php if ($this->session->flashdata('message')) { ?>
	                        <div class="alets-pop">
	                            <div class="alert alert-<?= $this->session->flashdata('type'); ?>">
	                                <strong><?= ucfirst($this->session->flashdata('type')); ?>!</strong> <?= $this->session->flashdata('message'); ?>
	                            </div>
	                        </div>
	                    <?php } ?>

	                    <?php if (validation_errors()) { ?>
	                        <div class="alets-pop">
	                            <div class="alert alert-danger">
	                                <strong>Error!</strong> <?php echo validation_errors(); ?>
	                            </div>
	                        </div>
	                    <?php } ?>

	                    <div class="form-group">
	                        <label for="company">Name of the company</label>
	                        <select name="company" id="company" class="form-control" required>
	                            <option value="">Select Company</option>
	                            <?php
	                            foreach ($company as $row) {
	                                echo '<option value="' . $row->id . '">' . $row->name . '</option>';
	                            }
	                            ?>
	                        </select>
	                    </div>
	                    <br />
	                    <div class="form-group">
	                        <label for="client">Name of the client</label>
	                        <select name="client" id="client" class="form-control" required>
	                            <option value="">Select Client</option>
	                        </select>
	                    </div>
	                    <br />                    
	                    <div class="form-group">
	                        <label for="Campaign">Campaign Name</label>
	                        <select name="campaignName" id="campaignName" class="form-control" required>
	                            <option value="">Select Campaign</option>
	                        </select>
	                    </div>
	                    <br />

	                    <div class="form-group">
	                    	<input type="button" name="contactSubmit" id="go" class="btn btn-primary frm-submit pull-right" value="Go">
	                    </div>                    
	                
	            </div>            
	            
	        </div>
	        <div id="body" class="col-md-6">
	            <div class="content-frm">
	                    <div class="form-group">
	                        <label for="totalBudget">Total Budget</label>
	                        <input type="text" name="totalBudget" id="totalBudget" class="form-control" value="" placeholder="Total Budget" readonly="">	                        
	                    </div>
	                    <br />
	                    <div class="form-group">
	                        <label for="actualspent">Budget Actual Spent</label>
	                        <input type="text" name="actualspent" id="actualSpent" class="form-control" value="" placeholder="Actual Budget Spent" readonly>	                        
	                    </div>
	                    <br />
	                    <div class="form-group">
	                        <label for="profit">Profit</label>
	                        <input type="number" name="profit" id="profitVal" class="form-control" value="" placeholder="Profit" readonly>
	                    </div>
	                    <br />
	                    <div class="form-group">
	                        <label for="percentage">Profit %</label>
	                        <input type="number" name="profitpercnt" id="profitPercent" class="form-control" value="" placeholder="Profit Percentage" readonly>	                        
	                    </div>
	                    <br />
	            </div>	            
	        </div>
	        <div class="col-md-12">
	        	<div class="panel panel-default">
  					<div class="panel-heading">Panel heading</div>
                    <div class="table-responsive">
			        	<table class="table">
			        		<thead>
			        			<tr>
			        				<!-- <th>#</th> -->
			        				<th>Name</th>	
			        				<th>Amount</th>	
			        				<th>Invoice Uploaded</th>
			        				<th>Payment Done?</th>
			        				<th>Payment Date</th>
			        				<th>Payment Screenshot</th>
			        			</tr>			        			
			        		</thead>			        		
			        		<tbody id="tblListData">
			        						        			
			        		</tbody>
			        	</table>
                    </div>
			        </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="submit" id="saveInvoice" value="Save">
                    </div>
                    
	        	</div>

	    </div>
	    </form>
    </div>
</div>

</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#company').change(function() {
            var company_id = $('#company').val();
            if (company_id != '') {
                $.ajax({
                    url: "<?php echo base_url(); ?>campaign/fetch_clients/",
                    method: "POST",
                    data: {
                        company_id: company_id
                    },
                    success: function(data) {
                        $('#client').html(data);
                    }
                });
            } else {
                $('#state').html('<option value="">Select State</option>');
                $('#city').html('<option value="">Select City</option>');
            }
        });

        $('#client').change(function(){
        	var company_id = $('#company').val();
        	var client_id = $('#client').val();
        	if (company_id != '' && client_id != '') {
        		$.ajax({
        			url: "<?php echo base_url(); ?>campaign/fetch_compaign/",
                    method: "POST",
                    data: {
                        company_id: company_id,
                        client_id: client_id
                    },
                    success: function(data) {
                    if(data != ''){
                        $('#campaignName').html(data);
                    }else{
                    	alert('No Data Found');	
                    }
                    }
        		});
        	}
        });

        $('#go').click(function(){
        	var company_id = $('#company').val();
        	var client_id = $('#client').val();
        	var campaign_id = $('#campaignName').val();
        	if (company_id != '' && client_id != '' && campaign_id != '') {
	        	$.ajax({
	        		url: "<?php echo base_url(); ?>campaign/fetch_budget/",
                    method: "POST",
                    data: {
                        company_id: company_id,
                        client_id: client_id,
                        campaign_id: campaign_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#totalBudget').val(response.campaign_data.totalBudget);
                    	var totalbudget = $('#totalBudget').val();
                    	//console.log(response.list_content);	                    		
                    	$("#tblListData").html(response.list_content);
                        var total = Number($('#amountSum').val());
                        $('#actualSpent').val(total);
                    	var sum = $('#actualSpent').val();
                        console.log(sum, totalbudget);
                    	var profit = Number(totalbudget) - Number(sum);
                        var profitpercnt = (profit/totalbudget)*100;
                        console.log(profitpercnt.toFixed(2));
                    	$('#profitVal').val(profit);
                        $('#profitPercent').val(profitpercnt.toFixed(2));

                    }
                });
        	}        
    	});

        $('form#invoiceForm').submit(function(e) {
            //var form = $(this).serialize();
            var form = $('#invoiceForm')[0];
            var formData = new FormData(form);
            //console.log(formData.append('image', $('input[type=file]')[0].files[0]) );
            console.log(formData);                               
            e.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>campaign/saveInvoice',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                     $('.statusMsg').html('<div class="alets-pop"><div class="alert alert-success"><strong>Success!</strong> Data Inserted</div></div>');
                     setTimeout(function(){                                                
                         $('.statusMsg').html('');
                         //location.reload();
                     }, 2000);                   
                    
                    //alert("Record added successfully");  
                }
            });
        });


		$('.paymentDate').datepicker({
            dateFormat: 'dd/mm/yy',
            todayHighlight: true,
            //startDate: today,
            //endDate: end,
            //autoclose: true
        });
	});
</script>
