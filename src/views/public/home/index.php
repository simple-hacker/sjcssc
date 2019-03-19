<?php
    if (file_exists(PUBLIC_VIEWS . 'inc/header.php')) {
        require_once(PUBLIC_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>
<?php 
    $bg_url = URLROOT . 'img/parallax/' . $data['club']->club . '/main.jpg';
?>
    <div class="parallax">
        <div class="parallax-background" style="background-image: url(<?php echo $bg_url; ?>)"></div>
        <div class="parallax-text sj-heading-large">
            <?php echo $data['club']->name; ?>
        </div>
    </div>
    <section>
        <div class="container mt-2">
            <div class="row">
                <p class="mb-0"><?php echo nl2br($data['club']->message); ?></p>
            </div>
        </div>
    </section>


<?php
    foreach (CLUBS[$data['club']->club]['sections'] as $i => $section) {

        // Check if there is any data before trying to load the section.
        if (!empty($data[$section])) {
            $bg = 'img/parallax/' . $data['club']->club . '/' . $section . '.jpg';
            $bg_url = (file_exists(PUBLIC_ROOT . $bg)) ? URLROOT . $bg : URLROOT . 'img/parallax/' . $data['club']->club . '/main.jpg';
?>
            <div class="parallax">
                <div class="parallax-background" style="background-image: url(<?php echo $bg_url; ?>)"></div>
                <div class="parallax-text sj-heading-large">
                    <?php
                        if (isset(CLUBS[$data['club']->club]['section_titles'][$section])) {
                            echo CLUBS[$data['club']->club]['section_titles'][$section];
                        }
                    ?>
                </div>
            </div>
<?php
            if (file_exists(PUBLIC_VIEWS . 'home/sections/' . $section . '.php')) {
                include (PUBLIC_VIEWS . 'home/sections/' . $section . '.php');
            } else {
               die('<strong>Fatal Error: </strong> File section\\' . $section . '.php doesn\'t exist');
            }
        }
    }
?>

<?php
    if (file_exists(PUBLIC_VIEWS . 'inc/footer.php')) {
        require_once(PUBLIC_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>