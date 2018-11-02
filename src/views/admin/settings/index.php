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
    <h2>Home Page Settings</h2>
    <input type="hidden" value="<?php echo (isset($data['club']->id)) ? $data['club']->id : ''; ?>"?>
    <input type="text" name="name" value="<?php echo (isset($data['club']->name)) ? $data['club']->name : ''; ?>" placeholder="Full Club Name"/>
    <textarea name="message" cols="30" rows="10" placeholder="Enter front page message."><?php echo (isset($data['club']->message)) ? $data['club']->message : ''; ?></textarea>

    
    <h2>Addresses</h2>
<?php
    foreach ($data['club']->addresses as $i => $address) {
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
    foreach ($data['club']->emails as $i => $email) {
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
    foreach ($data['club']->phone_numbers as $i => $phone_number) {
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
        <input type="hidden" name="menu_link_id[]" value="<?php echo (!empty($data['club']->menu_links[$i]->id)) ? $data['club']->menu_links[$i]->id : ''; ?>"/>
        <input type="text" name="menu_link_title[]" value="<?php echo (!empty($data['club']->menu_links[$i]->menu_link_title)) ? $data['club']->menu_links[$i]->menu_link_title : ''; ?>" placeholder="Link Title"/>
        <input type="url" name="menu_link[]" value="<?php echo (!empty($data['club']->menu_links[$i]->menu_link)) ? $data['club']->menu_links[$i]->menu_link : ''; ?>" placeholder="Link URL"/>
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

<?php
    // Only show team name if the club has a results or outings section.  i.e. All but social should show this.
    if (!empty(array_intersect(['results', 'outings'], CLUBS[$data['club']->club]['sections']))) {
?>
        <h1>Home Team</h1>
<?php
        if (!empty($data['teams'])) {
?>
            <select name="team_id">
<?php
                foreach ($data['teams'] as $team) {
?>
                    <option value="<?php echo $team->id; ?>" <?php echo ($team->id === $data['club']->team_id) ? 'selected' : ''; ?>><?php echo $team->team; ?></option>
<?php
                }
?>
            </select>
<?php
        } else {
?>
            <input type="text" name="home_team" value="No Teams Found.  Please enter teams in Settings." disabled><br/>
<?php
        }
?>

        <h2>Teams</h2>
        <a href="<?php echo ADMIN_URLROOT . $data['club']->club . '/settings/teams'; ?>">View All Teams</a>

        <h2>Leagues</h2>
        <a href="<?php echo ADMIN_URLROOT . $data['club']->club . '/settings/leagues'; ?>">View All Leagues</a>

        <h2>Venues</h2>
        <a href="<?php echo ADMIN_URLROOT . $data['club']->club . '/settings/venues'; ?>">View All Venues</a>

        <h1>People</h1>
        <a href="<?php echo ADMIN_URLROOT . $data['club']->club . '/settings/people'; ?>">View All People</a>
<?php
    }
?>
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