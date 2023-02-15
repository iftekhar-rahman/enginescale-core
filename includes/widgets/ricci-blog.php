<?php
namespace ricci_core_addon;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Ricci_Blog extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'ricci-blog';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Ricci Blog', 'ricci-core-addon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-code';
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general', 'basic' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	// public function get_keywords() {
	// 	return [ 'oembed', 'url', 'link' ];
	// }

	// Load CSS
	public function get_style_depends() {
		
		wp_register_style( 'common-css', plugins_url( '../assets/css/common.css', __FILE__ ) );

		return [
			'common-css',
		];

	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'ricci-core-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post_count',
			[
				'label' => esc_html__( 'Post Per Page', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 4,
			]
		);

		$this->add_control(
			'post_orderby',
			[
				'label' => esc_html__( 'Post Order By', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'ID'  => esc_html__( 'ID', 'plugin-name' ),
					'date' => esc_html__( 'Date', 'plugin-name' ),
					'comment_count' => esc_html__( 'Comment Count', 'plugin-name' ),
					'author' => esc_html__( 'Author', 'plugin-name' ),
					'title' => esc_html__( 'Title', 'plugin-name' ),
					'rand' => esc_html__( 'Rand', 'plugin-name' ),
				],
			]
		);

		$this->add_control(
			'post_order',
			[
				'label' => esc_html__( 'Post Order', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'ASC'  => esc_html__( 'Ascending', 'plugin-name' ),
					'DESC' => esc_html__( 'Descending', 'plugin-name' ),
				],
			]
		);

		$this->add_control(
			'title_word_limit',
			[
				'label' => esc_html__( 'Title Word Limit', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);

		$this->add_control(
			'content_limit',
			[
				'label' => esc_html__( 'Content Limit', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);


		$this->end_controls_section();

		// section_style
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'ricci-core-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		

		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$content_limit = $settings['content_limit'];
		$title_word_limit = $settings['title_word_limit'];
	?>
	<div class="ricci-blog-section">
	<?php

		// The Query
		$args = array(
			'post_type' => 'post',
			'posts_per_page'      => $settings['post_count'],
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'orderby' => $settings['post_orderby'],
			'order'   =>  $settings['post_order'],
			'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
		);

		$the_query = new \WP_Query( $args );
		// The Loop
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				
				?>
				<article id="post-<?php the_ID();?>" <?php post_class( 'single-item' );?>>
					<?php if( has_post_thumbnail(  ) ): ?>
					<a href="<?php the_permalink(  ); ?>" class="d-block blog-thumb-wrap">
						<div class="blog-thumb" style="background-image: url(<?php  the_post_thumbnail_url('full'); ?>);"></div>
					</a>
					<?php endif; ?>
					<div class="blog-content">
						<div class="blog-meta">
							<span><?php echo get_the_author(); ?></span> <span><?php echo get_the_date(); ?></span>
						</div>
						<a href="<?php the_permalink(  ); ?>" class="d-block">
							<h2><?php echo wp_trim_words( get_the_title(), $title_word_limit, '' ); ?></h2>
							<img src="<?php echo esc_attr__( 'https://ricciorthodonticstudio.com/wp-content/uploads/2023/01/arrowIcon.png', 'hello-elementor' ) ?>" alt="">
						</a>
						<p><?php echo wp_trim_words( get_the_content(), $content_limit, '...' ); ?></p>
						
					</div>
				</article>
				<?php
			}
		}
		wp_reset_postdata();
	?>
	</div>

	<!-- Pagination -->
	<?php
		echo "<div class='page-nav-container'>" . paginate_links(array(
			'total' => $the_query->max_num_pages,
			'prev_text' => __('Prev'),
			'next_text' => __('Next')
		)) . "</div>";
	?>

	<?php

	}

}