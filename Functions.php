<?php
global $wpdb;
// Get text from database to add when article/writing is copied by the user
$added_text = $wpdb->get_var("SELECT option_value FROM {$wpdb->prefix}options WHERE option_name = 'referensi_copy'");
function ILRICT_check_data()
{
    global $added_text;
    // Check if the admin has set the plugin
    if (!$added_text) {
        // If not, display this text when the article/writing is copied by the user
        echo "Read more at:";
    } else {
        // If yes, display the text set by the admin
        echo esc_html($added_text);
    }
}

function ILRICT_reference_link()
{
?>

    <script>
        function ILRICT_add_link() {
            var body_element = document.getElementsByTagName('body')[0];
            var selection;
            selection = window.getSelection();
            var oldselection = selection
            var page_link = "<br><br><?php ILRICT_check_data() ?> <a href='<?php echo get_permalink(get_the_ID()); ?>'><?php echo get_permalink(get_the_ID()); ?></a>"; // Text that appears when the article/writing is copied by the user
            var copy_text = selection + page_link;
            var new_div = document.createElement('div');
            new_div.style.left = '-99999px';
            new_div.style.position = 'absolute';

            body_element.appendChild(new_div);
            new_div.innerHTML = copy_text;
            selection.selectAllChildren(new_div);
            window.setTimeout(function() {
                body_element.removeChild(new_div);
            }, 0);
        }

        document.oncopy = ILRICT_add_link;
    </script>

<?php
}
add_action('wp_head', 'ILRICT_reference_link');
?>