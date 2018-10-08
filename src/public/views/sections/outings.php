<?php require_once(APPROOT . 'classes\\Outing.php') ?>

<p>OUTINGS SECTION</p>

<?php
    // foreach(CLUBS[$club->club]['outings']['fields'] as $field) {

    //     // First check if there are multiple of the same field, mainly for Rinks and Players
    //     if (!isset($field['count'])) {
    //         if ($field['type'] === 'textarea') {
    //             $output = "<textarea name=\"{$field['name']}\" class=\"col-{$field['size']}\"";
    //             $output .= (isset($field['placeholder'])) ? " placeholder=\"{$field['placeholder']}\"" : "";
    //             $output .= ">";
    //             $output .= (isset($data)) ? $data : "";
    //             $output .= "</textarea>";
    //         } else {
    //             $output = "<input name=\"{$field['name']}\" type=\"{$field['type']}\" class=\"col-{$field['size']}\"";
    //             $output .= (isset($field['placeholder'])) ? " placeholder=\"{$field['placeholder']}\"" : "";
    //             $output .= (isset($data)) ? " value=\"{$data}\"" : "";
    //             $output .= "></input>";
    //         }

    //         echo $output;
    //     } else {
    //         for ($i = 1; $i <= $field['count']; $i++) {
    //             $output = "<input name=\"{$field['name']}{$i}\" type=\"{$field['type']}\" class=\"col-{$field['size']}\"";
    //             $output .= (isset($field['placeholder'])) ? " placeholder=\"{$field['placeholder']} {$i}\"" : "";
    //             $output .= (isset($data)) ? " value=\"{$data}\"" : "";
    //             $output .= "></input>";

    //             echo $output;
    //         }
    //     }
    // }
?>

<hr>
<h4>View Outings</h4>

<?php
    $num_outings = 4;
    $outings = Outing::getOutings($club->club, $num_outings);

    echo '<pre>',print_r($outings,1),'</pre>';
?>