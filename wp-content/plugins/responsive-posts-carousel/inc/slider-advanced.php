<?php
	global $post;
	$saved_meta = get_post_meta( $post->ID, 'carousel_meta', true );
?>
<table class="wp-list-table widefat fixed striped posts">
	<tr>
		<td>Rows</td>
		<td>
			<input name="car[slider][rows]" type="number" value="<?php echo (isset($saved_meta['slider']['rows'])) ? $saved_meta['slider']['rows'] : '1' ; ?>">
		</td>
		<td>
			<p class="description">Setting this to more than 1 initializes grid mode. Use slidesPerRow to set how many slides should be in each row.</p>
		</td>
	</tr>
	<tr>
		<td>Slides Per Row</td>
		<td>
			<input name="car[slider][slidesPerRow]" type="number" value="<?php echo (isset($saved_meta['slider']['slidesPerRow'])) ? $saved_meta['slider']['slidesPerRow'] : '1' ; ?>">
		</td>
		<td>
			<p class="description">With grid mode initialized via the rows option, this sets how many slides are in each grid row.</p>
		</td>
	</tr>
</table>