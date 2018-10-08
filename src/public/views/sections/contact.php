<p>CONTACT SECTION</p>

<?php
    foreach ($club->emails as $email) {
        echo $email->email_title . ' - ' . $email->email . '<br>';
    }
?>

<?php
    foreach ($club->addresses as $address) {
        echo $address->address_title . ' - ' . $address->address . '<br>';
    }
?>

<?php
    foreach ($club->phone_numbers as $phone_number) {
        echo $phone_number->phone_number_title . ' - ' . $phone_number->phone_number . '<br>';
    }
?>