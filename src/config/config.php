<?php
    define('CLUBS', [
        'social' => [
            'sections' => ['notices', 'events'],
            'section_titles' => [
                'notices' => 'Latest News',
                'events' => 'Upcoming Events',
            ],
        ],
        'bowls'  => [
            'sections' => ['notices', 'events', 'fixtures', 'results'],
            'section_titles' => [
                'notices' => 'Latest News',
                'events' => 'Upcoming Events',
                'fixtures' => 'Upcoming Fixtures',
                'results' => 'Latest Results'
            ],
            'fixtures' => [
                'fields' => [
                    ['name' => 'home_team_id', 'type' => 'select', 'size' => 6, 'label' => 'Home Team', 'placeholder' => 'Select Home Team', 'select_item_model' => 'teams', 'select_item' => 'team'],
                    ['name' => 'away_team_id', 'type' => 'select', 'size' => 6, 'label' => 'Away Team', 'placeholder' => 'Select Away Team', 'select_item_model' => 'teams', 'select_item' => 'team'],
                    ['name' => 'league_id', 'type' => 'select', 'size' => 12, 'label' => 'League', 'placeholder' => 'Select a League', 'select_item_model' => 'leagues', 'select_item' => 'league'],
                    ['name' => 'date', 'type' => 'date', 'size' => 6, 'label' => 'Date', ],
                    ['name' => 'time', 'type' => 'time', 'size' => 6, 'label' => 'Time', ],
                    ['name' => 'venue_id', 'type' => 'select', 'size' => 12, 'label' => 'Venue', 'placeholder' => 'Select a Venue', 'select_item_model' => 'venues', 'select_item' => 'venue'],
                    ['name' => 'meet_at', 'type' => 'text', 'size' => 12, 'label' => 'Meet At', 'placeholder' => 'Enter Meet At Location'],
                    ['name' => 'contact', 'type' => 'text', 'size' => 12, 'label' => 'Contact', 'placeholder' => 'Contact Information'],
                    ['name' => 'squad', 'type' => 'text', 'size' => 6, 'label' => 'Rink', 'placeholder' => 'Rink', 'count' => 6],
                    ['name' => 'substitutes', 'type' => 'text', 'size' => 12, 'label' => 'Reserves', 'placeholder' => 'Reserves'],
                    ['name' => 'other_information', 'type' => 'textarea', 'size' => 12, 'label' => 'Other Information', 'placeholder' => 'Other Information']
                ],
                'squad_title' => 'Rink',
                'substitutes_title' => 'Reserves',
            ],
            'results' => [
                'fields' => [
                    ['name' => 'home_team_score', 'type' => 'number', 'size' => 6, 'label' => 'Home Team Score', 'placeholder' => 'Enter Home Team Score'],
                    ['name' => 'away_team_score', 'type' => 'number', 'size' => 6, 'label' => 'Away Team Score', 'placeholder' => 'Enter Away Team Score'],
                    ['name' => 'home_team_points', 'type' => 'number', 'size' => 6, 'label' => 'Home Team Points', 'placeholder' => 'Enter Home Team Points'],
                    ['name' => 'away_team_points', 'type' => 'number', 'size' => 6, 'label' => 'Away Team Points', 'placeholder' => 'Enter Away Team Points'],
                    ['name' => 'home_team_bonus_points', 'type' => 'number', 'size' => 6, 'label' => 'Home Team Bonus Points', 'placeholder' => 'Enter Home Tam Bonus Points'],
                    ['name' => 'away_team_bonus_points', 'type' => 'number', 'size' => 6, 'label' => 'Away Team Bonus Points', 'placeholder' => 'Enter Away Team Bonus Points']
                ],
                'scoreline' => 'home_team_score (home_team_points+home_team_bonus_points) - away_team_score (away_team_points+away_team_bonus_points)',
            ],          
        ],
        'rugby' => [
            'sections' => ['notices', 'events', 'fixtures', 'results'],
            'section_titles' => [
                'notices' => 'Latest News',
                'events' => 'Upcoming Events',
                'fixtures' => 'Upcoming Fixtures',
                'results' => 'Latest Results'
            ],
            'fixtures' => [
                'fields' => [
                    ['name' => 'home_team_id', 'type' => 'select', 'size' => 6, 'label' => 'Home Team', 'placeholder' => 'Select Home Team', 'select_item_model' => 'teams', 'select_item' => 'team'],
                    ['name' => 'away_team_id', 'type' => 'select', 'size' => 6, 'label' => 'Away Team', 'placeholder' => 'Select Away Team', 'select_item_model' => 'teams', 'select_item' => 'team'],
                    ['name' => 'league_id', 'type' => 'select', 'size' => 12, 'label' => 'League', 'placeholder' => 'Select a League', 'select_item_model' => 'leagues', 'select_item' => 'league'],
                    ['name' => 'date', 'type' => 'date', 'label' => 'Date', 'size' => 6],
                    ['name' => 'time', 'type' => 'time', 'label' => 'Time', 'size' => 6],
                    ['name' => 'venue_id', 'type' => 'select', 'size' => 12, 'label' => 'Venue', 'placeholder' => 'Select a Venue', 'select_item_model' => 'venues', 'select_item' => 'venue'],
                    ['name' => 'meet_at', 'type' => 'text', 'size' => 12, 'label' => 'Meet At', 'placeholder' => 'Enter Meet At Location'],
                    ['name' => 'contact', 'type' => 'text', 'size' => 12, 'label' => 'Contact', 'placeholder' => 'Contact Information'],
                    ['name' => 'squad', 'type' => 'text', 'size' => 6, 'label' => 'Player', 'placeholder' => 'Player', 'count' => 15],
                    ['name' => 'substitutes', 'type' => 'text', 'size' => 12, 'label' => 'Substitutes', 'placeholder' => 'Substitutes'],
                    ['name' => 'other_information', 'type' => 'textarea', 'size' => 12, 'label' => 'Other Information', 'placeholder' => 'Other Information']
                ],
                'squad_title' => 'Player',
                'substitutes_title' => 'Substitutes',
            ],
            'results' => [
                'fields' => [
                    ['name' => 'home_team_score', 'type' => 'number', 'size' => 6, 'label' => 'Home Team Score', 'placeholder' => 'Enter Home Team Score'],
                    ['name' => 'away_team_score', 'type' => 'number', 'size' => 6, 'label' => 'Away Team Score', 'placeholder' => 'Enter Away Team Score']
                ],
                'scoreline' => 'home_team_score - away_team_score',
            ]
        ],
        'football' => [
            'sections' => ['notices', 'events', 'fixtures', 'results'],
            'section_titles' => [
                'notices' => 'Latest News',
                'events' => 'Upcoming Events',
                'fixtures' => 'Upcoming Fixtures',
                'results' => 'Latest Results'
            ],
            'fixtures' => [
                'fields' => [
                    ['name' => 'home_team_id', 'type' => 'select', 'size' => 6, 'label' => 'Home Team', 'placeholder' => 'Select Home Team', 'select_item_model' => 'teams', 'select_item' => 'team'],
                    ['name' => 'away_team_id', 'type' => 'select', 'size' => 6, 'label' => 'Away Team', 'placeholder' => 'Select Away Team', 'select_item_model' => 'teams', 'select_item' => 'team'],
                    ['name' => 'league_id', 'type' => 'select', 'size' => 12, 'label' => 'League', 'placeholder' => 'Select a League', 'select_item_model' => 'leagues', 'select_item' => 'league'],
                    ['name' => 'date', 'type' => 'date', 'label' => 'Date', 'size' => 6],
                    ['name' => 'time', 'type' => 'time', 'label' => 'Time', 'size' => 6],
                    ['name' => 'venue_id', 'type' => 'select', 'size' => 12, 'label' => 'Venue', 'placeholder' => 'Select a Venue', 'select_item_model' => 'venues', 'select_item' => 'venue'],
                    ['name' => 'meet_at', 'type' => 'text', 'size' => 12, 'label' => 'Meet At', 'placeholder' => 'Enter Meet At Location'],
                    ['name' => 'contact', 'type' => 'text', 'size' => 12, 'label' => 'Contact', 'placeholder' => 'Contact Information'],
                    ['name' => 'squad', 'type' => 'text', 'size' => 6, 'label' => 'Player', 'placeholder' => 'Player', 'count' => 11],
                    ['name' => 'substitutes', 'type' => 'text', 'size' => 12, 'label' => 'Substitutes', 'placeholder' => 'Substitutes'],
                    ['name' => 'other_information', 'type' => 'textarea', 'size' => 12, 'label' => 'Other Information', 'placeholder' => 'Other Information']
                ],
                'squad_title' => 'Player',
                'substitutes_title' => 'Substitutes',
            ],
            'results' => [
                'fields' => [
                    ['name' => 'home_team_score', 'type' => 'number', 'size' => 6, 'label' => 'Home Team Score', 'placeholder' => 'Enter Home Team Score'],
                    ['name' => 'away_team_score', 'type' => 'number', 'size' => 6, 'label' => 'Away Team Score', 'placeholder' => 'Enter Away Team Score']
                ],
                'scoreline' => 'home_team_score - away_team_score',
            ]
        ],
        'fishing' => [
            'sections' => ['notices', 'events', 'outings', 'reports'],
            'section_titles' => [
                'notices' => 'Lastest News',
                'events' => 'Upcoming Events',
                'outings' => 'Upcoming Outings',
                'reports' => 'Latest Reports'
            ],
            'outings' => [
                'fields' => [
                    ['name' => 'title', 'type' => 'text', 'size' => 12, 'label' => 'Title', 'placeholder' => 'Enter Outing Title'],
                    ['name' => 'date', 'type' => 'date', 'label' => 'Date', 'size' => 6],
                    ['name' => 'time', 'type' => 'time', 'label' => 'Time', 'size' => 6],
                    ['name' => 'venue_id', 'type' => 'select', 'size' => 12, 'label' => 'Venue', 'placeholder' => 'Select a Venue', 'select_item_model' => 'venues', 'select_item' => 'venue'],
                    ['name' => 'meet_at', 'type' => 'text', 'size' => 12, 'label' => 'Meet At', 'placeholder' => 'Enter Meet At Location'],
                    ['name' => 'contact', 'type' => 'text', 'size' => 12, 'label' => 'Contact', 'placeholder' => 'Contact Information'],
                    ['name' => 'other_information', 'type' => 'textarea', 'size' => 12, 'label' => 'Other Information', 'placeholder' => 'Enter extra information here.']
                ]
            ],
            'reports' => [
                'fields' => [
                    ['name' => 'report', 'type' => 'textarea', 'size' => 12, 'label' => 'Report', 'placeholder' => 'Enter Report']
                ]
            ]
        ],
    ]);

    // These define the other controllers we can use, mainly for the admin area.
    // Other controllers are defined from 'sections' for each club, such as Notices, Fixtures etc.
    define('CONTROLLERS', ['user', 'users', 'settings']); // Need to include these variables in .htaccess
    // Array of all possible pages, each controller could have.
    // define('PAGES', ['index', 'add', 'edit', 'delete', 'view', 'show', 'login', 'settings']);

    define('ICONS', [
        'notices' => '<i class="fas fa-edit"></i>',
        'events' => '<i class="fas fa-calendar-alt"></i>',
        'fixtures' => '<i class="fas fa-calendar-plus"></i>',
        'results' => '<i class="fas fa-star"></i>',
        'outings' => '<i class="fas fa-calendar-plus"></i>',
        'reports' => '<i class="fas fa-star"></i>',
    ]);