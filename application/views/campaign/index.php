<!-- <?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Campaign</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/bootstrap-datepicker.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/bootstrap-datepicker.min.js"></script>


    <style type="text/css">
        ::selection {
            background-color: #E13300;
            color: white;
        }

        ::-moz-selection {
            background-color: #E13300;
            color: white;
        }

        body {
            background-color: #fff;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        #body {
            margin: 0 15px 0 15px;
        }

        p.footer {
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
        }

        #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
        }
        .wrapper{display: flex; justify-content: center;}
        .sidebar-section{border: 1px solid #D0D0D0; margin: 10px; box-shadow: 0 0 8px #D0D0D0;padding: 20px}
        .sidebar-section li{list-style: none;}
        a.sidebar-list {font-size: 15px; line-height: 2;font-weight: 700;}
    </style>
</head>

<body>

<div class="wrapper">
    <div class="col-md-3">
        <ul class="sidebar-section">
            <li><a href="#" class="sidebar-list">New Campaign</a></li>
            <li><a href="#" class="sidebar-list">View Campaigns</a></li>
            <li><a href="#" class="sidebar-list">Payment Processing</a></li>            
        </ul>
    </div> -->
    
    <div id="container" class="col-md-6">
    	
        <h1>Campaign : Add Campaign </h1>

        <div id="body">

            <div class="content-frm">
                <!-- Display the status message -->

                <form action="<?= base_url(); ?>campaign/saveCampaignData" method="post">
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
                        <select name="company" id="company" class="form-control input-lg" required>
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
                        <select name="client" id="client" class="form-control input-lg" required>
                            <option value="">Select Client</option>
                        </select>
                    </div>
                    <br />

                    <div class="form-group">
                        <label for="campaignName">Campaign Name</label>
                        <input type="text" name="campaignName" class="form-control input-lg" value="<?php echo !empty($postData['campaignName']) ? $postData['campaignName'] : ''; ?>" placeholder="Campaign Name" required>
                        <?php echo form_error('campaignName', '<p class="field-error">', '</p>'); ?>
                    </div>
                    <br />

                    <div class="form-group">
                        <label for="totalBudget">Total Budget</label>
                        <input type="text" name="totalBudget" class="form-control input-lg" value="<?php echo !empty($postData['totalBudget']) ? $postData['totalBudget'] : ''; ?>" placeholder="Total Budget" required>
                        <?php echo form_error('totalBudget', '<p class="field-error">', '</p>'); ?>
                    </div>
                    <br />

                    <div class="form-group">
                        <label for="advancePayment">Advance Payments</label>
                        <input class="form-check-input" type="radio" name="advancePayment" value="yes" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">Yes</label>
                        <input class="form-check-input" type="radio" name="advancePayment" value="no" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">No</label>

                    </div>
                    <div class="form-group">
                        <label for="campaignName">Delivery date</label>
                        <input type="text" name="deliveryDate" class="form-control input-lg datepicker" value="<?php echo !empty($postData['deliveryDate']) ? $postData['deliveryDate'] : ''; ?>" id="dobDate" placeholder="Select Date" required>
                        <?php echo form_error('deliveryDate', '<p class="field-error">', '</p>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="campaignName">Platform(s)</label>

                        <input class="form-check-input" type="checkbox" name="platforms[]" value="google" id="platform">
                        <label class="form-check-label" for="defaultCheck1">Google</label>
                        <input class="form-check-input" type="checkbox" name="platforms[]" value="facebook" id="platform">
                        <label class="form-check-label" for="defaultCheck1">Facebook</label>
                        <input class="form-check-input" type="checkbox" name="platforms[]" value="instagram" id="platform">
                        <label class="form-check-label" for="defaultCheck1">Instagram</label>
                        <input class="form-check-input" type="checkbox" name="platforms[]" value="twitter" id="platform">
                        <label class="form-check-label" for="defaultCheck1">Twitter</label>
                    </div>
                    <div class="form-group">
                        <label for="deliverables">Deliverables</label>
                        <textarea name="deliverables" class="form-control" aria-label="With textarea"></textarea>
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="campaignName">List of influencers</label>
                        <input type="hidden" name="influencerList" class="influencername" value="">
                        <a href="#" data-toggle="modal" data-target="#exampleModal">Create new list</a>
                        <div class="listname"></div>
                    </div>

                    <input type="submit" name="contactSubmit" class="btn btn-primary frm-submit" value="Save">
                </form>
            </div>
            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            </div>
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
                $('#state').html('<option value="">Select State</option>');
                $('#city').html('<option value="">Select City</option>');
            }
        });

        $('#dobDate').datepicker({
            dateFormat: 'dd/mm/yy',
            todayHighlight: true,
            //startDate: today,
            //endDate: end,
            //autoclose: true
        });

        $('form#influencerForm').submit(function(e) {
            var form = $(this).serialize();
            var influname = $('#listName').val();
            console.log(influname);
            e.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>campaign/saveInfluencerData',
                type: 'POST',
                data: form,
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    $('.statusMsg').html('<span style="color:green;">Data Inserted Successfully</span>');
                    setTimeout(function(){
					    $('#exampleModal').modal('hide');
					    $('.influencername').val(influname);
                        $('.listname').html('List Name: '+influname);
					    $('.statusMsg').html('');
					}, 1000);					
                    
                    //alert("Record added successfully");  
                }
            });
        });
        
    });


    var room = 1;

    function influencer_fields() {

        room++;
        var objTo = document.getElementById('influencer_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group removeclass" + room);
        var rdiv = 'removeclass' + room;
        divtest.innerHTML = '<div class="col-sm-3 nopadding"><div class="form-group"> <input type="text" class="form-control" id="userName" name="userName[]" value="" placeholder="Name" required></div></div><div class="col-sm-4 nopadding"><div class="form-group"> <input type="text" class="form-control" id="igLink" name="igLink[]" value="" placeholder="IG Link" required></div></div><div class="col-sm-3 nopadding"><div class="form-group"> <input type="text" class="form-control" id="amount" name="amount[]" value="" placeholder="Total Amount" required></div></div><div class="col-sm-2 nopadding"><div class="form-group"><div class="input-group"><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_influencer_fields(' + room + ');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div></div></div><div class="clear"></div>';

        objTo.appendChild(divtest)
    }

    function remove_influencer_fields(rid) {
        $('.removeclass' + rid).remove();
    }
</script>