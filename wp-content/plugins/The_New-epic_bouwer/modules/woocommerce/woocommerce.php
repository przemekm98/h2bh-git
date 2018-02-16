<?php

/**
 * @class FLWooCommerceModule
 */
class FLWooCommerceModule extends EPBOUWERModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		$enabled = class_exists('Woocommerce');

		parent::__construct(array(
			'name'          => __('WooCommerce', 'ep-bouwer'),
			'description'   => __('Display products or categories from your WooCommerce store.', 'ep-bouwer'),
			'category'      => __('Advanced Modules', 'ep-bouwer'),
			'enabled'       => $enabled
		));
	}

	/**
	 * @method products_post_class
	 */
	public function products_post_class($classes)
	{
		$classes[] = 'product';

		return $classes;
	}

	/**
	 * @method single_product_post_class
	 */
	public function single_product_post_class($classes)
	{
		$classes[] = 'product';
		$classes[] = 'single-product';

		return $classes;
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLWooCommerceModule', array(
	'general'       => array(
		'title'         => __('General', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'layout'        => array(
						'type'          => 'select',
						'label'         => __('Layout', 'ep-bouwer'),
						'default'       => '',
						'options'       => array(
							''              => __('Choose...', 'ep-bouwer'),
							'product'       => __('Single Product', 'ep-bouwer'),
							'products'      => __('Multiple Products', 'ep-bouwer'),
							'add-cart'      => __( '"Add to Cart" Button', 'ep-bouwer' ),
							'categories'    => __('Categories', 'ep-bouwer'),
							'cart'          => __('Cart', 'ep-bouwer'),
							'checkout'      => __('Checkout', 'ep-bouwer'),
							'tracking'      => __('Order Tracking', 'ep-bouwer'),
							'account'       => __('My Account', 'ep-bouwer')
						),
						'toggle'        => array(
							'product'       => array(
								'fields'        => array('product_id')
							),
							'products'      => array(
								'sections'      => array('multiple_products')
							),
							'add-cart'      => array(
								'fields'        => array('product_id')
							),
							'categories'    => array(
								'fields'        => array('parent_cat_id', 'cat_columns')
							)
						)
					),
					'product_id'    => array(
						'type'          => 'text',
						'label'         => __('Product ID', 'ep-bouwer'),
						'default'       => '',
						'size'          => '4',
						'help'          => __('As you add products in the WooCommerce Products area, each will be assigned a unique ID. You can find this unique product ID by visiting the Products area and rolling over the product. The unique ID will be the first attribute.', 'ep-bouwer')
					),
					'parent_cat_id' => array(
						'type'          => 'text',
						'label'         => __('Parent Category ID', 'ep-bouwer'),
						'default'       => '0',
						'size'          => '4',
						'help'          => __('As you add product categories in the WooCommerce Products area, each will be assigned a unique ID. This ID can be found by hovering on the category in the categories area under Products and looking in the URL that is displayed in your browser. The ID will be the only number value in the URL.', 'ep-bouwer')
					),
					'cat_columns'   => array(
						'type'          => 'select',
						'label'         => __('Columns', 'ep-bouwer'),
						'default'       => '4',
						'options'       => array(
							'1'             => '1',
							'2'             => '2',
							'3'             => '3',
							'4'             => '4'
						)
					)
				)
			),
			'multiple_products' => array(
				'title'         => __('Multiple Products', 'ep-bouwer'),
				'fields'        => array(
					'products_source' => array(
						'type'          => 'select',
						'label'         => __('Products Source', 'ep-bouwer'),
						'default'       => 'ids',
						'options'       => array(
							'ids'           => __('Products IDs', 'ep-bouwer'),
							'category'      => __('Product Category', 'ep-bouwer'),
							'recent'        => __('Recent Products', 'ep-bouwer'),
							'featured'      => __('Featured Products', 'ep-bouwer'),
							'sale'          => __('Sale Products', 'ep-bouwer'),
							'best-selling'  => __('Best Selling Products', 'ep-bouwer'),
							'top-rated'     => __('Top Rated Products', 'ep-bouwer')
						),
						'toggle'        => array(
							'ids'           => array(
								'fields'        => array('product_ids', 'columns', 'orderby', 'order')
							),
							'category'      => array(
								'fields'        => array('category_slug', 'num_products', 'columns', 'orderby', 'order')
							),
							'recent'        => array(
								'fields'        => array('num_products', 'columns', 'orderby', 'order')
							),
							'featured'      => array(
								'fields'        => array('num_products', 'columns', 'orderby', 'order')
							),
							'sale'          => array(
								'fields'        => array('num_products', 'columns', 'orderby', 'order')
							),
							'best-selling'  => array(
								'fields'        => array('num_products', 'columns')
							),
							'top-rated'     => array(
								'fields'        => array('num_products', 'columns', 'orderby', 'order')
							)
						)
					),
					'product_ids'   => array(
						'type'          => 'text',
						'label'         => __('Product IDs', 'ep-bouwer'),
						'default'       => '',
						'help'          => __('As you add products in the WooCommerce Products area, each will be assigned a unique ID. You can find this unique product ID by visiting the Products area and rolling over the product. The unique ID will be the first attribute and you can add several here separated by a comma.', 'ep-bouwer')
					),
					'category_slug' => array(
						'type'          => 'text',
						'label'         => __('Category Slug', 'ep-bouwer'),
						'default'       => '',
						'help'          => __('As you add product categories in the WooCommerce Products area, each will be assigned a unique slug or you can edit and add your own. These slugs can be found in the Categories area under WooCommerce Products. Several can be added here separated by a comma.', 'ep-bouwer')
					),
					'num_products'  => array(
						'type'          => 'text',
						'label'         => __('Number of Products', 'ep-bouwer'),
						'default'       => '12',
						'size'          => '4'
					),
					'columns'       => array(
						'type'          => 'select',
						'label'         => __('Columns', 'ep-bouwer'),
						'default'       => '4',
						'options'       => array(
							'1'             => '1',
							'2'             => '2',
							'3'             => '3',
							'4'             => '4'
						)
					),
					'orderby'       => array(
						'type'          => 'select',
						'label'         => __('Sort By', 'ep-bouwer'),
						'default'       => 'menu_order',
						'options'       => array(
							'menu_order'    => _x( 'Default', 'Sort by.', 'ep-bouwer' ),
							'popularity'    => __('Popularity', 'ep-bouwer'),
							'rating'        => __('Rating', 'ep-bouwer'),
							'date'          => __('Date', 'ep-bouwer'),
							'price'         => __('Price', 'ep-bouwer')
						)
					),
					'order'         => array(
						'type'          => 'select',
						'label'         => __('Sort Direction', 'ep-bouwer'),
						'default'       => 'menu_order',
						'options'       => array(
							'ASC'           => __('Ascending', 'ep-bouwer'),
							'DESC'          => __('Descending', 'ep-bouwer')
						)
					)
				)
			)
		)
	)
));