<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
    display_flash_messages('user');
?>

<div class="wrap">
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, eaque.
</div>

<div class="wrap">
    <div class="pretty p-icon p-curve p-jelly">
        <input type="checkbox" />
        <div class="state p-warning">
            <i class="icon fas fa-check"></i>
            <label></label>
        </div>
    </div>
</div>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>