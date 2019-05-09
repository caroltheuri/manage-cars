 <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#individualFriend">
View friend
</button> -->

<!-- Modal -->
<div class="modal fade" id="individualFriend<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $name; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
    <table class="tableh">
<tr>
<th scope="col">#</th>
<th scope="col">Name</th>
<th scope="col">Phone Number</th>
<th scope="col">Picture</th>
<th scope="col">Edit Friend</th>

</tr>
<tr>
<td>
    <?php echo $count; ?>
</td>
<td>
    <?php echo $name; ?>
</td>
<td>
    <?php echo $age; ?>
</td>
<td>
    <?php echo $gender; ?>
</td>
<td>

<?php echo anchor("friends/friends/display_edit_form/" . $id, "Edit", "class ='btn btn-info'"); ?>
</td>
<td>
<?php echo anchor("friends/friends/delete_friend/" . $id, "Delete", array("onclick" => "return confirm('Are you sure you want to delete?')", "class" => "btn btn-danger")); ?>

</td>
</tr>

</table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div>
    </div>
</div>
</div>