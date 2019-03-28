<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
    display_flash_messages('pages');
?>
<div class="wrap">
    <h3>Add Page</h3>
    <div class="form-group row">
        <div class="col-12"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . '/pages/add'; ?>" class="btn btn-block btn-brown-secondary">Add New Page</a></div>
    </div> 
</div>
<div class="wrap">
    <h3>Pages</h3>
<?php
    // print_var($data['pages']);
    if (!empty($data['pages'])) {
?>
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
                <tr class="thead-light text-center">
                    <th>Page Name</th>
                    <th>Page Title</th>
                    <th class="d-none d-md-table-cell">Link</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
<?php
            foreach ($data['pages'] as $page) {
?>
                <tr>
                    <td><?php echo $page->page ?></td>
                    <td><?php echo $page->page_title; ?></td>
                    <td class="d-none d-md-table-cell"><a href="<?php echo URLROOT . $data['club']->club . "/pages/" . $page->page_id . "/" . $page->page_url; ?>" target="_blank"><?php echo URLROOT . $data['club']->club . "/pages/" . $page->page_id . "/" . $page->page_url; ?></a></td>
                    <td class="text-center"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/pages/edit/" . $page->page_id; ?>" class="btn btn-small btn-primary"><i class="fas fa-sm fa-edit"></i></a></td>
                    <td class="text-center"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/pages/delete/" . $page->page_id; ?>" class="btn btn-small btn-danger"><i class="fas fa-sm fa-trash-alt"></i></a></td>
                </tr>
<?php
            }
?>
            </tbody>
        </table>
    </div>
<?php
    } else {
?>
        <div class="empty-section">
            <p>There aren't any pages to show.</p>
        </div>
<?php
    }
?>
</div>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>