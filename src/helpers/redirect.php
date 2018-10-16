<?php
  // Simple page redirect
  function redirect($page, $admin = false){
    if ($admin === true) {
      header('location: '.ADMIN_URLROOT .$page);
    } else {
      header('location: '.URLROOT .$page);
    }
  }