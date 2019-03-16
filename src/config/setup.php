<?php
  // DB Params
  define("DB_HOST", "localhost");
  define("DB_USER", "root");
  define("DB_PASS", "");
  define("DB_NAME", "sjcssc");

  // App Root
  define('APPROOT', dirname(dirname(__FILE__)) . '\\');
  define('PUBLIC_ROOT', dirname(dirname(dirname(__FILE__))) . '\\public\\');
  // Public Views Root
  define('PUBLIC_VIEWS', APPROOT . 'views\\public\\');
  // Admin Views Root
  define('ADMIN_VIEWS', APPROOT . 'views\\admin\\');
  // URL Root
  define('URLROOT', 'http://localhost/sjcssc/');
  // URL Root
  define('ADMIN_URLROOT', 'http://localhost/sjcssc/admin/');

  