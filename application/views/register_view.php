
		<!-- THIS IS THE REGISTRATION FORM -->
		<?php    
			$attributes = array('class' => '', 'id' => '');
			echo form_open('register', $attributes); 
		?>
		
		<p>
			<label for="first_name">First Name</label>
		    <?php echo form_error('first_name'); ?>
		        <br /><input id="first_name" type="text" name="first_name" maxlength="40" value="<?php echo set_value('first_name'); ?>"  />
		</p>
		
		<p>
		        <label for="last_name">Last Name</label>
		        <?php echo form_error('last_name'); ?>
		        <br /><input id="last_name" type="text" name="last_name" maxlength="40" value="<?php echo set_value('last_name'); ?>"  />
		</p>
		
		<p>
		        <label for="email_address">Email Address</label>
		        <?php echo form_error('email_address'); ?>
		        <br /><input id="email_address" type="text" name="email_address" maxlength="50" value="<?php echo set_value('email_address'); ?>"  />
		</p>
		
		<p>
		        <label for="password">Create a new password</label>
		        <?php echo form_error('password'); ?>
		        <br /><input id="password" type="text" name="password" maxlength="128" value="<?php echo set_value('password'); ?>"  />
		</p>
		
		
		<p>
		        <?php echo form_submit( 'submit', 'Submit'); ?>
		</p>
		
		<?php echo form_close(); 
				echo form_open('welcome/cancelbutton');
				echo form_submit('submit', 'Cancel');
				echo form_close();
		?>
		
