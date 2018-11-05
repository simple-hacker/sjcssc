<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('user');
?>


<h1>DASHBOARD</h1>

<div class="container">
    <div class="row">
<?php
    foreach (CLUBS[$data['club']->club]['sections'] as $club_section) {
        if (!in_array($club_section, ['results', 'reports'])) {
?>
            <a href="<?php echo ADMIN_URLROOT . $data['club']->club . '/' . $club_section; ?>" class="db-btn">
                <span class="db-btn-icon"><?php echo isset(ICONS[$club_section]) ? ICONS[$club_section] : ''; ?></span>    
                <p class="db-btn-text">Add <?php echo trim(ucwords($club_section), "s"); ?></p>
            </a>
<?php
        }
    }
?>
    </div>
</div>

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