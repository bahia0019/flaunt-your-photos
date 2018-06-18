<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://flauntyoursite.com
 * @since      1.0.0
 *
 * @package    Flaunt_Your_Photos
 * @subpackage Flaunt_Your_Photos/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Flaunt_Your_Photos
 * @subpackage Flaunt_Your_Photos/includes
 * @author     William Bay <william@flauntyoursite.com>
 */
class Flaunt_Your_Photos {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Flaunt_Your_Photos_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'flaunt-your-photos';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Flaunt_Your_Photos_Loader. Orchestrates the hooks of the plugin.
	 * - Flaunt_Your_Photos_i18n. Defines internationalization functionality.
	 * - Flaunt_Your_Photos_Admin. Defines all hooks for the admin area.
	 * - Flaunt_Your_Photos_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-flaunt-your-photos-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-flaunt-your-photos-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-flaunt-your-photos-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-flaunt-your-photos-public.php';

		$this->loader = new Flaunt_Your_Photos_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Flaunt_Your_Photos_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Flaunt_Your_Photos_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Flaunt_Your_Photos_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Flaunt_Your_Photos_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Flaunt_Your_Photos_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}


/**
 * Disables Yoast on specific CPTs
 */

function fyp_remove_yoast_cpts() {
	remove_meta_box( 'wpseo_meta', array( 'catalogs'  ), 'normal' );
}
add_action('add_meta_boxes', 'fyp_remove_yoast_cpts', 100);


if(get_current_blog_id() === 1){
	$show_in_menu = false;
}


