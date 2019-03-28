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
            <?php echo ucwords($data['page']->page_title); ?>
        </div>
    </div>

<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
<?php
                // print_var($data['page']);
                echo html_entity_decode($data['page']->html);
                // print_var($data);
?>
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