<div class="modal-header">
    <h5 class="modal-title" id="DistanceQuestsModal">
        <?php echo i8ln("Update Distance for all tracked Quests?"); ?>
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<!-- CHECK CURRENT DISTANCE SET -->
<?php
    $sql = "SELECT distance from quest WHERE id = '" . $_SESSION['id'] . "' GROUP by distance";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
            while ($row = $result->fetch_assoc()) {
                    $distance_set = $row['distance'];
            }
    } else {
            $distance_set = 0;
    }
?>
<form action='./form_action.php?action=update_quests_distance' method='POST'>
<div class="modal-body">
    <?php echo i8ln("This will update Distance settings for ALL tracked Quests"); ?>.<br><br>
    <?php echo i8ln("Please Set New Distance"); ?>:
    <div class="form-row align-items-center">
       <div class="col-sm-12 my-1 mt-2">
           <div class="input-group">
               <div class="input-group-prepend">
                   <div class="input-group-text"><?php echo i8ln("Distance"); ?></div>
               </div>
               <input type='hidden' id='type' name='type' value='quests'>
               <input type="number" id='distance' name='distance' value='<?php echo $distance_set; ?>' min='0'
                   class="form-control text-center">
               <div class="input-group-append">
                  <span class="input-group-text"><?php echo i8ln("meters"); ?></span>
               </div>
          </div>
       </div>
   </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary">
        <?php echo i8ln("UPDATE"); ?></button>
    <button type="button" class="btn btn-secondary"
        data-dismiss="modal"><?php echo i8ln("CANCEL"); ?></button>
</div>
</form>

