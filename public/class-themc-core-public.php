<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://linuxarchitect.themc.network
 * @since      0.0.1
 *
 * @package    Themc_Core
 * @subpackage Themc_Core/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two hooks to
 * enqueue the public-facing stylesheet and JavaScript.
 * As you add hooks and methods, update this description.
 *
 * @package    Themc_Core
 * @subpackage Themc_Core/public
 * @author     LinuxArchitect <george@themc.network>
 */
class Themc_Core_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The unique prefix of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $plugin_prefix    The string used to uniquely prefix technical functions of this plugin.
	 */
	private $plugin_prefix;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.0.1
	 * @param      string $plugin_name      The name of the plugin.
	 * @param      string $plugin_prefix          The unique prefix of this plugin.
	 * @param      string $version          The version of this plugin.
	 */
	public function __construct( $plugin_name, $plugin_prefix, $version ) {

		$this->plugin_name   = $plugin_name;
		$this->plugin_prefix = $plugin_prefix;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/themc-core-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/themc-core-public.js', array( 'jquery' ), $this->version, true );

	}

    // fires when member_registration form is completed...
    function themc_core_wpf_member_registration( $fields, $entry, $form_data, $entry_id ) {

        error_log( __FUNCTION__ . ' hook called' );

    }


    function themc_core_wpf_member_activation( $user_id ) {

        error_log( __FUNCTION__ . ' hook called, user_id: ' . $user_id );

        //
        // get list of sites to activate user
        //
        $args = [ 'limit' => -1 ];
        $core_sites = pods( 'core_site', $args );
        error_log( __FUNCTION__ . ": total: " . $core_sites->total() );

        //
        // loop over all sites found
        //
        if ( 0 < $core_sites->total() ) {
            while ( $core_sites->fetch() ) {

                //
                // get the type of site and do the right thing for each type
                //
                $site_title = $core_sites->field( 'post_title' );
                $site_type = $core_sites->field( 'site_type' );
                $role = $core_sites->field( 'default_user_role' );

                error_log( __FUNCTION__ . ": site: " . $site_title . ", site_type: " . $site_type . ", user_id: " . $user_id . ", role: " . $role );
                switch( $site_type ) {
                    //
                    // multisite sites use add_user_to_blog
                    //
                    case "Multisite":
                        $site = $core_sites->field( 'multisite_name' );

                        if (! is_array( $site ) ) {
                            error_log( __FUNCTION__ . ": site: " . $site_title . ", missing multisite_name" );
                            break;
                        }
                        error_log( __FUNCTION__ . ": site_name: " . $site['domain'] . ", blog_id: " . $site['blog_id'] . ", user_id: " . $user_id . ", role: " . $role );
                        $return = add_user_to_blog( $site['blog_id'], $user_id, $role );
                        if ( is_wp_error( $return ) ) {
                            error_log( __FUNCTION__ . ": error: " . $return->get_error_message() );
                        } else {
                            error_log( __FUNCTION__ . ": ok, added user_id: " . $user_id . " to blog_id: " . $site['blog_id'] . " with role: " . $role );
                        }

                        break;
                    //
                    // for shared usermeta table, add caps with the correct prefix
                    // assumption: a given role has the same caps on each site
                    //
                    case "Internal":
                        $internal_table_prefix = $core_sites->field( 'internal_table_prefix' );
                        error_log( __FUNCTION__ . ": table_prefix: " . $internal_table_prefix );

                        //$caps = get_role( $role )->capabilities;
                        //$caps = array( $role );
                        $caps = [ $role => true ];

                        if ( $caps ) {
                            error_log( __FUNCTION__ . ": table_prefix: " . $internal_table_prefix . ", user_caps: " . print_r( $caps, true) );
                            $return = update_user_meta( $user_id, $internal_table_prefix . 'capabilities', $caps );
                            if ( is_int($return) ) {
                                error_log( __FUNCTION__ . ": ok, added user_id: " . $user_id . " to site: " . $site_title . ", with role: " . $role );
                            } else if ($return) {
                                error_log( __FUNCTION__ . ": ok, updated user_id: " . $user_id . " on site: " . $site_title . ", with role: " . $role );
                            } else {
                                 error_log( __FUNCTION__ . ": error, no change to user_id: " . $user_id . " on site: " . $site_title . ", with role: " . $role );
                            }
                        }

                        break;
                    case "External":
                        $external_site_name = $core_sites->field( 'external_site_name' );
                        error_log( __FUNCTION__ . ": site_name: " . $external_site_name );
                        break;
                    default:
                        error_log( __FUNCTION__ . ": unknown/unsupported site_type: " . $site_type );
                        break;
                }

            }
        } else {
            error_log( __FUNCTION__ . ": no core sites found, no work to do" );
        }


        //error_log( __FUNCTION__ . ": add role: subscriber" );
        //$user->add_role( "subscriber" );
    }

}
