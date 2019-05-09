<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Caros cars</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel ="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/custom/style.css">
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css "rel="stylesheet">

</head>
<body>
    <nav class="navbar navbar-light" style="background-color: #FC6C02;">
        <h4>Caro CarShop</h4>
    </nav>
    <main class ="container">
        
        <?php echo anchor("cars/add_car", "Add New Car"); ?>
        <table class="table table-striped table-bordered">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Car Make</th>
                <th scope="col">Color</th>
                <th scope="col">RegistrationNumber</th>
                <th scope="col">YearOfManufuctring</th>
                <th scope="col">Car Type</th>
                <th scope="col">Availability</th>
                <th scope="col">DateCreated</th>
                <th scope="col">DateUpdated</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            <tr>
            <?php 
                foreach($car_details->result() as $row){ 
                    $car_make = $row->car_make;
                    $color = $row->color;
                    $registration_number = $row->registration_number;
                    $year_of_manufuctring = $row->year_of_manufuctring;
                    $car_type = $row->car_type;
                    $availability = $row->availability;
                    $date_created = $row->date_created;
                    $date_updated = $row->date_updated;
                    ?>
                    <td><?php echo $car_make ?></td>
                }
                endforeach
                
            ?>
            </tr>
        </table>
      
    </main>
    <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-3.3.1.slim.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/themes/custom/feather.min.js"></script>
    <script src="<?php echo base_url() ?>assets/themes/custom/script.js"></script>
</body>
</html>