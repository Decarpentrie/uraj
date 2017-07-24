<?php
/**
 * Created by G5Theme.
 * User: trungpq
 * Date: 7/15/2017
 * Time: 11:20 PM
 * @var $css_class_field
 * @var $request_features_search
 * @var $request_features
 */
?>
<div class="col-md-12 col-sm-12 col-xs-12 other-features-wrap clearfix">
    <div class="enable-other-features">
        <?php if (!empty($request_features_search) && $request_features_search == '1') {
            $class_other_features = 'show';
        } else {
            $class_other_features = '';
        } ?>
        <a href="javascript:;" class="btn-other-features <?php echo esc_attr($class_other_features);?>">
            <i class="fa fa-chevron-down"></i><?php esc_html_e('Other Features','essential-real-estate');?>
        </a>
        <input type="hidden" name="features-search" class="search-field" data-default-value="0"
               value="<?php if (!empty($request_features_search) && $request_features_search == '1') {
                   echo esc_attr('1');
               } else {
                   echo esc_attr('0');
               } ?>">
    </div>
    <?php if (!empty($request_features_search) && $request_features_search == '1') {
        $class_featured_show = 'ere-display-block';
    } else {
        $class_featured_show = '';
    } ?>
    <div class="row other-features-list <?php echo esc_attr($class_featured_show); ?>">
        <?php
        $feature_terms = get_categories(array(
            'hide_empty' => 0,
            'taxonomy'  => 'property-feature'
        ));
        if (!empty($feature_terms)) {
            $count = 1;
            foreach ($feature_terms as $term) {
                echo '<div class="col-md-2 col-sm-6 col-xs-6 col-mb-12"><div class="checkbox"><label>';
                if (!empty($request_features) && in_array($term->slug, $request_features)) {
                    echo '<input type="checkbox" name="other_features" id="feature-' . esc_attr($count) . '" value="' . esc_attr($term->slug) . '" checked/>';
                } else {
                    echo '<input type="checkbox" name="other_features" id="feature-' . esc_attr($count) . '" value="' . esc_attr($term->slug) . '" />';
                }
                echo esc_attr($term->name);
                echo '</label></div></div>';
                $count++;
            }
        }
        ?>
    </div>
</div>