<?php
    extract($carousel_settings);
    $data_attr = '';
    if(is_array($slider)){
        foreach ($slider as $p_name => $p_val) {
            $data_attr .= ' data-'.$p_name.' = '.$p_val;
        }
    }


    // Query Arguments
    $args = array(
        'posts_per_page'   => (isset($attrs['count'])) ? $attrs['count'] : -1,
        'ignore_sticky_posts' => true,
        'order' => (isset($attrs['order'])) ? $attrs['order'] : 'DESC',
        'orderby' => (isset($attrs['orderby'])) ? $attrs['orderby'] : 'date',
    );


    if (isset($carousel_settings['display_by']) && $carousel_settings['display_by'] == 'taxonomy') {
        $exclude_ids_arr = explode(",",$carousel_settings['exclude_ids']);
        $args['post__not_in'] = $exclude_ids_arr;
        $args['tax_query'] = array(
            array(
                'taxonomy'         => $carousel_settings['taxonomy'],
                'terms'            => array( $carousel_settings['term'] ),
                'include_children' => true,
            ),
        );
    } else {
        $args['post_type'] = $post_type;
        $args['post__in'] = $posts;
    }

    $car_query = new WP_Query( $args );


    // The Loop
    if ( $car_query->have_posts() ) { ?>
        <section class="wcp-slick" <?php echo $data_attr; ?> id="carousel-<?php echo $attrs['id']; ?>">

            <?php while ( $car_query->have_posts() ) {
                $car_query->the_post(); ?>
                <div class="carousel-item-<?php echo get_the_id(); ?>">
                    <?php switch ($hover_effect) {
                        case 'none':
                            include 'templates/default.php';
                            break;

                        case 'mini post':
                            include 'templates/style1.php';
                            break;

                        case 'post card':
                            include 'templates/style2.php';
                            break;

                        case 'no thumbnails':
                            include 'templates/style3.php';
                            break;
                        
                        default:
                            include 'templates/squares.php';
                            break;
                    } ?>
                </div>    

            <?php } ?>
    
        </section>
        <?php wp_reset_postdata();
    } else {
        echo 'Carousel contents not found!';
    }
?>
<style>
    #carousel-<?php echo $attrs['id']; ?> .slick-prev:before, #carousel-<?php echo $attrs['id']; ?> .slick-next:before {
        color: <?php echo $arrow_color; ?> !important;
    }
    #carousel-<?php echo $attrs['id']; ?> .slick-slide {
        margin: 2px <?php echo $slider['margin']; ?>;
    }
    #carousel-<?php echo $attrs['id']; ?> h3,
    #carousel-<?php echo $attrs['id']; ?> .car-caption,
    #carousel-<?php echo $attrs['id']; ?> .car-caption h3 a {
        background-color: <?php echo $title_bg; ?>;
        color: <?php echo $title_color; ?>;
    }
    #carousel-<?php echo $attrs['id']; ?> .car-caption {
        text-align: center;
    }
    #carousel-<?php echo $attrs['id']; ?> p {
        color: <?php echo (isset($desc_color)) ? $desc_color : ''; ?>;
    }
    #carousel-<?php echo $attrs['id']; ?> a {
        text-decoration: none;
        border-bottom: none;
    }
    #carousel-<?php echo $attrs['id']; ?> .post-style-1 .wcp-post-author a {
        color: <?php echo (isset($desc_color)) ? $desc_color : ''; ?>;
    }
    <?php if (isset($border_width) && $border_width != '') { ?>
        #carousel-<?php echo $attrs['id']; ?> .ih-item,
        #carousel-<?php echo $attrs['id']; ?> .post-style-1,
        #carousel-<?php echo $attrs['id']; ?> .post-style-3,
        #carousel-<?php echo $attrs['id']; ?> .car-caption { 
            border: <?php echo $border_width; ?> solid <?php echo $border_color; ?>;
            box-shadow: <?php echo $shadow; ?>;
        }
    <?php } ?>
    <?php if (isset($border_width) && $border_width != '') { ?>
        #carousel-<?php echo $attrs['id']; ?> .post-style-2 .wcp-content-wrap { 
            border: <?php echo $border_width; ?> solid <?php echo $border_color; ?>;
            border-top: none;
        }
    <?php } ?>
</style>