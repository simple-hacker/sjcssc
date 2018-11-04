<?php
    // Only show sidebar if we're logged in.
    if (isset($_SESSION['user'])) {
?>
    <nav id="sidebar">
        <ul class="list-unstyled">
        <?php
            // Only if user has permissions to view clubs.
            if (sizeof($_SESSION['user']['permissions']) > 0) {
                // List all clubs user has permission for, along with the subsections of those clubs.
                foreach ($_SESSION['user']['permissions'] as $club_id => $club_name) {
        ?>
                    <li class="<?php echo ($club_name === $data['club']->club) ? 'active' : ''; ?>">
                        <a href="#<?php echo $club_name; ?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?php echo ucwords($club_name); ?></a>
                        <ul class="<?php echo !($club_name === $data['club']->club) ? 'collapse' : ''; ?> list-unstyled" id="<?php echo $club_name; ?>">
                            <li>
                                <a href="<?php echo ADMIN_URLROOT . $club_name . '/dashboard'; ?>"><i class="fas fa-home"></i> Dashboard</a>
                            </li>
        <?php
                            foreach (CLUBS[$club_name]['sections'] as $section) {
        ?>
                            <li>
                                <a href="<?php echo ADMIN_URLROOT . $club_name . '/' . $section; ?>"><?php echo (isset(ICONS[$section])) ? ICONS[$section] : ''; ?><?php echo ucwords($section); ?></a>
                            </li>
        <?php
                            }
        ?>
                            <li>
                                <a href="<?php echo ADMIN_URLROOT . $club_name . '/settings'; ?>"><i class="fas fa-cog"></i> Settings</a>
                            </li>
                        </ul>
                    </li>
        <?php
                }
            }
        ?>
                <li>
                    <a href="<?php echo ADMIN_URLROOT . 'user/settings'; ?>"><i class="fas fa-user"></i> User Settings</a>
                </li>
        <?php
                if ($_SESSION['user']['admin'] === true) {
        ?>
                    <li>
                        <a href="<?php echo ADMIN_URLROOT . 'users'; ?>"><i class="fas fa-users"></i> Manage Users</a>
                    </li> 
        <?php
                }
        ?>
        </ul>
    </nav>
<?php
    }
?>