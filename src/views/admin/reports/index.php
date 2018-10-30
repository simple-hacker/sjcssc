<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('reports');
?>

<h1>Reports</h1>
<?php
    if (!empty($data['reports'])) {
?>
        <table>
            <thead>
                <tr>
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
                <td><?php echo $report->date; ?></td>
                <td><?php echo $report->title; ?></td>
                <td><?php echo substr($report->report, 0, 100); ?>...</td>
                <td><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/reports/edit/" . $report->id;  ?>">Edit</a></td>
            </tr>
<?php
        }
?>
            </tbody>
        </table>
<?php
    } else {
?>
        <p>No Reports available.</p>
<?php
    }
?>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>