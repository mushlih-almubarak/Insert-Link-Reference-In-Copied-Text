<?php
global $wpdb;
// if the admin clicks "save" in the setting page
if (isset($_POST["save"])) {
    // Check if there are settings that have been previously saved by the admin
    $check_data = $wpdb->get_var("SELECT * FROM {$wpdb->prefix}options WHERE option_name = 'referensi_copy'");

    // Enter the admin input into the "text" variable
    $text = sanitize_text_field($_POST["reference"]);
    // Function to write error message (if any) in console
    function ILRICT_log_to_console($error)
    {
        printf('<script>console.log(%s);</script>', json_encode($error));
    };

    // If the admin has never set up the plugin before:
    if (!$check_data) {
        // Insert data
        $wpdb->insert($wpdb->options, array("option_id" => null, "option_name" => "referensi_copy", "option_value" => "$text", "autoload" => "yes"));

        // Check if the data was inserted successfully
        if (!$wpdb->last_error) {
            echo "<script>alert('Setting Saved')</script>";
        } else {
            echo "<script>alert('Failed To Save Settings')</script>";
            // Log error to console
            $error_when_insert_data = $wpdb->last_error;
            ILRICT_log_to_console($error_when_insert_data);
        }
    }
    // If the admin has set up the plugin before:
    else {
        // Update data
        $wpdb->update($wpdb->options, array("option_value" => "$text"), array("option_name" => "referensi_copy"));

        // Check if the data was updated successfully
        if (!$wpdb->last_error) {
            echo "<script>alert('Setting Updated')</script>";
        } else {
            echo "<script>alert('Failed To Update Settings')</script>";
            // Log error to console
            $error_when_update_data = $wpdb->last_error;
            ILRICT_log_to_console($error_when_update_data);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Link Reference In Copied Text Setting Plugin</title>
</head>

<body>
    <form method="POST">
        <h1>The Text That Appears When A Text Copied</h1>
        <input type="text" name="reference">
        <button type="submit" name="save" autofocus>Save</button>
    </form>
    <p>Created by <a href="https://github.com/mushlih-almubarak" target="_blank">Mushlih</a>, from Indonesia</p>
</body>

</html>