<?php
    if (file_exists(PUBLIC_VIEWS . 'inc/header.php')) {
        require_once(PUBLIC_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>

<?php 
    $bg = 'img/parallax/' . $data['club']->club . '/' . strtolower(basename(dirname(__FILE__))) . '.jpg';
    $bg_url = (file_exists(PUBLIC_ROOT . $bg)) ? URLROOT . $bg : 'img/parallax/' . $data['club']->club . '/main.jpg';
?>
    <div class="parallax">
        <div class="parallax-background" style="background-image: url(<?php echo $bg_url; ?>)"></div>
        <div class="parallax-text sj-heading-large">
            <?php echo isset(CLUBS[$data['club']->club]['section_titles']['events']) ? CLUBS[$data['club']->club]['section_titles']['events'] : 'Events'; ?>
        </div>
    </div>
    <section>
        <div class="container mt-2">
            <div class="row">
<?php
            if (!empty($data['event'])) {
?>
                <div class="card mb-3">
                <div class="card-header text-center sj-heading-small">
                    <?php echo $data['event']->title; ?>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row align-items-center mt-2">
                            <div class="col-4 text-right"><i class="fa fa-calendar-alt border"></i></div>
                            <div class="col-8"><?php echo date("l jS F, Y", strtotime($data['event']->date)); ?></div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="col-4 text-right"><i class="fa fa-clock border"></i></div>
                            <div class="col-8"><?php echo date("H:i", strtotime($data['event']->time)); ?></div>
                        </div>
                <?php
                        if (!empty($data['event']->location)) {
                ?>
                        <div class="row align-items-center mt-2">
                            <div class="col-4 text-right"><i class="fa fa-map-marker-alt border"></i></div>
                            <div class="col-8"><?php echo $data['event']->location; ?></div>
                        </div>
                <?php
                        }
                ?>
                <?php
                        if (!empty($data['event']->meet_at)) {
                ?>
                        <div class="row align-items-center mt-2">
                            <div class="col-4 text-right">Meet At:</div>
                            <div class="col-8"><?php echo $data['event']->meet_at; ?></div>
                        </div>
                <?php
                        }
                ?>
                <?php
                        if (!empty($data['event']->contact)) {
                ?>
                        <div class="row align-items-center mt-2">
                            <div class="col-4 text-right">Contact Details:</div>
                            <div class="col-8"><?php echo $data['event']->contact; ?></div>
                        </div>
                <?php
                        }
                ?>
                <?php
                        if (!empty($data['event']->other_information)) {
                ?>
                        <div class="row align-items-center mt-2">
                            <div class="col-4 text-right">Other Information:</div>
                            <div class="col-8"><?php echo $data['event']->other_information; ?></div>
                        </div>
                <?php
                        }
                ?>
                        <div class="row mt-3">
                            <div class="blockquote-footer">Created on <?php echo date("l jS F, Y", strtotime($data['event']->created_date)); ?></div>
                        </div>
                        
                    </div>
                </div>
            </div>
<?php
            } elseif (!empty($data['events'])) {
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
                                if (!empty($event->location)) {
                        ?>
                                <div class="row align-items-center mt-1">
                                    <div class="col-2"><i class="fa fa-map-marker-alt border"></i></div>
                                    <div class="col-10"><?php echo $event->location; ?></div>
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
            } else {
?>
                <div class="empty-section">
                    <p>There aren't any events to show.</p>
                </div>
<?php
             }
?>
            </div>
        </div>
    </section>

<?php
    if (file_exists(PUBLIC_VIEWS . 'inc/footer.php')) {
        require_once(PUBLIC_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>