<?php
/**
 * Template file to display portfolio links
 */
?>
<div id="filters_container">
	<ul id="filters">
		<li><a href="#" data-filter="*" class="active">All</a></li>
		<?php
		if (sizeof($allowed_values) > 0) {
			foreach ($allowed_values as $key => $value) {
		?>
				<li class="separator">/</li>
				<li><a href="#" data-filter=".<?php print strtolower($value);?>"><?php print $value; ?></a></li>
		<?php
			}	   
		}
		?>
  </ul>
</div>
