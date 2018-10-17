<h1>DASHBOARD</h1>
<p>
    <ul>
        <li>List of items that need consolidating.</li>
        <ul><li>e.g. Fixtures without Results</li></ul>
    </ul>
</p>

<?php
    if (isset($_SESSION)) {
        print_var($_SESSION);
    }
?>