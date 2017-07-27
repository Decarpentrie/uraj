<div>
    <?php the_post_thumbnail(); ?>
    <div class="car-caption">
        <h3>
            <a href="<?php the_permalink(); ?>">
                <?php do_action( 'wcp_carousel_title', $carousel_settings['title'], get_the_id() ); ?>
            </a>
        </h3>
        <p>
            <?php do_action( 'wcp_carousel_desc', $carousel_settings['desc'], get_the_id()); ?>
            <?php if (isset($read_more_txt) && $read_more_txt != '') { ?>
                <br>
                <a href="<?php the_permalink(); ?>" target="<?php echo $read_more_target; ?>" class="<?php echo $read_more_classes; ?>"><?php echo $read_more_txt; ?></a>
            <?php } ?>
        </p>
    </div>
</div>