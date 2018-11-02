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
                    ['name' => 'home_team_id', 'type' => 'select', 'size' => 6, 'placeholder' => 'Select Home Team', 'select_item_model' => 'teams', 'select_item' => 'team'],
                    ['name' => 'away_team_id', 'type' => 'select', 'size' => 6, 'placeholder' => 'Select Away Team', 'select_item_model' => 'teams', 'select_item' => 'team'],
                    ['name' => 'league_id', 'type' => 'select', 'size' => 12, 'placeholder' => 'Select a League', 'select_item_model' => 'leagues', 'select_item' => 'league'],
                    ['name' => 'date', 'type' => 'date', 'size' => 6],
                    ['name' => 'time', 'type' => 'time', 'size' => 6],
                    ['name' => 'venue_id', 'type' => 'select', 'size' => 12, 'placeholder' => 'Select a Venue', 'select_item_model' => 'venues', 'select_item' => 'venue'],
                    ['name' => 'meet_at', 'type' => 'text', 'size' => 12, 'placeholder' => 'Enter Meet At Location'],
                    ['name' => 'contact', 'type' => 'text', 'size' => 12, 'placeholder' => 'Contact Information'],
                    ['name' => 'squad', 'type' => 'text', 'size' => 6, 'placeholder' => 'Rink', 'count' => 6],
                    ['name' => 'substitutes', 'type' => 'text', 'size' => 12, 'placeholder' => 'Reserves'],
                    ['name' => 'other_information', 'type' => 'textarea', 'size' => 12, 'placeholder' => 'Other Information']
                ]
            ],
            'results' => [
                'fields' => [
                    ['name' => 'home_team_score', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Home Team Score'],
                    ['name' => 'away_team_score', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Away Team Score'],
                    ['name' => 'home_team_points', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Home Team Points'],
                    ['name' => 'away_team_points', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Away Team Points'],
                    ['name' => 'home_team_bonus_points', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Home Team Bonus Points'],
                    ['name' => 'away_team_bonus_points', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Away Team Bonus Points']
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
                    ['name' => 'home_team_id', 'type' => 'select', 'size' => 6, 'placeholder' => 'Select Home Team', 'select_item_model' => 'teams', 'select_item' => 'team'],
                    ['name' => 'away_team_id', 'type' => 'select', 'size' => 6, 'placeholder' => 'Select Away Team', 'select_item_model' => 'teams', 'select_item' => 'team'],
                    ['name' => 'league_id', 'type' => 'select', 'size' => 12, 'placeholder' => 'Select a League', 'select_item_model' => 'leagues', 'select_item' => 'league'],
                    ['name' => 'date', 'type' => 'date', 'size' => 6],
                    ['name' => 'time', 'type' => 'time', 'size' => 6],
                    ['name' => 'venue_id', 'type' => 'select', 'size' => 12, 'placeholder' => 'Select a Venue', 'select_item_model' => 'venues', 'select_item' => 'venue'],
                    ['name' => 'meet_at', 'type' => 'text', 'size' => 12, 'placeholder' => 'Enter Meet At Location'],
                    ['name' => 'contact', 'type' => 'text', 'size' => 12, 'placeholder' => 'Contact Information'],
                    ['name' => 'squad', 'type' => 'text', 'size' => 6, 'placeholder' => 'Player', 'count' => 15],
                    ['name' => 'substitutes', 'type' => 'text', 'size' => 12, 'placeholder' => 'Substitutes'],
                    ['name' => 'other_information', 'type' => 'textarea', 'size' => 12, 'placeholder' => 'Other Information']
                ]
            ],
            'results' => [
                'fields' => [
                    ['name' => 'home_team_score', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Home Team Score'],
                    ['name' => 'away_team_score', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Away Team Score']
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
                    ['name' => 'home_team_id', 'type' => 'select', 'size' => 6, 'placeholder' => 'Select Home Team', 'select_item_model' => 'teams', 'select_item' => 'team'],
                    ['name' => 'away_team_id', 'type' => 'select', 'size' => 6, 'placeholder' => 'Select Away Team', 'select_item_model' => 'teams', 'select_item' => 'team'],
                    ['name' => 'league_id', 'type' => 'select', 'size' => 12, 'placeholder' => 'Select a League', 'select_item_model' => 'leagues', 'select_item' => 'league'],
                    ['name' => 'date', 'type' => 'date', 'size' => 6],
                    ['name' => 'time', 'type' => 'time', 'size' => 6],
                    ['name' => 'venue_id', 'type' => 'select', 'size' => 12, 'placeholder' => 'Select a Venue', 'select_item_model' => 'venues', 'select_item' => 'venue'],
                    ['name' => 'meet_at', 'type' => 'text', 'size' => 12, 'placeholder' => 'Enter Meet At Location'],
                    ['name' => 'contact', 'type' => 'text', 'size' => 12, 'placeholder' => 'Contact Information'],
                    ['name' => 'squad', 'type' => 'text', 'size' => 6, 'placeholder' => 'Player', 'count' => 11],
                    ['name' => 'substitutes', 'type' => 'text', 'size' => 12, 'placeholder' => 'Substitutes'],
                    ['name' => 'other_information', 'type' => 'textarea', 'size' => 12, 'placeholder' => 'Other Information']
                ]
            ],
            'results' => [
                'fields' => [
                    ['name' => 'home_team_score', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Home Team Score'],
                    ['name' => 'away_team_score', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Away Team Score']
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
                    ['name' => 'title', 'type' => 'text', 'size' => 12, 'placeholder' => 'Enter Outing Title'],
                    ['name' => 'date', 'type' => 'date', 'size' => 6],
                    ['name' => 'time', 'type' => 'time', 'size' => 6],
                    ['name' => 'venue_id', 'type' => 'select', 'size' => 12, 'placeholder' => 'Select a Venue', 'select_item_model' => 'venues', 'select_item' => 'venue'],
                    ['name' => 'meet_at', 'type' => 'text', 'size' => 12, 'placeholder' => 'Enter Meet At Location'],
                    ['name' => 'contact', 'type' => 'text', 'size' => 12, 'placeholder' => 'Contact Information'],
                    ['name' => 'other_information', 'type' => 'textarea', 'size' => 12, 'placeholder' => 'Enter extra information here.']
                ]
            ],
            'reports' => [
                'fields' => [
                    ['name' => 'report', 'type' => 'textarea', 'size' => 12, 'placeholder' => 'Enter Report']
                ]
            ]
        ]
    ]);

    // These define the other controllers we can use, mainly for the admin area.
    // Other controllers are defined from 'sections' for each club, such as Notices, Fixtures etc.
    define('CONTROLLERS', ['user', 'users', 'settings']); // Need to include these variables in .htaccess
    // Array of all possible pages, each controller could have.
    // define('PAGES', ['index', 'add', 'edit', 'delete', 'view', 'show', 'login', 'settings']);