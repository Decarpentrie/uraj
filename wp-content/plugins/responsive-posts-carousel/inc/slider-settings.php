<?php
	global $post;
	$saved_meta = get_post_meta( $post->ID, 'carousel_meta', true );
?>
<table class="wp-list-table widefat fixed striped posts">
	<tr>
		<td>Accessibility</td>
		<td>
			<label><input name="car[slider][accessibility]" type="checkbox" <?php echo (isset($saved_meta['slider']['accessibility'])) ? 'checked' : '' ; ?>> Enable</label>
		</td>
		<td>
			<p class="description">Enables tabbing and arrow key navigation</p>
		</td>
	</tr>
	<tr>
		<td>Auto Play</td>
		<td>
			<label><input name="car[slider][autoplay]" type="checkbox" <?php echo (isset($saved_meta['slider']['autoplay'])) ? 'checked' : '' ; ?>> Enable</label>
		</td>
		<td>
			<p class="description">Enables auto play of slides</p>
		</td>
	</tr>
	<tr>
		<td>Bottom Dots</td>
		<td>
			<label><input name="car[slider][dots]" type="checkbox" <?php echo (isset($saved_meta['slider']['dots'])) ? 'checked' : '' ; ?>> Enable</label>
		</td>
		<td>
			<p class="description">Current slide indicator dots</p>
		</td>
	</tr>
	<tr>
		<td>Arrows</td>
		<td>
			<label><input name="car[slider][arrows]" type="checkbox" <?php echo (isset($saved_meta['slider']['arrows'])) ? 'checked' : '' ; ?>> Enable</label>
		</td>
		<td>
			<p class="description">Enable Next/Prev arrows</p>
		</td>
	</tr>
	<tr>
		<td>Auto Play Speed</td>
		<td>
			<input name="car[slider][autoplaySpeed]" type="number" value="<?php echo (isset($saved_meta['slider']['autoplaySpeed'])) ? $saved_meta['slider']['autoplaySpeed'] : '3000' ; ?>">
		</td>
		<td>
			<p class="description">Auto play change interval in ms</p>
		</td>
	</tr>
	<tr>
		<td>Number of Columns</td>
		<td>
			<input name="car[slider][slidesToShow]" type="number" value="<?php echo (isset($saved_meta['slider']['slidesToShow'])) ? $saved_meta['slider']['slidesToShow'] : '1' ; ?>">
		</td>
		<td>
			<p class="description">Number of items to show at a time.</p>
		</td>
	</tr>
	<tr>
		<td>Number of Items To Slide</td>
		<td>
			<input name="car[slider][slidesToScroll]" type="number" value="<?php echo (isset($saved_meta['slider']['slidesToScroll'])) ? $saved_meta['slider']['slidesToScroll'] : '1' ; ?>">
		</td>
		<td>
			<p class="description">Number of items to slide at a time.</p>
		</td>
	</tr>
	<tr>
		<td>Speed</td>
		<td>
			<input name="car[slider][speed]" type="number" value="<?php echo (isset($saved_meta['slider']['speed'])) ? $saved_meta['slider']['speed'] : '300' ; ?>">
		</td>
		<td>
			<p class="description">Transition speed in ms.</p>
		</td>
	</tr>
	<tr>
		<td>Space Between Slides</td>
		<td>
			<input name="car[slider][margin]" type="text" value="<?php echo (isset($saved_meta['slider']['margin'])) ? $saved_meta['slider']['margin'] : '20px' ; ?>">
		</td>
		<td>
			<p class="description">Margin will apply to both sides.</p>
		</td>
	</tr>
</table>