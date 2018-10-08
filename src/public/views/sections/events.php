<?php require_once(APPROOT . 'classes\\Event.php') ?>

<p>Events SECTION</p>

<?php
    $test = new Event(1);

    // echo '<pre>',print_r($test,1),'</pre>';

    $num_events = 4;
    $events = Event::getEvents($club->id, $num_events);

    echo '<pre>',print_r($events,1),'</pre>';
?>