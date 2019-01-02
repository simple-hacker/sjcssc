<nav class="clubbar">
    <div class="container text-center">
        <?php 
            foreach (CLUBS as $club_name => $club_data) {
                $url = URLROOT . $club_name;
        ?>
                <a href="<?php echo URLROOT . $club_name; ?>" class="<?php echo ($club_name === $data['club']->club) ? 'active' : ''; ?>">
                    <div class="nav-club-image">
                        <img src="<?php echo URLROOT . '\\img\\sportsbar\\' . $club_name . '.png'; ?>" alt="St Joseph's Catholic Sports and Social Club">
                    </div>
                    <div class="nav-club-text d-none d-lg-block">
                        <?php echo ucwords($club_name); ?>
                    </div>
                </a>
        <?php
            }
        ?>
    </div>
</nav>

