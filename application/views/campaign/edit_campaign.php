<div id="container" class="col-md-6">
    	
        <h1>Campaign : Edit Campaign </h1>

        <div id="body">

            <div class="content-frm">
                <!-- Display the status message -->

                <form action="<?= base_url(); ?>campaign/edit/<?=$campaign->id;?>" method="post">
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
                        <?php $comp = $campaign->company_id; ?>
                        <label for="company">Name of the company</label>
                        <select name="company" id="company" class="form-control input-lg" required>
                            <option value="">Select Company</option>
                            <?php                                 
                                 foreach ($company as $row) { 
                                    $selected = ($comp == $row->id) ? "selected" : "";
                            ?>
                                <option value="<?=$row->id;?>" <?php echo $selected; ?> ><?=$row->name;?></option>
                            <?php }  ?>
                        </select>
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="client">Name of the client</label>
                        <select name="client" id="client" class="form-control input-lg" required>
                            <option value="">Select Client</option>
                            <?php                                 
                                 foreach ($client as $row) { 
                                    if($row->company_id == $campaign->company_id):
                                    $selected = ($campaign->client_id == $row->id) ? "selected" : "";
                            ?>
                                <option value="<?=$row->id;?>" <?php echo $selected; ?> ><?=$row->clientName;?></option>
                            <?php endif; }  ?>
                        </select>
                    </div>
                    <br />

                    <div class="form-group">
                        <label for="campaignName">Campaign Name</label>
                        <input type="text" name="campaignName" class="form-control input-lg" value="<?php echo !empty($campaign->campaignName) ?$campaign->campaignName : ''; ?>" placeholder="Campaign Name" required>
                        <?php echo form_error('campaignName', '<p class="field-error">', '</p>'); ?>
                    </div>
                    <br />

                    <div class="form-group">
                        <label for="totalBudget">Total Budget</label>
                        <input type="text" name="totalBudget" class="form-control input-lg" value="<?php echo !empty($campaign->totalBudget) ? $campaign->totalBudget : ''; ?>" placeholder="Total Budget" required>
                        <?php echo form_error('totalBudget', '<p class="field-error">', '</p>'); ?>
                    </div>
                    <br />

                    <div class="form-group">
                        <label for="advancePayment">Advance Payments</label>
                        <input class="form-check-input" type="radio" name="advancePayment" value="yes" id="defaultCheck1" <?=($campaign->advancePayment=='yes')?'checked':'';?>>
                        <label class="form-check-label" for="defaultCheck1">Yes</label>
                        <input class="form-check-input" type="radio" name="advancePayment" value="no" id="defaultCheck1" <?=($campaign->advancePayment=='no')?'checked':'';?>>
                        <label class="form-check-label" for="defaultCheck1">No</label>

                    </div>
                    <div class="form-group">
                        <label for="campaignName">Delivery date</label>
                        <input type="text" name="deliveryDate" class="form-control input-lg datepicker" value="<?php echo !empty($campaign->deliveryDate) ? $campaign->deliveryDate : ''; ?>" id="dobDate" placeholder="Select Date" required>
                        <?php echo form_error('deliveryDate', '<p class="field-error">', '</p>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="campaignName">Platform(s)</label>

                        <input class="form-check-input" type="checkbox" name="platforms[]" value="google" id="platform" <?php echo (in_array('google', explode(',',$campaign->platforms)) ? 'checked' : '');?>>
                        <label class="form-check-label" for="defaultCheck1">Google</label>
                        <input class="form-check-input" type="checkbox" name="platforms[]" value="facebook" id="platform" <?php echo (in_array('facebook', explode(',',$campaign->platforms)) ? 'checked' : '');?>>
                        <label class="form-check-label" for="defaultCheck1">Facebook</label>
                        <input class="form-check-input" type="checkbox" name="platforms[]" value="instagram" id="platform" <?php echo (in_array('instagram', explode(',',$campaign->platforms)) ? 'checked' : '');?>>
                        <label class="form-check-label" for="defaultCheck1">Instagram</label>
                        <input class="form-check-input" type="checkbox" name="platforms[]" value="twitter" id="platform" <?php echo (in_array('twitter', explode(',',$campaign->platforms)) ? 'checked' : '');?>>
                        <label class="form-check-label" for="defaultCheck1">Twitter</label>
                    </div>
                    <div class="form-group">
                        <label for="deliverables">Deliverables</label>
                        <textarea name="deliverables" class="form-control" aria-label="With textarea"><?=$campaign->deliverables;?></textarea>
                    </div>
                    <br />
                    <!-- <div class="form-group">
                        <label for="campaignName">List of influencers</label>
                        <input type="hidden" name="influencerList" class="influencername" value="">
                        <a href="#" data-toggle="modal" data-target="#exampleModal">Create new list</a>
                        <div class="listname"></div>
                    </div> -->
                    <div class="form-group">
                        <input type="submit" name="updateCampaign" class="btn btn-primary frm-submit" value="Save">
                    </div>
                </form>
            </div>
            <!-- Modal -->
            <!-- <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create New List</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" class="influencer_form" id="influencerForm">
                            <div class="statusMsg"></div>
                            <div class="modal-body">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Add Influencer</div>
                                    <div class="panel-body">

                                        <div class="col-sm-10 ">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="listName" name="listName" value="" placeholder="List Name" required>
                                            </div>
                                        </div>

                                        <div id="influencer_fields">

                                        </div>
                                        <div class="col-sm-3 nopadding">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="userName" name="userName[]" value="" placeholder="Name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 nopadding">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igLink" name="igLink[]" value="" placeholder="IG Link" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 nopadding">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="amount" name="amount[]" value="" placeholder="Total Amount" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-2 nopadding">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-success" type="button" onclick="influencer_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clear"></div>

                                    </div>
                                    <div class="panel-footer"><small>Press <span class="glyphicon glyphicon-plus gs"></span> to add another form field :)</small>, <small>Press <span class="glyphicon glyphicon-minus gs"></span> to remove form field :)</small></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="saveData">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->
        </div>

        <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
    </div>

    <div class="col-md-3"></div>

    </div>

