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
    if (!empty($data['reports'])) {
?>
    <div class="wrap">
    <h3>Reports</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr class="thead-light text-center">
                        <th>Date</th>
                        <th>Title</th>
                        <th>Report</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
<?php
        foreach ($data['reports'] as $report) {
?>
                <tr>
                    <td><?php echo date("d/m/y", strtotime($report->date)); ?></td>
                    <td><?php echo $report->title; ?></td>
                    <td><?php echo substr($report->report, 0, 100); ?>...</td>
                    <td class="text-center"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/reports/edit/" . $report->id; ?>" class="btn btn-small btn-primary"><i class="fas fa-sm fa-edit"></i></a></td>
                </tr>
<?php
        }
?>
                </tbody>
            </table>
        </div>
    </div>
<?php   } ?>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>