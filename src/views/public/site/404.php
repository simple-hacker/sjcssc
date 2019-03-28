<?php
    if (file_exists(PUBLIC_VIEWS . 'inc/header.php')) {
        require_once(PUBLIC_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>
<?php 
    $bg = 'img/parallax/' . $data['club']->club . '/' . strtolower(basename(dirname(__FILE__))) . '.jpg';
    $bg_url = (file_exists(PUBLIC_ROOT . $bg)) ? URLROOT . $bg : URLROOT . 'img/parallax/' . $data['club']->club . '/main.jpg';
?>
    <div class="parallax">
        <div class="parallax-background" style="background-image: url(<?php echo $bg_url; ?>)"></div>
        <div class="parallax-text sj-heading-large">
            Page Not Found
        </div>
    </div>
    <section>
        <div class="container mt-2">
            <div class="row">
                <div class="empty-section">
                    <p>Page Cannot Be Found.</p>
                </div>
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