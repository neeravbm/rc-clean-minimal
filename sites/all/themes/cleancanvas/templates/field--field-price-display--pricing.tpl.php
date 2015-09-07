<?php
 global $base_url;
 $path = $base_url . '/' . path_to_theme();
?>
<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?> id="in_pricing">
  <div class="content row charts_wrapp"<?php print $content_attributes; ?>>
    <?php
     foreach ($items as $delta => $item):
    ?>
		 <div class="col-sm-4">
				<div class="plan">
					<div class="wrapper">
						<img class="ribbon" src="<?php print $path; ?>/assets/img/badge.png">
						<?php print render($item); ?>
					</div>
				</div>
			</div>
		 <?php
       endforeach; 
     ?>
  </div>
</div>
