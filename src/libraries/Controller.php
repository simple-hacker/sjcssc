<?php

  class Controller {

    public function model($model){

      // $model = ucwords(strtolower($model)); // Convert to camelcase in case I make a mistake in each Controller.  // Doesn't work with UserModel

      if(file_exists('../src/models/' . $model . '.php')){
        require_once '../src/models/' . $model . '.php';
        return new $model();
      } else {
        die('<strong>Fatal Error:</strong> Model <em>' . $model .'</em> does not exist');
      }
    }

    public function view($page, $data = []){
      
      $page = strtolower($page); // Make sure $page is lowercase in case I make a mistake in each Controller.

      if (isset($_GET['admin'])) {
        //First check is /admin/ was provided in URL.  If so convert to boolean.
        $admin = settype($_GET['admin'], "bool");
        if ($admin) {
          // If succesfully converted to a boolean and true, then load Admin views.
          $loadView  = ADMIN_VIEWS . $page . '.php';
        } else {
          // Else error converting, so load Public Views
          $loadView = PUBLIC_VIEWS . $page . '.php';
        }
      } else {
        // Admin wasn't provided in URl, so load Public Views.
        $loadView = PUBLIC_VIEWS . $page . '.php';
      }

      // Check if file hasn't been deleted.
      if(file_exists($loadView)){
        require_once $loadView;
      } else {
        die('<strong>Fatal Error:</strong> View <em>' . $loadView .'</em> does not exist');
      }
    }
  }