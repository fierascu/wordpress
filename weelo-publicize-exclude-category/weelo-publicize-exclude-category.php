<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://weelo.ro/
 * @since             1.0.0
 * @package           Jetpack_Publicize_Exclude_Category_From_Being_Shared
 *
 * @wordpress-plugin
 * Plugin Name:       publicize-exclude-category
 * Plugin URI:        https://weelo.ro/publicize-exclude-category
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Weelo
 * Author URI:        https://weelo.ro/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       jetpack publicize exclude category from being shared
 * Domain Path:       /languages
 */

// example from https://developer.jetpack.com/hooks/publicize_should_publicize_published_post/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * Do not trigger Publicize if the post uses the `do-not-publicize` category.
 *
 * @param bool $should_publicize Should the post be publicized? Default to true.
 * @param WP_POST $post Current Post object.
 */
function jeherve_control_publicize_for_categories( $should_publicize, $post ) {
    // Return early if we don't have a post yet (it hasn't been saved as a draft)
    if ( ! $post ) {
        return $should_publicize;
    }
  
    // Get list of categories for our post.
    $categories = get_the_category( $post->ID );
     
    if ( is_array( $categories ) && ! empty( $categories ) ) {
        foreach( $categories as $category ) {
            if ( 'Premium' === $category->slug ||  'articole-premium' === $category->slug ||  'premium' === $category->slug ) {
                return false;
            }
        }
    }
  
    return $should_publicize;
}
add_filter( 'publicize_should_publicize_published_post', 'jeherve_control_publicize_for_categories', 10, 2 );

?>