<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('events');
?>
    <h1>Edit Event</h1>
    <form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/events/edit/' . $data['event']->event_id  ; ?>" method="POST">
        <input type="hidden" name="event_id" value="<?php echo (isset($data['event']->event_id)) ? $data['event']->event_id : ''; ?>"/>
        <input type="text" name="title" placeholder="Enter Event Title" value="<?php echo (isset($data['event']->title)) ? $data['event']->title : ''; ?>"/>
        <input type="date" name="date" value="<?php echo (isset($data['event']->date)) ? $data['event']->date : ''; ?>"/>
        <input type="time" name="time" value="<?php echo (isset($data['event']->time)) ? $data['event']->time : ''; ?>"/>
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
        <input type="meet_at" name="meet_at" placeholder="Enter Meet At" value="<?php echo (isset($data['event']->meet_at)) ? $data['event']->meet_at : ''; ?>"/>
        <input type="contact" name="contact" placeholder="Enter Contact Information" value="<?php echo (isset($data['event']->contact)) ? $data['event']->contact : ''; ?>"/>
        <textarea name="other_information" cols="30" rows="5" placeholder="Enter More Information"><?php echo (isset($data['event']->other_information)) ? $data['event']->other_information : ''; ?></textarea>
        <h2>Save Changes</h2>
        <input type="submit" value="Save Changes">
    </form>

<?php
    if (!empty($data['events'])) {
?>
        <h1>All Events</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Created Date</th>
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
                    <td><?php echo $event->event_id; ?></td>
                    <td><?php echo $event->created_date; ?></td>
                    <td><?php echo $event->title; ?></td>
                    <td><?php echo $event->venue; ?></td>
                    <td><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/events/edit/" . $event->event_id;  ?>">Edit</td>
                    <td><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/events/delete/" . $event->event_id; ?>">Delete?</td>
                </tr>
<?php
    }
?>
            </tbody>
        </table>
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