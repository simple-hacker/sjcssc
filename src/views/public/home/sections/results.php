<section>
    <div class="container">
        <div class="row">
<?php
    if (!empty($data['results'])) {
?>
    <table class="table table-sm table-bordered text-center">
        <thead>
            <th>Date</th>
            <th>League</th>
            <th>Home Team</th>
            <th>Score</th>
            <th>Away Team</th>
            <th>View Fixture</th>
        </thead>
        <tbody>
<?php
        foreach ($data['results'] as $result) {

            // Determine if win/draw/lose.
            if ($result->home_team_score === $result->away_team_score) {
                $tr_class = "draw";
            } elseif ($result->home_team_id === $data['club']->team_id) {
                $tr_class = ($result->home_team_score > $result->away_team_score) ? "win" : "lose";
            } elseif ($result->away_team_id === $data['club']->team_id) {
                $tr_class = ($result->away_team_score > $result->home_team_score) ? "win" : "lose";
            }
?>
            <tr class="<?php echo isset($tr_class) ? $tr_class : ''; ?>">
                <td><?php echo $result->date; ?></td>
                <td><?php echo $result->league; ?></td>
                <td><?php echo ($fixture->home_team_id === $data['club']->team_id) ? '<strong>' . $fixture->home_team . '</strong>' : $fixture->home_team; ?></td>
                <td><?php echo scoreline($data['club']->club, $result) ?></td> <!-- Scoreline function is in helpers folder. -->
                <td><?php echo ($fixture->away_team_id === $data['club']->team_id) ? '<strong>' . $fixture->away_team . '</strong>' : $fixture->away_team; ?></td>
                <td><a href="<?php echo URLROOT . $data['club']->club . '/results/' . $result->id; ?>" class="btn btn-brown">View Fixture</a></td>
            </tr>
<?php
        }
?>
        </tbody>
    </table>
<?php
    }
?>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <a href="<?php echo URLROOT . $data['club']->club . '/results/'; ?>" class="btn btn-lg btn-brown">View All Results</a>
            </div>
        </div>
    </div>
</section>