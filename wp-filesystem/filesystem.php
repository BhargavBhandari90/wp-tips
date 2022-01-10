<?php

<?php

/**
 * Read file content using WP_Filesystem.
 *
 * @return void
 */
function custom_read_file() {

	global $wp_filesystem; // Define constant

	include_once ABSPATH . 'wp-admin/includes/file.php'; // include file.
	WP_Filesystem(); // Initiate methods.

	$states_json = $wp_filesystem->get_contents( 'states.json' ); // Add absolutepath of file which we want to read.

	$states = json_decode( $states_json, true ); // Convert to array.

}
