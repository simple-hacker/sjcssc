<?php

  class Controller {

    public function model($model){
      if(file_exists('../src/models/' . $model . '.php')){
        require_once '../src/models/' . $model . '.php';
        return new $model();
      } else {
        die('<strong>Fatal Error:</strong> Model . ' . $model .' does not exist');
      }
    }

    public function view($page, $data = []){
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

      // Check if file hasn't been deleted or anything.
      if(file_exists($loadView)){
        require_once $loadView;
      } else {
        die('<strong>Fatal Error:</strong> View <em>' . $loadView .'</em> does not exist');
      }
    }
  }