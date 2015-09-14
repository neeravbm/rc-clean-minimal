<?php
/**
 * Second Register template
 */
?>
<div class="top-user-register-form">
	<div id="sign_up1">
		<div class="container">
			<div class="row">
				<div class="col-md-12 header">
					 <h4>Create your account</h4>
				 </div>
				 <div class="col-md-12 footer">
					<?php
						if (isset($register_form)) :
						  print drupal_render($register_form);
						endif;
					?>
				</div>
					
			</div>
		</div>
	</div>
</div>
