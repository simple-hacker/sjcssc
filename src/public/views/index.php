<?php require_once(PUBLIC_VIEWS . 'includes\\header.php'); ?>

    <!-- TODO: Need to include a banner section, message section and notices. -->

    <p><?php echo ucwords($club->name); ?>.</p>
    <p><?php echo $club->message; ?></p>

<?php
    // Just double check club name is in clubs_cfg
    if (array_key_exists($club->club, $GLOBALS['clubs_config'])) {
        foreach ($GLOBALS['clubs_config'][$club->club]['sections'] as $section) {
            // Check to see if file exists first, to see if it's been accidentally deleted.
            if (file_exists(PUBLIC_VIEWS . 'sections\\' . strtolower($section) . '.php')) {
                require_once(PUBLIC_VIEWS . 'sections\\' . strtolower($section) . '.php');
            } else {
                die('Missing section file <b>' . $section . '.php</b>');
            }
        }
    }

    // Contact section
    if (file_exists(PUBLIC_VIEWS . 'sections\\contact.php')) {
        require_once(PUBLIC_VIEWS . 'sections\\contact.php');
    } else {
        die('Missing section file <b>contact.php</b>');
    }
?>

<?php require_once(PUBLIC_VIEWS . 'includes\\footer.php'); ?>