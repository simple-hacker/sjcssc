<?php

    // $GLOBALS['clubs_config'] = [
    //     'social' => [
    //         'sections' => ['notices', 'events']
    //     ],
    //     'bowls'  => [
    //         'sections' => ['notices', 'events', 'fixtures', 'results'],
    //         'fixtures' => [
    //             'fields' => [
    //                 ['name' => 'home_team', 'type' => 'select', 'size' => 6, 'placeholder' => 'Select Home Team', 'select_item' => 'team'],
    //                 ['name' => 'away_team', 'type' => 'select', 'size' => 6, 'placeholder' => 'Select Away Team', 'select_item' => 'team'],
    //                 ['name' => 'league', 'type' => 'select', 'size' => 12, 'placeholder' => 'Select a League', 'select_item' => 'league'],
    //                 ['name' => 'date', 'type' => 'date', 'size' => 6],
    //                 ['name' => 'time', 'type' => 'time', 'size' => 6],
    //                 ['name' => 'location', 'type' => 'select', 'size' => 12, 'placeholder' => 'Select a Venue', 'select_item' => 'venue'],
    //                 ['name' => 'meet_at', 'type' => 'text', 'size' => 12, 'placeholder' => 'Enter Meet At Location'],
    //                 ['name' => 'contact', 'type' => 'text', 'size' => 12, 'placeholder' => 'Contact Information'],
    //                 ['name' => 'rink', 'type' => 'text', 'size' => 6, 'placeholder' => 'Rink', 'count' => 6, 'squad' => true],
    //                 ['name' => 'reserves', 'type' => 'text', 'size' => 12, 'placeholder' => 'Reserves', 'squad' => true],
    //                 ['name' => 'other_information', 'type' => 'textarea', 'size' => 12, 'placeholder' => 'Other Information']
    //             ]
    //         ],
    //         'results' => [
    //             'fields' => [
    //                 ['name' => 'home_team_score', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Home Team Score'],
    //                 ['name' => 'away_team_score', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Away Team Score'],
    //                 ['name' => 'home_team_points', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Home Team Points'],
    //                 ['name' => 'away_team_points', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Away Team Points'],
    //                 ['name' => 'home_team_bonus_points', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Home Team Bonus Points'],
    //                 ['name' => 'away_team_bonus_points', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Away Team Bonus Points']
    //             ]
    //         ],          
    //     ],
    //     'rugby' => [
    //         'sections' => ['notices', 'events', 'fixtures', 'results'],
    //         'fixtures' => [
    //             'fields' => [
    //                 ['name' => 'home_team', 'type' => 'text', 'size' => 12, 'placeholder' => 'Enter Home Team'],
    //                 ['name' => 'away_team', 'type' => 'text', 'size' => 12, 'placeholder' => 'Enter Away Team'],
    //                 ['name' => 'date', 'type' => 'date', 'size' => 6],
    //                 ['name' => 'time', 'type' => 'time', 'size' => 6],
    //                 ['name' => 'player', 'type' => 'text', 'size' => 6, 'placeholder' => 'Player', 'count' => 15]
    //             ]
    //         ],
    //         'results' => [
    //             'fields' => [
    //                 ['name' => 'home_team_score', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Home Team Score'],
    //                 ['name' => 'away_team_score', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Away Team Score']
    //             ]
    //         ]
    //     ],
    //     'football' => [
    //         'sections' => ['notices', 'events', 'fixtures', 'results'],
    //         'fixtures' => [
    //             'fields' => [
    //                 ['name' => 'home_team', 'type' => 'text', 'size' => 12, 'placeholder' => 'Enter Home Team'],
    //                 ['name' => 'away_team', 'type' => 'text', 'size' => 12, 'placeholder' => 'Enter Away Team'],
    //                 ['name' => 'date', 'type' => 'date', 'size' => 6],
    //                 ['name' => 'time', 'type' => 'time', 'size' => 6],
    //                 ['name' => 'player', 'type' => 'text', 'size' => 6, 'placeholder' => 'Player', 'count' => 11]
    //             ]
    //         ],
    //         'results' => [
    //             'fields' => [
    //                 ['name' => 'home_team_score', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Home Team Score'],
    //                 ['name' => 'away_team_score', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Away Team Score']
    //             ]
    //         ]
    //     ],
    //     'fishing' => [
    //         'sections' => ['notices', 'events', 'outings', 'reports'],
    //         'outings' => [
    //             'fields' => [
    //                 ['name' => 'title', 'type' => 'text', 'size' => 12, 'placeholder' => 'Enter Outing Title'],
    //                 ['name' => 'date', 'type' => 'date', 'size' => 6],
    //                 ['name' => 'time', 'type' => 'time', 'size' => 6],
    //                 ['name' => 'meet_at', 'type' => 'text', 'size' => 12, 'placeholder' => 'Enter Meet At Location'],
    //                 ['name' => 'contact', 'type' => 'text', 'size' => 12, 'placeholder' => 'Contact Information'],
    //                 ['name' => 'information', 'type' => 'textarea', 'size' => 12, 'placeholder' => 'Enter extra information here.']
    //             ]
    //         ],
    //         'reports' => [
    //             'fields' => [
    //                 ['name' => 'reports', 'type' => 'textarea', 'size' => 12, 'placeholder' => 'Enter Report']
    //             ]
    //         ]
    //     ]
    // ];

    define('CLUBS', [
        'social' => [
            'sections' => ['notices', 'events']
        ],
        'bowls'  => [
            'sections' => ['notices', 'events', 'fixtures', 'results'],
            'fixtures' => [
                'fields' => [
                    ['name' => 'home_team', 'type' => 'select', 'size' => 6, 'placeholder' => 'Select Home Team', 'select_item' => 'team'],
                    ['name' => 'away_team', 'type' => 'select', 'size' => 6, 'placeholder' => 'Select Away Team', 'select_item' => 'team'],
                    ['name' => 'league', 'type' => 'select', 'size' => 12, 'placeholder' => 'Select a League', 'select_item' => 'league'],
                    ['name' => 'date', 'type' => 'date', 'size' => 6],
                    ['name' => 'time', 'type' => 'time', 'size' => 6],
                    ['name' => 'location', 'type' => 'select', 'size' => 12, 'placeholder' => 'Select a Venue', 'select_item' => 'venue'],
                    ['name' => 'meet_at', 'type' => 'text', 'size' => 12, 'placeholder' => 'Enter Meet At Location'],
                    ['name' => 'contact', 'type' => 'text', 'size' => 12, 'placeholder' => 'Contact Information'],
                    ['name' => 'rink', 'type' => 'text', 'size' => 6, 'placeholder' => 'Rink', 'count' => 6, 'squad' => true],
                    ['name' => 'reserves', 'type' => 'text', 'size' => 12, 'placeholder' => 'Reserves', 'squad' => true],
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
                ]
            ],          
        ],
        'rugby' => [
            'sections' => ['notices', 'events', 'fixtures', 'results'],
            'fixtures' => [
                'fields' => [
                    ['name' => 'home_team', 'type' => 'text', 'size' => 12, 'placeholder' => 'Enter Home Team'],
                    ['name' => 'away_team', 'type' => 'text', 'size' => 12, 'placeholder' => 'Enter Away Team'],
                    ['name' => 'date', 'type' => 'date', 'size' => 6],
                    ['name' => 'time', 'type' => 'time', 'size' => 6],
                    ['name' => 'player', 'type' => 'text', 'size' => 6, 'placeholder' => 'Player', 'count' => 15]
                ]
            ],
            'results' => [
                'fields' => [
                    ['name' => 'home_team_score', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Home Team Score'],
                    ['name' => 'away_team_score', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Away Team Score']
                ]
            ]
        ],
        'football' => [
            'sections' => ['notices', 'events', 'fixtures', 'results'],
            'fixtures' => [
                'fields' => [
                    ['name' => 'home_team', 'type' => 'text', 'size' => 12, 'placeholder' => 'Enter Home Team'],
                    ['name' => 'away_team', 'type' => 'text', 'size' => 12, 'placeholder' => 'Enter Away Team'],
                    ['name' => 'date', 'type' => 'date', 'size' => 6],
                    ['name' => 'time', 'type' => 'time', 'size' => 6],
                    ['name' => 'player', 'type' => 'text', 'size' => 6, 'placeholder' => 'Player', 'count' => 11]
                ]
            ],
            'results' => [
                'fields' => [
                    ['name' => 'home_team_score', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Home Team Score'],
                    ['name' => 'away_team_score', 'type' => 'number', 'size' => 12, 'placeholder' => 'Enter Away Team Score']
                ]
            ]
        ],
        'fishing' => [
            'sections' => ['notices', 'events', 'outings', 'reports'],
            'outings' => [
                'fields' => [
                    ['name' => 'title', 'type' => 'text', 'size' => 12, 'placeholder' => 'Enter Outing Title'],
                    ['name' => 'date', 'type' => 'date', 'size' => 6],
                    ['name' => 'time', 'type' => 'time', 'size' => 6],
                    ['name' => 'meet_at', 'type' => 'text', 'size' => 12, 'placeholder' => 'Enter Meet At Location'],
                    ['name' => 'contact', 'type' => 'text', 'size' => 12, 'placeholder' => 'Contact Information'],
                    ['name' => 'information', 'type' => 'textarea', 'size' => 12, 'placeholder' => 'Enter extra information here.']
                ]
            ],
            'reports' => [
                'fields' => [
                    ['name' => 'reports', 'type' => 'textarea', 'size' => 12, 'placeholder' => 'Enter Report']
                ]
            ]
        ]
    ]);