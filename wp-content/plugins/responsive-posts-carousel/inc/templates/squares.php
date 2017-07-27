<div class="ih-item <?php echo $hover_effect; ?>">
    <a href="<?php the_permalink(); ?>" target="<?php echo (isset($read_more_target)) ? $read_more_target : '' ; ?>">
        <div class="img">
            <?php the_post_thumbnail(); ?>
        </div>
        <div class="info">
            <h3>
                <?php do_action( 'wcp_carousel_title', $carousel_settings['title'], get_the_id() ); ?>
            </h3>
            <p>
                <?php do_action( 'wcp_carousel_desc', $carousel_settings['desc'], get_the_id()); ?>
            </p>
        </div>
    </a>
</div>