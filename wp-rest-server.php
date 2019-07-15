<?php namespace WpRestServer;

/**
 * Plugin Name:  WP REST Server
 * Plugin URI:   https://github.com/i30/wp-rest-server
 * Description:  My WordPress plugin boilerplate for WP REST servers.
 * Author:       i30
 * Version:      1.0.0
 * Text Domain:  wp-rest-server
 * Requires PHP: 7.2
 */

use Exception;

/**
 * Plugin container.
 */
final class Plugin
{
    /**
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * @var string
     */
    const API_VERSION = 'v1';

    /**
     * @var string
     */
    const NAMESPACE = 'ns/v1';

    /**
     * Option key
     *
     * @var  string
     */
    const SETTINGS_KEY = 'wp_rest_server_settings';

    /**
     * Settings
     *
     * @var array
     */
    private $settings;

    /**
     * Constructor
     */
    function __construct(array $settings = [])
    {
        $this->settings = array_merge(
            [], // Maybe merge with default values
            $settings
        );

        add_action('plugins_loaded', [$this, '_install'], 10, 0);
        add_action('activate_wp-rest-server/wp-rest-server.php', [$this, '_activate']);
        add_action('deactivate_wp-rest-server/wp-rest-server.php', [$this, '_deactivate']);
    }

    /**
     * Do activation
     *
     * @internal  Used as a callback.
     *
     * @see  https://developer.wordpress.org/reference/functions/register_activation_hook/
     *
     * @param  bool  $network  Whether to activate this plugin on network or a single site.
     */
    function _activate($network)
    {
        try {
            $this->preActivate();
        } catch (Exception $e) {
            if (defined('DOING_AJAX') && DOING_AJAX) {
                header('Content-Type: application/json; charset=' . get_option('blog_charset'));
                status_header(500);
                exit(json_encode([
                    'success' => false,
                    'name'    => __('Plugin Activation Error', 'wp-rest-server'),
                    'message' => $e->getMessage()
                ]));
            } else {
                exit($e->getMessage());
            }
        }

        add_option(self::SETTINGS_KEY, [

        ]);
    }

    /**
     * Do installation
     *
     * @internal  Used as a callback.
     *
     * @see  https://developer.wordpress.org/reference/hooks/plugins_loaded/
     */
    function _install()
    {
        // Define useful constants.
        define('WP_REST_SERVER_DIR', __DIR__ . '/');
        define('WP_REST_SERVER_URI', plugins_url('/', __FILE__));

        // Make sure translation is available.
        load_plugin_textdomain('wp-rest-server', false, __DIR__ . '/languages');

        // Load autoloader.
        require __DIR__ . '/src/Utils/Autoloader.php';

        // Register autoloading.
        Utils\Autoloader::init()->load(__NAMESPACE__, __DIR__ . '/src');
    }

    /**
     * Do deactivation
     *
     * @internal  Used as a callback.
     *
     * @see  https://developer.wordpress.org/reference/functions/register_deactivation_hook/
     *
     * @param  bool  $network  Whether to deactivate this plugin on network or a single site.
     */
    function _deactivate($network)
    {

    }

    /**
     * Pre-activation check
     *
     * @throws  Exception
     */
    private function preActivate()
    {
        if (version_compare(PHP_VERSION, '7.2', '<')) {
            throw new Exception(__('This plugin requires PHP version 7.2 at least!', 'wp-rest-server'));
        }

        if (version_compare($GLOBALS['wp_version'], '5.0', '<')) {
            throw new Exception(__('This plugin requires WordPress version 5.0 at least!', 'wp-rest-server'));
        }

        if (!defined('WP_CONTENT_DIR') || !is_writable(WP_CONTENT_DIR)) {
            throw new Exception(__('WordPress content directory is undefined or not writable.', 'wp-rest-server'));
        }
    }
}

// Initialize plugin.
return new Plugin(get_option(Plugin::SETTINGS_KEY, []));
