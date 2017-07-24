<?php
/**
 * Created by G5Theme.
 * User: trungpq
 * Date: 7/15/2017
 * Time: 11:20 PM
 * @var $css_class_field
 * @var $request_status
 */
?>
<div class="<?php echo esc_attr($css_class_field); ?> form-group">
    <select name="status" title="<?php esc_html_e('Property Status', 'essential-real-estate') ?>"
            class="search-field form-control" data-default-value="">
        <?php ere_get_taxonomy_slug('property-status', $request_status); ?>
    </select>
</div>