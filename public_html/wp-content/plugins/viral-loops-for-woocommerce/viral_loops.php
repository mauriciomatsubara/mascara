<?php
/*
Plugin Name: Viral Loops for WooCommerce
Plugin URI:  https://viral-loops.com/
Description: Integration of Viral Loops into WooCommerce
Version:     1.3.2
Author:      Viralloops
Author URI:  https://viral-loops.com/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
if (!class_exists('Viralloops_API')) {

    class Viralloops
    {
        function __construct()
        {
            $this->addAction('init', 'pluginInit');
        }

        public function pluginInit()
        {
            //Setup plugin options
            $this->addAction('plugin_uninstall_hook', 'unregisterSettings');

            //Setup Setting's Pages
			if(is_admin()) 
			{
			  $this->addAction( 'admin_init', 'registerSettings' );
              $this->addAction( 'admin_init', 'viral_loops_settings' );
			  $this->addAction( 'admin_menu', 'viral_loops_create_settings_page' );
			}
			
            $this->addAction( 'wp_head', 'extra_scripts' );
            $this->addAction( 'woocommerce_thankyou', 'register_conversion' );
            $this->addAction( 'wp_logout', 'clear_storage' );
            $this->addAction( 'wp_login', 'after_login');

			$this->addAction( 'register_form', 'add_hidden_fields' );
			$this->addAction( 'user_register', 'add_metas' );
			$this->addAction( 'login_form', 'add_hidden_fields' );
			$this->addAction( 'user_login', 'add_metas' );

			$this->addAction( 'wp_ajax_nopriv_vl_guest_checkout', 'vl_guest_checkout' );

        }

		function add_hidden_fields() {
			$referralCode = '';
			$refSource = '';
			if (isset($_COOKIE['referrer'])) {
				$referralCode = sanitize_text_field(  $_COOKIE['referrer'] );
			}
			if (isset($_COOKIE['referrer']) && isset($_COOKIE['refSource'])) {
				$refSource = sanitize_text_field( $_COOKIE['refSource'] );
			}
			?>
				<p>
					<input type="hidden" name="referralCode" value="<?php echo esc_attr( $referralCode ); ?>"/>
					<input type="hidden" name="refSource" value="<?php echo esc_attr( $refSource ); ?>"/>
				</p>
			<?php
		}

		function add_metas($user_id) {
			if ( isset( $_POST['referralCode'] ) ) {
				$referrer = sanitize_text_field( $_POST['referralCode'] );
				update_user_meta($user_id, 'referrer', $referrer);	
			}
			if ( isset( $_POST['refSource'] ) ) {
				$refSource = sanitize_text_field( $_POST['refSource'] );
				update_user_meta($user_id, 'refSource', $refSource);	
			}		
		}

        public function addFilter($filter, $function)
        {
            add_filter($filter, array($this , $function) );
        }

        public function addAction($action, $function)
        {
            add_action($action, array($this , $function) );
        }

        public function registerSettings()
        {
             register_setting( 'viral-loops-api', 'viral-loops-api-key', array( $this, 'sanitize' ) );
             register_setting( 'viral-loops-api', 'viral-loops-api-campaign-id', array( $this, 'sanitize' ) );
             register_setting( 'viral-loops-api', 'viral-loops-widget-position', array( $this, 'sanitize' ) );
        }

        public function unregisterSettings()
        {
             unregister_setting( 'viral-loops-api', 'viral-loops-api-key' );
             unregister_setting( 'viral-loops-api', 'viral-loops-api-campaign-id' );
             unregister_setting( 'viral-loops-api', 'viral-loops-widget-position' );
        }

		public function viral_loops_create_settings_page()
		{
			// add top level menu page
			add_menu_page('Viral Loops for WooCommerce', 'Viral Loops for WooCommerce', 'administrator', 'viral_loops_options_page', array($this,'viral_loops_settings_page') );
		}

		public function viral_loops_settings_page()
		{
			?>
			<div class="wrap">
				<h2>Viral Loops for WooCommerce Settings</h2>
				<form method="post" action="options.php">
				<?php  settings_fields( 'viral-loops-api' ); ?>
				<?php do_settings_sections( 'viral_loops_options_page' ); ?>
				<?php submit_button(); ?>
			</form>
			</div>
			<?php
		}

		public function viral_loops_settings()
		{
			add_settings_section(
				'viral_loops_settings',
				'',
				array($this, 'viral_loops_section_cb'),
				'viral_loops_options_page'
			);
			
			add_settings_field(
				'viral-loops-api-capaign-id',
				'Campaign Id',
				array($this, 'viral_loops_api_campaign_cb'),
				'viral_loops_options_page',
				'viral_loops_settings'
			);

			add_settings_field(
				'viral-loops-api-key',
				'API Token',
				array($this, 'viral_loops_api_key_cb'),
				'viral_loops_options_page',
				'viral_loops_settings'
			);
				
			add_settings_field(
				'viral-loops-widget-position',
				'Widget Position',
				array($this, 'viral_loops_widget_positon_cb'),
				'viral_loops_options_page',
				'viral_loops_settings'
			); 
		}

        public function sanitize( $input ) {
            $new_input = '';

            if( isset( $input ) )
                $new_input = sanitize_text_field( $input );

            return $new_input;
        }

        public function viral_loops_section_cb()
        {
			print 'Fill in your Campaign Id and apiToken:';
        }

        public function viral_loops_api_key_cb()
        {
            printf(
                '<input type="text" id="viral-loops-api-key" name="viral-loops-api-key" value="%s" />',
                get_option( 'viral-loops-api-key' ) !== '' ? esc_attr( get_option( 'viral-loops-api-key' )) : ''
            );
        }
		
        public function viral_loops_api_campaign_cb()
        {
            printf(
                '<input type="text" id="viral-loops-api-campaign-id" name="viral-loops-api-campaign-id" value="%s" />',
                get_option( 'viral-loops-api-campaign-id' ) !== '' ? esc_attr( get_option( 'viral-loops-api-campaign-id' )) : ''
            );
        }
		
        public function viral_loops_widget_positon_cb()
        {
			$selected = get_option( 'viral-loops-widget-position' ) !== '' ? esc_attr( get_option( 'viral-loops-widget-position' )) : 'bottom-right';
			$options = array(
				'bottom-right' => 'bottom-right',
				'bottom-left' => 'bottom-left',
				'top-right' => 'top-right',
				'top-left' => 'top-left'
			);
			// Build <select> element.
			$html = '<select id="viral-loops-widget-position" name="viral-loops-widget-position">';
			foreach ( $options as $value => $text )
			{
				$html .= '<option value="'. $value .'"';
				// We make sure the current options selected.
				if ( $value == $selected ) $html .= ' selected="selected"';
				$html .= '>'. $text .'</option>';
			}
			$html .= '</select>';
            printf(
                $html,
                get_option( 'viral-loops-widget-position' ) !== '' ? esc_attr( get_option( 'viral-loops-widget-position' )) : ''
            );        
		}

        function redeem_coupon($coupon_id)
        {
			$coupon_entry = $this->get_coupon_by_name($coupon_id);
			if ($coupon_entry && $coupon_entry->post_excerpt === "viral_loops_coupon") {
				$rewardId = json_decode($coupon_entry->post_content)->rewardId;
		
				$payloadArray = array(
					"apiToken"=>get_option( 'viral-loops-api-key' ),
					"rewardId"=>$rewardId
				);

				$result = $this->do_request("https://app.viral-loops.com/api/v2/rewarded", $payloadArray);
			}
        }

		function get_coupon_by_name($coupon_name, $output = OBJECT) {
			global $wpdb;
				$post = $wpdb->get_var( $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE post_name = %s AND post_type='shop_coupon'", $coupon_name ));
				if ( $post )
					return get_post($post, $output);

			return null;
		}

        public function extra_scripts()
        {
			?>
				<script>!function(){var a=window.VL=window.VL||{};return a.instances=a.instances||{},a.invoked?void(window.console&&console.error&&console.error("VL snippet loaded twice.")):(a.invoked=!0,void(a.load=function(b,c,d){var e={};e.publicToken=b,e.config=c||{};var f=document.createElement("script");f.type="text/javascript",f.id="vrlps-js",f.defer=!0,f.src="https://app.viral-loops.com/client/vl/vl.min.js";var g=document.getElementsByTagName("script")[0];return g.parentNode.insertBefore(f,g),f.onload=function(){a.setup(e),a.instances[b]=e},e.identify=e.identify||function(a,b){e.afterLoad={identify:{userData:a,cb:b}}},e.pendingEvents=[],e.track=e.track||function(a,b){e.pendingEvents.push({event:a,cb:b})},e.pendingHooks=[],e.addHook=e.addHook||function(a,b){e.pendingHooks.push({name:a,cb:b})},e}))}();var campaign = VL.load("<?=get_option( 'viral-loops-api-campaign-id')?>",{autoLoadWidgets: true});</script>
				<div data-vl-widget="rewardingWidget"
					data-vl-widget-for="<?= get_option( "viral-loops-api-campaign-id"  ) ?>"
					data-vl-widget-position="<?= get_option( "viral-loops-widget-position"  )?>">
				</div>
				<div data-vl-widget="rewardingWidgetTrigger"
					data-vl-widget-for="<?= get_option( "viral-loops-api-campaign-id"  ) ?>"
					data-vl-widget-position="<?= get_option( "viral-loops-widget-position"  )?>">
				</div>
				<script>
					var vl_ajax = {url: "<?=admin_url('admin-ajax.php')?>"};
					(function() {
						function getQueryString(field, url) {
							var href = url ? url : window.location.href;
							var reg = new RegExp("[?&]" + field + "=([^&#]*)", "i");
							var string = reg.exec(href);
							return string ? decodeURIComponent(string[1]) : null;
						}
						function getCookie(name) {
							var value = "; " + document.cookie;
							var parts = value.split("; " + name + "=");
							if (parts.length == 2) return parts.pop().split(";").shift();
						}
						function deleteCookie(name) {
							document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
						}
						if (getCookie("vl_logout")) {
							deleteCookie("vl_logout");
							deleteCookie("referrer");
							deleteCookie("refSource");
							campaign.addHook("boot", function() {
								campaign.logout({reloadWidgets: true});
							});
						}
						if (getCookie("vl_auto_trigger")) {
							deleteCookie("vl_auto_trigger");
							campaign.addHook("widgetsLoad", function() {
								campaign.widgets.getByType("rewardingWidget").forEach(function(widget) {
									 widget.toggle();
									 widget.execute(function(type) { 
										 document.getElementById(type).click();
									 }, ["sharing"])
								});
							});
						}
						var date = new Date();
						var days = 100;
						date.setTime(date.getTime() + (days*24*60*60*1000));
						var expires = "; expires=" + date.toUTCString();
						if (getQueryString("referralCode")) {
							document.cookie = "referrer=" + getQueryString("referralCode")+ expires + "; path=/";
							if (getQueryString("refSource")) {
								document.cookie = "refSource=" + getQueryString("refSource") + expires + "; path=/";
							}
						}
					})();
				</script>
			<?php
            if (is_user_logged_in()) {
				$this->add_signature_at_session();
                if (!empty($_SESSION['viral_loops_hash'])) {
                    $userId = get_current_user_id();

                    $fname = get_user_meta($userId, 'first_name', true);
                    $lname = get_user_meta($userId, 'last_name', true);

                    $hash = json_decode($_SESSION['viral_loops_hash']);
             
                    $user = wp_get_current_user();

					$this->register_login($userId, $fname, $lname, $user->data->user_email, $user->data->user_registered);

                    ?>
						<script>
							campaign.identify({
								firstname:  "<?= $fname? $fname:'' ?>",
								lastname:  "<?= $lname? $lname:'' ?>",
								email: "<?= $user->data->user_email ?>",
								timestamp: "<?= $hash->timestamp ?>",
								signature: "<?= $hash->hash ?>",
								createdAt: <?= (int)strtotime($user->data->user_registered) ?>,
							});
						</script>
					<?php
                }
            }
        }

        public function clear_storage()
        {
			setcookie('vl_logout', '1');
        }

        public function register_conversion($orderid)
        {
            $order = new  WC_Order($orderid);
			$coupons = $order->get_used_coupons();
			if (isset($coupons)) {
				foreach($coupons as $coupon_id) {
					$this->redeem_coupon($coupon_id);
				}
			}
			$payloadArray = null;
			//normal conversion
			if (is_user_logged_in()) {
				$user =  wp_get_current_user();
				$payloadArray = array(
					'apiToken' => get_option( 'viral-loops-api-key' ),
					'amount' => $order->get_total(),
					'params' => array(
						'event' => 'order',
						'user' => array(
							'email' => $user->data->user_email
						)
					)
				);
				//guest conversion
			} else {
				if (isset($coupons)) {
					foreach($coupons as $coupon_id) {
						$coupon_entry = $this->get_coupon_by_name($coupon_id);
						if ($coupon_entry && $coupon_entry->post_excerpt === "viral_loops_coupon") {
							$rewardId = json_decode($coupon_entry->post_content)->rewardId;
							$payloadArray = array(
								'apiToken' => get_option( 'viral-loops-api-key' ),
								'amount' => $order->get_total(),
								'params' => array(
									'event' => 'order',
									'user' => array(
										'rewardId' => $rewardId
									)
								)
							);
						}
					}
				}
			}
            $result = $this->do_request("https://app.viral-loops.com/api/v2/events", $payloadArray);
			if (isset($result) && property_exists($result, "rewards")) {
				foreach ($result->rewards as $reward) {
					$this->create_coupon($reward->id, $reward->coupon->name, $reward->coupon->value, $reward->coupon->type, $reward->coupon->settings);
				}
			}
			//add the auto trigger cookie
			setcookie('vl_auto_trigger', '1');
        }
		
		public function add_signature_at_session()
		{
			$user = wp_get_current_user();
            $date = new DateTime();
            $timestamp = $date->getTimestamp();
            $hash = hash_hmac("sha1", "email='.$user->user_email.'&timestamp='.$timestamp.'", get_option( 'viral-loops-api-key' ));
            $_SESSION['viral_loops_hash'] = '{ "hash" : "'.$hash.'" , "timestamp": "'.$timestamp.'"}';
		}

        public function after_login()
        {
            $this->add_signature_at_session();
		}
		
		public function vl_guest_checkout() {
			$email = $_POST['email'];
			$payloadArray = array(
				"apiToken"=>get_option( 'viral-loops-api-key' ),
				"params"=>array(
					"event"=>"action",
					"user"=>array(
						"email"=>$email
					)
				)
			);
			$result = $this->do_request("https://app.viral-loops.com/api/v2/events", $payloadArray);
			if (isset($result) && property_exists($result, "rewards")) {
				foreach ($result->rewards as $reward) {
					$this->create_coupon($reward->id, $reward->coupon->name, $reward->coupon->value, $reward->coupon->type, $reward->coupon->settings);
				}
			}
			echo "ok";
			wp_die();
		}

		public function register_login($userId, $fname, $lname, $email, $createdAt)
        {
			if (is_user_logged_in()) {
				$referralCode = get_user_meta( $userId, 'referrer', true );
				$refSource = get_user_meta( $userId, 'refSource', true );

				$payloadArray = array(
					"apiToken"=>get_option( 'viral-loops-api-key' ),
					"params"=>array(
						"event"=>"action",
						"user"=>array(
							"firstname"=>$fname ? $fname : '',
							"lastname"=>$lname ? $lname : '',
							"email"=>$email,
							"createdAt"=>(int)strtotime($createdAt)
						),
						"referrer"=>array(
							"referralCode"=>$referralCode
						),
						"refSource"=>$refSource
					)
				);
				$result = $this->do_request("https://app.viral-loops.com/api/v2/events", $payloadArray);
				if (isset($result) && property_exists($result, "rewards")) {
					foreach ($result->rewards as $reward) {
						$this->create_coupon($reward->id, $reward->coupon->name, $reward->coupon->value, $reward->coupon->type, $reward->coupon->settings);
					}
				}
			}
        }

        public function create_coupon($id, $name, $amount, $type, $settings)
        {
            $coupon_code = $name; // Code
            $amount = $amount; // Amount
			if ($type === "percentage") { 
				$discount_type = "percent";
			} else {
				$discount_type = "fixed_cart";
			}
			// all types: fixed_cart, percent, fixed_product, percent_product

			$coupon_details = array(
				'rewardId'=> $id,
				'name'=> $name,
				'amount'=> $amount,
				'type'=> $type,
				'discount_type'=> $discount_type
			);
			$coupon_details = json_encode($coupon_details);
                    
            $coupon = array(
				'post_title'  => $coupon_code,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_type'   => 'shop_coupon',
				'post_content'=> $coupon_details,
				'post_excerpt'=> 'viral_loops_coupon'
            );
                    
            $new_coupon_id = wp_insert_post($coupon);

			//coupon settings
			$free_shipping = true;
			$minimum_amount = 0;
			$usage_limit = 1;
			if (isset($settings)) {
				if ($settings->useInShipping === 0) {
					$free_shipping = false;
				}
				if ($settings->minimumOrderTotal > 0) {
					$minimum_amount = $settings->minimumOrderTotal;
				}
				if ($settings->totalUses > 1) {
					$usage_limit = $settings->totalUses;
				}
			}
                    
            // Add meta
            update_post_meta($new_coupon_id, 'discount_type', $discount_type);
            update_post_meta($new_coupon_id, 'coupon_amount', $amount);
            update_post_meta($new_coupon_id, 'individual_use', 'yes');
            update_post_meta($new_coupon_id, 'product_ids', '');
            update_post_meta($new_coupon_id, 'exclude_product_ids', '');
            update_post_meta($new_coupon_id, 'usage_limit', $usage_limit);
            update_post_meta($new_coupon_id, 'expiry_date', '');
            update_post_meta($new_coupon_id, 'apply_before_tax', 'yes');
            update_post_meta($new_coupon_id, 'free_shipping', $free_shipping);
			update_post_meta($new_coupon_id, 'minimum_amount', $minimum_amount);
        }

        public function do_request($url, $payload)
        {
			$response = wp_remote_post( $url, array(
				'method' => 'POST',
				'headers' => array('Content-Type' => 'application/json'),
				'body' => json_encode($payload)
				)
			);

			if ( is_wp_error( $response ) ) {
				$error_message = $response->get_error_message();
				echo "Something went wrong: $error_message";
				return null;
			} else {
				return json_decode($response['body']);
			}
        }
    }

    $instance = new Viralloops();
}
