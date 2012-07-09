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
        <label for="task_status">SetTask Status</label>
        <?php echo form_error('task_status'); ?>
        <br />
                <?php // Change or Add the radio values/labels/css classes to suit your needs ?>
                <input id="task_status" name="task_status" type="radio" class="" value="Not Started" <?php echo $this->form_validation->set_radio('task_status', 'Not Started'); ?> checked/>
        		<label for="task_status" class="">Not Started</label>
			&nbsp &nbsp
        		<input id="task_status" name="task_status" type="radio" class="" value="In Progress" <?php echo $this->form_validation->set_radio('task_status', 'In Progress'); ?> />
        		<label for="task_status" class="">In Progress</label>
        	&nbsp &nbsp	
        		<input id="task_status" name="task_status" type="radio" class="" value="Completed" <?php echo $this->form_validation->set_radio('task_status', 'Completed'); ?> />
        		<label for="task_status" class="">Completed</label>
        	&nbsp &nbsp
        		<input id="task_status" name="task_status" type="radio" class="" value="Postponed" <?php echo $this->form_validation->set_radio('task_status', 'Postponed'); ?> />
        		<label for="task_status" class="">Postponed</label>

	
</p>



<p>
        <?php echo form_submit( 'submit', 'Create New List & Task'); ?>
</p>

<?php echo form_close(); 

		echo form_open('welcome/cancelbutton');
		echo form_submit('submit', 'Cancel');
		echo form_close();
?>
