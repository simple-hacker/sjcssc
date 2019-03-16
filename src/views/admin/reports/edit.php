<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('reports');
?>

<div class="wrap">
    <h3>Edit Report for <?php echo $data['report']->title; ?></h3>
    <form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/reports/edit/' . $data['report']->id; ?>" method="POST">
        <textarea name="report" placeholder="Enter Report" rows="5" class="form-control"><?php echo (isset($data['report']->report)) ? $data['report']->report : ''; ?></textarea>
        <div class="row mt-4">
            <div class="col-6 mx-auto"><input type="submit" value="Save Report" class="btn btn-brown btn-block"/></div>
        </div>
    </form>
</div>

<?php
    if (!empty($data['report_err'])) {
        print_var($data['report_err']);
    }
?>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>