<?php
/**
 * Created by G5Theme.
 * User: trungpq
 * Date: 7/15/2017
 * Time: 11:20 PM
 * @var $css_class_field
 * @var $request_label
 */
?>
<div class="<?php echo esc_attr($css_class_field); ?> form-group">
    <select name="label" id="label" title="<?php esc_html_e('Property Labels', 'essential-real-estate') ?>"
            class="search-field form-control" data-default-value="">
        <?php ere_get_taxonomy_slug('property-labels', $request_label); ?>
        <option
            value="" <?php if (empty($request_label)) echo esc_attr('selected'); ?>>
            <?php esc_html_e('All Labels', 'essential-real-estate') ?></option>
    </select>
</div>