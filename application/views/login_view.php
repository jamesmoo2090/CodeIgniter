<!DOCTYPE html>

<html lang="en">
	<head>
	   <meta charset="utf-8">
	   <title>Todo List - Login</title>
	   
	   <style> label { display: block; } </style>
	   

	  

	</head>
	
	<body>

		
		
		
		<!------ LOGIN BOX ---->
		<center>
			<div class="publicorprivate">
		<h1> Please Login</h1>
		<?php echo form_open('admin'); ?>
		<p>
		   <?php 
		      echo form_label('Email Address: ', 'email_address');
		      echo form_input('email_address', set_value('email_address'), 'id="email_address" autofocus');
		   ?>
		</p>
		
		<p>
		   <?php 
		      echo form_label('Password:', 'password');
		      echo form_password('password', '', 'id="password"');
		   ?>
		</p>
		
		<p>
		   <?php echo form_submit('submit', 'Login'); ?>
		</p>
		<?php echo form_close(); ?>
		
		<?php echo validation_errors(); ?>
	
		<!--- LINK TO THE REGISTRATION PAGE -->
		<b>
		<a href="<?php echo site_url('register') ?>">Create Account</a>
		&nbsp
		<a href="<?php echo site_url('forgot') ?>">Forgot Password</a>
		</b>
		</div>
		
		
		
		<div class="accordion">
			<section id="one">
				<h2><a href="#one">What is this?</a></h2>
					<div>
						<p>This is a list/task management system.</p>
						<p>Create an account and keep organized!</p>
				
					</div>
			</section>
			<section id="two">
				<h2><a href="#two">How it works</a></h2>
					<div>
						<p>Create an account and login</p>
						<p>You will be able to immediately see any public lists/task available</p>
				
					</div>
			</section>
			
			<section id="three">
				<h2><a href="#three">Public Lists/Tasks</a></h2>
					<div>
						<p>They are create by anyone, including you!</p>
						<p>Everyone can see them!</p>
				
					</div>
			</section>
			
			<section id="four">
				<h2><a href="#four">Private Lists/Tasks</a></h2>
					<div>
						<p>They are only create and viewable by you</p>
						<p>You are the only one that can see them</p>
				
					</div>
			</section>

		</div>
		</div>
			
	</center>
	</body>
</html>	

