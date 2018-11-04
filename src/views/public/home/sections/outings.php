<section>
    <div class="container">
        <div class="row">
<?php
    if (!empty($data['outings'])) {
        foreach ($data['outings'] as $outing) {
?>
            <div class="col-12 col-lg-4">
                <div class="card mb-3">
                    <div class="card-header table-striped text-center sj-heading-small">
                        <?php echo $outing->title; ?>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row mt-1">
                                <div class="col-2"><i class="fa fa-star border"></i></div>
                                <div class="col-10"><?php echo $outing->title; ?></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-2"><i class="fa fa-calendar-alt border"></i></div>
                                <div class="col-10"><?php echo date("l jS F, Y", strtotime($outing->date)); ?></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-2"><i class="fa fa-clock border"></i></div>
                                <div class="col-10"><?php echo date("H:i", strtotime($outing->time)); ?></div>
                            </div>
                    <?php
                            if (!empty($outing->venue)) {
                    ?>
                            <div class="row mt-1">
                                <div class="col-2"><i class="fa fa-map-marker-alt border"></i></div>
                                <div class="col-10"><?php echo $outing->venue; ?></div>
                            </div>
                    <?php
                            }
                    ?>
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <a href="<?php echo URLROOT . $data['club']->club . '/outings/' . $outing->id; ?>" class="btn btn-brown">View Outing</a>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    }
?>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <a href="<?php echo URLROOT . $data['club']->club . '/outings/'; ?>" class="btn btn-lg btn-brown">View All Upcoming Outings</a>
            </div>
        </div>
    </div>
</section>