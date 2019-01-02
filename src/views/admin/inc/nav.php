<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
    <div class="container-fluid">

        <?php  if (isset($_SESSION['user'])) { ?>
            <span class="mr-4">
                <button type="button" id="sidebarCollapse" class="btn btn-brown pr-3 pl-3">
                    <i class="fas fa-bars"></i>
                </button>
            </span>
        <?php } ?>

        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu_links" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="menu_links">
            <ul class="navbar-nav ml-auto">
        <?php
                if (isset($_SESSION['user'])) {
        ?>
                <li class="nav-item d-none d-lg-block">
                    <p class="text-muted pt-3 mr-5">Welcome <?php echo (!empty($_SESSION['user']['name'])) ? $_SESSION['user']['name'] : $_SESSION['user']['username']; ?>!</p> <!-- Either display name if given, or username -->
                </li>
                <li class="nav-item">
                    <a href="<?php echo URLROOT; ?>" target="_blank" class="nav-link"><i class="fas fa-globe-americas i-lg mr-1"></i> Back To Website</a>
                </li> 
                <!-- <li class="nav-item"> 
                    <a href="<?php // echo ADMIN_URLROOT; ?>user/settings" class="nav-link"><i class="fas fa-cog i-lg mr-1"></i> Settings</a>
                </li>  -->
                <li class="nav-item">
                    <a href="<?php echo ADMIN_URLROOT; ?>user/logout" class="nav-link"><i class="fas fa-sign-out-alt i-lg mr-1"></i> Logout</a>
                </li>
        <?php
                } else {
        ?>
                <li class="nav-item">
                    <a href="<?php echo URLROOT; ?>" target="_blank" class="nav-link"><i class="fas fa-globe-americas i-lg mr-1"></i> Back To Website</a>
                </li> 
                <li class="nav-item">
                    <a href="<?php echo ADMIN_URLROOT; ?>user/login" class="nav-link"><i class="fas fa-sign-in-alt i-lg mr-1"></i>Login</a>
                </li>  
        <?php
                }
        ?>
            </ul>
        </div>
    </div>
</nav>