<?php
/**
 * Second Login template
 */
?>
<div class="top-user-login-form">
	<div id="sign_in1">
		<div class="container">
			<div class="row">
				 <div class="col-md-12 header">
						<h4><?php print t('Log in to your account'); ?></h4>
				 </div>
				<div class="col-md-12 footer">
					<?php
					  if (isset($login_form)):
						  print drupal_render($login_form);
						endif;
					?>
				</div>
			</div>
		</div>
	</div>
</div>
