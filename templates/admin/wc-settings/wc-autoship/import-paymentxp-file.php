<tr valign="top">
	<th scope="row" class="titledesc">
		<label for="<?php echo esc_attr( $value['id'] ); ?>"><?php echo esc_html( $value['title'] ); ?></label>
		<?php echo $description['tooltip_html']; ?>
	</th>
	<td class="forminp forminp-<?php echo sanitize_title( $value['type'] ) ?>">
		<input type="file" id="<?php echo esc_attr( $value['id'] ); ?>" />
		<button type="button" id="<?php echo esc_attr( $value['id'] ); ?>_button" class="button-secondary">Import</button>
		<div id="<?php echo esc_attr( $value['id'] ); ?>_result"></div>
	</td>
</tr>