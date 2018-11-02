<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
    <div class="container">
        <a href="<?php echo URLROOT . $data['club']->club; ?>" class="navbar-brand"><?php echo $data['club']->name; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu_links" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu_links">
            <ul class="navbar-nav ml-auto">
            <?php 
                foreach (CLUBS[$data['club']->club]['sections'] as $section) {
                    $url = URLROOT . $data['club']->club . "/" . $section;
            ?>
                    <li class="nav-item">
                        <a href="<?php echo $url; ?>" class="nav-link"><?php echo ucwords($section); ?></a>
                    </li> 
            <?php
                }
                if (isset($data['club']->menu_links)) {
                    foreach ($data['club']->menu_links as $menu_link) {
            ?>
                    <li class="nav-item">
                        <a href="<?php echo $menu_link->menu_link; ?>" target="_blank" class="nav-link"><?php echo $menu_link->menu_link_title; ?></a>
                    </li> 
            <?php
                    }
                }
            ?>
            </ul>
        </div>
    </div>
</nav>
