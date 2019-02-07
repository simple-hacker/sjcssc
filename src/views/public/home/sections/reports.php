<section>
    <div class="container">
        <div class="row">
<?php
    if (!empty($data['reports'])) {
?>
    <div class="table-responsive">
        <table class="table table-sm table-striped table-bordered text-center">
            <thead>
                <th>Date</th>
                <th>Title</th>
                <th class="d-none d-md-table-cell">Venue</th>
                <th class="d-none d-md-table-cell">View Report</th>
            </thead>
            <tbody>
<?php
        foreach ($data['reports'] as $report) {
?>
                <tr>
                    <td><?php echo date("d/m/y", strtotime($report->date)); ?></td>
                    <td><?php echo $report->title; ?></td>
                    <td class="d-none d-md-table-cell"><?php echo $report->venue; ?></td>
                    <td class="d-none d-md-table-cell"><a href="<?php echo URLROOT . $data['club']->club . '/reports/' . $report->id; ?>" class="btn btn-brown">View Report</a></td>
                </tr>
<?php
        }
?>
            </tbody>
        </table>
    </div>
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