// Register Custom Post Type
function fyp_exhibit_cpt() {

	global $show_in_menu;
	
		$labels = array(
			'name'                  => _x( 'Exhibits', 'Post Type General Name', 'fyp_exhibit_cpt' ),
			'singular_name'         => _x( 'Exhibit', 'Post Type Singular Name', 'fyp_exhibit_cpt' ),
			'menu_name'             => __( 'Exhibits', 'fyp_exhibit_cpt' ),
			'name_admin_bar'        => __( 'Exhibit', 'fyp_exhibit_cpt' ),
			'archives'              => __( 'Exhibit Archives', 'fyp_exhibit_cpt' ),
			'attributes'            => __( 'Exhibit Attributes', 'fyp_exhibit_cpt' ),
			'parent_item_colon'     => __( 'Parent Exhibit:', 'fyp_exhibit_cpt' ),
			'all_items'             => __( 'All Exhibits', 'fyp_exhibit_cpt' ),
			'add_new_item'          => __( 'Add New Exhibit', 'fyp_exhibit_cpt' ),
			'add_new'               => __( 'Add New', 'fyp_exhibit_cpt' ),
			'new_item'              => __( 'New Exhibit', 'fyp_exhibit_cpt' ),
			'edit_item'             => __( 'Edit Exhibit', 'fyp_exhibit_cpt' ),
			'update_item'           => __( 'Update Exhibit', 'fyp_exhibit_cpt' ),
			'view_item'             => __( 'View Exhibit', 'fyp_exhibit_cpt' ),
			'view_items'            => __( 'View Exhibit', 'fyp_exhibit_cpt' ),
			'search_items'          => __( 'Search Exhibit', 'fyp_exhibit_cpt' ),
			'not_found'             => __( 'Not found', 'fyp_exhibit_cpt' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'fyp_exhibit_cpt' ),
			'featured_image'        => __( 'Featured Image', 'fyp_exhibit_cpt' ),
			'set_featured_image'    => __( 'Set featured image', 'fyp_exhibit_cpt' ),
			'remove_featured_image' => __( 'Remove featured image', 'fyp_exhibit_cpt' ),
			'use_featured_image'    => __( 'Use as featured image', 'fyp_exhibit_cpt' ),
			'insert_into_item'      => __( 'Insert into Exhibit', 'fyp_exhibit_cpt' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Exhibit', 'fyp_exhibit_cpt' ),
			'items_list'            => __( 'Exhibits list', 'fyp_exhibit_cpt' ),
			'items_list_navigation' => __( 'Exhibits list navigation', 'fyp_exhibit_cpt' ),
			'filter_items_list'     => __( 'Filter Exhibits list', 'fyp_exhibit_cpt' ),
		);
		$args = array(
			'label'                 => __( 'Exhibit', 'fyp_exhibit_cpt' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'page-attributes', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => $show_in_menu,
			'menu_position'         => 20,
			'menu_icon'             => 'dashicons-store',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'exhibits', $args );
	
	}
	add_action( 'init', 'fyp_exhibit_cpt', 0 );



// Register Custom Post Type
function fyp_catalog_cpt() {

	global $show_in_menu;
	
		$labels = array(
			'name'                  => _x( 'Catalogs', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Catalog', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Catalogs', 'text_domain' ),
			'name_admin_bar'        => __( 'Catalog', 'text_domain' ),
			'archives'              => __( 'Catalog Archives', 'text_domain' ),
			'attributes'            => __( 'Catalog Attributes', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Catalog:', 'text_domain' ),
			'all_items'             => __( 'All Catalogs', 'text_domain' ),
			'add_new_item'          => __( 'Add New Catalog', 'text_domain' ),
			'add_new'               => __( 'Add New', 'text_domain' ),
			'new_item'              => __( 'New Catalog', 'text_domain' ),
			'edit_item'             => __( 'Edit Catalog', 'text_domain' ),
			'update_item'           => __( 'Update Catalog', 'text_domain' ),
			'view_item'             => __( 'View Catalog', 'text_domain' ),
			'view_items'            => __( 'View ICatalog', 'text_domain' ),
			'search_items'          => __( 'Search Catalog', 'text_domain' ),
			'not_found'             => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
			'featured_image'        => __( 'Featured Image', 'text_domain' ),
			'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
			'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
			'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
			'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
			'items_list'            => __( 'Catalogs list', 'text_domain' ),
			'items_list_navigation' => __( 'Catalogs list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
		);
		$args = array(
			'label'                 => __( 'Catalog', 'text_domain' ),
			'description'           => __( 'Catalog of prices', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'revisions', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => $show_in_menu,
			'menu_position'         => 60,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => false,		
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'catalogs', $args );
	
	}
	add_action( 'init', 'fyp_catalog_cpt', 0 );



// Register Products Type
function fyp_products_cpt() {
	
		$labels = array(
			'name'                  => _x( 'Products', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Product', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Products', 'text_domain' ),
			'name_admin_bar'        => __( 'Product', 'text_domain' ),
			'archives'              => __( 'Product Archives', 'text_domain' ),
			'attributes'            => __( 'Product Attributes', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Product:', 'text_domain' ),
			'all_items'             => __( 'All Products', 'text_domain' ),
			'add_new_item'          => __( 'Add New Product', 'text_domain' ),
			'add_new'               => __( 'Add New', 'text_domain' ),
			'new_item'              => __( 'New Product', 'text_domain' ),
			'edit_item'             => __( 'Edit Product', 'text_domain' ),
			'update_item'           => __( 'Update Product', 'text_domain' ),
			'view_item'             => __( 'View Product', 'text_domain' ),
			'view_items'            => __( 'View Product', 'text_domain' ),
			'search_items'          => __( 'Search Product', 'text_domain' ),
			'not_found'             => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
			'featured_image'        => __( 'Featured Image', 'text_domain' ),
			'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
			'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
			'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
			'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
			'items_list'            => __( 'Products list', 'text_domain' ),
			'items_list_navigation' => __( 'Products list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
		);
		$args = array(
			'label'                 => __( 'Products', 'text_domain' ),
			'description'           => __( 'Products', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'revisions', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 60,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => false,		
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
		);
		register_post_type( 'products', $args );
	
	}
	add_action( 'init', 'fyp_products_cpt', 0 );