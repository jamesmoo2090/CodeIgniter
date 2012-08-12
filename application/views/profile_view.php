<?php

	//variables used to fill the form field
	$first_name; $last_name; $email; $password;
	
	//place user info in the variables used to fill up the fields	
	foreach ($sql->result() as $item)
	{
		$email      =  $item->email_address;
		$last_name  =  $item->last_name;
		$first_name =  $item->first_name;
		$password   =  $item->password;
	}
	
	$attributes = array('class' => '', 'id' => '');
	echo form_open('admin/editprofile', $attributes); 
?>

<p>
        <label for="first_name">First Name <span class="required">(required field)</span></label>
        <?php echo form_error('first_name'); ?>
        <br /><input id="first_name" type="text" name="first_name" maxlength="40" value="<?php echo set_value('first_name',$first_name); ?>"  />
</p>

<p>
        <label for="last_name">Last Name <span class="required">(required field)</span></label>
        <?php echo form_error('last_name'); ?>
        <br /><input id="last_name" type="text" name="last_name" maxlength="40" value="<?php echo set_value('last_name',$last_name); ?>"  />
</p>


<p>
        <label for="email_address">Last Name <span class="required">(required field)</span></label>
        <?php echo form_error('email_address'); ?>
        <br /><input id="email_address" type="text" name="email_address" maxlength="256" value="<?php echo set_value('email_address',$email); ?>"  />
</p>

<p>
        <label for="password">Password<span class="required">(required field)</span></label>
        <?php echo form_error('password'); ?>
        <br /><input id="password" type="password" name="password" maxlength="256" value="<?php echo set_value('password',$password); ?>"  />
</p>
<p>
        <?php 
        	echo form_submit( 'submit', 'Save Changes');
			echo form_close(); 
        ?>
</p>


<p><b><a href="<?php echo site_url('welcome') ?>">Cancel & Go Back to Lists</a></b>