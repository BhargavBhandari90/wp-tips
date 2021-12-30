<?php
/**
 * Add this code to plugin's main file.
 * After adding, YOU HAVE TO RE-ACTIVATE THE PLUGIN.
 */

function custom_every_minute_schedule( $schedules ) {

	// add a 'everyminute' schedule to the existing set
	$schedules['everyminute'] = array(
		'interval' => 60,
		'display'  => __( 'Custom Every Minute', 'gca-core' ),
	);
	return $schedules;
}

add_filter( 'cron_schedules', 'custom_every_minute_schedule' );

function custom_core_activate() {
	if ( ! wp_next_scheduled( 'custom_every_minute_event' ) ) {
		wp_schedule_event( time(), 'everyminute', 'custom_every_minute_event' );
	}
}

register_activation_hook( __FILE__, 'custom_core_activate' );

add_action( 'custom_every_minute_event', 'custom_every_minute_cronjob' );

function custom_every_minute_cronjob() {
	error_log( date( 'Y-m-d H:i:s', time() ) );
	add_option( 'custom_crone_run_at', date( 'Y-m-d H:i:s', time() ) );
}
