<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('people');
?>
<form action="<?php echo ADMIN_URLROOT . $data['club_name'] . '/settings/people'; ?>" method="POST">
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
                    <div class="col-1"><button href="<?php echo ADMIN_URLROOT . $data['club_name'] . "/settings/people/delete/" . $team->id; ?>" class="btn btn-small btn-danger" disabled><i class="fas fa-sm fa-trash-alt"></i></button></div>
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
                    <div class="col-1"><input type="checkbox" name="people_active[]" class="form-control" value="<?php echo $person->id; ?>" placeholder="Active?" <?php echo ($person->active) ? ' checked' : ''; ?>/></div>
                    <div class="col-1"><button href="<?php echo ADMIN_URLROOT . $data['club_name'] . "/settings/people/delete/" . $team->id; ?>" class="btn btn-small btn-danger" disabled><i class="fas fa-sm fa-trash-alt"></i></button></div>
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