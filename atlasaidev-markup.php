<?php
/**
 * MarkUp
 *
 * @package           AtlasAiDev MarkUp
 * @author            Azizul Hasan
 * @copyright         2024 Azizul Hasan
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       MarkUp
 * Plugin URI:        https://atlasaidev.com
 * Description:       Description of the plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Azizul Hasan
 * Author URI:        https://atlasaidev.com
 * Text Domain:       MarkUp
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://example.com/my-plugin/
 */

/**
{MarkUp} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

{MarkUp} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with {MarkUp}. If not, see {URI to Plugin License}.
*/

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Absolute path to the WordPress directory.
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

require_once 'vendor/autoload.php';

if( ! function_exists('is_plugin_active') ) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php');
}

if ( ! class_exists( 'MarkUp' ) ) {
	final class MarkUp {

		/**
		 * Plugin version
		 *
		 * @var string
		 */
		const version = '1.0.0';

		/**
		 * Class constructor
		 */
		public function __construct() {
			$this->define_constants();

            register_activation_hook( __FILE__, [ $this, 'activate' ] );

            add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
		}

        /**
         * Initialize a singleton instance
         *
         * @return false|self
         */
        public static function init() {
            static $instance    = false;

            if ( ! $instance ) {
                $instance       = new self();
            }
            return $instance;
        }

		/**
		 * Define the required plugin constants
		 *
		 * @return void
		 */
		public function define_constants() {
			define( 'MARKUP_VERSION', self::version );
			define( 'MARKUP_FILE', __FILE__ );
			define( 'MARKUP_PATH', __DIR__ );
			define( 'MARKUP_URL', plugins_url( '', MARKUP_FILE ) );
			define( 'MARKUP_ASSETS', MARKUP_URL . '/assets' );
		}

		/**
		 * Do stuff upon plugin activation
		 *
		 * @return void
		 */
		public function activate() {

            $installed = get_option( 'markup_installed' );

            if ( ! $installed ) {
                update_option( 'markup_installed', time() );
            }

            update_option( 'markup_version', MARKUP_VERSION );


			add_action( 'init', [ $this, 'init_plugin' ] );
		}

		/**
		 * Initialize the plugin
		 *
		 * @return void
		 */
		public function init_plugin() {
            new AtlasAiDev\MarkUp\Init();
		}

	}
}

/**
 * Initialize the main plugin
 *
 * @return \MarkUp
 */
function markup() {
    return MarkUp::init();
}

markup();
