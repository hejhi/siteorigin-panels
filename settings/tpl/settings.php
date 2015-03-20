<div class="wrap" id="panels-settings-page">
	<div class="settings-banner">

		<span class="icon">
			<img src="<?php echo plugin_dir_url(__FILE__) ?>../images/icon-layer.png" class="layer-3" />
			<img src="<?php echo plugin_dir_url(__FILE__) ?>../images/icon-layer.png" class="layer-2" />
			<img src="<?php echo plugin_dir_url(__FILE__) ?>../images/icon-layer.png" class="layer-1" />
		</span>
		<h1><?php _e('SiteOrigin Page Builder', 'siteorigin-panels') ?></h1>

		<div id="panels-settings-search">
			<input type="search" placeholder="<?php esc_attr_e('Search Settings', 'siteorigin-panels') ?>" />

			<ul class="results">
			</ul>
		</div>
	</div>

	<ul class="settings-nav">
		<?php
		foreach($settings_fields as $section_id => $section) {
			?><li><a href="#<?php echo esc_attr( $section_id ) ?>"><?php echo esc_html( $section['title'] ) ?></a></li><?php
		}
		?>
	</ul>

	<?php if( $this->settings_saved ) : ?>
		<div id="setting-error-settings_updated" class="updated settings-error">
			<p><strong><?php _e('Settings Saved', 'siteorigin-panels') ?></strong></p>
		</div>
	<?php endif; ?>

	<form action="<?php echo admin_url('options-general.php?page=siteorigin_panels') ?>" method="post" >

		<div id="panels-settings-sections">
			<?php
			foreach($settings_fields as $section_id => $section) {
				?>
				<div id="panels-settings-section-<?php echo esc_attr($section_id) ?>" class="panels-settings-section" data-section="<?php echo esc_attr($section_id) ?>">
					<table class="form-table">
						<tbody>
							<?php foreach( $section['fields'] as $field_id => $field ) : ?>
								<tr class="panels-setting">
									<th scope="row"><label><?php echo esc_html($field['label']) ?></label></th>
									<td>
										<?php
										$this->display_field( $field_id, $field );
										if( !empty($field['description']) ) {
											?>
											<small class="description" data-keywords="<?php if(!empty($field['keywords'])) echo esc_attr($field['keywords']) ?>">
												<?php
												echo wp_kses( $field['description'], array(
													'a' => array(
														'href' => array(),
														'title' => array()
													),
													'em' => array(),
													'strong' => array(),
												) );
												?>
											</small>
											<?php
										}
										?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<?php
			}
			?>
		</div>

		<div class="submit">
			<?php wp_nonce_field( 'panels-settings' ) ?>
			<input type="submit" value="<?php _e('Save Settings', 'siteorigin-panels') ?>" class="button-primary" />
		</div>
	</form>
	<script charset="utf-8">
		jQuery('#row-layout-submit').on('click', function(e) {
			e.preventDefault();

			var layoutLabel = jQuery('#row-layout-label').val();
			var layoutRatio = jQuery('#row-layout-ratio').val();

			jQuery.post(
				ajaxurl,
				{
					action: 'so_panels_layout_form',
					layout_action: 'add',
					label: layoutLabel,
					ratio: layoutRatio
				},
				function(name){
					jQuery('#grid-layouts').append('<li><span class="remove-layout dashicons-no-alt dashicons-before"></span> '+name+': '+layoutRatio+'</li>');
				}
			);
		});

		jQuery('.remove-layout').on('click', function(e) {
			e.preventDefault();

			var toremove = jQuery(this).data('layout');

			jQuery.post(
				ajaxurl,
				{
					action: 'so_panels_layout_form',
					layout_action: 'remove',
					layout: toremove,
				},
				function(name){
					jQuery('#layout-'+name).remove();
				}
			);
		});
	</script>

</div>
