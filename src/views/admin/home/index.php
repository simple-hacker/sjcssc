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
<?php
    if (!empty($data['unpublished_results'])) {
        echo '<h2>Unpublished Results</h2>';
        foreach ($data['unpublished_results'] as $ur) {
            echo '<a href="' . ADMIN_URLROOT . $data['club']->club . '/results/edit/' . $ur->id . '">' . $ur->date . ' - ' . $ur->home_team . ' v ' . $ur->away_team . '</a><br/>';
        }
    }
?>

<h2>Mailing List</h2>
<a href="#">Message All Club Members</a>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>