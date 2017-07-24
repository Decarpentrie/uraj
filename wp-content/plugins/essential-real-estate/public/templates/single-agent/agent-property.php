<?php
/**
 * @var $agent_post_meta_data
 */
global $post;
$agent_post_meta_data = get_post_custom( get_the_ID());
$agent_id = get_the_ID();
$property_of_agent_layout_style = ere_get_option('property_of_agent_layout_style', 'property-grid');
$property_of_agent_items_amount = ere_get_option('property_of_agent_items_amount', 6);
$property_of_agent_image_size = ere_get_option('property_of_agent_image_size', '280x180');
$property_of_agent_show_paging = ere_get_option('property_of_agent_show_paging', array());

$property_of_agent_column_lg = ere_get_option('property_of_agent_column_lg', '3');
$property_of_agent_column_md = ere_get_option('property_of_agent_column_md', '3');
$property_of_agent_column_sm = ere_get_option('property_of_agent_column_sm', '2');
$property_of_agent_column_xs = ere_get_option('property_of_agent_column_xs', '1');
$property_of_agent_column_mb = ere_get_option('property_of_agent_column_mb', '1');

$custom_property_of_agent_columns_gap = ere_get_option('property_of_agent_columns_gap', 'col-gap-30');

if (!is_array($property_of_agent_show_paging)) {
	$property_of_agent_show_paging = array();
}

if (in_array("show_paging_property_of_agent", $property_of_agent_show_paging)) {
	$property_of_agent_show_paging = 'true';
} else {
	$property_of_agent_show_paging = '';
}

$agent_user_id = isset($agent_post_meta_data[ERE_METABOX_PREFIX . 'agent_user_id']) ? $agent_post_meta_data[ERE_METABOX_PREFIX . 'agent_user_id'][0] : '';
$user = get_user_by('id', $agent_user_id);
if (empty($user)) {
	$agent_user_id = 0;
}
$ere_property = new ERE_Property();
$total_property = $ere_property->get_total_properties_by_user($agent_id, $agent_user_id);

$property_agent_shortcode = '[ere_property layout_style = "' . $property_of_agent_layout_style . '"
    item_amount = "' . $property_of_agent_items_amount . '" columns="' . $property_of_agent_column_lg . '"
    items_md="' . $property_of_agent_column_md . '"
    items_sm="' . $property_of_agent_column_sm . '" 
    items_xs="' . $property_of_agent_column_xs . '"
    items_mb="' . $property_of_agent_column_mb . '" 
    image_size = "' . $property_of_agent_image_size . '" 
    columns_gap = "' . $custom_property_of_agent_columns_gap . '" 
    show_paging = "' . $property_of_agent_show_paging . '"
    author_id = "' . $agent_user_id . '"
    agent_id = "' . $agent_id . '"]';
?>
<?php if ($total_property > 0): ?>
	<div class="agent-properties">
		<div class="agent-properties-inner container">
			<div class="ere-heading text-center mg-bottom-60">
				<span></span>

				<p class="uppercase"><?php
					if ($total_property > 1) {
						printf(__('%s properties', 'essential-real-estate'), $total_property);
					} else {
						printf(__('%s property', 'essential-real-estate'), $total_property);
					}
					?></p>

				<h2 class="uppercase"><?php esc_html_e('My properties list', 'essential-real-estate'); ?></h2>
			</div>
			<?php echo do_shortcode($property_agent_shortcode); ?>
		</div>
	</div>
<?php endif; ?>