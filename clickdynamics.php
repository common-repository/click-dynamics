<?php
/*
Plugin Name: ClickDynamics
Plugin URI: http://www.clickdynamics.com
Description: A plugin to automatically add contextual links to your website and earn you revenue on a CPC basis. You must be approved on clickdynamics.com.
Version: 0.1
Author: ClickDynamics
Author URI: http://www.clickdynamics.com
*/
?>
<?php
function clickdynamics_init() {
        if ( is_admin() ) {
                add_action( 'admin_menu', 'add_clickdynamics' );
        } elseif ( get_option( 'cd_uid' ) ) {
                wp_enqueue_script(
                        'clickdynamics-js',
                        'http://c2ssystems.clickdynamics.com/default.aspx?uid='.get_option('cd_uid').'&uc='.get_option('cd_ad'),
                        array(),
                        '0.1',
                        true
                );
        }
}
add_action( 'init', 'clickdynamics_init' );
function add_clickdynamics() {
    add_menu_page('ClickDynamics Plugin Settings', 'Click Dynamics', 'administrator', __FILE__, 'clickdynamics_options',plugins_url('/images/logo_cd.png', __FILE__));
    add_action( 'admin_init', 'register_clickdynamics' );
}
function register_clickdynamics() {
    register_setting( 'clickdynamics-group', 'cd_uid', 'intval' );
    register_setting( 'clickdynamics-group', 'cd_ad', 'intval' );
}
function clickdynamics_options() {
	echo '<div class="wrap">';
        echo "<h2>" . __( 'ClickDynamics Options', 'clickdynamics_form' ) . "</h2>";
        ?>
        <form name="cd_form" method="post" action="options.php">
            <input type="hidden" name="cd_hidden" value="Y">
            <?php
            settings_fields( 'clickdynamics-group' );
            ?>
        <table class="form-table">
            <tr valign="top">
            <th scope="row">Signup at clickdynamics.com</th>
            <td><a href="http://register.clickdynamics.com/shortreg.htm" target="_blank">Register Here</a></td>
            </tr>
        </table>
        <table class="form-table">
            <tr valign="top">
            <th scope="row">ClickDynamics ID</th>
            <td><input type="text" name="cd_uid" value="<?php echo esc_attr(get_option('cd_uid')); ?>" /></td>
            </tr>
        </table>
        <table class="form-table">
            <tr valign="top">
            <th scope="row">ClickDynamics Ad Code</th>
            <td><input type="text" name="cd_ad" value="<?php echo esc_attr(get_option('cd_ad')); ?>" /></td>
            </tr>
        </table>
        <?php


        echo '<p class="submit">';
        ?>
            <?php submit_button(); ?>
        <?php 
        echo '</p>';
        echo '</form>';
        echo '</div> ';
}
?>