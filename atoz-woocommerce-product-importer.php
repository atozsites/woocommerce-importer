<?php /*
    Plugin Name: Atoz Woocommerce Product Importer
    Plugin URI:https://github.com/atozsites/atoz-woocommerce-importer
    Description: Free CSV import utility for WooCommerce
    Version: 1.0
    Author: AtoZ Sites
    Author URI: https://atozsites.com/
    Text Domain: atoz-woocommerce-product-importer  
*/

    
    class AtoZ_Woocommerce_Product_Importer {
        
        public function __construct() {
            add_action( 'init', array( 'AtoZ_Woocommerce_Product_Importer', 'translations' ), 1 );
            add_action('admin_menu', array('AtoZ_Woocommerce_Product_Importer', 'admin_menu'));
            add_action('wp_ajax_atoz-woocommerce-product-importer-ajax', array('AtoZ_Woocommerce_Product_Importer', 'render_ajax_action'));
        }

        public static function translations() {
            load_plugin_textdomain( 'atoz-woocommerce-product-importer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }

        public static function admin_menu() {
            add_management_page( __( 'Woo Product Importer', 'atoz-woocommerce-product-importer' ), __( 'Woo Product Importer', 'atoz-woocommerce-product-importer' ), 'manage_options', 'atoz-woocommerce-product-importer', array('AtoZ_Woocommerce_Product_Importer', 'render_admin_action'));
        }
        
        public static function render_admin_action() {
            $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'upload';
            require_once(plugin_dir_path(__FILE__).'atoz-woocommerce-product-importer-common.php');
            require_once(plugin_dir_path(__FILE__)."atoz-woocommerce-product-importer-{$action}.php");
        }
        
        public static function render_ajax_action() {
            require_once(plugin_dir_path(__FILE__)."atoz-woocommerce-product-importer-ajax.php");
            die(); // this is required to return a proper result
        }
    }
    
    $AtoZ_Woocommerce_product_importer = new AtoZ_Woocommerce_Product_Importer();
