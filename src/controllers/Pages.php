<?php

    class Pages extends Controller {

        private $admin, $club_id, $club_name;

        public function __construct($admin = false, $club_id) {
            // Load all models needed.
            $this->userModel = $this->model('UserModel');
            $this->clubModel = $this->model('Club');
            $this->pageModel = $this->model('Page');

            $this->admin = $admin;
            $this->club_id = $club_id;
            $this->club_name = $this->clubModel->getClubName($this->club_id);
            
            if ($this->admin === true) {
                $this->userModel->permissionCheckRedirect($this->club_id);
            }
        }

        public function index($page_var) {
            if (isset($page_var)) {
                // Check if page_var is an integer or the title of the page.
                $page_int = filter_var($page_var, FILTER_VALIDATE_INT);
                if ($page_int == true) {
                    // Page var was given as an integer
                    $page = $this->pageModel->getPageByID($this->club_id, $page_var);
                } else {
                    // Page var was given as a title string
                    // Strip all non alphanumeric characters, replace spaces with -
                    $page_var = str_replace(" ", "-", $page_var);
                    $page_var = preg_replace("/[^A-Za-z0-9-]/", "", $page_var);
                    $page_var = strtolower($page_var);
                    $page = $this->pageModel->getPageByURL($this->club_id, $page_var);
                }

                // If cannot find page then redirect to 404.
                if (empty($page)) {
                    $data = [
                        'club' => $this->clubModel->getClubByID($this->club_id),
                    ];
                    $this->view('site/404', $data);
                    exit;
                }
                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'page' => $page,
                ];
            } else {
                if ($this->admin === true) {
                    // Don't have to supply id or title in admin, this loads the list of pages to edit.
                    // admin/bowls/pages will display list of pages.
                    $data = [
                        'club' => $this->clubModel->getClubByID($this->club_id),
                        'pages' => $this->pageModel->getPages($this->club_id),
                    ];
                } else {
                    // If not page id or title supplied in public then redirect to 404.
                    $data = [
                        'club' => $this->clubModel->getClubByID($this->club_id),
                    ];
                    $this->view('site/404', $data);
                    exit;
                }
            }
            $this->view('pages/index', $data);
        }

        public function add() {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                // Validate POST data.
                $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Validation
                if (empty($_POST['page'])) {
                    $page_err = 'Please enter a page name';
                } else {
                    $page_title = ucwords(trim($_POST['page']));
                    $pages = $this->pageModel->getPageByTitle($this->club_id, $page_title);
                    if (count($pages) > 0) $page_err = 'Page with that name already exists.  Please try another one.';
                }
                if (empty($_POST['page_title'])) {
                    $page_title_err = 'Please enter the page\'s display title';
                }
                if (empty($_POST['html'])) {
                    $page_html_err = 'Please enter the the page\'s body text.';
                }

                $showMenu = isset($_POST['showMenu']) ? true : false;

                // Create URL
                // Strip all non alphanumeric characters, replace spaces with -
                $page_url = str_replace(" ", "-", $_POST['page_title']);
                $page_url = preg_replace("/[^A-Za-z0-9-]/", "", $page_url);
                $page_url = strtolower($page_url);

                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'page' => (object) ['page' => ucwords(trim($_POST['page'])), 'page_url' => $page_url, 'page_title' => trim($_POST['page_title']), 'showMenu' => $showMenu, 'html' => trim($_POST['html'])],
                    'page_err' => isset($page_err) ? $page_err : '',
                    'page_title_err' => isset($page_title_err) ? $page_title_err : '',
                    'page_html_err' => isset($page_html_err) ? $page_html_err : '',
                ];

                //If no errors then save page
                if (!isset($page_err) && !isset($page_title_err) && !isset($page_html_err)) {
                    if ($this->pageModel->addPage($this->club_id, $data['page'])) {
                        create_flash_message('pages', 'Successfully created the page ' . $data['page']->page);
                        redirect($this->club_name . '/pages', true);
                    } else {
                        die('<strong>Fatal Error: </strong> Something went wrong when adding a page.');
                    }
                } else {
                    create_flash_message('pages', 'Please correct all highlighted errors and try again.', 'danger');
                }
            } else {
                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                ];
            }
            $this->view('pages/add', $data);
        }

        public function edit($page_id) {
            if (isset($page_id)) {
                $page_id = (int)$page_id;
                if ($_SERVER['REQUEST_METHOD'] === "POST") {
                    // Validate POST data.
                    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    // Validation
                    if (empty($_POST['page_title'])) {
                        $page_title_err = 'Please enter the page\'s display title';
                    }
                    if (empty($_POST['html'])) {
                        $page_html_err = 'Please enter the the page\'s body text.';
                    }

                    $showMenu = isset($_POST['showMenu']) ? 1 : 0;

                    // Create URL
                    // Strip all non alphanumeric characters, replace spaces with -
                    $page_url = str_replace(" ", "-", $_POST['page_title']);
                    $page_url = preg_replace("/[^A-Za-z0-9-]/", "", $page_url);
                    $page_url = strtolower($page_url);

                    $data = [
                        'club' => $this->clubModel->getClubByID($this->club_id),
                        'page' => (object) ['page_id' => $page_id, 'page' => ucwords(trim($_POST['page'])), 'page_url' => $page_url, 'page_title' => trim($_POST['page_title']), 'showMenu' => $showMenu, 'html' => trim($_POST['html'])],
                        'page_title_err' => isset($page_title_err) ? $page_title_err : '',
                        'page_html_err' => isset($page_html_err) ? $page_html_err : '',
                    ];

                    //If no errors then save page
                    if (!isset($page_title_err) && !isset($page_html_err)) {
                        if ($this->pageModel->updatePage($this->club_id, $data['page'])) {
                            create_flash_message('pages', 'Successfully edited the page ' . $data['page']->page);
                            redirect($this->club_name . '/pages', true);
                        } else {
                            die('<strong>Fatal Error: </strong> Something went wrong when editing a page.');
                        }
                    } else {
                        create_flash_message('pages', 'Please correct all highlighted errors and try again.', 'danger');
                    }
                } else {
                    $data = [
                        'club' => $this->clubModel->getClubByID($this->club_id),
                        'page' => $this->pageModel->getPageByID($this->club_id, $page_id),
                    ];
                }
            } else {
                create_flash_message('pages', 'That\'s an invalid page', 'warning', true);
                redirect($this->club_name . '/pages', true);
            }
            $this->view('pages/edit', $data);
        }

        public function delete($page_id) {
            if (isset($page_id)) {
                if ($_SERVER['REQUEST_METHOD'] === "POST") {
                    
                    $page = $this->pageModel->getPageByID($this->club_id, $page_id);

                    if ($this->pageModel->deletePage($this->club_id, $page_id)) {
                        create_flash_message('pages', 'Successfully deleted the page <strong>' . $page->page . '</strong>.');
                        redirect($this->club_name . '/pages', true);
                    } else {
                        die('<strong>Fatal Error: </strong>Something went wrong when deleting a page.');
                    }

                    $data = [
                        'club' => $this->clubModel->getClubByID($this->club_id),
                        'page' => $this->pageModel->getPageByID($this->club_id, $page_id),
                    ];
                } else {
                    $data = [
                        'club' => $this->clubModel->getClubByID($this->club_id),
                        'page' => $this->pageModel->getPageByID($this->club_id, $page_id),
                    ];
                }
            } else {
                create_flash_message('pages', 'That\'s an invalid page', 'warning', true);
                redirect($this->club_name . '/pages', true);
            }
            $this->view('pages/delete', $data);
        }

    }