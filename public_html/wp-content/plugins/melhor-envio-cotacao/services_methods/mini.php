<?php

use Services\CalculateShippingMethodService;
use Services\WooCommerceService;

add_action( 'woocommerce_shipping_init', 'mini_shipping_method_init' );

function mini_shipping_method_init() {
    if ( ! class_exists( 'WC_Mini_Shipping_Method' ) ) {

        class WC_Mini_Shipping_Method extends WC_Shipping_Method {

            public $code = '17';
            /**
             * Constructor for your shipping class
             *
             * @access public
             * @return void
             */
            public function __construct($instance_id = 0) {
                $this->id                 = "mini";
                $this->instance_id = absint( $instance_id );
                $this->method_title       = "Correios Mini (Melhor Envio)";
                $this->method_description = 'Serviço Mini';
                $this->enabled            = "yes";
                $this->title              = isset($this->settings['title']) ? $this->settings['title'] : 'Melhor Envio Mini';
                $this->supports = array(
                    'shipping-zones',
                    'instance-settings',
                );
                $this->init_form_fields();
            }

            /**
             * Init your settings
             *
             * @access public
             * @return void
             */
            function init() {
                $this->init_form_fields();
                $this->init_settings();
                add_action('woocommerce_update_options_shipping_' . $this->id, array($this, 'process_admin_options'));
            }

            /**
             * calculate_shipping function.
             *
             * @access public
             * @param mixed $package
             * @return void
             */
            public function calculate_shipping( $package = []) 
            {
                $rate = (new CalculateShippingMethodService())->calculate_shipping(
                    $package, 
                    $this->code,
                    'melhorenvio_mini',
                    'Correios'
                );

                if ($rate) {
					$this->add_rate($rate);
				}
            }
        }
    }
}

function add_mini_shipping_method( $methods ) {
    $methods['mini'] = 'WC_Mini_Shipping_Method';
    return $methods;
}
add_filter( 'woocommerce_shipping_methods', 'add_mini_shipping_method' );
