<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('people');
?>
<form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/settings/people'; ?>" method="POST">
    <div class="wrap">
        <h3>Add People</h3>
<?php
    if (isset($data['people'])) {
        foreach ($data['people'] as $i => $person) {
            if (empty($person->id)) {
?>
                <div class="form-group row">
                    <input type="hidden" name="people_id[]" value="<?php echo (!empty($person->id)) ? $person->id : ''; ?>"/>
                    <div class="col-5"><input type="text" name="people[]" class="form-control<?php if (!empty($data['people_err'][$i])) echo ' is-invalid'; ?>" value="<?php echo (!empty($person->name)) ? $person->name : ''; ?>" placeholder="Add Person"/></div>
                    <div class="col-5"><input type="email" name="people_email[]" class="form-control" value="<?php echo (!empty($person->email)) ? $person->email : ''; ?>" placeholder="Add Person's Email"/></div>
                    <div class="col-12"><?php if (isset($data['people_err'][$i])) display_invalid($data['people_err'][$i]); ?></div>
                </div>
<?php
            }
        }
    }
?>
        <div class="form-group row">
            <input type="hidden" name="people_id[]" value=""/>
            <div class="col-5"><input type="text" name="people[]" class="form-control" value="" placeholder="Add Person"/></div>
            <div class="col-5"><input type="email" name="people_email[]" class="form-control" value="" placeholder="Add Person's Email"/></div>
        </div>
        <div class="form-group row">
            <div class="col-6 ml-auto text-right">
                <button type="button" class="addRow btn btn-dark" data-item="address"><i class="fas fa-plus-square mr-2"></i> Another Row</button>
            </div>
        </div>
    </div>

    <div class="wrap">        
        <h3>Edit People</h3>
<?php
    if (isset($data['people'])) {
        foreach ($data['people'] as $i => $person) {
            if (!empty($person->id)) {
?>
                <div class="form-group row">
                    <input type="hidden" name="people_id[]" value="<?php echo (!empty($person->id)) ? $person->id : ''; ?>"/>
                    <div class="col-5"><input type="text" name="people[]" class="form-control<?php if (!empty($data['people_with_id_err'][$person->id])) echo ' is-invalid'; ?>" value="<?php echo (!empty($person->name)) ? $person->name : ''; ?>" placeholder="Add Person"/></div>
                    <div class="col-5"><input type="email" name="people_email[]" class="form-control" value="<?php echo (!empty($person->email)) ? $person->email : ''; ?>" placeholder="Add Person's Email"/></div>
                    <div class="col-1">
                        <div class="pretty p-icon p-curve p-jelly">
                        <input type="checkbox" name="people_active[]" onclick="toggleActive(<?php echo $data['club']->id; ?>, <?php echo $person->id; ?>);" value="<?php echo $person->id; ?>" placeholder="Active?" <?php echo ($person->active) ? ' checked' : ''; ?>/>
                            <div class="state p-warning">
                                <i class="icon fas fa-check"></i>
                                <label></label>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-1"><button type="button" class="btn btn-small btn-danger deleteRow" data-item="people" data-id="<?php echo $person->id; ?>"><i class="fas fa-sm fa-trash-alt"></i></button></div>
                    <div class="col-12"><?php if (isset($data['people_with_id_err'][$person->id])) display_invalid($data['people_with_id_err'][$person->id]); ?></div>
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