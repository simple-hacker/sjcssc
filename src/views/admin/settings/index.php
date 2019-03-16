<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('settings');
?>

<form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/settings'; ?>" method="POST">

    <div class="wrap">
        <h3>Home Page Settings</h3>
        <input type="hidden" value="<?php echo (isset($data['club']->id)) ? $data['club']->id : ''; ?>"?>
        <div class="form-group row">
            <div class="col-12"><input type="text" name="name" class="form-control<?php if (!empty($data['name_err'])) echo ' is-invalid'; ?>" value="<?php echo (isset($data['club']->name)) ? $data['club']->name : ''; ?>" placeholder="Full Club Name"/></div>
            <div class="col-12"><?php if (isset($data['name_err'])) display_invalid($data['name_err']); ?></div>
        </div>
        <div class="form-group row">
            <div class="col-12"><textarea name="message" class="form-control<?php if (!empty($data['message_err'])) echo ' is-invalid'; ?>" rows="10" placeholder="Enter front page message."><?php echo (isset($data['club']->message)) ? $data['club']->message : ''; ?></textarea></div>
            <div class="col-12"><?php if (isset($data['message_err'])) display_invalid($data['message_err']); ?></div>
        </div>
    </div>

    <div class="wrap">
        <h3>Contact Information</h3>
        <br>
        <h4>Addresses</h4>
<?php
    foreach ($data['addresses'] as $i => $address) {
?>
        <div class="form-group row">
            <input type="hidden" name="address_id[]" value="<?php echo (!empty($address->id)) ? $address->id : ''; ?>"/>
            <div class="col-6"><input type="text" name="address_title[]" class="form-control<?php if (!empty($data['addresses_title_err'][$i])) echo ' is-invalid'; ?>" value="<?php echo (!empty($address->address_title)) ? $address->address_title : ''; ?>" placeholder="Address Title"/></div>
            <div class="col-6"><input type="text" name="address[]" class="form-control<?php if (!empty($data['addresses_err'][$i])) echo ' is-invalid'; ?>" value="<?php echo (!empty($address->address)) ? $address->address : ''; ?>" placeholder="Address"/></div>
            <div class="col-6"><?php if (isset($data['addresses_title_err'][$i])) display_invalid($data['addresses_title_err'][$i]); ?></div>
            <div class="col-6"><?php if (isset($data['addresses_err'][$i])) display_invalid($data['addresses_err'][$i]); ?></div>
        </div>
<?php
    }
?>
        <div class="form-group row">
            <input type="hidden" name="address_id[]" value=""/>
            <div class="col-6"><input type="text" name="address_title[]" class="form-control" value="" placeholder="Address Title"/></div>
            <div class="col-6"><input type="text" name="address[]" class="form-control" value="" placeholder="Address"/></div>
        </div>

        <div class="form-group row">
            <div class="col-6 ml-auto text-right">
                <button type="button" class="addRow btn btn-dark"><i class="fas fa-plus-square mr-2"></i> Another Row</button>
            </div>
        </div>

        <h4>Emails</h4>
<?php
    foreach ($data['emails'] as $i => $email) {
?>
        <div class="form-group row">
            <input type="hidden" name="email_id[]" value="<?php echo (!empty($email->id)) ? $email->id : ''; ?>"/>
            <div class="col-6"><input type="text" name="email_title[]" class="form-control<?php if (!empty($data['emails_title_err'][$i])) echo ' is-invalid'; ?>" value="<?php echo (!empty($email->email_title)) ? $email->email_title : ''; ?>" placeholder="Email Title"/></div>
            <div class="col-6"><input type="email" name="email[]" class="form-control<?php if (!empty($data['emails_err'][$i])) echo ' is-invalid'; ?>" value="<?php echo (!empty($email->email)) ? $email->email : ''; ?>" placeholder="Email Address"/></div>
            <div class="col-6"><?php if (isset($data['emails_title_err'][$i])) display_invalid($data['emails_title_err'][$i]); ?></div>
            <div class="col-6"><?php if (isset($data['emails_err'][$i])) display_invalid($data['emails_err'][$i]); ?></div>
        </div>
<?php
    }
?>
        <div class="form-group row">
            <input type="hidden" name="email_id[]" value=""/>
            <div class="col-6"><input type="text" name="email_title[]" class="form-control" value="" placeholder="Email Title"/></div>
            <div class="col-6"><input type="text" name="email[]" class="form-control" value="" placeholder="Email Address"/></div>
        </div>

        <div class="form-group row">
            <div class="col-6 ml-auto text-right">
                <button type="button" class="addRow btn btn-dark"><i class="fas fa-plus-square mr-2"></i> Another Row</button>
            </div>
        </div>

        <h4>Phone Numbers</h4>
