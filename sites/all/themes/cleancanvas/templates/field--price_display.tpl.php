<?php
 global $base_url;
 $path = $base_url . '/' . path_to_theme();
 $count = count($rows);
?>
<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?> id="in_pricing<?php print ($count > 3) ? 2 : ''; ?>">
  <div class="content row charts_wrapp"<?php print $content_attributes; ?>>
    <?php foreach($rows as $key => $row): ?>
		 <div class="col-sm-<?php print ($count > 3) ? 3 : 4; ?> pro <?php print ($row['field_background_details']['#items'][0]['value']) ? 'black' : 'white' ?>">
				<div class="plan <?php print ($row['field_background_details']['#items'][0]['value']) ? 'black' : 'white' ?>">
					<div class="wrapper">
						<?php if($row['field_most_popular']['#items'][0]['value']): ?>
						   <img class="ribbon" src="<?php print $path; ?>/assets/img/badge.png">
						<?php endif; ?>
						<?php if($row['field_product_heading']): ?>
						<div class="field-price_display">
							<?php print render($row['field_product_heading']); ?>
						</div>
						<?php endif; ?>
						<?php if($row['field_product_details']): ?>
					  <div class="field-price_display">
							<?php print render($row['field_product_details']); ?>
						</div>
						<?php endif; ?>
						<?php if($row['field_product_button']): ?>
							<div class="field-price_display">
								<a class="order" href="#"><?php print render($row['field_product_button']); ?></a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		 <?php endforeach; ?>
  </div>
</div>
