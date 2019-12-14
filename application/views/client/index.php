
<div id="container" class="col-md-6">
    	
        <h1>Campaign : Add Client </h1>

        <div id="body">

            <div class="content-frm">
                <!-- Display the status message -->

                <form action="<?= base_url(); ?>client/saveClientData" method="post">
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
                                echo '<option value="' . $row->id . '">' . $row->name . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="client">Name of the client</label>
                        <input type="text" name="clientName" class="form-control input-lg" value="" placeholder="Client Name" required="">
                    </div>
                    <br />

                    <div class="form-group">
                        <label for="GSTNUMBER">GST Number</label>
                        <input type="text" name="gstNumber" class="form-control input-lg" value="" placeholder="GST Number" required>                        
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" name="emailAddress" class="form-control input-lg" value="" placeholder="Enter Email" required>                        
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="Address">Address</label>
                        <textarea name="address" class="form-control"></textarea>                        
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="Contact">Contact No.</label>
                        <input type="text" name="contactNumber" class="form-control input-lg" value="" placeholder="Contact No." required>                        
                    </div>                    
                    <br />
                   <div class="form-group">
                        <input type="submit" name="clientSubmit" class="btn btn-primary frm-submit" value="Save">
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