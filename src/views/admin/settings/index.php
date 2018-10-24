<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('settings');
?>

<form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/settings'; ?>" method="POST">
    <h1>Club Settings</h1>
    <input type="hidden" value="<?php echo (isset($data['club']->id)) ? $data['club']->id : ''; ?>"?>
    <input type="text" name="name" value="<?php echo (isset($data['club']->name)) ? $data['club']->name : ''; ?>" placeholder="Full Club Name"/>
    <textarea name="message" cols="30" rows="10" placeholder="Enter front page message."><?php echo (isset($data['club']->message)) ? $data['club']->message : ''; ?></textarea>
    
    <h2>Addresses</h2>
<?php
    foreach ($data['addresses'] as $i => $address) {
?>
        <input type="hidden" name="address_id[]" value="<?php echo (!empty($address->id)) ? $address->id : ''; ?>"/>
        <input type="text" name="address_title[]" value="<?php echo (!empty($address->address_title)) ? $address->address_title : ''; ?>" placeholder="Address Title"/>
        <input type="text" name="address[]" value="<?php echo (!empty($address->address)) ? $address->address : ''; ?>" placeholder="Address"/>
        <br />
<?php
        if (isset($data['addresses_title_err'][$i])) {
            print_var($data['addresses_title_err'][$i]);
        }
        if (isset($data['addresses_err'][$i])) {
            print_var($data['addresses_err'][$i]);
        }
    }
?>
    <input type="hidden" name="address_id[]" value=""/>
    <input type="text" name="address_title[]" value="" placeholder="Address Title"/>
    <input type="text" name="address[]" value="" placeholder="Address"/>

    <h2>Emails</h2>
<?php
    foreach ($data['emails'] as $i => $email) {
?>
        <input type="hidden" name="email_id[]" value="<?php echo (!empty($email->id)) ? $email->id : ''; ?>"/>
        <input type="text" name="email_title[]" value="<?php echo (!empty($email->email_title)) ? $email->email_title : ''; ?>" placeholder="Email Title"/>
        <input type="email" name="email[]" value="<?php echo (!empty($email->email)) ? $email->email : ''; ?>" placeholder="Email Address"/>
        <br />
<?php
        if (isset($data['emails_title_err'][$i])) {
            print_var($data['emails_title_err'][$i]);
        }
        if (isset($data['emails_err'][$i])) {
            print_var($data['emails_err'][$i]);
        }
    }
?>
    <input type="hidden" name="email_id[]" value=""/>
    <input type="text" name="email_title[]" value="" placeholder="Email Title"/>
    <input type="text" name="email[]" value="" placeholder="Email Address"/>

    <h2>Phone Numbers</h2>
<?php
    foreach ($data['phone_numbers'] as $i => $phone_number) {
?>
        <input type="hidden" name="phone_number_id[]" value="<?php echo (!empty($phone_number->id)) ? $phone_number->id : ''; ?>"/>
        <input type="text" name="phone_number_title[]" value="<?php echo (!empty($phone_number->phone_number_title)) ? $phone_number->phone_number_title : ''; ?>" placeholder="Phone Number Title"/>
        <input type="tel" name="phone_number[]" value="<?php echo (!empty($phone_number->phone_number)) ? $phone_number->phone_number : ''; ?>" placeholder="Phone Number"/>
        <br />
<?php
        if (isset($data['phone_numbers_title_err'][$i])) {
            print_var($data['phone_numbers_title_err'][$i]);
        }
        if (isset($data['phone_numbers_err'][$i])) {
            print_var($data['phone_numbers_err'][$i]);
        }
    }
?>
    <input type="hidden" name="phone_number_id[]" value=""/>
    <input type="text" name="phone_number_title[]" value="" placeholder="Phone Number Title"/>
    <input type="text" name="phone_number[]" value="" placeholder="Phone Number"/>

    <h2>Menu Links</h2>
    <p>Can have up to five menu links</p>
