<?php $controller = isset($_GET['controller']) ? $_GET['controller'] : 'dashboard'; ?>

<nav id="sidebar"<?php if (isset($_SESSION['user'])) echo " class=\"active\""; ?>>
    <div class="sidebar-header">
        <a href="<?php echo isset($data['club']->club) ? ADMIN_URLROOT . $data['club']->club : ADMIN_URLROOT; ?>" class=""><?php echo isset($data['club']->name) ? $data['club']->name : 'St Joseph\'s Catholic Sports and Social Club'; ?></a>
        <img src="<?php echo URLROOT . 'img/sportsbar/' . ( isset($data['club']->club) ? $data['club']->club : 'social') . '.png'; ?>" alt="<?php echo isset($data['club']->name) ? $data['club']->name : 'St Joseph\'s Catholic Sports and Social Club'; ?>">
    </div>
    <ul class="list-unstyled">
    <?php
        // Only if user has permissions to view clubs.
        if (sizeof($_SESSION['user']['permissions']) > 0) {
            // List all clubs user has permission for, along with the subsections of those clubs.
            foreach ($_SESSION['user']['permissions'] as $club_id => $club_name) {
    ?>
                <li class="<?php echo ($club_name === $data['club']->club) ? 'active' : ''; ?>">
                    <a href="#<?php echo $club_name; ?>" data-toggle="collapse" aria-expanded="<?php echo ($club_name === $data['club']->club) ? 'true' : 'false'; ?>" class="dropdown-toggle"><?php echo ucwords($club_name); ?></a>
                    <ul class="<?php echo !($club_name === $data['club']->club) ? 'collapse' : 'show'; ?> list-unstyled" id="<?php echo $club_name; ?>">
                        <li>
                            <a href="<?php echo ADMIN_URLROOT . $club_name . '/dashboard'; ?>" class="<?php echo ($data['club']->club === $club_name && $controller === 'dashboard') ? 'active' : ''; ?>"><i class="fas fa-home"></i>Dashboard</a>
                        </li>
    <?php
                        foreach (CLUBS[$club_name]['sections'] as $section) {
    ?>
                        <li>
                            <a href="<?php echo ADMIN_URLROOT . $club_name . '/' . $section; ?>" class="<?php echo ($data['club']->club === $club_name && $controller === $section) ? 'active' : ''; ?>"><?php echo (isset(ICONS[$section])) ? ICONS[$section] : ''; ?><?php echo ucwords($section); ?></a>
                        </li>
    <?php
                        }
    ?>
                        <li>
                            <a href="<?php echo ADMIN_URLROOT . $club_name . '/settings'; ?>" class="<?php echo ($data['club']->club === $club_name && $controller === 'settings') ? 'active' : ''; ?>"><i class="fas fa-cog"></i>Settings</a>
                        </li>
                    </ul>
                </li>
    <?php
            }
        }
    ?>
            <li>
                <a href="<?php echo ADMIN_URLROOT . 'user/settings'; ?>" class="<?php echo ($controller === 'user') ? 'active' : ''; ?>"><i class="fas fa-user"></i>User Settings</a>
            </li>
    <?php
            if ($_SESSION['user']['admin'] === true) {
    ?>
                <li>
                    <a href="<?php echo ADMIN_URLROOT . 'users'; ?>" class="<?php echo ($controller === 'users') ? 'active' : ''; ?>"><i class="fas fa-users"></i>Manage Users</a>
                </li> 
    <?php
            }
    ?>
    </ul>
</nav>