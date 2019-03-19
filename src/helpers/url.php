<?php

    function google_maps($location) {

        // $location = str_replace(" ", "+", $location);
        // $location = str_replace(",", "%2C", $location);
        // $location = str_replace("'", "%27", $location);
        // $location = str_replace(".", "%2E", $location);
        // $location = str_replace("&", "%26", $location);
        // $location = str_replace("(", "%28", $location);
        // $location = str_replace(")", "%29", $location);

        $location = urlencode($location);
        $location = str_replace("%20", "+", $location);

        $url = "https://www.google.com/maps/search/?api=1&query=" . $location;
        return $url;
    }