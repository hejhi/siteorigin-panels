<?php $settings = siteorigin_panels_setting(); ?>

<div class="wrap">
	<div id="icon-options-general" class="icon32"><br></div>
	<h2><?php _e('SiteOrigin Page Builder', 'siteorigin-panels') ?></h2>

	<form action="<?php echo admin_url( 'options-general.php?page=siteorigin_panels' ) ?>" method="POST">

		<pre><?php //var_dump($settings) ?></pre>

		<h3><?php _e('General', 'siteorigin-panels') ?></h3>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><strong><?php _e('Post Types', 'siteorigin-panels') ?></strong></th>
					<td>
						<?php siteorigin_panels_options_field_post_types($settings['post-types']) ?>
					</td>
				</tr>

				<?php
				siteorigin_panels_options_field(
					'copy-content',
					$settings['copy-content'],
					__('Copy Content', 'siteorigin-panels'),
					__('Copy content from Page Builder into the standard content editor.', 'siteorigin-panels')
				);

				siteorigin_panels_options_field(
					'animations',
					$settings['animations'],
					__('Animations', 'siteorigin-panels'),
					__('Disable animations for improved performance.', 'siteorigin-panels')
				);

				siteorigin_panels_options_field(
					'bundled-widgets',
					$settings['bundled-widgets'],
					__('Bundled Widgets', 'siteorigin-panels'),
					__('Include the bundled widgets.', 'siteorigin-panels')
				);

				siteorigin_panels_options_field(
					'row-layouts',
					$settings['row-layouts'],
					__('Row Layouts', 'siteorigin-panels'),
					__('Add or remove the row layouts you would like.', 'siteorigin-panels')
				);

				?>

			</tbody>
		</table>

		<h3><?php _e('Display', 'siteorigin-panels') ?></h3>
		<table class="form-table">
			<tbody>

				<?php

				siteorigin_panels_options_field(
					'responsive',
					$settings['responsive'],
					__('Responsive Layout', 'siteorigin-panels'),
					__('Should the layout collapse for mobile devices.', 'siteorigin-panels')
				);

				siteorigin_panels_options_field(
					'mobile-width',
					$settings['mobile-width'],
					__('Mobile Width', 'siteorigin-panels')
				);

				siteorigin_panels_options_field(
					'margin-bottom',
					$settings['margin-bottom'],
					__('Row Bottom Margin', 'siteorigin-panels')
				);

				siteorigin_panels_options_field(
					'margin-sides',
					$settings['margin-sides'],
					__('Cell Side Margins', 'siteorigin-panels')
				);

				siteorigin_panels_options_field(
					'inline-css',
					$settings['inline-css'],
					__('Inline CSS', 'siteorigin-panels')
				);

				?>

			</tbody>
		</table>


		<?php wp_nonce_field('save_panels_settings'); ?>
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'siteorigin-panels') ?>"/>
		</p>

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
