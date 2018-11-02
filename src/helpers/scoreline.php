<?php
    function scoreline($club_name, $result) {
        if (isset(CLUBS[$club_name]['results']['scoreline'])) {
            $scoreline = CLUBS[$club_name]['results']['scoreline'];
            if (isset(CLUBS[$club_name]['results']['fields'])) {
                foreach (CLUBS[$club_name]['results']['fields'] as $field) {
                    if ((strpos($scoreline, $field['name']) !== false) && (isset($result->{$field['name']}))) {
                        // If the field exists within the scoreline string && the field value has been passed with result then replace keyword with value.
                        $scoreline = str_replace($field['name'], $result->{$field['name']}, $scoreline);
                    }
                }
                return $scoreline;
            }
        } else {
            return 'No Scoreline in CONFIG file.';
        }
    }
?>