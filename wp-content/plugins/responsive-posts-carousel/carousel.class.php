<?php
/**
* Main Class for Responsive Posts Carousel
*/
class WCP_Responsive_Posts_Carousel
{
	
	function __construct()
	{
		add_action( 'init', array($this, 'register_carousels') );
		add_action( 'add_meta_boxes', array($this, 'carousel_metaboxes' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array($this, 'admin_scripts' ) );
		add_shortcode( 'wcp-carousel', array($this, 'render_shortcode') );
		add_action( 'wp_ajax_wcp_get_posts', array($this, 'wcp_get_posts') );
		add_action( 'save_post', array($this, 'save_carousel' ) );

		add_action( 'wcp_carousel_title', array($this, 'render_carousel_title' ), 10, 2 );
		add_action( 'wcp_carousel_desc', array($this, 'render_carousel_desc' ), 10, 2 );
	}

	/**
	 * Register a carousels post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	function register_carousels() {
		$labels = array(
			'name'               => _x( 'Carousels', 'Carousel', 'wcp-carousel' ),
			'singular_name'      => _x( 'Carousel', 'Carousel', 'wcp-carousel' ),
			'menu_name'          => _x( 'Carousels', 'admin menu', 'wcp-carousel' ),
			'name_admin_bar'     => _x( 'Carousel', 'Carousels', 'wcp-carousel' ),
			'add_new'            => _x( 'Add New', 'Carousel', 'wcp-carousel' ),
			'add_new_item'       => __( 'Add New Carousel', 'wcp-carousel' ),
			'new_item'           => __( 'New Carousel', 'wcp-carousel' ),
			'edit_item'          => __( 'Edit Carousel', 'wcp-carousel' ),
			'view_item'          => __( 'View Carousel', 'wcp-carousel' ),
			'all_items'          => __( 'All Carousels', 'wcp-carousel' ),
			'search_items'       => __( 'Search Carousels', 'wcp-carousel' ),
			'parent_item_colon'  => __( 'Parent Carousels:', 'wcp-carousel' ),
			'not_found'          => __( 'No Carousel found.', 'wcp-carousel' ),
			'not_found_in_trash' => __( 'No Carousel found in Trash.', 'wcp-carousel' )
		);

		$args = array(
			'labels'             => $labels,
	        'description'        => __( 'Create Posts Carousels.', 'wcp-carousel' ),
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'menu_icon'       	 => 'dashicons-editor-insertmore',
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'supports'           => array( 'title' )
		);

		register_post_type( 'wcp_carousel', $args );
	}

	function carousel_metaboxes( $post_type, $post ) {
	    add_meta_box( 'wcp-contents', 'Slider Contents', array($this, 'render_contents_box'), 'wcp_carousel', 'normal');
	    add_meta_box( 'wcp-settings', 'Slider Settings', array($this, 'render_settings_box'), 'wcp_carousel', 'normal');
	    add_meta_box( 'wcp-advanced', 'Advanced Settings', array($this, 'render_adv_box'), 'wcp_carousel', 'normal');
	    add_meta_box( 'wcp-shortcode', 'Shortcode', array($this, 'render_sc_box'), 'wcp_carousel', 'side');
	    add_meta_box( 'wcp-help', 'Need Help?', array($this, 'render_help_box'), 'wcp_carousel', 'side');
	}

	function render_sc_box($carousel){
		if (isset($carousel->ID)) { ?>
			<p style="text-align:center;">
				<b>Default Shortcode</b><br>
				[wcp-carousel id="<?php echo $carousel->ID; ?>"]
			</p>
			<hr>
			<p style="text-align:center;">
				<b>Display 10 Latest Posted</b><br>
				[wcp-carousel id="<?php echo $carousel->ID; ?>" order="DESC" orderby="date" count="10"] <br>
			</p>
			<hr>
			<p style="text-align:center;">
				<b>Order by Ascending Titles</b><br>
				[wcp-carousel id="<?php echo $carousel->ID; ?>" order="ASC" orderby="title"] <br>
			</p>
		<?php }
	}

	function render_help_box(){
		?>
			<p>Contact <a target="_blank" href="https://webcodingplace.com/contact-us">here</a> for help.</p>
		<?php
	}

	function render_contents_box(){
		include 'inc/slider-contents.php';
	}


	function render_adv_box(){
		include 'inc/slider-advanced.php';
	}

	function render_settings_box(){
		include 'inc/slider-settings.php';
		wp_nonce_field( plugin_basename( __FILE__ ), 'wcp_carousel_nonce' );
	}

	function render_shortcode($attrs){
		if (isset($attrs['id']) && $attrs['id'] != '') {
			wp_enqueue_style( 'font-awesome', plugin_dir_url( __FILE__ ).'/css/css/font-awesome.min.css' );
			wp_enqueue_style( 'slick-css', plugin_dir_url( __FILE__ ).'/assets/slick.css' );
			wp_enqueue_style( 'slick-theme-css', plugin_dir_url( __FILE__ ).'/assets/slick-theme.css' );
			wp_enqueue_style( 'ihover-css', plugin_dir_url( __FILE__ ).'/assets/ihover.min.css' );
			wp_enqueue_script( 'slick-js', plugin_dir_url( __FILE__ ).'/assets/slick.min.js', array('jquery') );
			wp_enqueue_script( 'custom-crsl-js', plugin_dir_url( __FILE__ ).'/assets/custom.js', array('jquery') );
			$carousel_settings = get_post_meta( $attrs['id'], 'carousel_meta', true );
			ob_start();
			include 'inc/render.php';
			return ob_get_clean();
		}
	}

	function admin_scripts($slug){
		global $post;
        if ( $slug == 'post-new.php' || $slug == 'post.php') {
            if (isset($post->post_type) && 'wcp_carousel' === $post->post_type) {
            	wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_style( 'select2-css', plugin_dir_url( __FILE__ ).'/css/select2.min.css' );
				wp_enqueue_style( 'wcp-admin-css', plugin_dir_url( __FILE__ ).'/css/admin.css' );
				wp_enqueue_script( 'select2-js', plugin_dir_url( __FILE__ ).'/js/select2.min.js', array('jquery') );
				wp_enqueue_script( 'carousel-admin', plugin_dir_url( __FILE__ ).'/js/admin.js', array('jquery', 'wp-color-picker') );
            }
        }		
	}

	function wcp_get_posts(){
		// print_r($_REQUEST);
		extract($_REQUEST);
		$all_posts = get_posts( array('post_type' => $post_type, 'posts_per_page' => -1 ) );
		foreach ($all_posts as $key => $post_obj) {
			echo '<option value="'.$post_obj->ID.'">'.$post_obj->post_title.'</option>';
		}
		// var_dump($all_posts);
		die(0);
	}

	function save_carousel($post_id){
        // verify if this is an auto save routine. 
        // If it is our form has not been submitted, so we dont want to do anything
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
            return;

        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if ( !isset( $_POST['wcp_carousel_nonce'] ) )
            return;

        if ( !wp_verify_nonce( $_POST['wcp_carousel_nonce'], plugin_basename( __FILE__ ) ) )
            return;

        // OK, we're authenticated: we need to find and save the data

        if (isset($_POST['car']) && $_POST['car'] != '') {
            update_post_meta( $post_id, 'carousel_meta', $_POST['car'] );
        }		
	}

	function render_carousel_title($title, $post_id){
		if ($title == 'post_title' || $title == '') {
		   the_title();
		} else {
		    echo get_post_meta( $post_id, $title, true );
		}		
	}

	function render_carousel_desc($desc, $post_id){
        switch ($desc) {
            case 'post_date':
                echo get_the_date();
                break;
            case 'content':
                the_content();
                break;
            case 'excerpt':
                the_excerpt();
                break;
            case 'none':
                break;
            
            default:
                echo get_post_meta( $post_id, $desc, true );
                break;
        }
	}

    function get_ihover_effects(){
        $hoverEffects = array(
            'mini post',
            'post card',
            'no thumbnails',
            'none',
            'square effect1 left_and_right',
            'square effect1 top_to_bottom',
            'square effect1 bottom_to_top',
            'square effect2',
            'square effect3 bottom_to_top',
            'square effect3 top_to_bottom',
            'square effect4',
            'square effect5 left_to_right',
            'square effect5 right_to_left',
            'square effect6 from_top_and_bottom',
            'square effect6 from_left_and_right',
            'square effect6 top_to_bottom',
            'square effect6 bottom_to_top',
            'square effect7',
            'square effect8 scale_up',
            'square effect8 scale_down',
            'square effect9 bottom_to_top',
            'square effect9 left_to_right',
            'square effect9 right_to_left',
            'square effect9 top_to_bottom',
            'square effect10 left_to_right',
            'square effect10 right_to_left',
            'square effect10 top_to_bottom',
            'square effect10 bottom_to_top',
            'square effect11 left_to_right',
            'square effect11 right_to_left',
            'square effect11 top_to_bottom',
            'square effect11 bottom_to_top',
            'square effect12 left_to_right',
            'square effect12 right_to_left',
            'square effect12 top_to_bottom',
            'square effect12 bottom_to_top',
            'square effect13 left_to_right',
            'square effect13 right_to_left',
            'square effect13 top_to_bottom',
            'square effect13 bottom_to_top',
            'square effect14 left_to_right',
            'square effect14 right_to_left',
            'square effect14 top_to_bottom',
            'square effect14 bottom_to_top',
            'square effect15 left_to_right',
            'square effect15 right_to_left',
            'square effect15 top_to_bottom',
            'square effect15 bottom_to_top',
        );

        return $hoverEffects;
    }	

}
?>