<?php
    foreach ($data['phone_numbers'] as $i => $phone_number) {
?>
        <div class="form-group row">
            <input type="hidden" name="phone_number_id[]" value="<?php echo (!empty($phone_number->id)) ? $phone_number->id : ''; ?>"/>
            <div class="col-6"><input type="text" name="phone_number_title[]" class="form-control<?php if (!empty($data['phone_number_title'][$i])) echo ' is-invalid'; ?>" value="<?php echo (!empty($phone_number->phone_number_title)) ? $phone_number->phone_number_title : ''; ?>" placeholder="Phone Number Title"/></div>
            <div class="col-6"><input type="tel" name="phone_number[]" class="form-control<?php if (!empty($data['phone_number'][$i])) echo ' is-invalid'; ?>" value="<?php echo (!empty($phone_number->phone_number)) ? $phone_number->phone_number : ''; ?>" placeholder="Phone Number"/></div>
            <div class="col-6"><?php if (isset($data['phone_number_title'][$i])) display_invalid($data['phone_number_title'][$i]); ?></div>
            <div class="col-6"><?php if (isset($data['phone_number'][$i])) display_invalid($data['phone_number'][$i]); ?></div>
        </div>
<?php
    }
?>
        <div class="form-group row">
            <input type="hidden" name="phone_number_id[]" value=""/>
            <div class="col-6"><input type="text" name="phone_number_title[]" class="form-control" value="" placeholder="Phone Number Title"/></div>
            <div class="col-6"><input type="text" name="phone_number[]" class="form-control" value="" placeholder="Phone Number"/></div>
        </div>

        <div class="form-group row">
            <div class="col-6 ml-auto text-right">
                <button type="button" class="addRow btn btn-dark"><i class="fas fa-plus-square mr-2"></i> Another Row</button>
            </div>
        </div>
    </div>

    <div class="wrap">
        <h3>Menu Links</h3>
        <p>Can have up to five menu links</p>
<?php
    for ($i = 0; $i < 5; $i++) {
?>
        <div class="form-group row">
            <input type="hidden" name="menu_link_id[]" value="<?php echo (!empty($data['menu_links'][$i]->id)) ? $data['menu_links'][$i]->id : ''; ?>"/>
            <div class="col-6"><input type="text" name="menu_link_title[]" class="form-control<?php if (!empty($data['menu_links_title_err'][$i])) echo ' is-invalid'; ?>" value="<?php echo (!empty($data['menu_links'][$i]->menu_link_title)) ? $data['menu_links'][$i]->menu_link_title : ''; ?>" placeholder="Link Title"/></div>
            <div class="col-6"><input type="url" name="menu_link[]" class="form-control<?php if (!empty($data['menu_links_err'][$i])) echo ' is-invalid'; ?>" value="<?php echo (!empty($data['menu_links'][$i]->menu_link)) ? $data['menu_links'][$i]->menu_link : ''; ?>" placeholder="Link URL"/></div>
            <div class="col-6"><?php if (isset($data['menu_links_title_err'][$i])) display_invalid($data['menu_links_title_err'][$i]); ?></div>
            <div class="col-6"><?php if (isset($data['menu_links_err'][$i])) display_invalid($data['menu_links_err'][$i]); ?></div>
        </div>
<?php
    }
?>
    </div>

    <div class="wrap">
        <h3>Website Images</h3>
        <div class="form-group row">
            <div class="col-12"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . '/settings/images'; ?>" class="btn btn-block btn-brown-secondary">View and change website images</a></div>
        </div>  
    </div>

<?php
    // Only show team name if the club has a results or outings section.  i.e. All but social should show this.
    if (!empty(array_intersect(['results', 'outings'], CLUBS[$data['club']->club]['sections']))) {
?>
        <div class="wrap">
            <h3>Sport Settings</h3>
            <div class="form-group row">
                <label for="home_team" class="col-sm-2 col-form-label d-none d-md-flex">Home Team</label>
                <div class="col-10">
<?php
            if (!empty($data['teams'])) {
?>  
                <select id="team_id" name="team_id" class="form-control">
<?php
                foreach ($data['teams'] as $team) {
?>
                    <option value="<?php echo $team->id; ?>" <?php echo ($team->id === $data['club']->team_id) ? 'selected' : ''; ?>><?php echo $team->team; ?></option>
<?php
                }
?>
                </select>
<?php
            } else {
?>
            <div class="form-group row">
                <input type="text" name="home_team" class="form-control disabled" value="No Teams Found.  Please enter teams in Settings." disabled><br/>
            </div>
<?php
            }
?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-4"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . '/settings/teams'; ?>" class="btn btn-block btn-brown-secondary">View All Teams</a></div>
                <div class="col-4"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . '/settings/leagues'; ?>" class="btn btn-block btn-brown-secondary">View All Leagues</a></div>
                <div class="col-4"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . '/settings/people'; ?>" class="btn btn-block btn-brown-secondary">View All People</a></div>
            </div>          
        </div>
<?php
    }
?>
        <div class="wrap">
            <div class="row">
                <div class="col-6 mx-auto"><input type="submit" value="Save Changes" class="btn btn-block btn-brown ww-50"/></div>
            </div>
        </div>
    </form>


    <script>
        var lastValue;

        $("#team_id").bind("click", function(e){
            lastValue = $(this).val();
        }).bind("change", function(e){
            changeConfirmation = confirm("Are you sure you want to change the home team?");
            if (changeConfirmation) {
                // Proceed as planned
            } else {
                $(this).val(lastValue);
            }
        });
    </script>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>