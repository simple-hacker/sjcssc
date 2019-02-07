<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('venues');
?>
    <form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/settings/venues'; ?>" method="POST">
        <div class="wrap">
            <h3>Add Venue</h3>
<?php
    if (isset($data['venues'])) {
        foreach ($data['venues'] as $i => $venue) {
            if (empty($venue->id)) {
?>
                <div class="form-group row">
                    <input type="hidden" name="venue_id[]" value="<?php echo (!empty($venue->id)) ? $venue->id : ''; ?>"/>
                    <div class="col-4"><input type="text" name="venue[]" class="form-control<?php if (!empty($data['venues_err'][$i])) echo ' is-invalid'; ?>" value="<?php echo (!empty($venue->venue)) ? $venue->venue : ''; ?>" placeholder="Add Venue"/></div>
                    <div class="col-4"><input type="text" name="venue_location[]" class="form-control" value="<?php echo (!empty($venue->location)) ? $venue->location : ''; ?>" placeholder="Add Venue Full"/></div>
                    <div class="col-12"><?php if (isset($data['venues_err'][$i])) display_invalid($data['venues_err'][$i]); ?></div>
                </div>
<?php
            }
        }
    }
?>
            <div class="form-group row">
                <input type="hidden" name="venue_id[]" value=""/>
                <div class="col-4"><input type="text" name="venue[]" class="form-control" value="" placeholder="Add Venue"/></div>
                <div class="col-7"><input type="text" name="venue_location[]" class="form-control" value="" placeholder="Add Venue Full"/></div>
            </div>
            <div class="form-group row">
                <div class="col-6 ml-auto text-right">
                    <button type="button" class="addRow btn btn-dark" data-item="address"><i class="fas fa-plus-square mr-2"></i> Another Row</button>
                </div>
            </div>
        </div>

        <div class="wrap">
            <h3>Edit Venues</h3>
<?php
    if (isset($data['venues'])) {
        foreach ($data['venues'] as $i => $venue) {
            if (!empty($venue->id)) {
?>
                <div class="form-group row">
                    <input type="hidden" name="venue_id[]" value="<?php echo (!empty($venue->id)) ? $venue->id : ''; ?>"/>
                    <div class="col-4"><input type="text" name="venue[]" class="form-control<?php if (!empty($data['venues_with_id_err'][$venue->id])) echo ' is-invalid'; ?>" value="<?php echo (!empty($venue->venue)) ? $venue->venue : ''; ?>" placeholder="Add Venue"/></div>
                    <div class="col-7"><input type="text" name="venue_location[]" class="form-control" value="<?php echo (!empty($venue->location)) ? $venue->location : ''; ?>" placeholder="Add Venue Full"/></div>
                    <div class="col-1"><button type="button" class="btn btn-small btn-danger deleteRow" data-item="venue" data-id="<?php echo $venue->id; ?>"><i class="fas fa-sm fa-trash-alt"></i></button></div>
                    <div class="col-12"><?php if (isset($data['venues_with_id_err'][$venue->id])) display_invalid($data['venues_with_id_err'][$venue->id]); ?></div>
            </div>
<?php
            }
        }
    }
?>
        </div>

        <div class="wrap">
            <div class="row">
                <div class="col-6 mx-auto">
                    <input type="submit" value="Save Changes" class="btn btn-block btn-brown"/>
                </div>
            </div> 
        </div>
    </form>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>