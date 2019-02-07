
<?php
    if (isset($page)) {
        $page = explode("/", $page);

        if (isset($data['club']->club)) {
            if (isset($page[1]) && $page[1] != 'index') {
                $url = ADMIN_URLROOT . $data['club']->club . "/" . $page[0];
            } else {
                $url = ADMIN_URLROOT . $data['club']->club;
            }
        } else {
            $url = ADMIN_URLROOT . $page[0];
        }
?>
        <div class="wrap">
            <div class="row">
            <div class="col-1"><a href="<?php echo $url ?>" class="btn btn-brown btn-lg">Back</a></div>
            <div class="col-11">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php
                            if (isset($data['club']->club)) {
                                if ($page != 'home/index') {
                        ?>
                                    <li class="breadcrumb-item"><a href="<?php echo ADMIN_URLROOT . $data['club']->club; ?>"><?php echo ucwords($data['club']->club); ?> Dashboard</a></li>
                        <?php
                                } else {
                        ?>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo ucwords($data['club']->club); ?> Dashboard</li>
                        <?php
                                }
                            }
                            if (isset($page[0]) && $page[0] != 'home') {
                                if (isset($page[1]) && $page[1] != 'index') {
                                    $url = (isset($data['club']->club)) ? ADMIN_URLROOT . $data['club']->club . "/" . $page[0] : ADMIN_URLROOT . $page[0];
                        ?>
                                        <li class="breadcrumb-item<?php if (isset($page[1])) ?>"><a href="<?php echo $url ?>"><?php echo ucwords($page[0]); ?></a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><?php echo ucwords($page[1]); ?></li>
                        <?php
                                } else {
                        ?>
                                        <li class="breadcrumb-item active" aria-current="page"><?php echo ucwords($page[0]); ?></li>
                        <?php
                                }
                            }
                        ?>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
<?php
    }
?>
        