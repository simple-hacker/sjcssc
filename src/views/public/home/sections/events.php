<section>
    <div class="container">
        <div class="row">
<?php
    if (!empty($data['events'])) {
        foreach ($data['events'] as $event) {
?>
            <div class="col-12 col-lg-6">
                <div class="card mb-3">
                    <div class="card-header text-center sj-heading-small">
                        <?php echo $event->title; ?>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row align-items-center mt-1">
                                <div class="col-2"><i class="fa fa-calendar-alt border"></i></div>
                                <div class="col-10"><?php echo date("l jS F, Y", strtotime($event->date)); ?></div>
                            </div>
                            <div class="row align-items-center mt-1">
                                <div class="col-2"><i class="fa fa-clock border"></i></div>
                                <div class="col-10"><?php echo date("H:i", strtotime($event->time)); ?></div>
                            </div>
                    <?php
                            if (!empty($event->venue)) {
                    ?>
                            <div class="row align-items-center mt-1">
                                <div class="col-2"><i class="fa fa-map-marker-alt border"></i></div>
                                <div class="col-10"><?php echo $event->venue; ?></div>
                            </div>
                    <?php
                            }
                    ?>
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <a href="<?php echo URLROOT . $data['club']->club . '/events/' . $event->event_id; ?>" class="btn btn-brown">View Event</a>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="blockquote-footer">Created on <?php echo date("l jS F, Y", strtotime($event->created_date)); ?></div>
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
                <a href="<?php echo URLROOT . $data['club']->club . '/events/'; ?>" class="btn btn-lg btn-brown">View All Events</a>
            </div>
        </div>
    </div>
</section>