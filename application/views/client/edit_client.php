
<div id="container" class="col-md-6">
    	
        <h1>Campaign : Edit Client </h1>

        <div id="body">

            <div class="content-frm">
                
                <form action="<?= base_url(); ?>client/editClient/<?=$client->id;?>" method="post">
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
                        <select name="company" id="company" class="form-control input-lg selectpicker" data-live-search="true" required>
                            <option value="">Select Company</option>
                            <?php
                            foreach ($company as $row) {
                                $selected = ($client->company_id == $row->id) ? "selected" : "";
                                echo '<option value="' . $row->id . '" '.$selected.'>' . $row->name . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="client">Name of the client</label>
                        <input type="text" name="clientName" class="form-control input-lg" placeholder="Client Name" required="" value="<?php echo !empty($client->clientName) ? $client->clientName : ''; ?>">
                    </div>
                    <br />

                    <div class="form-group">
                        <label for="GSTNUMBER">GST Number</label>
                        <input type="text" name="gstNumber" class="form-control input-lg" placeholder="GST Number" required value="<?php echo !empty($client->gstNumber) ? $client->gstNumber : ''; ?>">                        
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" name="emailAddress" class="form-control input-lg" placeholder="Enter Email" required value="<?php echo !empty($client->emailAddress) ? $client->emailAddress : ''; ?>">                        
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="Address">Address</label>
                        <textarea name="address" class="form-control"><?php echo !empty($client->address) ? $client->address : ''; ?></textarea>                        
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="Contact">Contact No.</label>
                        <input type="text" name="contactNumber" class="form-control input-lg" placeholder="Contact No." required value="<?php echo !empty($client->contactNumber) ? $client->contactNumber : ''; ?>">                        
                    </div>                    
                    <br />
                   <div class="form-group">
                        <input type="submit" name="clientUpdate" class="btn btn-primary frm-submit" value="Update">
                    </div>
                </form>
            </div>            
        </div>
    </div>

    <div class="col-md-3"></div>

    </div>

</body>

</html>
<script type="text/javascript">
    $(function() {
      $('.selectpicker').selectpicker();
    });
</script>