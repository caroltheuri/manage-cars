<?php
$tr_friends = "";

if ($all_friends->num_rows() > 0) 
{
    
    $count = $page;

    foreach($all_friends->result() as $row) 
    {
        $count++;
        $id = $row->friend_id;
        $name = $row->friend_name;
        $age = $row->friend_age;
        $gender = $row->friend_gender;
        $friend_thumbnail = $row->friend_thumb; 
        $modal_data = array(
            'name' => $name,
            'id' => $id,
            'count' => $count,
            'age' => $age,
            'gender' => $gender
        );

        $tr_friends .= '
            <tr>
                <td>' . $count . '</td>
                <td>' . $name . '</td>
                <td>' . $age . '</td>
                <td>' .$gender .  '</td>
                <td><img src="'. base_url() . 'assets/uploads/' .$friend_thumbnail .'"></td>
                <td>
                <a href="#individualFriend' . $id . '" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#individualFriend' . $id . '">View friend</a>
                </td>
                <td>'
                    . anchor("friends/friends/display_edit_form/" . $id, "Edit", "class ='btn btn-info'") .
                '</td>
                <td>'
                . anchor("friends/friends/delete_friend/" . $id, "Delete", array("onclick" => "return confirm('Are you sure you want to delete?')", "class" => "btn btn-danger")) .

                '</td>
            </tr>
        ';

        $this->load->view('view_friend',$modal_data);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel ="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/custom/style.css">
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css "rel="stylesheet">

</head>
<body>
    <div class ="container">

        <h1>My friends</h1>
        <?php echo form_open($this->uri->uri_string()) ?>
        <div class = "form-group">
            <input name="search" class="form-control form-control-dark w-10 col-md-3" type="text" placeholder="Search by name" aria-label="Search">
        </div>
        <div class = "form-group">
            <input type = "submit" value="Search" class="btn btn-primary">
        </div>
        <?php echo form_close() ?>

        <?php echo anchor("friends/new_friend", "Add Friend"); ?>
        <table class="table">

            <tr>
                <th scope="col">#</th>
                <th scope="col"><a href="<?php echo site_url().'friends/all-friends/friend_name/'.$order_method.'/'.$page ?>">Name</a></th>
                <th scope="col">Phone Number</th>
                <th scope="col">Gender</th>
                <th>Images</th>
                <th scope="col">View Friend</th>
                <th scope="col">Edit Friend</th>
            </tr>
            <?php echo $tr_friends; ?>
        </table>
       <!-- pagination -->
        <?php echo $links;?>
        <!-- end of pagination -->
    </div>

</body>
</html>