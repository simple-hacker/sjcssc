<?php require_once(APPROOT . 'classes\\Fixture.php') ?>

<p>FIXTURES SECTION</p>

<h4>View Fixtures</h4>

<?php
    // $fixture = new Fixture;
    // $fixture->getFixture($club->id, 1);
    
    $fixtures = Fixture::getFixtures($club->id);
    printVar($fixtures);
?>