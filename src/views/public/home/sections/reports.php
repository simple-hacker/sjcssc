<section>
    <div class="container">
        <div class="row">
<?php
    if (!empty($data['reports'])) {
?>
    <table class="table table-sm table-striped table-bordered text-center">
        <thead>
            <th>Date</th>
            <th>Title</th>
            <th>Venue</th>
            <th>View Report</th>
        </thead>
        <tbody>
<?php
        foreach ($data['reports'] as $report) {
?>
            <tr>
                <td><?php echo $report->date; ?></td>
                <td><?php echo $report->title; ?></td>
                <td><?php echo $report->venue; ?></td>
                <td><a href="<?php echo URLROOT . $data['club']->club . '/reports/' . $report->id; ?>" class="btn btn-brown">View Report</a></td>
            </tr>
<?php
        }
?>
        </tbody>
    </table>
<?php
    }
?>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <a href="<?php echo URLROOT . $data['club']->club . '/reports/'; ?>" class="btn btn-lg btn-brown">View All Reports</a>
            </div>
        </div>
    </div>
</section>