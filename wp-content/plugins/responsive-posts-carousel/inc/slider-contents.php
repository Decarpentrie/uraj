<?php
	global $post;
	$saved_meta = get_post_meta( $post->ID, 'carousel_meta', true );
	$selected_post_ids = (isset($saved_meta['posts'])) ? $saved_meta['posts'] : '' ;
	$ihover_selected = (isset($saved_meta['hover_effect'])) ? $saved_meta['hover_effect'] : '' ;
?>
<table class="wp-list-table widefat fixed striped posts">
	<tr>
		<td>Display By</td>
		<td>
			<select name="car[display_by]" class="widefat select-list-by">
				<option value="" <?php echo (isset($saved_meta['display_by']) && $saved_meta['display_by'] == '') ? 'selected' : '' ; ?>>By Post Type</option>
				<option value="taxonomy" <?php echo (isset($saved_meta['display_by']) && $saved_meta['display_by'] == 'taxonomy') ? 'selected' : '' ; ?>>By Taxonomy</option>
			</select>
		</td>
		<td>
			<p class="description">Select how you want to choose posts</p>
		</td>
	</tr>
	<tr class="tax-list-row if-by-tax">
		<td><?php _e( 'Select Taxonomy', 'wcp-carousel' ); ?></td>
		<td>
		<select class="wcp-taxonomy widefat" name="car[taxonomy]"> 
		 <option value=""><?php echo esc_attr(__('Select Taxonomy')); ?></option> 
		 <?php 
		  $taxonomies = get_taxonomies(array('public'   => true));
		  foreach ($taxonomies as $tax) { 
		  	$selected = (isset($saved_meta['taxonomy']) && $saved_meta['taxonomy'] == $tax) ? 'selected' : '' ;
		  	$option = '<option value="'.$tax.'" '.$selected.'>';
			$option .= $tax;
			$option .= '</option>';
			echo $option;
		  }
		 ?>
		</select>		  						
		</td>
		<td>
			<p class="description"><?php _e( 'Select Taxonomy', 'wcp-carousel' ); ?>.</p>
		</td>
	</tr>
	<tr class="if-by-tax">
		<td><?php _e( 'Select Term', 'wcp-carousel' ); ?></td>
		<td class="append-terms">
			<?php
				if (isset($saved_meta['taxonomy']) && $saved_meta['taxonomy'] != '') {
					$terms = get_terms( $saved_meta['taxonomy'] );
					if (empty($terms)) {
						echo __( 'Sorry! this Taxonomy has no Terms.', 'wcp-carousel' );
					} else {
						echo '<select class="wcp-term widefat" name="car[term]">';
						foreach ($terms as $key => $value) {
							$selected = (isset($saved_meta['term']) && $saved_meta['term'] == $value->term_id) ? 'selected' : '' ;
							echo '<option value="'.$value->term_id.'" '.$selected.'>'.$value->name.'('.$value->count.')</option>';
						}
						echo '</select>';			
					}					
				} else { ?>
					<p class="description"><?php _e( 'Please select any taxonomy first', 'wcp-carousel' ); ?>.</p>
				<?php }
			?>
		</td>
		<td>
			<p class="description"><?php _e( 'Select Term which posts will be shown in Carousel', 'wcp-carousel' ); ?>.</p>
		</td>
	</tr>
	<tr class="if-by-tax">
		<td><?php _e( 'Exclude Posts', 'wcp-carousel' ); ?></td>
		<td>
			<input type="text" class="exclude-ids widefat" value="<?php echo (isset($saved_meta['exclude_ids'])) ? $saved_meta['exclude_ids'] : '' ; ?>" name="car[exclude_ids]">
		</td>
		<td>
			<p class="description"><?php _e( 'Comma separated ids of posts that you do not want to display', 'wcp-carousel' ); ?>.</p>
		</td>
	</tr>
	<tr class="if-by-post">
		<td>Select Post Type</td>
		<td>
			<select name="car[post_type]" id="select-post-type" class="widefat">
				<option value=""><?php _e( 'Select Post Type', 'wcp-carousel' ); ?></option>
			<?php $post_types = get_post_types( array( 'public' => true, ) );
				foreach ($post_types as $name => $label) {
					$selected = (isset($saved_meta['post_type']) && $saved_meta['post_type'] == $name) ? 'selected' : '' ;
					echo '<option value="'.$name.'" '.$selected.'>'.$label.'</option>';
				}
			?>
			</select>
		</td>
		<td>
			<p class="description">Please select post type here</p>
		</td>
	</tr>
	<tr class="if-by-post">
		<td>Select Posts</td>
		<td>
			<img src="<?php echo plugin_dir_url( dirname(__FILE__) ); ?>images/ajax-loader.gif" alt="Loading Posts" style="display:none;" class="posts-loader">
			<select name="car[posts][]" id="select-posts" style="display:<?php echo (isset($saved_meta['post_type']) && $saved_meta['post_type'] != '') ? '' : 'none' ; ?>;" class="widefat" multiple>
				<?php
					if (isset($saved_meta['post_type']) && $saved_meta['post_type'] != '') {
						$all_posts = get_posts( array('post_type' => $saved_meta['post_type'], 'posts_per_page' => -1 ) );
						foreach ($all_posts as $key => $post_obj) {
							if ($selected_post_ids != '' && is_array($selected_post_ids)) {
								$selected = (in_array($post_obj->ID, $selected_post_ids)) ? 'selected' : '' ;
							}
							echo '<option value="'.$post_obj->ID.'" '.$selected.'>'.$post_obj->post_title.'</option>';
						}
					}
				?>				
			</select>
		</td>
		<td>
			<p class="description">Choose posts to display in carousel</p>
		</td>
	</tr>
	<tr>
		<td>Select Meta for Heading</td>
		<td>
			<input type="text" name="car[title]" class="widefat" value="<?php echo (isset($saved_meta['title'])) ? $saved_meta['title'] : 'post_title' ; ?>">
		</td>
		<td>
			<p class="description">Provide post meta key to display as heading</p>
		</td>
	</tr>
	<tr>
		<td>Select Meta for Description</td>
		<td>
			<input type="text" name="car[desc]" class="widefat" value="<?php echo (isset($saved_meta['desc'])) ? $saved_meta['desc'] : 'post_date' ; ?>">
		</td>
		<td>
			<p class="description">Provide post meta key to display as description, you can also use <b>excerpt</b> or <b>content</b></p>
		</td>
	</tr>
	<tr>
		<td>Carousel Style</td>
		<td>
			<select name="car[hover_effect]" class="widefat">
				<?php
				$free_ihovers = $this->get_ihover_effects();
				foreach ($free_ihovers as $className) {
				    $selected = ($ihover_selected == $className) ? 'selected' : '' ; ?>
				    <option value="<?php echo $className; ?>" <?php echo $selected; ?>><?php echo ucwords(str_replace("_"," ",$className)) ?></option>
				<?php }
				?>				
			</select>
		</td>
		<td>
			<p class="description">Choose post display style for carousel</p>
		</td>
	</tr>
	<tr>
		<td>Border Width</td>
		<td>
			<input type="text" name="car[border_width]" class="widefat" value="<?php echo (isset($saved_meta['border_width'])) ? $saved_meta['border_width'] : '8px' ; ?>">
		</td>
		<td>
			<p class="description">Provide width for border eg 2px, leave blank to disable border</p>
		</td>
	</tr>
	<tr>
		<td>Border Color</td>
		<td>
			<input type="text" name="car[border_color]" class="widefat colorpicker" value="<?php echo (isset($saved_meta['border_color'])) ? $saved_meta['border_color'] : '#FFF' ; ?>">
		</td>
		<td>
			<p class="description">Choose border color for carousel items</p>
		</td>
	</tr>
	<tr>
		<td>Arrows Color</td>
		<td>
			<input type="text" name="car[arrow_color]" class="widefat colorpicker" value="<?php echo (isset($saved_meta['arrow_color'])) ? $saved_meta['arrow_color'] : '#000' ; ?>">
		</td>
		<td>
			<p class="description">Choose arrows color</p>
		</td>
	</tr>
	<tr>
		<td>Title Background Color</td>
		<td>
			<input type="text" name="car[title_bg]" class="widefat colorpicker" value="<?php echo (isset($saved_meta['title_bg'])) ? $saved_meta['title_bg'] : '' ; ?>">
		</td>
		<td>
			<p class="description">Choose Title Background Color, Leave blank for default</p>
		</td>
	</tr>
	<tr>
		<td>Title Color</td>
		<td>
			<input type="text" name="car[title_color]" class="widefat colorpicker" value="<?php echo (isset($saved_meta['title_color'])) ? $saved_meta['title_color'] : '' ; ?>">
		</td>
		<td>
			<p class="description">Choose Title text color, Leave blank for default</p>
		</td>
	</tr>
	<tr>
		<td>Description Color</td>
		<td>
			<input type="text" name="car[desc_color]" class="widefat colorpicker" value="<?php echo (isset($saved_meta['desc_color'])) ? $saved_meta['desc_color'] : '' ; ?>">
		</td>
		<td>
			<p class="description">Choose description text color, Leave blank for default</p>
		</td>
	</tr>
	<tr>
		<td>Shadow</td>
		<td>
			<input type="text" name="car[shadow]" class="widefat" value="<?php echo (isset($saved_meta['shadow'])) ? $saved_meta['shadow'] : '1px 1px 3px rgba(0, 0, 0, 0.3)' ; ?>">
		</td>
		<td>
			<p class="description">Provide Shadow</p>
		</td>
	</tr>
	<tr>
		<td>Read More Button Text</td>
		<td>
			<input type="text" name="car[read_more_txt]" class="widefat" value="<?php echo (isset($saved_meta['read_more_txt'])) ? $saved_meta['read_more_txt'] : '' ; ?>">
		</td>
		<td>
			<p class="description">Provide Read More button text, leave blank to disable</p>
		</td>
	</tr>
	<tr>
		<td>Read More Button CSS Classes</td>
		<td>
			<input type="text" name="car[read_more_classes]" class="widefat" value="<?php echo (isset($saved_meta['read_more_classes'])) ? $saved_meta['read_more_classes'] : '' ; ?>">
		</td>
		<td>
			<p class="description">Provide classes to add with the link for styling</p>
		</td>
	</tr>
	<tr>
		<td>Link Target</td>
		<td>
			<select name="car[read_more_target]" class="widefat">
				<option value="" <?php echo (isset($saved_meta['read_more_target']) && $saved_meta['read_more_target'] == '') ? 'selected' : '' ; ?>>Same Tab</option>
				<option value="_blank" <?php echo (isset($saved_meta['read_more_target']) && $saved_meta['read_more_target'] == '_blank') ? 'selected' : '' ; ?>>New Tab</option>
			</select>
		</td>
		<td>
			<p class="description">How you want to open the link</p>
		</td>
	</tr>	
</table>