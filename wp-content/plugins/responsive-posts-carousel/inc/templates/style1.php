<div class="post-style-1" style="box-shadow: <?php echo $shadow; ?>;background-color: <?php echo $title_bg; ?>;">
    <div class="wcp-img-wrap">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail( 'thumbnail', array('width' => '100%') ); ?>
        </a>
    </div>
    <div class="wcp-content-wrap">
        <h3>
            <a href="<?php the_permalink(); ?>" style="color: <?php echo $title_color; ?>;">
                <?php do_action( 'wcp_carousel_title', $carousel_settings['title'], get_the_id() ); ?>
            </a>
        </h3>
        <span class="wcp-post-meta" style="color: <?php echo (isset($desc_color)) ? $desc_color : ''; ?>;">
            <span class="wcp-post-author"><i class="fa fa-user"></i>
                <?php the_author_posts_link(); ?>
            </span>
            &nbsp;
            <span class="wcp-post-date"><i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?></span>
        </span>        
    </div>
    <p style="clear:both;margin:0;padding:0;"></p>
</div>