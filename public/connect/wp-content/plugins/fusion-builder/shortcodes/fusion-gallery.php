<?php

if ( fusion_is_element_enabled( 'fusion_gallery' ) ) {

	if ( ! class_exists( 'FusionSC_FusionGallery' ) ) {
		/**
		 * Shortcode class.
		 *
		 * @package fusion-builder
		 * @since 1.0
		 */
		class FusionSC_FusionGallery extends Fusion_Element {

			/**
			 * An array of the shortcode arguments.
			 *
			 * @access protected
			 * @since 1.0
			 * @var array
			 */
			protected $args;

			/**
			 * Number of columns.
			 *
			 * @access private
			 * @since 1.0
			 * @var int
			 */
			private $num_of_columns = 1;

			/**
			 * Total number of columns.
			 *
			 * @access private
			 * @since 1.0
			 * @var int
			 */
			private $total_num_of_columns = 1;

			/**
			 * The image data.
			 *
			 * @access private
			 * @since 1.0
			 * @var false|array
			 */
			private $image_data = false;

			/**
			 * The gallery counter.
			 *
			 * @access private
			 * @since 1.5.3
			 * @var int
			 */
			private $gallery_counter = 1;

			/**
			 * Constructor.
			 *
			 * @access public
			 * @since 1.0
			 */
			public function __construct() {
				parent::__construct();
				add_shortcode( 'fusion_gallery', array( $this, 'render' ) );

				add_filter( 'fusion_attr_gallery-shortcode', array( $this, 'attr' ) );
				add_filter( 'fusion_attr_gallery-shortcode-masonry-wrapper', array( $this, 'masonry_wrapper_attr' ) );
				add_filter( 'fusion_attr_gallery-shortcode-images', array( $this, 'image_attr' ) );
				add_filter( 'fusion_attr_gallery-shortcode-link', array( $this, 'link_attr' ) );
			}

			/**
			 * Render the shortcode
			 *
			 * @access public
			 * @since 1.0
			 * @param  array  $args    Shortcode parameters.
			 * @param  string $content Content between shortcode.
			 * @return string          HTML output.
			 */
			public function render( $args, $content = '' ) {
				global $fusion_library, $fusion_settings;

				$defaults = FusionBuilder::set_shortcode_defaults(
					array(
						'hide_on_mobile'               => fusion_builder_default_visibility( 'string' ),
						'class'                        => '',
						'id'                           => '',
						'image_ids'                    => '',
						'columns'                      => ( '' !== $fusion_settings->get( 'gallery_columns' ) ) ? (int) $fusion_settings->get( 'gallery_columns' ) : 3,
						'hover_type'                   => ( '' !== $fusion_settings->get( 'gallery_hover_type' ) ) ? strtolower( $fusion_settings->get( 'gallery_hover_type' ) ) : 'none',
						'lightbox_content'             => ( '' !== $fusion_settings->get( 'gallery_lightbox_content' ) ) ? strtolower( $fusion_settings->get( 'gallery_lightbox_content' ) ) : '',
						'lightbox'                     => $fusion_settings->get( 'status_lightbox' ),
						'column_spacing'               => ( '' !== $fusion_settings->get( 'gallery_column_spacing' ) ) ? strtolower( $fusion_settings->get( 'gallery_column_spacing' ) ) : '',
						'picture_size'                 => ( '' !== $fusion_settings->get( 'gallery_picture_size' ) ) ? strtolower( $fusion_settings->get( 'gallery_picture_size' ) ) : '',
						'layout'                       => ( '' !== $fusion_settings->get( 'gallery_layout' ) ) ? strtolower( $fusion_settings->get( 'gallery_layout' ) ) : 'grid',
						'gallery_masonry_grid_ratio'   => $fusion_settings->get( 'masonry_grid_ratio' ),
						'gallery_masonry_width_double' => $fusion_settings->get( 'masonry_width_double' ),
						'bordersize'                   => $fusion_settings->get( 'gallery_border_size' ),
						'bordercolor'                  => $fusion_settings->get( 'gallery_border_color' ),
						'border_radius'                => (int) $fusion_settings->get( 'gallery_border_radius' ) . 'px',
					),
					$args,
					'fusion_gallery'
				);
				$defaults = apply_filters( 'fusion_builder_default_args', $defaults, 'fusion_gallery', $args );

				$defaults['bordersize']    = FusionBuilder::validate_shortcode_attr_value( $defaults['bordersize'], 'px' );
				$defaults['border_radius'] = FusionBuilder::validate_shortcode_attr_value( $defaults['border_radius'], 'px' );

				if ( 'round' === $defaults['border_radius'] ) {
					$defaults['border_radius'] = '50%';
				}

				extract( $defaults );

				$this->args = $defaults;

				$image_ids = explode( ',', $args['image_ids'] );

				$this->num_of_columns       = $this->args['columns'];
				$this->total_num_of_columns = count( $image_ids );

				$this->args['column_spacing'] = $fusion_library->sanitize->get_value_with_unit( $this->args['column_spacing'] / 2 );

				$title = $alt_tag = $image_url = $image_id = '';

				$image_size = 'full';
				$image_class = '';
				if ( 'fixed' === $this->args['picture_size'] && 'masonry' !== $this->args['layout'] ) {
					$image_size = 'portfolio-two';
					if ( in_array( $columns, array( 4, 5, 6 ) ) ) {
						$image_size = 'blog-medium';
					}
				}

				$n           = 1;
				$images_html = '';
				$styles      = '';

				if ( is_array( $image_ids ) ) {
					foreach ( $image_ids as $image_id ) {
						$this->image_data = $fusion_library->images->get_attachment_data( $image_id, $image_size );

						$image_url = $this->args['pic_link'] = '';
						if ( $this->image_data['url'] ) {
							$image_url = $this->args['pic_link'] = $this->image_data['url'];
						}

						$image_html = '<img src="' . $image_url . '" alt="' . $this->image_data['alt'] . '" title="' . $this->image_data['title'] . '" aria-label="' . $this->image_data['title'] . '" class="img-responsive wp-image-' . $image_id . '" />';

						// For masonry layout, set the correct column size and classes.
						$element_orientation_class = '';
						$responsive_images_columns = $this->args['columns'];
						if ( 'masonry' === $this->args['layout'] && $this->image_data ) {

							// Get the correct image orientation class.
							$element_orientation_class = $fusion_library->images->get_element_orientation_class( $this->image_data['id'], array(), $this->args['gallery_masonry_grid_ratio'], $this->args['gallery_masonry_width_double'] );
							$element_base_padding  = $fusion_library->images->get_element_base_padding( $element_orientation_class );
							$this->image_data['orientation_class'] = $element_orientation_class;
							$this->image_data['element_base_padding'] = $element_base_padding;

							// Check if we have a landscape image, then it has to stretch over 2 cols.
							if ( false !== strpos( $element_orientation_class, 'fusion-element-landscape' ) ) {
								$responsive_images_columns = $this->args['columns'] / 2;
							}
						}

						// Responsive images.
						$fusion_library->images->set_grid_image_meta(
							array(
								'layout' => $this->args['layout'],
								'columns' => $responsive_images_columns,
								'gutter_width' => $this->args['column_spacing'],
							)
						);

						if ( 'full' === $image_size ) {
							$image_html = $fusion_library->images->edit_grid_image_src( $image_html, null, $image_id, 'full' );
						}

						if ( function_exists( 'wp_make_content_images_responsive' ) ) {
							$image_html = wp_make_content_images_responsive( $image_html );
						}
						$fusion_library->images->set_grid_image_meta( array() );

						if ( 'masonry' === $this->args['layout'] ) {
							$image_html = '<div ' . FusionBuilder::attributes( 'gallery-shortcode-masonry-wrapper' ) . '>' . $image_html . '</div>';
						}

						$images_html .= '<div ' . FusionBuilder::attributes( 'gallery-shortcode-images' ) . '>';
						if ( 'liftup' === $this->args['hover_type'] ) {
							$image_class = ' fusion-gallery-image-liftup';
						}
						$images_html .= '<div class="fusion-gallery-image' . $image_class . '">';

						if ( 'no' !== $lightbox && $lightbox ) {
							$images_html .= '<a ' . FusionBuilder::attributes( 'gallery-shortcode-link' ) . '>' . $image_html . '</a>';
						} else {
							$images_html .= $image_html;
						}
						$images_html .= '</div>';
						$images_html .= '</div>';

						if ( 0 === $n % $this->num_of_columns && 'grid' === $this->args['layout'] ) {
							$images_html .= '<div class="clearfix"></div>';
						}

						$n++;
					}

					if ( '' !== $this->args['bordersize'] && 0 !== $this->args['bordersize'] ) {
						$styles .= '.fusion-gallery-' . $this->gallery_counter . ' .fusion-gallery-image {';
						$styles .= "border:{$bordersize} solid {$bordercolor};";
						if ( '0' != $this->args['border_radius'] && '0px' !== $this->args['border_radius'] && 'px' !== $this->args['border_radius'] ) {
							$styles .= "-webkit-border-radius:{$border_radius};-moz-border-radius:{$border_radius};border-radius:{$border_radius};";
							if ( '50%' === $this->args['border_radius'] || 100 < (int) $this->args['border_radius'] ) {
									$styles .= '-webkit-mask-image: -webkit-radial-gradient(circle, white, black);';
							}
						}
						$styles .= '}';
					}

					if ( '' !== $styles ) {
						$style_tag = '<style type="text/css" scoped="scoped">' . $styles . '</style>';
					}
				}

				$html = '<div ' . FusionBuilder::attributes( 'gallery-shortcode' ) . '>';

				if ( 'masonry' === $this->args['layout'] ) {
					$this->args['grid_sizer'] = true;
					$html .= '<div ' . FusionBuilder::attributes( 'gallery-shortcode-images' ) . '></div>';
				}

				$html .= $images_html;
				$html .= '</div>';

				$this->gallery_counter++;

				return $style_tag . $html;
			}

			/**
			 * Builds the attributes array.
			 *
			 * @access public
			 * @since 1.0
			 * @return array
			 */
			public function attr() {

				$attr = array();

				$attr['class']  = 'fusion-gallery fusion-gallery-container';
				$attr['class'] .= ' fusion-grid-' . $this->num_of_columns;
				$attr['class'] .= ' fusion-columns-total-' . $this->total_num_of_columns;
				$attr['class'] .= ' fusion-gallery-layout-' . $this->args['layout'];
				$attr['class'] .= ' fusion-gallery-' . $this->gallery_counter;

				if ( $this->args['column_spacing'] ) {
					$margin = ( -1 ) * (int) $this->args['column_spacing'];
					$attr['style'] = 'margin:' . $margin . 'px;';
				}

				$attr = fusion_builder_visibility_atts( $this->args['hide_on_mobile'], $attr );

				if ( $this->args['class'] ) {
					$attr['class'] .= ' ' . $this->args['class'];
				}

				if ( $this->args['id'] ) {
					$attr['id'] = $this->args['id'];
				}

				return $attr;
			}

			/**
			 * Builds the attributes array for the masonry image wrapper.
			 *
			 * @access public
			 * @since 1.2
			 * @return array
			 */
			public function masonry_wrapper_attr() {
				$attr = array(
					'style' => '',
					'class' => 'fusion-masonry-element-container',
				);

				if ( isset( $this->image_data['url'] ) ) {
					$attr['style'] .= 'background-image:url(' . $this->image_data['url'] . ');';
				}

				if ( isset( $this->image_data['element_base_padding'] ) ) {

					// If portrait it requires more spacing.
					$column_offset = ' - ' . $this->args['column_spacing'];
					if ( false !== strpos( $this->image_data['orientation_class'], 'fusion-element-portrait' ) ) {
						$column_offset = '';
					}

					$column_spacing = 2 * (int) $this->args['column_spacing'] . 'px';

					// Calculate the correct size of the image wrapper container, based on orientation and column spacing.
					$attr['style'] .= 'padding-top:calc((100% + ' . $column_spacing . ') * ' . $this->image_data['element_base_padding'] . $column_offset . ');';
				}

				return $attr;
			}

			/**
			 * Builds the attributes array.
			 *
			 * @access public
			 * @since 1.2
			 * @return array
			 */
			public function image_attr() {
				global $fusion_library;

				$columns = 12 / $this->num_of_columns;

				$attr = array(
					'style' => '',
					'class' => 'fusion-grid-column',
				);
				$attr['class'] .= ' fusion-gallery-column fusion-gallery-column-' . $this->num_of_columns;

				if ( 'liftup' !== $this->args['hover_type'] ) {
					$attr['class'] .= ' hover-type-' . $this->args['hover_type'];
				}

				if ( isset( $this->image_data['orientation_class'] ) ) {
					$attr['class'] .= ' ' . $this->image_data['orientation_class'];
				}

				if ( '' !== $this->args['column_spacing'] && ! ( isset( $this->args['grid_sizer'] ) && $this->args['grid_sizer'] ) ) {
					$attr['style'] = 'padding:' . $this->args['column_spacing'] . ';';
				}

				if ( isset( $this->args['grid_sizer'] ) && $this->args['grid_sizer'] ) {
					$this->args['grid_sizer'] = false;
					$attr['class'] .= ' fusion-grid-sizer';
				}

				return $attr;
			}

			/**
			 * Builds the link attributes array.
			 *
			 * @access public
			 * @since 1.0
			 * @return array
			 */
			public function link_attr() {

				$attr = array();

				$attr['href']  = $this->args['pic_link'];
				$attr['class'] = 'fusion-lightbox';

				$attr['data-rel'] = 'iLightbox[' . substr( md5( $this->args['image_ids'] ), 13 ) . ']';

				if ( $this->image_data ) {
					if ( false !== strpos( $this->args['lightbox_content'], 'title' ) ) {
						$attr['data-title']   = $this->image_data['title'];
						$attr['title']        = $this->image_data['title'];
					}

					if ( false !== strpos( $this->args['lightbox_content'], 'caption' ) ) {
						$attr['data-caption'] = $this->image_data['caption'];
					}
				}

				return $attr;

			}

			/**
			 * Sets the necessary scripts.
			 *
			 * @access public
			 * @since 1.1
			 * @return void
			 */
			public function add_scripts() {
				Fusion_Dynamic_JS::enqueue_script(
					'fusion-gallery',
					FusionBuilder::$js_folder_url . '/general/fusion-gallery.js',
					FusionBuilder::$js_folder_path . '/general/fusion-gallery.js',
					array( 'jquery', 'fusion-animations', 'packery', 'isotope', 'fusion-lightbox', 'images-loaded' ),
					'1',
					true
				);
			}

			/**
			 * Adds settings to element options panel.
			 *
			 * @access public
			 * @since 1.1.6
			 * @return array $sections Button settings.
			 */
			public function add_options() {

				return array(
					'gallery_shortcode_section' => array(
						'label'       => esc_html__( 'Gallery Element', 'fusion-builder' ),
						'id'          => 'gallery_shortcode_section',
						'type'        => 'accordion',
						'fields'      => array(
							'gallery_picture_size' => array(
								'type'        => 'radio-buttonset',
								'label'       => esc_attr__( 'Picture Size', 'fusion-builder' ),
								'description' => __( 'Fixed = width and height will be fixed<br/>Auto = width and height will adjust to the image.', 'fusion-builder' ),
								'id'          => 'gallery_picture_size',
								'choices'     => array(
									'fixed'  => esc_attr__( 'Fixed', 'fusion-builder' ),
									'auto'   => esc_attr__( 'Auto', 'fusion-builder' ),
								),
								'default'     => 'auto',
							),
							'gallery_layout' => array(
								'type'        => 'radio-buttonset',
								'label'       => esc_attr__( 'Gallery Layout', 'fusion-builder' ),
								'description' => __( 'Select the gallery layout type.', 'fusion-builder' ),
								'id'          => 'gallery_layout',
								'choices'     => array(
									'grid' => esc_attr__( 'Grid', 'fusion-builder' ),
									'masonry'       => esc_attr__( 'Masonry', 'fusion-builder' ),
								),
								'default'     => 'grid',
							),
							'gallery_columns' => array(
								'type'        => 'slider',
								'label'       => esc_attr__( 'Number of Columns', 'fusion-builder' ),
								'description' => __( 'Set the number of columns per row. <strong>IMPORTANT:</strong> Masonry layout does not work with 1 column.', 'fusion-builder' ),
								'id'          => 'gallery_columns',
								'default'     => 3,
								'min'         => 1,
								'max'         => 6,
								'step'        => 1,
							),
							'gallery_column_spacing' => array(
								'label'       => esc_attr__( 'Column Spacing', 'fusion-builder' ),
								'description' => esc_attr__( 'Controls the column spacing for gallery images.', 'fusion-builder' ),
								'id'          => 'gallery_column_spacing',
								'default'     => '10',
								'type'        => 'slider',
								'choices'     => array(
									'min'  => '0',
									'max'  => '300',
									'step' => '1',
								),
							),
							'gallery_hover_type' => array(
								'type'        => 'select',
								'label'       => esc_attr__( 'Hover Type', 'fusion-builder' ),
								'description' => esc_attr__( 'Select the hover effect type.', 'fusion-builder' ),
								'id'          => 'gallery_hover_type',
								'choices'       => array(
									''        => esc_attr__( 'Default', 'fusion-builder' ),
									'none'    => esc_attr__( 'None', 'fusion-builder' ),
									'zoomin'  => esc_attr__( 'Zoom In', 'fusion-builder' ),
									'zoomout' => esc_attr__( 'Zoom Out', 'fusion-builder' ),
									'liftup'  => esc_attr__( 'Lift Up', 'fusion-builder' ),
								),
								'default'     => 'none',
							),
							'gallery_lightbox_content' => array(
								'type'    => 'radio-buttonset',
								'label'   => esc_attr__( 'Lightbox Content', 'fusion-builder' ),
								'id'      => 'gallery_lightbox_content',
								'default' => 'none',
								'choices' => array(
									'none'              => esc_attr__( 'None', 'fusion-builder' ),
									'titles'            => esc_attr__( 'Titles', 'fusion-builder' ),
									'captions'          => esc_attr__( 'Captions', 'fusion-builder' ),
									'title_and_caption' => esc_attr__( 'Titles & Captions', 'fusion-builder' ),
								),
								'description' => esc_attr__( 'Choose if titles and captions will display in the lightbox.', 'fusion-builder' ),
							),
							'gallery_border_size' => array(
								'label'       => esc_html__( 'Gallery Image Border Size', 'fusion-builder' ),
								'description' => esc_html__( 'Controls the border size of the image.', 'fusion-builder' ),
								'id'          => 'gallery_border_size',
								'default'     => '0',
								'type'        => 'slider',
								'choices'     => array(
									'min'  => '0',
									'max'  => '50',
									'step' => '1',
								),
							),
							'gallery_border_color' => array(
								'label'       => esc_html__( 'Gallery Image Border Color', 'fusion-builder' ),
								'description' => esc_html__( 'Controls the border color of the image.', 'fusion-builder' ),
								'id'          => 'gallery_border_color',
								'default'     => '#f6f6f6',
								'type'        => 'color-alpha',
							),
							'gallery_border_radius' => array(
								'label'       => esc_html__( 'Gallery Image Border Radius', 'fusion-builder' ),
								'description' => esc_html__( 'Controls the border radius of the gallery images.', 'fusion-builder' ),
								'id'          => 'gallery_border_radius',
								'default'     => '0px',
								'type'        => 'dimension',
								'choices'     => array( 'px', '%' ),
							),
						),
					),
				);
			}

			/**
			 * Builds the dynamic styling.
			 *
			 * @access public
			 * @since 3.1
			 * @return array
			 */
			public function add_styling() {

				global $wp_version, $content_media_query, $six_fourty_media_query, $three_twenty_six_fourty_media_query, $ipad_portrait_media_query, $fusion_settings, $dynamic_css_helpers, $fusion_library;

				$css['global']['.fusion-filters .fusion-filter.fusion-active a']['color'] = $fusion_library->sanitize->color( $fusion_settings->get( 'primary_color' ) );
				$css['global']['.fusion-filters .fusion-filter.fusion-active a']['border-color'] = $fusion_library->sanitize->color( $fusion_settings->get( 'primary_color' ) );

				$css[ $content_media_query ]['.fusion-filters']['border-bottom'] = '0';
				$css[ $content_media_query ]['.fusion-filter']['float']          = 'none';
				$css[ $content_media_query ]['.fusion-filter']['margin']         = '0';
				$css[ $content_media_query ]['.fusion-filter']['border-bottom']  = '1px solid #E7E6E6';

				return $css;
			}
		}
	}

	new FusionSC_FusionGallery();

}

