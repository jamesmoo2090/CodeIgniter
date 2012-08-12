<!-- THIS IS THE Forgot Password FORM -->
		<?php    
			$attributes = array('class' => '', 'id' => '');
			echo form_open('forgot', $attributes); 
		?>
		
		<h2>Seems you forgot your password...</h2>
		<h3>put your email address and we will send you your password.</h3>
		<p>
		        <label for="email_address">Email Address</label>
		        <?php echo form_error('email_address'); ?>
		        <br /><input id="email_address" type="text" name="email_address" maxlength="50" value="<?php echo set_value('email_address'); ?>"  />
		</p>
		
		<p>
		        <?php echo form_submit( 'submit', 'Submit'); ?>
		</p>
		
		<?php 
				echo form_close(); 
				
		?>		
		
		<b><a href="<?php echo site_url('admin') ?>">Cancel password Retrival and Go Back to Login</a></b>
		
		
