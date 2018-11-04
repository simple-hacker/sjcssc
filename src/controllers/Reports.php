<?php

    class Reports extends Controller {

        private $admin, $club_id, $club_name;

        public function __construct($admin = false, $club_id) {
            
            // Load all models needed.
            $this->userModel = $this->model('UserModel');
            $this->clubModel = $this->model('Club');
            $this->outingModel = $this->model('Outing');
            $this->reportModel = $this->model('Report');
            
            $this->admin = $admin;
            $this->club_id = $club_id;
            $this->club_name = $this->clubModel->getClubName($this->club_id);

            if ($this->admin === true) {
                $this->userModel->permissionCheckRedirect($this->club_id);
            }
        }

        public function index($report_id) {
            if (isset($report_id)) {
                // Get single fixture.
                // This should be PUBLIC_VIEWS because in admin fixtures with an id will have page of add/edit/delete etc.  Public views will be i.e. bowls/fixtures/2 which loads index.
                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'report' => $this->reportModel->getReport($report_id),
                ];
            } else {
                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'reports' => $this->outingModel->getPastOutings(),
                ];
            }
            $this->view('reports/index', $data);
        }

        public function edit($report_id) {

            if (isset($report_id)) {
                // Check if such a fixture exists.
                $report = $this->outingModel->getOuting($report_id);
                if ($report) {
                    if ($_SERVER['REQUEST_METHOD'] === "POST") {
                        //Validate Form
                        if (empty($_POST['report'])) {
                            $report_err = 'Please enter a report.';
                        }
                        
                        $report->report = isset($_POST['report']) ? trim($_POST['report']) : '';
                        
                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'report' => $report,
                            'reports' => $this->outingModel->getPastOutings(),
                            'report_err' => isset($report_err) ? $report_err : '',
                        ];

                        if (!isset($report_err)) {
                            // Proceed with saving report.
                            if ($this->reportModel->updateReport($data['report'])) {
                                create_flash_message('reports', 'Successfully saved the report for <strong>' . $data['report']->title . '</strong>');
                                redirect($this->club_name . '/reports', true);
                            } else {
                                die('<strong>Fatal Error: </strong> Something went wrong when saving a report.');
                            }
                        } else {
                            create_flash_message('reports', 'Please correct all highlighted errors and try again.', 'danger');
                        }
                    } else {
                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'reports' => $this->outingModel->getPastOutings(),
                            'report' => $this->outingModel->getOuting($report_id),
                        ];
                    }
                } else {
                    create_flash_message('reports', 'Invalid Outing ID.', 'warning');
                    redirect($this->club_name . '/reports', true);
                }
            } else {
                create_flash_message('reports', 'Please supply a valid Outing ID.', 'warning');
                redirect($this->club_name . '/reports', true);
            }
             $this->view('reports/edit', $data);
        }
    }