<?php
/**
 * Created by G5Theme.
 * User: trungpq
 * Date: 7/15/2017
 * Time: 11:20 PM
 * @var $css_class_field
 * @var $request_min_land_area
 * @var $request_max_land_area
 * @var $land_area_is_slider
 */
if ($land_area_is_slider=='true'):
    $min_land_area = ere_get_option('property_land_slider_min',0);
    $max_land_area = ere_get_option('property_land_slider_max',1000);
?>
<div class="<?php echo esc_attr($css_class_field); ?> form-group">
    <?php if (!empty($request_min_land_area) && !empty($request_max_land_area)) {
        $min_land_area_change = $request_min_land_area;
        $max_land_area_change = $request_max_land_area;
    } else {
        $min_land_area_change = $min_land_area;
        $max_land_area_change = $max_land_area;
    } ?>
    <div class="ere-sliderbar-land-area ere-sliderbar-filter"
         data-min-default="<?php echo esc_attr($min_land_area) ?>"
         data-max-default="<?php echo esc_attr($max_land_area) ?>"
         data-min="<?php echo esc_attr($min_land_area_change); ?>"
         data-max="<?php echo esc_attr($max_land_area_change); ?>">
        <div class="title-slider-filter">
            <span><?php esc_html_e('Land Area', 'essential-real-estate') ?> [</span><span
                class="min-value"><?php echo ere_get_format_number($min_land_area_change) ?></span>
            - <span
                class="max-value"><?php echo ere_get_format_number($max_land_area_change) ?></span><span>]
                <?php $measurement_units = ere_get_option('measurement_units', 'SqFt');
                echo esc_html($measurement_units).'</span>'; ?>
                <input type="hidden" name="min-land-area" class="min-input-request"
                       value="<?php echo esc_attr($min_land_area_change) ?>">
                                                <input type="hidden" name="max-land-area" class="max-input-request"
                                                       value="<?php echo esc_attr($max_land_area_change) ?>">
        </div>
        <div class="sidebar-filter">
        </div>
    </div>
</div>
<?php else: ?>
    <div class="<?php echo esc_attr($css_class_field); ?>">
        <div class="row">
            <div class="col-md-6 col-sm-12 form-group">
                <select name="min-land-area" id=min-land-area" title="<?php esc_html_e('Min Land Area Size', 'essential-real-estate') ?>"
                        class="search-field form-control" data-default-value="">
                    <option value="">
                        <?php esc_html_e('Min Land Area', 'essential-real-estate') ?>
                    </option>
                    <?php
                    $property_land_dropdown_min = ere_get_option('property_land_dropdown_min', '0,100,300,500,700,900,1100,1300,1500,1700,1900');
                    $property_land_array = explode(',', $property_land_dropdown_min);
                    if (is_array($property_land_array) && !empty($property_land_array)) {
                        foreach ($property_land_array as $n) {
                            ?>
                            <option
                                value="<?php echo esc_attr($n) ?>" <?php if ($n == $request_min_land_area) {
                                echo esc_attr('selected');
                            } ?>>
                                <?php echo ere_get_format_number($n); ?>
                                <span class="land-measurement-units">
                                <?php echo ere_get_option('measurement_units', 'SqFt');?>
                                </span>
                            </option>
                            <?php
                        }
                    } ?>
                </select>
            </div>
            <div class="col-md-6 col-sm-12 form-group">
                <select name="max-land-area" id="max-land-area" title="<?php esc_html_e('Max Land Area Size', 'essential-real-estate') ?>"
                        class="search-field form-control" data-default-value="">
                    <option value="">
                        <?php esc_html_e('Max Land Area', 'essential-real-estate') ?>
                    </option>
                    <?php
                    $property_land_dropdown_max = ere_get_option('property_land_dropdown_max', '200,400,600,800,1000,1200,1400,1600,1800,2000');
                    $property_land_array = explode(',', $property_land_dropdown_max);
                    if (is_array($property_land_array) && !empty($property_land_array)) {
                        foreach ($property_land_array as $n) {
                            ?>
                            <option
                                value="<?php echo esc_attr($n) ?>" <?php if ($n == $request_max_land_area) {
                                echo esc_attr('selected');
                            } ?>>
                                <?php echo ere_get_format_number($n); ?>
                                <span class="land-measurement-units">
                                <?php echo ere_get_option('measurement_units', 'SqFt');?>
                                </span>
                            </option>
                            <?php
                        }
                    } ?>
                </select>
            </div>
        </div>
    </div>
<?php endif; ?>