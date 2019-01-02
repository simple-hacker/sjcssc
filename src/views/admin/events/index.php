<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('events');
?>
    <div class="wrap">
        <h3>Add Event</h3>
        <form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/events' ; ?>" method="POST">
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control<?php if (!empty($data['title_err'])) echo ' is-invalid'; ?>" placeholder="Enter Event Title" value="<?php echo (isset($data['event']->title)) ? $data['event']->title : ''; ?>"/>
                    <?php if (isset($data['title_err'])) display_invalid($data['title_err']); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="date" class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-4">
                    <input type="date" name="date" class="form-control<?php if (!empty($data['date_err'])) echo ' is-invalid'; ?>" value="<?php echo (isset($data['event']->date)) ? $data['event']->date : ''; ?>"/>
                    <?php if (isset($data['date_err'])) display_invalid($data['date_err']); ?>
                </div>
                <label for="time" class="col-sm-2 col-form-label">Time</label>
                <div class="col-sm-4">
                    <input type="time" name="time" class="form-control<?php if (!empty($data['time_err'])) echo ' is-invalid'; ?>" value="<?php echo (isset($data['event']->time)) ? $data['event']->time : ''; ?>"/>
                    <?php if (isset($data['time_err'])) display_invalid($data['time_err']); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="meet_at" class="col-sm-2 col-form-label">Meet At</label>
                <div class="col-sm-10">
                    <input type="meet_at" name="meet_at" class="form-control" placeholder="Enter Meet At" value="<?php echo (isset($data['event']->meet_at)) ? $data['event']->meet_at : ''; ?>"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="contact" class="col-sm-2 col-form-label">Contact</label>
                <div class="col-sm-10">
                    <input type="contact" name="contact"  class="form-control" placeholder="Enter Contact Information" value="<?php echo (isset($data['event']->contact)) ? $data['event']->contact : ''; ?>"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="other_information" class="col-sm-2 col-form-label">Other Information</label>
                <div class="col-sm-10">
                    <textarea name="other_information" class="form-control" rows="5" placeholder="Enter More Information"><?php echo (isset($data['event']->other_information)) ? $data['event']->other_information : ''; ?></textarea>
                </div>
            </div>
    <?php
            // if (sizeof($locations) > 0) {
            //     echo "<select name=\"location\">";
            //     foreach ($locations as $location) {
            //         echo "<option value=\"{$location->id}\"";
            //         echo (isset($data['location_id']) && $data['location_id'] === $location->id) ? " selected" : "";
            //         echo ">{$location->venue}</option>";
            //     }
            //     echo "</select>";
            // } else {
            //     // Display disabled location box.
            //     echo "<input type=\"text\" name=\"location\" value=\"No Venues Found.  Please enter Venues in Settings page.\" disabled>";
            // }
    ?>
            <div class="form-group row mt-5">
                <div class="col-6 mx-auto text-center">
                    <input type="submit" value="Add Event" class="btn btn-brown btn-block">
                </div>
            </div> 
        </form>
    </div>

    
<?php
    if (!empty($data['events'])) {
?>
    <div class="wrap">
        <h3>Events</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr class="thead-light">
                        <th>Event Date</th>
                        <th>Title</th>
                        <th>Venue</th>
                        <th>Edit</th>
                        <th>Delete?</th>
                    </tr>
                </thead>
                <tbody>
    <?php
            foreach($data['events'] as $event) {
    ?>
                    <tr>
                        <td><?php echo date("d/m/y", strtotime($event->date)); ?></td>
                        <td><?php echo $event->title; ?></td>
                        <td><?php echo $event->venue; ?></td>
                        <td><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/events/edit/" . $event->event_id; ?>" class="btn btn-small btn-primary"><i class="fas fa-sm fa-edit"></i></a></td>
                        <td><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/events/delete/" . $event->event_id; ?>" class="btn btn-small btn-danger"><i class="fas fa-sm fa-trash-alt"></i></a></td>
                    </tr>
    <?php
        }
    ?>
                </tbody>
            </table>
        </div>
    </div>
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