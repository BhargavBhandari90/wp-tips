<?php

/**
 * Add scripts.
 *
 * @return void
 */
function custom_enqueue_scripts() {

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'backbone' );
    wp_enqueue_script(
		'custom-bb-script',
		plugin_dir_url( __FILE__ ) . 'custom-bb.js', // URL to the script.
		array(
			'jquery',
			'backbone'
		),
		'1.0.0',
		false
	);
}

add_action( 'wp_enqueue_scripts', 'custom_enqueue_scripts' );

/**
 * Custom element for Backebone in the footer.
 *
 * @return void
 */
function custom_element() {
    ?>
    <div id="experiment-plugin-element"><button id="click-button" data-test="">Click Me</button></div>

    <script id="experiment-item-template" type="text/template">
        <div class="abc"><%= post_title %><a href="<%= guid %>">click</a></div>
    </script>
    <?php
}

add_action( 'wp_footer', 'custom_element' );
