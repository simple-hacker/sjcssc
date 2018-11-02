<section>
    <div class="container">
<?php
    if (!empty($data['notices'])) {
        foreach ($data['notices'] as $notice) {
?>
            <div class="card mb-3">
                <div class="card-header text-center sj-heading-small">
                    <?php echo ($notice->important == true) ? '<i class="fa fa-star"></i> ' : ''; ?>
                    <?php echo $notice->title; ?>
                    <?php echo ($notice->important == true) ? ' <i class="fa fa-star"></i>' : ''; ?>
                </div>
                <div class="card-body">
                    <p><?php echo $notice->notice; ?><p>
                    <div class="blockquote-footer">Posted on <?php echo date("l jS F, Y", strtotime($notice->created_date)); ?></div>
                </div>
            </div>
<?php
        }
    }
?>
    </div>
</section>