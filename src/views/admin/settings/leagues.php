<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('leagues');
?>
    <form action="<?php echo ADMIN_URLROOT . $data['club_name'] . '/settings/leagues'; ?>" method="POST">
        <div class="wrap">
            <h3>Add League</h3>
<?php
    if (isset($data['leagues'])) {
        foreach ($data['leagues'] as $i => $league) {
            if (empty($league->id)) {
?>
                <div class="form-group row">
                    <input type="hidden" name="league_id[]" value="<?php echo (!empty($league->id)) ? $league->id : ''; ?>"/>
                    <div class="col-3"><input type="text" name="league[]" class="form-control<?php if (!empty($data['leagues_err'][$i])) echo ' is-invalid'; ?>" value="<?php echo (!empty($league->league)) ? $league->league : ''; ?>" placeholder="Add League"/></div>
                    <div class="col-4"><input type="text" name="league_full[]" class="form-control" value="<?php echo (!empty($league->league_full)) ? $league->league_full : ''; ?>" placeholder="Add League Full"/></div>
                    <div class="col-4"><input type="text" name="league_website[]" class="form-control" value="<?php echo (!empty($league->league_website)) ? $league->league_website : ''; ?>" placeholder="Add League Website"/></div>
                    <div class="col-12"><?php if (isset($data['leagues_err'][$i])) display_invalid($data['leagues_err'][$i]); ?></div>
                </div>
<?php
            }
        }
    }
?>
            <div class="form-group row">
                <input type="hidden" name="league_id[]" value=""/>
                <div class="col-3"><input type="text" name="league[]" class="form-control" value="" placeholder="Add League"/></div>
                <div class="col-4"><input type="text" name="league_full[]" class="form-control" value="" placeholder="Add League Full"/></div>
                <div class="col-4"><input type="text" name="league_website[]" class="form-control" value="" placeholder="Add League Website"/></div>
            </div>
        </div>

        <div class="wrap">
            <h3>Edit Leagues</h3>
<?php
    if (isset($data['leagues'])) {
        foreach ($data['leagues'] as $i => $league) {
            if (!empty($league->id)) {
?>
                <div class="form-group row">
                    <input type="hidden" name="league_id[]" value="<?php echo (!empty($league->id)) ? $league->id : ''; ?>"/>
                    <div class="col-3"><input type="text" name="league[]" class="form-control<?php if (!empty($data['leagues_with_id_err'][$league->id])) echo ' is-invalid'; ?>" value="<?php echo (!empty($league->league)) ? $league->league : ''; ?>" placeholder="Add League"/></div>
                    <div class="col-4"><input type="text" name="league_full[]" class="form-control" value="<?php echo (!empty($league->league_full)) ? $league->league_full : ''; ?>" placeholder="Add League Full"/></div>
                    <div class="col-4"><input type="text" name="league_website[]" class="form-control" value="<?php echo (!empty($league->league_website)) ? $league->league_website : ''; ?>" placeholder="Add League Website"/></div>
                    <div class="col-1"><button href="<?php echo ADMIN_URLROOT . $data['club_name'] . "/settings/leagues/delete/" . $team->id; ?>" class="btn btn-small btn-danger" disabled><i class="fas fa-sm fa-trash-alt"></i></button></div>
                    <div class="col-12"><?php if (isset($data['leagues_with_id_err'][$league->id])) display_invalid($data['leagues_with_id_err'][$league->id]); ?></div>
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