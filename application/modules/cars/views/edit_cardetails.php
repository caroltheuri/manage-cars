<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Update Car</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel ="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/custom/style.css">
    <link href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css "rel="stylesheet">
    <script src="main.js"></script>
</head>
<body>
    <div class = "container">
        <?php
            $validation_errors = validation_errors();
            if (!empty($validation_errors)) {
                echo $validation_errors;
            }
        ?>
         <?php echo anchor("cars/index", "Go Home",array("class" => "btn btn-warning")); ?>
        <?php echo form_open_multipart($this->uri->uri_string()); ?>
            <div class="form-group">
                <label for="color">Color</label>
                <input type="text" name="color" class="form-control" value="<?php echo $color ?>"/>
            </div>
            <div class="form-group mb-3">
            
                <label for="availability"><?php echo $availability ?></label>
                <select class="custom-select form-control" name="availability" value="<?php echo $availability ?>">
                    <option selected>Choose...</option>
                    <option value="1">Available</option>
                    <option value="0">Not Available</option>
                </select>
            </div>
            <div class="submit_button">
                <input type ="submit" class="btn btn-primary" value="Update Car Details"/>
            </div>
        <?php echo form_close() ?>
    </div>
    <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-3.3.1.slim.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/themes/custom/feather.min.js"></script>
    <script src="<?php echo base_url() ?>assets/themes/custom/script.js"></script>
</body>
</html>