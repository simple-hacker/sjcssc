<?php
    function scoreline($club_name, $result, $team_id) {
        if (isset(CLUBS[$club_name]['results']['scoreline'])) {
            $scoreline = CLUBS[$club_name]['results']['scoreline'];
            if (isset(CLUBS[$club_name]['results']['fields'])) {
                foreach (CLUBS[$club_name]['results']['fields'] as $field) {
                    if ((strpos($scoreline, $field['name']) !== false) && (isset($result->{$field['name']}))) {
                        // If the field exists within the scoreline string && the field value has been passed with result then replace keyword with value.
                        $scoreline = str_replace($field['name'], $result->{$field['name']}, $scoreline);
                    }
                }
                // Explode scoreline in to home_team and away_team scores.
                $scoreline = explode(" - ", $scoreline);
                // Add strong tags to team_id score only.
                $scoreline[0] = ($team_id === $result->home_team_id) ? '<strong>' . $scoreline[0] . '</strong>' : $scoreline[0];
                $scoreline[1] = ($team_id === $result->away_team_id) ? '<strong>' . $scoreline[1] . '</strong>' : $scoreline[1];
                // Put scoreline back together.
                $scoreline = implode(" - ", $scoreline);

                // Add values between ().
                // Only run this code if scoreline contains both ( and )
                if (strpos($scoreline, "(") !== false && strpos($scoreline, ")") !== false) {
                    preg_match_all('!\(([^\)]+)\)!', $scoreline, $match);
                    // Note: I am hard coding this for now as it's only needed for bowls, so we know the scoreline pattern.
                    // Need to store the text that we will eventually replace.
                    $home_score_text = $match[1][0];
                    $away_score_text = $match[1][1];
                    // Evaluate points+bonus_points string.
                    // Note eval is not the best solution, but this is a quick fix.
                    $home_score = eval('return '.$home_score_text.';');
                    $away_score = eval('return '.$away_score_text.';');
                    // Replace score text with the actual score.
                    $scoreline = str_replace($home_score_text, $home_score, $scoreline);
                    $scoreline = str_replace($away_score_text, $away_score, $scoreline);
                }
                return $scoreline;
            }
        } else {
            return 'No Scoreline in CONFIG file.';
        }
    }
?>