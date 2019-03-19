<nav class="clubbar">
    <div class="container text-center">
        <?php 
            foreach (CLUBS as $club_name => $club_data) {
                $url = URLROOT . $club_name;
        ?>
                <a href="<?php echo URLROOT . $club_name; ?>" class="<?php echo ($club_name === $data['club']->club) ? 'active' : ''; ?>">
                    <div class="nav-club-image">
        <?php
                $file = PUBLIC_ROOT . "img/sportsbar/" . $club_name . ".png";
                $icon = (file_exists($file)) ? URLROOT . "img/sportsbar/" . $club_name . ".png" : URLROOT . "img/sportsbar/default.png";
        ?>
                        <img src="<?php echo $icon; ?>" alt="St Joseph's <?php echo ucwords($club_name) ?> Club">
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

