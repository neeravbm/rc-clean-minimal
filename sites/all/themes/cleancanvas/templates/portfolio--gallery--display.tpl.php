<div class="big">
<?php
foreach ($images as $image):
  $imgurl = $image['uri'];
  $style = 'portfolio_large';
?>
  <img src="<?php print image_style_url($style, $imgurl); ?>"  style="display:none;" class="img-responsive">
<?php endforeach; ?>
</div>

<div class="thumbs">
<?php
foreach ($images as $image):
$img_url = $image['uri'];
$style = 'portfolio_thumbnail_90x87';
?>
	<div class="thumb">
		<img src="<?php print image_style_url($style, $img_url); ?>" class="img-rounded">
		<a href="#" class="mask">
				<div class="more">+</div>
		</a>
	</div>

<?php endforeach; ?>
</div>
