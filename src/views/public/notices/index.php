<?php
    if (file_exists(PUBLIC_VIEWS . 'inc/header.php')) {
        require_once(PUBLIC_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>

<?php 
    $bg = 'img/parallax/' . $data['club']->club . '/' . strtolower(basename(dirname(__FILE__))) . '.jpg';
    $bg_url = (file_exists(PUBLIC_ROOT . $bg)) ? URLROOT . $bg : 'img/parallax/' . $data['club']->club . '/main.jpg';
?>
    <div class="parallax">
        <div class="parallax-background" style="background-image: url(<?php echo $bg_url; ?>)"></div>
        <div class="parallax-text sj-heading-large">
            <?php echo isset(CLUBS[$data['club']->club]['section_titles']['notices']) ? CLUBS[$data['club']->club]['section_titles']['notices'] : 'Notices'; ?>
        </div>
    </div>
    <section>
        <div class="container mt-2">
            <div class="row">
<?php
            if (!empty($data['notices'])) {
                foreach ($data['notices'] as $notice) {
?>
                <div class="card mb-3">
                    <div class="card-header text-center sj-heading-small">
                        <?php echo ($notice->important == true) ? '<i class="fa fa-star"></i> ' : ''; ?>
                        <?php echo $notice->title; ?>
                        <?php echo ($notice->important == true) ? ' <i class="fa fa-star"></i>' : ''; ?>
                    </div>
                    <div class="card-body">
                        <p><?php echo $notice->notice; ?><p>
                        <div class="blockquote-footer">Posted on <?php echo date("l jS F, Y", strtotime($notice->created_date)); ?></div>
                    </div>
                </div>
<?php
                }
            } else {
?>
                <div class="empty-section">
                    <p>There isn't any news to show.</p>
                </div>
<?php
            }
?>
            </div>
        </div>
    </section>
<?php
    if (file_exists(PUBLIC_VIEWS . 'inc/footer.php')) {
        require_once(PUBLIC_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>