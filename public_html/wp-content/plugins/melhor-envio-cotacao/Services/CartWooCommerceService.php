<?php

namespace Services;

use Helpers\DimensionsHelper;

class CartWooCommerceService
{
    /**
     * Function to get alls products on cart woocommerce
     * @return Array
     */
    public function getProducts() 
    {
        global $woocommerce;

        $dimensionHelper = new DimensionsHelper();

        $items = $woocommerce->cart->get_cart();

        $products = array();

        foreach( $items as $item_id => $item_product ){

            $productId = ($item_product['variation_id'] != 0) ? $item_product['variation_id'] : $item_product['product_id'];

            $productInfo = wc_get_product( $productId );

            if(!$productInfo || empty($productInfo)) {
                continue;
            } else {

                $data = $productInfo->get_data();

                $products[] = array(
                    'id'           => $item_product['product_id'],
                    'variation_id' => $item_product['variation_id'],
                    'name'         => $data['name'],
                    'price'        => $productInfo->get_price(),
                    'insurance_value' => $productInfo->get_price(),
                    'height'       => $dimensionHelper->converterDimension($productInfo->get_height()),
                    'width'        => $dimensionHelper->converterDimension($productInfo->get_width()),
                    'length'       => $dimensionHelper->converterDimension($productInfo->get_length()),
                    'weight'       => $dimensionHelper->converterIfNecessary($productInfo->get_weight()),
                    'quantity'     => (isset($item_product['quantity'])) ? intval($item_product['quantity']) : 1,
                );
            }
        }
        return $products;
    }
}