<?php
    DEFINE('PHPIMAGEUPLOADERROR', [
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    ]);

    DEFINE('FILETYPES', [
        "jpg",
        "jpeg",
        "png",
        "gif",
    ]);

    function image_upload($club_name, $section, $image) {
        // Check php file upload errors first.
        if ($image['error'] != 0) {
            // TODO:  Check why the phpFileUploadErrors isn't showing in flash_message
            $message = "Failed to upload <strong>" . ucwords($section) . "</strong> image ({$image['name']}).  Please try again.<br><em>" . PHPIMAGEUPLOADERROR[$image['error']] . "</em>";
            create_flash_message('images', $message, 'danger');
            return;
        }

        // Check valid file type, only images, jpg, jpeg, gif, png.
        // i.e. no .exe, .pdf etc.
        if (in_array(strtolower(pathinfo($image['name'], PATHINFO_EXTENSION)), FILETYPES)) {
            // If valid image then create new image from uploaded image.
            // Need to resize and rename.
            // Save it to img directory with $section file name.
            // TODO: Maybe create different sized images for quicker loading?

            $tmp_name = $image["tmp_name"];

            // Set all variables such as file path, extension, image resize widths etc.
            if ($section == "icon") {
                // Create png
                $new_image_path = PUBLIC_ROOT . "img\\sportsbar\\" . $club_name . ".png";
                $new_thumb_path = PUBLIC_ROOT . "img\\sportsbar\\" . $club_name . "_thumb.png";
                $ext = IMAGETYPE_PNG;
                $size = ['width' => 80, 'height' => 80];
                $thumb = ['width' => 200, 'height' => 200];
            } else {
                // Create jpg
                $new_image_path = PUBLIC_ROOT . "img\\parallax\\" . $club_name . "\\" . $section . ".jpg";
                $new_thumb_path = PUBLIC_ROOT . "img\\parallax\\" . $club_name . "\\" . $section . "_thumb.jpg";
                $ext = IMAGETYPE_JPEG;
                $size = ['width' => 1920, 'height' => 1080];
                $thumb = ['width' => 300, 'height' => 300];
            }
            
            echo $new_image_path . "<br>";

            $main_image = new SimpleImage();
            $main_image->load($tmp_name);
            $main_image->resizeToWidth($size['width']);
            $main_image->save($new_image_path, $ext, 100);

            $thumbnail = new SimpleImage();
            $thumbnail->load($tmp_name);
            $thumbnail->resizeToWidth($thumb['width']);
            $thumbnail->save($new_thumb_path, $ext, 100);

            // If tmp file exists then change permission and delete.
            if(file_exists($tmp_name)) {
                chmod($tmp_name,0755); //Change the file permissions if allowed
                unlink($tmp_name); //remove the file
            }

            // If successfully created/replaced new image create_flash_message
            if (file_exists($new_image_path) && file_exists($new_thumb_path)) {
                $message = "Successfully uploaded <strong>" . ucwords($section) . "</strong> image.";
                create_flash_message('images', $message);
            } else {
                $message = "Something went wrong when trying to upload the <strong>" . ucwords($section) . "</strong> image.  Please try again.";
                create_flash_message('images', $message, 'danger');
            }
        } else {
            $message = "Failed to upload <strong>{$image['name']}</strong>.  Invalid file type.  Please upload .jpg, .jpeg, .png or .gif";
            create_flash_message('images', $message, 'danger');
        }
    
        return;
    }