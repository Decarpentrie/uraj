<div class="post-style-3" style="box-shadow: <?php echo $shadow; ?>;background-color: <?php echo $title_bg; ?>;">
    <div class="wcp-content-wrap">
        <h3>
            <a href="<?php the_permalink(); ?>" style="color: <?php echo $title_color; ?>;">
                <?php do_action( 'wcp_carousel_title', $carousel_settings['title'], get_the_id() ); ?>
            </a>
        </h3>
        <div class="wcp-post-meta" style="color: <?php echo (isset($desc_color)) ? $desc_color : ''; ?>;">
            <span class="wcp-post-author"><i class="fa fa-user"></i>
                <?php the_author_posts_link(); ?>
            </span>
            &nbsp;
            <span class="wcp-post-date"><i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?></span>
        </div>
        <div class="wcp-post-contents">
            <?php do_action( 'wcp_carousel_desc', $carousel_settings['desc'], get_the_id()); ?>
            <?php if (isset($read_more_txt) && $read_more_txt != '') { ?>
                <a style="float:right;margin:10px;" href="<?php the_permalink(); ?>" target="<?php echo $read_more_target; ?>" class="<?php echo $read_more_classes; ?>"><?php echo $read_more_txt; ?>
                </a>
                <p style="clear:both;margin:0;padding:0;"></p>
            <?php } ?>
        </div>        
    </div>
</div>