<?php
    for ($i = 0; $i < 5; $i++) {
?>
        <input type="hidden" name="menu_link_id[]" value="<?php echo (!empty($data['menu_links'][$i]->id)) ? $data['menu_links'][$i]->id : ''; ?>"/>
        <input type="text" name="menu_link_title[]" value="<?php echo (!empty($data['menu_links'][$i]->menu_link_title)) ? $data['menu_links'][$i]->menu_link_title : ''; ?>" placeholder="Link Title"/>
        <input type="url" name="menu_link[]" value="<?php echo (!empty($data['menu_links'][$i]->menu_link)) ? $data['menu_links'][$i]->menu_link : ''; ?>" placeholder="Link URL"/>
        <br />
<?php
        if (isset($data['menu_links_title_err'][$i])) {
            print_var($data['menu_links_title_err'][$i]);
        }
        if (isset($data['menu_links_err'][$i])) {
            print_var($data['menu_links_err'][$i]);
        }
    }
?>

    <h1>Teams</h1>
<?php
    if (isset($data['teams'])) {
        foreach ($data['teams'] as $i => $team) {
?>
            <input type="hidden" name="team_id[]" value="<?php echo (!empty($team->id)) ? $team->id : ''; ?>"/>
            <input type="text" name="team[]" value="<?php echo (!empty($team->team)) ? $team->team : ''; ?>" placeholder="Add Team"/>
            <input type="text" name="team_location[]" value="<?php echo (!empty($team->location)) ? $team->location : ''; ?>" placeholder="Add Team Location"/>
            <br />
<?php
        if (isset($data['teams_err'][$i])) {
                print_var($data['teams_err'][$i]);
            }
        }
    }
?>
    <input type="hidden" name="team_id[]" value=""/>
    <input type="text" name="team[]" value="" placeholder="Add Team"/>
    <input type="text" name="team_location[]" value="" placeholder="Add Team Location"/>
    <a href="<?php echo ADMIN_URLROOT . $data['club']->club . '/settings/teams'; ?>">View All Teams</a>


    <h1>Leagues</h1>
<?php
    if (isset($data['leagues'])) {
        foreach ($data['leagues'] as $i => $league) {
?>
            <input type="hidden" name="league_id[]" value="<?php echo (!empty($league->id)) ? $league->id : ''; ?>"/>
            <input type="text" name="league[]" value="<?php echo (!empty($league->league)) ? $league->league : ''; ?>" placeholder="Add League Abbreviation"/>
            <input type="text" name="league_full[]" value="<?php echo (!empty($league->league_full)) ? $league->league_full : ''; ?>" placeholder="Add League Full"/>
            <input type="url" name="league_website[]" value="<?php echo (!empty($league->league_website)) ? $league->league_website : ''; ?>" placeholder="Add League's Website"/>
            <br />
<?php

            if (isset($data['leagues_err'][$i])) {
                print_var($data['leagues_err'][$i]);
            }
        }
    }
?>
    <input type="hidden" name="league_id[]" value=""/>
    <input type="text" name="league[]" value="" placeholder="Add League Abbreviation"/>
    <input type="text" name="league_full[]" value="" placeholder="Add League Full"/>
    <input type="url" name="league_website[]" value="" placeholder="Add League's Website"/>
    <a href="<?php echo ADMIN_URLROOT . $data['club']->club . '/settings/leagues'; ?>">View All Leagues</a>

    <h1>Venues</h1>
<?php
    foreach ($data['venues'] as $i => $venue) {
?>
        <input type="hidden" name="venue_id[]" value="<?php echo (!empty($venue->id)) ? $venue->id : ''; ?>"/>
        <input type="text" name="venue[]" value="<?php echo (!empty($venue->venue)) ? $venue->venue : ''; ?>" placeholder="Add Venue Name"/>
        <input type="text" name="venue_location[]" value="<?php echo (!empty($venue->location)) ? $venue->location : ''; ?>" placeholder="Add Venue Location"/>
        <br />
<?php
        if (isset($data['venues_err'][$i])) {
            print_var($data['venues_err'][$i]);
        }
    }
?>
    <input type="hidden" name="venue_id[]" value=""/>
    <input type="text" name="venue[]" value="" placeholder="Add Venue Name"/>
    <input type="text" name="venue_location[]" value="" placeholder="Add Venue Location"/>
    <a href="<?php echo ADMIN_URLROOT . $data['club']->club . '/settings/venues'; ?>">View All Venues</a>

    <h1>People</h1>
    <a href="<?php echo ADMIN_URLROOT . $data['club']->club . '/settings/people'; ?>">View All People</a>
    
    <hr>
    <h1>Save Changes</h1>
    <input type="submit" value="Save Changes"/>
</form>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>