</body>

</html>
<script>
    $(document).ready(function() {
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
                $('#client').html('<option value="">Select State</option>');                
            }
        });

        $('#dobDate').datepicker({
            dateFormat: 'dd/mm/yy',
            todayHighlight: true,
            //startDate: today,
            //endDate: end,
            //autoclose: true
        });

    });

    //     $('form#influencerForm').submit(function(e) {
    //         var form = $(this).serialize();
    //         var influname = $('#listName').val();
    //         console.log(influname);
    //         e.preventDefault();
    //         $.ajax({
    //             url: '<?= base_url(); ?>campaign/saveInfluencerData',
    //             type: 'POST',
    //             data: form,
    //             error: function() {
    //                 alert('Something is wrong');
    //             },
    //             success: function(data) {
    //                 $('.statusMsg').html('<span style="color:green;">Data Inserted Successfully</span>');
    //                 setTimeout(function(){
				// 	    $('#exampleModal').modal('hide');
				// 	    $('.influencername').val(influname);
    //                     $('.listname').html('List Name: '+influname);
				// 	    $('.statusMsg').html('');
				// 	}, 3000);					
                    
    //                 //alert("Record added successfully");  
    //             }
    //         });
    //     });
        
    


    // var room = 1;

    // function influencer_fields() {

    //     room++;
    //     var objTo = document.getElementById('influencer_fields')
    //     var divtest = document.createElement("div");
    //     divtest.setAttribute("class", "form-group removeclass" + room);
    //     var rdiv = 'removeclass' + room;
    //     divtest.innerHTML = '<div class="col-sm-3 nopadding"><div class="form-group"> <input type="text" class="form-control" id="userName" name="userName[]" value="" placeholder="Name" required></div></div><div class="col-sm-4 nopadding"><div class="form-group"> <input type="text" class="form-control" id="igLink" name="igLink[]" value="" placeholder="IG Link" required></div></div><div class="col-sm-3 nopadding"><div class="form-group"> <input type="text" class="form-control" id="amount" name="amount[]" value="" placeholder="Total Amount" required></div></div><div class="col-sm-2 nopadding"><div class="form-group"><div class="input-group"><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_influencer_fields(' + room + ');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div></div></div><div class="clear"></div>';

    //     objTo.appendChild(divtest)
    // }

    // function remove_influencer_fields(rid) {
    //     $('.removeclass' + rid).remove();
    // }
</script>