<?php
    if (file_exists(PUBLIC_VIEWS . 'inc/header.php')) {
        require_once(PUBLIC_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>

<?php 
    $bg_url = URLROOT . 'img/parallax/' . $data['club']->club . '/1.jpg';
?>
    <div class="parallax">
        <div class="parallax-background" style="background-image: url(<?php echo $bg_url; ?>)"></div>
        <div class="parallax-text sj-heading-large">
            <?php echo isset(CLUBS[$data['club']->club]['section_titles']['outings']) ? CLUBS[$data['club']->club]['section_titles']['outings'] : 'Outings'; ?>
        </div>
    </div>

<section>
    <div class="container">
        <div class="row">
<?php
    if (!empty($data['outing'])) {
?>
        <div class="card mb-3">
            <div class="card-header table-striped text-center sj-heading-small">
                <?php echo $data['outing']->title; ?>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row mt-1">
                        <div class="col-4 text-right"><i class="fa fa-star border"></i></div>
                        <div class="col-8"><?php echo $data['outing']->title; ?></div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-4 text-right"><span class="mr-3">Date</span><i class="fa fa-calendar-alt border"></i></div>
                        <div class="col-8"><?php echo date("l jS F, Y", strtotime($data['outing']->date)); ?></div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-4 text-right"><span class="mr-3">Time</span><i class="fa fa-clock border"></i></div>
                        <div class="col-8"><?php echo date("H:i", strtotime($data['outing']->time)); ?></div>
                    </div>
            <?php
                    if (!empty($data['outing']->venue)) {
            ?>
                    <div class="row mt-1">
                        <div class="col-4 text-right"><span class="mr-3">Venue</span><i class="fa fa-map-marker-alt border"></i></div>
                        <div class="col-8"><?php echo $data['outing']->venue; ?></div>
                    </div>
            <?php
                    }
            ?>
            <?php
                    if (!empty($data['outing']->meet_at)) {
            ?>
                    <div class="row mt-1">
                        <div class="col-4 text-right"><span class="mr-3">Meet At</span><i class="fas fa-map-marked-alt border"></i></div>
                        <div class="col-8"><?php echo $data['outing']->meet_at; ?></div>
                    </div>
            <?php
                    }
            ?>
            <?php
                    if (!empty($data['outing']->contact)) {
            ?>
                    <div class="row mt-1">
                        <div class="col-4 text-right"><span class="mr-3">Contact</span><i class="fas fa-phone border"></i></div>
                        <div class="col-8"><?php echo $data['outing']->contact; ?></div>
                    </div>
            <?php
                    }
            ?>
            <?php
                    if (!empty($data['outing']->other_information)) {
            ?>
                    <div class="row mt-1">
                        <div class="col-4 text-right"><span class="mr-3">Other Information</span><i class="fas fa-comment-alt border"></i></div>
                        <div class="col-8"><?php echo $data['outing']->other_information; ?></div>
                    </div>
            <?php
                    }
            ?>                         
                </div>
            </div>
        </div>
<?php
    } elseif (!empty($data['outings'])) {
?>
        <div class="table-responsive">
            <table class="table table-sm table-striped table-bordered text-center">
                <thead>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Venue</th>
                    <th>View Outing</th>
                </thead>
                <tbody>
<?php
            foreach ($data['outings'] as $outing) {
?>
                <tr>
                    <td><?php echo date("d/m/y", strtotime($outing->date)); ?></td>
                    <td><?php echo $outing->title; ?></td>
                    <td><?php echo $outing->venue; ?></td>
                    <td><a href="<?php echo URLROOT . $data['club']->club . '/outings/' . $outing->id; ?>" class="btn btn-brown">View Outing</a></td>
                </tr>
<?php
        }
?>
            </tbody>
        </table>
    </div>
<?php
    } else {
?>
        <div class="empty-section">
            <p>Unfortunately there aren't any outings to show.</p>
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