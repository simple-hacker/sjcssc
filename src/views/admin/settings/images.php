<?php
    // Forces non store of cache, so images should change when uploading new image.
    header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
    header("Pragma: no-cache"); // HTTP 1.0.
    header("Expires: 0");


    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('images');
?>

<form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/settings/images'; ?>" method="POST" enctype="multipart/form-data">
    <div class="wrap">
        <h3>Website Images</h3>
        <p>Here you can change your club's icon and section images.  If a section doesn't have an image then it will use the <strong>main</strong> image or a blank colour.</p>
        <p>Images will automatically be resized.  Max file upload is 64MB.</p>
        <div class="alert alert-warning"><i class="fas fa-exclamation-triangle mr-3"></i> You may need to do a hard refresh (Ctrl+F5) after uploading for the new images to refresh.</div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="wrap">
                <h3>Icon</h3>                
                <div class="row">
                    <?php
                        // So file_exists doesn't work with http:// and Chrome can't load files from C:\www etc.
                        // So check if file_exists using C:\, and then load image from URL http://
                        // So stupid but will do for now.
                        $image = "img/sportsbar/" . $data['club']->club . ".png";
                        // $image = dirname(APPROOT) . "\\public\\img\\sportsbar\\" . $data['club']->club . ".png";
                        if (file_exists(PUBLIC_ROOT . $image)) {
                    ?>
                            <div class="col-10 mb-4" class="text-center">
                                <img id="icon" src="<?php echo URLROOT . $image; ?>" width="200px">
                            </div>
                            <div class="col-2 d-flex align-items-center">
                                <button type="button" class="deleteImage btn btn-danger" data-item="icon" data-club="<?php echo $data['club']->club; ?>" data-section="icon"><i class="fa fa-2x fa-trash" aria-hidden="true"></i></button>
                            </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h5>Upload Image</h5>
                        <input type="file" name="icon" id="icon" accept="image/*">
                        <p class="mt-2"><small>It's better to upload a .png image with a transparent background.</small></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="wrap">
                <h3>Main Image</h3>
                <div class="row">
                    <?php
                        $image = "img/parallax/" . $data['club']->club . "/main.jpg";
                        // $image = dirname(APPROOT) . "\\public\\img\\sportsbar\\" . $data['club']->club . ".png";
                        if (file_exists(PUBLIC_ROOT . $image)) {
                    ?>
                            <div class="col-10 mb-4" class="text-center">
                                <img id="main" src="<?php echo URLROOT . $image; ?>" width="100%">
                            </div>
                            <div class="col-2 d-flex align-items-center">
                                <button type="button" class="deleteImage btn btn-danger" data-item="image" data-club="<?php echo $data['club']->club; ?>" data-section="main"><i class="fa fa-2x fa-trash" aria-hidden="true"></i></button>
                            </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h5>Upload Image</h5>
                        <input type="file" name="main" id="main" accept="image/*">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php
    foreach (CLUBS[$data['club']->club]['sections'] as $i => $section) {

        if ($i % 2 == 0)  echo "<div class=\"row\">";
?>
                <div class="col-12 col-lg-6">
                    <div class="wrap">
                        <h3><?php echo ucwords($section); ?></h3>
                        <div class="row">
                            <?php
                                $image = "img/parallax/" . $data['club']->club . "/" . $section . ".jpg";
                                // $image = dirname(APPROOT) . "\\public\\img\\sportsbar\\" . $data['club']->club . ".png";
                                if (file_exists(PUBLIC_ROOT . $image)) {
                            ?>
                                    <div class="col-10 mb-4" class="text-center">
                                        <img id="<?php echo $section; ?>" src="<?php echo URLROOT . $image; ?>" width="100%">
                                    </div>
                                    <div class="col-2 d-flex align-items-center">
                                        <button type="button" class="deleteImage btn btn-danger" data-item="image" data-club="<?php echo $data['club']->club; ?>" data-section="<?php echo $section; ?>"><i class="fa fa-2x fa-trash" aria-hidden="true"></i></button>
                                    </div>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h5>Upload Image</h5>
                                <input type="file" name="<?php echo $section; ?>" id="<?php echo $section; ?>" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
<?php
        if ($i % 2 == 1) echo "</div>";
    }
?>

    <div class="wrap">
        <div class="row">
            <div class="col-6 mx-auto">
                <input type="submit" value="Save Changes" class="btn btn-block btn-brown"/>
            </div>
        </div> 
    </div>

</form>
<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error:</strong> Footer file has been deleted');
    }
?>