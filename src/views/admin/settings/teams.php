<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('teams');
?>

<form action="<?php echo ADMIN_URLROOT . $data['club_name'] . '/settings/teams'; ?>" method="POST">
    <div class="wrap">
        <h3>Add Team</h3>
<?php                           
if (isset($data['teams'])) {
    foreach ($data['teams'] as $i => $team) {
        if (empty($team->id)) {
?>
        <div class="form-group row">
            <input type="hidden" name="team_id[]" value="<?php echo (!empty($team->id)) ? $team->id : ''; ?>"/>
            <div class="col-4"><input type="text" name="team[]" class="form-control<?php if (!empty($data['teams_err'][$i])) echo ' is-invalid'; ?>" value="<?php echo (!empty($team->team)) ? $team->team : ''; ?>" placeholder="Add Team"/></div>
            <div class="col-"></div><input type="text" name="team_location[]" class="form-control" value="<?php echo (!empty($team->location)) ? $team->location : ''; ?>" placeholder="Add Team Location"/></div>
            <div class="col-1"><button href="<?php echo ADMIN_URLROOT . $data['club_name'] . "/settings/teams/delete/" . $team->id; ?>" class="btn btn-small btn-danger" disabled><i class="fas fa-sm fa-trash-alt"></i></button></div>
            <div class="col-12"><?php if (isset($data['teams_err'][$i])) display_invalid($data['teams_err'][$i]); ?></div>
        </div>
<?php
            }
        }
    }
?>
        <div class="form-group row">
            <input type="hidden" name="team_id[]" value=""/>
            <div class="col-4"><input type="text" name="team[]" class="form-control" value="" placeholder="Add Team"/></div>
            <div class="col-7"><input type="text" name="team_location[]" class="form-control" value="" placeholder="Add Team Location"/></div>
        </div>
    </div>

    <div class="wrap">
        <h3>Edit Teams</h3>
<?php
    if (isset($data['teams'])) {
        foreach ($data['teams'] as $i => $team) {
            if (!empty($team->id)) {
?>
                <div class="form-group row">
                    <input type="hidden" name="team_id[]" value="<?php echo (!empty($team->id)) ? $team->id : ''; ?>"/>
                    <div class="col-4"><input type="text" name="team[]" class="form-control<?php if (!empty($data['teams_with_id_err'][$team->id])) echo ' is-invalid'; ?>" value="<?php echo (!empty($team->team)) ? $team->team : ''; ?>" placeholder="Add Team"/></div>
                    <div class="col-7"><input type="text" name="team_location[]" class="form-control" value="<?php echo (!empty($team->location)) ? $team->location : ''; ?>" placeholder="Add Team Location"/></div>
                    <div class="col-1"><button href="<?php echo ADMIN_URLROOT . $data['club_name'] . "/settings/teams/delete/" . $team->id; ?>" class="btn btn-small btn-danger" disabled><i class="fas fa-sm fa-trash-alt"></i></button></div>
                    <div class="col-12"><?php if (isset($data['teams_with_id_err'][$team->id])) display_invalid($data['teams_with_id_err'][$team->id]); ?></div>
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