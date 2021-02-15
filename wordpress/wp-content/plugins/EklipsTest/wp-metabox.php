<?php

/*
    Plugin Name: WP Metabox
    Description: This is a simple plugin for testing purpose.
    Version: 1.0.0
    Author: Eklips Test
*/

function wp_register_metabox() {
    add_meta_box("test-post-id", "Test Post Metabox", "wp_post_callback", "post", "side", "default");
}

add_action("add_meta_boxes", "wp_register_metabox");




// callback funtion for metabox
function wp_post_callback($post) {
    wp_nonce_field(basename(__FILE__), "wp_nonce");

    ?>

    <div>
        <p>Color</p>
        <?php
            $radioButtonColor = get_post_meta($post->ID, "post_color", true);
        ?>
        <input type="radio" id="white" name="radioButtonColor" value="White" checked="checked">
        <label for="radioButtonColor">White</label><br>
        
        <input type="radio" id="green" name="radioButtonColor" value="Green" <?php if ($radioButtonColor == "Green"){echo 'checked="checked"';} ?>>
        <label for="radioButtonColor">Green</label><br>
    </div>

    <?php
}


//Save post with new metabox data
add_action("save_post", "wp_save_metabox_data");

function wp_save_metabox_data($post_id) {
    // verfied the nonce
    if (!isset($_POST['wp_nonce']) || !wp_verify_nonce($_POST['wp_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    //save value to db field
    $color = 'white';
    if (isset($_POST['radioButtonColor'])) {
        $color = sanitize_text_field($_POST['radioButtonColor']);
    } else {
        $color = 'white';
    }
    update_post_meta($post_id, "post_color", $color);
}



// adding body class
add_filter('body_class','add_category_to_single');
function add_category_to_single($classes) {
    if (is_single() ) {
        global $post;
        foreach((get_post($post->ID)) as $post) {
            if(get_post_meta($post->ID, "post_color", true) == 'Green') {
                $classes[] = 'body-color-green';
            } else {
                $classes[] = 'body-color-white';
            }
        }
    }
    return $classes;
}




// adding color filter
add_filter( 'parse_query', 'admin_posts_filter' );
add_action( 'restrict_manage_posts', 'admin_posts_filter_restrict_manage_posts' );
 
function admin_posts_filter( $query )
{
    global $pagenow;
    if ( is_admin() && $pagenow=='edit.php' && isset($_GET['ADMIN_FILTER_FIELD_NAME']) && $_GET['ADMIN_FILTER_FIELD_NAME'] != '') {
        $query->query_vars['meta_key'] = $_GET['ADMIN_FILTER_FIELD_NAME'];
    if (isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE'] != '')
        $query->query_vars['meta_value'] = $_GET['ADMIN_FILTER_FIELD_VALUE'];
    }
}
 
function admin_posts_filter_restrict_manage_posts()
{
    global $wpdb;
    $sql = 'SELECT DISTINCT meta_key FROM '.$wpdb->postmeta.' ORDER BY 1';
    $fields = $wpdb->get_results($sql, ARRAY_N);

    ?>

    <select name="ADMIN_FILTER_FIELD_NAME">
    <option value=""><?php _e('Filter By Custom Fields', 'baapf'); ?></option>

    <?php
        $current = isset($_GET['ADMIN_FILTER_FIELD_NAME'])? $_GET['ADMIN_FILTER_FIELD_NAME']:'';
        $current_v = isset($_GET['ADMIN_FILTER_FIELD_VALUE'])? $_GET['ADMIN_FILTER_FIELD_VALUE']:'';
        foreach ($fields as $field) {
            if (substr($field[0],0,1) != "_"){
            printf
                (
                    '<option value="%s"%s>%s</option>',
                    $field[0],
                    $field[0] == $current? ' selected="selected"':'',
                    $field[0]
                );
            }
        }
    ?>
    </select>

    <select type="text" id="colors" name="ADMIN_FILTER_FIELD_VALUE" value="<?php echo $current_v; ?>">
        <option <?php if (isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE']=="White") echo "selected";?> >White</option>
        <option <?php if (isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE']=="Green") echo "selected";?> >Green</option>
    </select>

    <?php
}