/**
 * Map shortcode to Fusion Builder.
 *
 * @since 1.0
 */
function fusion_element_gallery() {
	global $fusion_settings;

	fusion_builder_map(
		array(
			'name'            => esc_attr__( 'Gallery', 'fusion-builder' ),
			'shortcode'       => 'fusion_gallery',
			'icon'            => 'fusiona-dashboard',
			'preview'         => FUSION_BUILDER_PLUGIN_DIR . 'inc/templates/previews/fusion-gallery-preview.php',
			'preview_id'      => 'fusion-builder-block-module-gallery-preview-template',
			'allow_generator' => true,
			'params'          => array(
				array(
					'type'        => 'upload_images',
					'heading'     => esc_attr__( 'Gallery Images', 'fusion-builder' ),
					'description' => esc_attr__( 'Upload or select images from media library.', 'fusion-builder' ),
					'param_name'  => 'image_ids',
					'element'     => 'fusion_gallery',
					'value'       => '',
				),
				array(
					'type'        => 'radio_button_set',
					'heading'     => esc_attr__( 'Gallery Layout', 'fusion-builder' ),
					'description' => __( 'Select the gallery layout type.', 'fusion-builder' ),
					'param_name'  => 'layout',
					'value'       => array(
						''        => esc_attr__( 'Default', 'fusion-builder' ),
						'grid'    => esc_attr__( 'Grid', 'fusion-builder' ),
						'masonry' => esc_attr__( 'Masonry', 'fusion-builder' ),
					),
					'default'     => '',
				),
				array(
					'type'        => 'radio_button_set',
					'heading'     => esc_attr__( 'Picture Size', 'fusion-builder' ),
					'description' => __( 'Fixed = width and height will be fixed.<br/>Auto = width and height will adjust to the image.<br/>', 'fusion-builder' ),
					'param_name'  => 'picture_size',
					'value'       => array(
						''       => esc_attr__( 'Default', 'fusion-builder' ),
						'fixed'  => esc_attr__( 'Fixed', 'fusion-builder' ),
						'auto'   => esc_attr__( 'Auto', 'fusion-builder' ),
					),
					'dependency'  => array(
						array(
							'element'  => 'layout',
							'value'    => 'masonry',
							'operator' => '!=',
						),
					),
					'default'     => '',
				),
				array(
					'type'        => 'range',
					'heading'     => esc_attr__( 'Number of Columns', 'fusion-builder' ),
					'description' => __( 'Set the number of columns per row. <strong>IMPORTANT:</strong> Masonry layout does not work with 1 column.', 'fusion-builder' ),
					'param_name'  => 'columns',
					'value'       => '',
					'min'         => '1',
					'max'         => '6',
					'step'        => '1',
					'default'     => $fusion_settings->get( 'gallery_columns' ),
				),
				array(
					'type'        => 'range',
					'heading'     => esc_attr__( 'Column Spacing', 'fusion-builder' ),
					'description' => esc_attr__( 'Controls the column spacing for gallery images.', 'fusion-builder' ),
					'param_name'  => 'column_spacing',
					'value'       => '10',
					'min'         => '0',
					'max'         => '300',
					'step'        => '1',
					'default'     => $fusion_settings->get( 'gallery_column_spacing' ),
					'dependency'  => array(
						array(
							'element'  => 'columns',
							'value'    => '1',
							'operator' => '!=',
						),
					),
				),
				array(
					'type'        => 'range',
					'heading'     => esc_attr__( 'Masonry Image Aspect Ratio', 'fusion-builder' ),
					'description' => __( 'Set the ratio to decide when an image should become landscape (ratio being width : height) and portrait (ratio being height : width). <strong>IMPORTANT:</strong> The value of "1.0" represents a special case, which will use the auto calculated ratios like in versions prior to Avada 5.5.', 'fusion-builder' ),
					'param_name'  => 'gallery_masonry_grid_ratio',
					'value'       => '',
					'min'         => '1',
					'max'         => '4',
					'step'        => '0.1',
					'default'     => $fusion_settings->get( 'masonry_grid_ratio' ),
					'dependency'  => array(
						array(
							'element'  => 'layout',
							'value'    => 'masonry',
							'operator' => '==',
						),
					),
				),
				array(
					'type'        => 'range',
					'heading'     => esc_attr__( 'Masonry 2x2 Width', 'fusion-builder' ),
					'description' => __( 'This option decides when a square 1x1 image should become 2x2. This will not apply to images that highly favor landscape or portrait layouts. <strong>IMPORTANT:</strong> There is a ???Masonry Image Layout??? setting for every image in the WP media library that allows you to manually set how an image will appear (1x1, landscape, portrait or 2x2), regardless of the original ratio. In pixels.', 'fusion-builder' ),
					'param_name'  => 'gallery_masonry_width_double',
					'value'       => '',
					'min'         => '200',
					'max'         => '5120',
					'step'        => '1',
					'default'     => $fusion_settings->get( 'masonry_width_double' ),
					'dependency'  => array(
						array(
							'element'  => 'layout',
							'value'    => 'masonry',
							'operator' => '==',
						),
					),
				),
				array(
					'type'        => 'radio_button_set',
					'heading'     => esc_attr__( 'Hover Type', 'fusion-builder' ),
					'description' => esc_attr__( 'Select the hover effect type.', 'fusion-builder' ),
					'param_name'  => 'hover_type',
					'value'       => array(
						''    => esc_attr__( 'Default', 'fusion-builder' ),
						'none'    => esc_attr__( 'None', 'fusion-builder' ),
						'zoomin'  => esc_attr__( 'Zoom In', 'fusion-builder' ),
						'zoomout' => esc_attr__( 'Zoom Out', 'fusion-builder' ),
						'liftup'  => esc_attr__( 'Lift Up', 'fusion-builder' ),
					),
					'default'     => '',
				),
				array(
					'type'        => 'radio_button_set',
					'heading'     => esc_attr__( 'Image lightbox', 'fusion-builder' ),
					'description' => esc_attr__( 'Show image in lightbox. Lightbox must be enabled in Theme Options or the image will open up in the same tab by itself.', 'fusion-builder' ),
					'param_name'  => 'lightbox',
					'value'       => array(
						'yes' => esc_attr__( 'Yes', 'fusion-builder' ),
						'no'  => esc_attr__( 'No', 'fusion-builder' ),
					),
					'default'     => $fusion_settings->get( 'status_lightbox' ) ? 'yes' : 'no',
				),
				array(
					'type'        => 'radio_button_set',
					'heading'     => esc_attr__( 'Lightbox Content', 'fusion-builder' ),
					'param_name'  => 'lightbox_content',
					'default'     => '',
					'value'       => array(
						''                  => esc_attr__( 'Default', 'fusion-builder' ),
						'none'              => esc_attr__( 'None', 'fusion-builder' ),
						'titles'            => esc_attr__( 'Titles', 'fusion-builder' ),
						'captions'          => esc_attr__( 'Captions', 'fusion-builder' ),
						'title_and_caption' => esc_attr__( 'Titles and Captions', 'fusion-builder' ),
					),
					'description' => esc_attr__( 'Choose if titles and captions will display in the lightbox.', 'fusion-builder' ),
					'dependency'  => array(
						array(
							'element'  => 'lightbox',
							'value'    => 'no',
							'operator' => '!=',
						),
					),
				),
				array(
					'type'        => 'range',
					'heading'     => esc_attr__( 'Gallery Image Border Size', 'fusion-builder' ),
					'description' => esc_attr__( 'In pixels.', 'fusion-builder' ),
					'param_name'  => 'bordersize',
					'value'       => '',
					'min'         => '0',
					'max'         => '50',
					'step'        => '1',
					'default'     => $fusion_settings->get( 'gallery_border_size' ),
				),
				array(
					'type'        => 'colorpickeralpha',
					'heading'     => esc_attr__( 'Gallery Image Border Color', 'fusion-builder' ),
					'description' => esc_attr__( 'Choose the border color. ', 'fusion-builder' ),
					'param_name'  => 'bordercolor',
					'value'       => '',
					'default'     => $fusion_settings->get( 'gallery_border_color' ),
					'dependency'  => array(
						array(
							'element'  => 'bordersize',
							'value'    => '0',
							'operator' => '!=',
						),
					),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_attr__( 'Gallery Image Border Radius', 'fusion-builder' ),
					'description' => esc_attr__( 'Controls the gallery image border radius. In pixels (px), ex: 1px, or "round". ', 'fusion-builder' ),
					'param_name'  => 'border_radius',
					'value'       => '',
					'dependency'  => array(
						array(
							'element'  => 'bordersize',
							'value'    => '0',
							'operator' => '!=',
						),
					),
				),
				array(
					'type'        => 'checkbox_button_set',
					'heading'     => esc_attr__( 'Element Visibility', 'fusion-builder' ),
					'param_name'  => 'hide_on_mobile',
					'value'       => fusion_builder_visibility_options( 'full' ),
					'default'     => fusion_builder_default_visibility( 'array' ),
					'description' => esc_attr__( 'Choose to show or hide the element on small, medium or large screens. You can choose more than one at a time.', 'fusion-builder' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_attr__( 'CSS Class', 'fusion-builder' ),
					'description' => esc_attr__( 'Add a class to the wrapping HTML element.', 'fusion-builder' ),
					'param_name'  => 'class',
					'value'       => '',
					'group'       => esc_attr__( 'General', 'fusion-builder' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_attr__( 'CSS ID', 'fusion-builder' ),
					'description' => esc_attr__( 'Add an ID to the wrapping HTML element.', 'fusion-builder' ),
					'param_name'  => 'id',
					'value'       => '',
					'group'       => esc_attr__( 'General', 'fusion-builder' ),
				),
			),
		)
	);
}
add_action( 'fusion_builder_before_init', 'fusion_element_gallery' );
