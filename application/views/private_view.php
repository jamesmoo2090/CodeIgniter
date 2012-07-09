<?php // Change the css classes to suit your needs    

$attributes = array('class' => '', 'id' => '');
echo form_open('welcome/newlist', $attributes); 
$email = $_SESSION['username'];


?>    
        
        <input id="email_address" type="hidden" name="email_address" maxlength="256" value="<?php echo set_value('email_address', $email); ?>"  />
		<input id="public_task" type="hidden" name="public_task" maxlength="256" value="<?php echo set_value('public_task', 'false'); ?>"  />
<p>
        <label for="list_name">Enter a List Name <span class="required">(required field)</span></label>
        <?php echo form_error('list_name'); ?>
        <br /><input id="list_name" type="text" name="list_name" maxlength="256" value="<?php echo set_value('list_name'); ?>"  />
</p>

<p>
        <label for="task_name">Enter a Task Name <span class="required">(required field)</span></label>
        <?php echo form_error('task_name'); ?>
        <br /><input id="task_name" type="text" name="task_name" maxlength="256" value="<?php echo set_value('task_name'); ?>"  />
</p>

<p>
        <label for="task_description">Task Description</label>
        <?php echo form_error('task_description'); ?>
        <br /><input id="task_description" type="text" name="task_description"  value="<?php echo set_value('task_description'); ?>"  />
</p>

<p>
        <label for="file_url">Link to file on the web (Chuck Norris)</label>
        <?php echo form_error('file_url'); ?>
        <br /><input id="file_url" type="text" name="file_url" maxlength="250" value="<?php echo set_value('file_url'); ?>"  />
</p>

<p>
        <label for="task_status">Current Task Status</label>
        <?php echo form_error('task_status'); ?>
  		<?php 
  			if ($status == "Not Started")
  			{
			   echo '<input id="task_status" name="task_status" type="radio" class="" value="Not Started"'.$this->form_validation->set_radio('task_status', 'Not Started').'checked/>';
        	   echo '<label for="task_status" class="">Not Started</label>';
			   echo "&nbsp &nbsp";		
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="In Progress"'.$this->form_validation->set_radio('task_status', 'In Progress').'/>';
        	   echo '<label for="task_status" class="">In Progress</label>';
        	   echo "&nbsp&nbsp";	
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="Completed"'.$this->form_validation->set_radio('task_status', 'Completed').'/>';
        	   echo '<label for="task_status" class="">Completed</label>';
        	   echo "&nbsp&nbsp";	
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="Postponed"'.$this->form_validation->set_radio('task_status', 'Postponed').'/>';
        	   echo '<label for="task_status" class="">Postponed</label>';
				  				
  			}
  			if ($status == "In Progress")
			{
			   echo '<input id="task_status" name="task_status" type="radio" class="" value="Not Started"'.$this->form_validation->set_radio('task_status', 'Not Started').'/>';
        	   echo '<label for="task_status" class="">Not Started</label>';
			   echo "&nbsp&nbsp";
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="In Progress"'.$this->form_validation->set_radio('task_status', 'In Progress').'checked/>';
        	   echo '<label for="task_status" class="">In Progress</label>';
               echo "&nbsp&nbsp";
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="Completed"'.$this->form_validation->set_radio('task_status', 'Completed').'/>';
        	   echo '<label for="task_status" class="">Completed</label>';
        		echo "&nbsp&nbsp";
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="Postponed"'.$this->form_validation->set_radio('task_status', 'Postponed').'/>';
        	   echo '<label for="task_status" class="">Postponed</label>';
							
			}
			if ($status == "Completed")
			{
			   echo '<input id="task_status" name="task_status" type="radio" class="" value="Not Started"'.$this->form_validation->set_radio('task_status', 'Not Started').'/>';
        	   echo '<label for="task_status" class="">Not Started</label>';
				echo "&nbsp&nbsp";
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="In Progress"'.$this->form_validation->set_radio('task_status', 'In Progress').'/>';
        	   echo '<label for="task_status" class="">In Progress</label>';
        		echo "&nbsp&nbsp";
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="Completed"'.$this->form_validation->set_radio('task_status', 'Completed').'checked/>';
        	   echo '<label for="task_status" class="">Completed</label>';
        		echo "&nbsp&nbsp";
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="Postponed"'.$this->form_validation->set_radio('task_status', 'Postponed').'/>';
        	   echo '<label for="task_status" class="">Postponed</label>';
			
			}
			if ($status == "Postponed")
			{
			   echo '<input id="task_status" name="task_status" type="radio" class="" value="Not Started"'.$this->form_validation->set_radio('task_status', 'Not Started').'/>';
        	   echo '<label for="task_status" class="">Not Started</label>';
				echo "&nbsp&nbsp";
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="In Progress"'.$this->form_validation->set_radio('task_status', 'In Progress').'/>';
        	   echo '<label for="task_status" class="">In Progress</label>';
        		echo "&nbsp&nbsp";
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="Completed"'.$this->form_validation->set_radio('task_status', 'Completed').'/>';
        	   echo '<label for="task_status" class="">Completed</label>';
        		echo "&nbsp&nbsp";
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="Postponed"'.$this->form_validation->set_radio('task_status', 'Postponed').'checked/>';
        	   echo '<label for="task_status" class="">Postponed</label>';
			
			}
  		?>


	
</p>



<p>
        <?php echo form_submit( 'submit', 'Create New List & Task'); ?>
</p>

<?php echo form_close(); 
        echo form_open('welcome/cancelbutton');
		echo form_submit('submit', 'Cancel');
		echo form_close();?>
