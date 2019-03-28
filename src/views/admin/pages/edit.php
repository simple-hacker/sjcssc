<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
    display_flash_messages('pages');
?>

<div class="wrap">
    <h3>Edit Page - <?php echo $data['page']->page; ?></h3>
    <form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/pages/edit/' . $data['page']->page_id ; ?>" method="POST">
        <input type="hidden" name="page" class="form-control<?php if (!empty($data['page_err'])) echo ' is-invalid'; ?>" placeholder="Enter Page Name" value="<?php echo (isset($data['page']->page)) ? $data['page']->page : ''; ?>"/>
        <?php if (isset($data['page_err'])) display_invalid($data['page_err']); ?>
        <div class="form-group row">
            <label for="page_title" class="col-sm-2 col-form-label d-none d-md-flex">Display Title</label>
            <div class="col-12 col-md-10">
                <input type="text" name="page_title" class="form-control<?php if (!empty($data['page_title_err'])) echo ' is-invalid'; ?>" placeholder="Enter Page Display Title" value="<?php echo (isset($data['page']->page_title)) ? $data['page']->page_title : ''; ?>"/>
                <?php if (isset($data['page_title_err'])) display_invalid($data['page_title_err']); ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="showMenu" class="col-sm-2 col-form-label">Show page in menu?</label>
            <div class="col-md-10">
                <div class="pretty p-icon p-curve p-jelly">
                    <input type="checkbox" name="showMenu" <?php echo (isset($data['page']->showMenu) && $data['page']->showMenu == 1) ? 'checked' : ''; ?>/>
                    <div class="state p-warning">
                        <i class="icon fas fa-check"></i>
                        <label></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="html" class="col-sm-2 col-form-label d-none d-md-flex">Page Body</label>
            <div class="col-12 col-md-10">
                <textarea id="editor" class="form-control<?php if (!empty($data['page_html_err'])) echo ' is-invalid'; ?>" placeholder="Enter Page Body"></textarea>
                <input type="hidden" id="html" name="html" value="<?php echo (isset($data['page']->html)) ? $data['page']->html : ''; ?>">
                <?php if (isset($data['page_html_err'])) display_invalid($data['page_html_err']); ?>
            </div>
        </div>
        <div class="form-group row mt-5">
            <div class="col-6 mx-auto text-center">
                <input type="submit" value="Save Changes" class="btn btn-brown btn-block" onClick="saveHTML();">
            </div>
        </div> 
    </form>
</div>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>