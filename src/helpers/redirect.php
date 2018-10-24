<?php
  // Simple page redirect
  function redirect($page, $admin = false){
    if ($admin === true) {
      header('Location: '. ADMIN_URLROOT . $page);
      exit(0); // Need this otherwise flash_messages won't display if code keeps running.
    } else {
      header('Location: '. URLROOT . $page);
      exit(0); // Need this otherwise flash_messages won't display if code keeps running.
    }
  }