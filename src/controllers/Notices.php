<?php

    class Notices extends Controller {

        private $admin, $club_id, $club_name;

        public function __construct($admin = false, $club_id) {
            
            // Load all models needed.
            $this->userModel = $this->model('UserModel');
            $this->clubModel = $this->model('Club');
            $this->noticeModel = $this->model('Notice');

            $this->admin = $admin;
            $this->club_id = $club_id;
            $this->club_name = $this->clubModel->getClubName($this->club_id);
            
            if ($this->admin === true) {
                $this->userModel->permissionCheckRedirect($this->club_id);
            }
        }

        public function index($notice_id) {
            
            if (isset($notice_id)) {
                // Get single notice.
                // This should be PUBLIC_VIEWS because in admin notices with an id will have page of add/edit/delete etc.  Public views will be i.e. bowls/notices/2 which loads index.
                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'notice' => $this->noticeModel->getNotice($this->club_id, $notice_id)
                ];
            } else {
                // We're on index, so retrieve all Notices.
                if ($this->admin === true) {
                    //In admin so need to check for POST data, validate and submit forms.
                    if ($_SERVER['REQUEST_METHOD'] === "POST") {
                        // Validate POST data.
                        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                        // Validate title
                        if (empty($_POST['title'])) {
                            $title_err = 'Please enter a notice title';
                        }
                        // Validate notice.
                        if (empty($_POST['notice'])) {
                            $notice_err = 'Please enter a notice body';
                        }

                        // Validate expiry_date
                        if ($_POST['expiry_date_select'] === "NULL") {
                            $expiry_date = NULL;
                        } else {
                            $expiry_date = date('Y-m-d', strtotime($_POST['expiry_date_select']) + 86400); // Have to add another day (86400 seconds) because notice will expire 00:00 on the day, rather than at 23:59 on the day.
                        }

                        // Validate important
                        $important = isset($_POST['important']) ? true : false;

                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'notice' => (object) ['title' => trim($_POST['title']), 'notice' => trim($_POST['notice']), 'expiry_date' => $expiry_date, 'expiry_date_option' => $_POST['expiry_date_select'], 'important' => $important],
                            'notices' => $this->noticeModel->getNotices($this->club_id), // Get all notices.
                            'title_err' => isset($title_err) ? $title_err : '',
                            'notice_err' => isset($notice_err) ? $notice_err : '',
                        ];

                        // If no errors then save notice.
                        if (!isset($title_err) && !isset($notice_err)) {
                            if ($this->noticeModel->addNotice($this->club_id, $data['notice'])) {
                                create_flash_message('notices', 'Successfully added notice ' . $data['notice']->title);
                                redirect($this->club_name . '/notices', true);
                            } else {
                                die('<strong>Fatal Error: </strong> Something went wrong when adding a notice.');
                            }
                        } else {
                            create_flash_message('notices', 'Please correct all highlighted errors and try again.', 'danger');
                        }
                    } else {
                        // Only get list of notices.
                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'notices' => $this->noticeModel->getNotices($this->club_id), // Get all notices.
                        ];
                    }
                } else {
                    // In public we only need the notices and not the form data.
                    $data = [
                        'club' => $this->clubModel->getClubByID($this->club_id),
                        'notices' => $this->noticeModel->getNotices($this->club_id)  // Default is 4 notices.  If left blank then all notices are returned.
                    ];
                }
            }
            $this->view('notices/index', $data);
        }

        public function edit($notice_id) {
            
            if (isset($notice_id)) {
                // Get single Notice
                // If notice exists then proceed
                if ($this->noticeModel->getNotice($this->club_id, $notice_id)) {

                    if ($_SERVER['REQUEST_METHOD'] === "POST") {
                        // Validate POST data.
                        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                        // Validate title
                        if (empty($_POST['title'])) {
                            $title_err = 'Please enter a notice title';
                        }
                        // Validate notice.
                        if (empty($_POST['notice'])) {
                            $notice_err = 'Please enter a notice body';
                        }

                        // Validate expiry_date
                        if ($_POST['expiry_date_select'] === "NULL") {
                            $expiry_date = NULL;
                        } else {
                            $expiry_date = date('Y-m-d', strtotime($_POST['expiry_date_select']) + 86400); // Have to add another day (86400 seconds) because notice will expire 00:00 on the day, rather than at 23:59 on the day.
                        }

                        // Validate important
                        $important = isset($_POST['important']) ? true : false;

                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'notice' => (object) ['notice_id' => $_POST['notice_id'], 'title' => trim($_POST['title']), 'notice' => trim($_POST['notice']), 'expiry_date' => $expiry_date, 'expiry_date_option' => $_POST['expiry_date_select'], 'important' => $important],
                            'notices' => $this->noticeModel->getNotices($this->club_id), // Get all notices.
                            'title_err' => isset($title_err) ? $title_err : '',
                            'notice_err' => isset($notice_err) ? $notice_err : '',
                        ];

                        // If no errors then save notice.
                        if (!isset($title_err) && !isset($notice_err)) {
                            if ($this->noticeModel->updateNotice($this->club_id, $data['notice'])) {
                                create_flash_message('notices', 'Successfully edited the notice ' . $data['notice']->title);
                                redirect($this->club_name . '/notices', true);
                            } else {
                                die('<strong>Fatal Error: </strong> Something went wrong when adding a notice.');
                            }
                        } else {
                            create_flash_message('notices', 'Please correct all highlighted errors.', 'danger');
                        }
                    } else {
                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'notice' => $this->noticeModel->getNotice($this->club_id, $notice_id),
                            'notices' => $this->noticeModel->getNotices($this->club_id),
                        ];
                    }
                } else {
                    create_flash_message('notices', 'Invalid Notice ID', 'warning');
                    redirect($this->club_name . '/notices', true);
                }
            } else {
                create_flash_message('notices', 'Please supply a valid notice id.', 'warning');
                redirect($this->club_name . '/notices', true);
            }

            $this->view('notices/edit', $data);
        }

        public function delete($notice_id) {
            if (isset($notice_id)) {
                // Get single Notice
                $notice = $this->noticeModel->getNotice($this->club_id, $notice_id);
                // If notice exist then proceed with deletion.
                if ($notice) {
                    if ($_SERVER['REQUEST_METHOD'] === "POST") {
                        if ($this->noticeModel->deleteNotice($this->club_id, $notice_id)) {
                            create_flash_message('notices', 'Successfully deleted the notice <strong>' . $notice->title . '</strong>.');
                            redirect($this->club_name . '/notices', true);
                        } else {
                            die('<strong>Fatal Error: </strong>Something went wrong when deleting a notice.');
                        }
                    } else {
                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'notice' => $notice,
                        ];
                    }
                } else {
                    // Invalid notice id so redirect.
                    create_flash_message('notices', 'Invalid Notice ID', 'warning');
                    redirect($this->club_name . '/notices', true);
                }
            } else {
                create_flash_message('notices', 'Please supply a valid notice id.', 'warning');
                redirect($this->club_name . '/notices', true);
            }
            $this->view('notices/delete', $data);
        }
    }