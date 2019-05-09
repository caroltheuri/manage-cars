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
        <table class="table table-striped table-bordered table-sm">
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
                <th colspan=3 >Actions</th>
            </tr>
            
            <?php 
            $count = 0;
            if ($car_details->num_rows() > 0) 
            {
                foreach($car_details->result() as $row){ 
                    $count ++;
                    $id = $row->car_id;
                    $car_make = $row->car_make;
                    $color = $row->color;
                    $registration_number = $row->registration_number;
                    $year_of_manufuctring = $row->year_of_manufuctring;
                    $car_type = $row->car_type;
                    $availability = $row->availability;
                    $date_created = $row->date_created;
                    $date_updated = $row->date_updated;
                    ?>
                    <tr>
                        <td><?php echo $count ?></td>
                        <td><?php echo $car_make ?></td>
                        <td><?php echo $color ?></td>
                        <td><?php echo $registration_number ?></td>
                        <td><?php echo $year_of_manufuctring ?></td>
                        <td><?php echo $car_type ?></td>
                        <td><?php echo $availability ?></td>
                        <td><?php echo $date_created ?></td>
                        <td><?php echo $date_updated ?></td>
                        <td><a href="" class="btn btn-primary">Edit</a></td>
                        <?php if($availability == 1){?>
                            <td><a href="" class="btn btn-warning" width="5%">De-Activate</a></td>
                        <?php }
                        else{?>
                            <td><a href="" class="btn btn-success">Activate</a></td>
                        <?php }
                        ?>
                        <td><?php echo anchor("cars/cars/delete_car/".$id,"Delete",array("onclick" => "return confirm('Are you sure you want to delete?')", "class" => "btn btn-danger"));?></td>
                    </tr>
                    <?php 
                }
            }?>
        </table>
    </main>
    <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-3.3.1.slim.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/themes/custom/feather.min.js"></script>
    <script src="<?php echo base_url() ?>assets/themes/custom/script.js"></script>
</body>
</html>