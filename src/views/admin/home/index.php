<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('user');
?>


<h1>DASHBOARD</h1>
<h2>Quick Add Buttons</h2>
<?php
    foreach (CLUBS[$data['club']->club]['sections'] as $club_section) {
        if (!in_array($club_section, ['results', 'reports'])) {
            echo '<a href="' . ADMIN_URLROOT . $data['club']->club . '/' . $club_section . '/add">Add ' . ucwords(rtrim($club_section, "s")) . '</a> | ';
        }
    }
?>
<h2>Results</h2>
<p>List of fixtures that need consolidating because results haven't been submitted yet.</p>

<h2>Mailing List</h2>
<a href="#">Message All Club Members</a>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>