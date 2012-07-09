<?php // Change the css classes to suit your needs    

$attributes = array('class' => '', 'id' => '');
echo form_open('welcome', $attributes); ?>

<p>
        <label for="email_address">Email Address <span class="required">*</span></label>
        <?php echo form_error('email_address'); ?>
        <br /><input id="email_address" type="text" name="email_address" maxlength="256" value="<?php echo set_value('email_address'); ?>"  />
</p>

<p>
        <label for="public_or_private">Public or Private <span class="required">*</span></label>
        <?php echo form_error('public_or_private'); ?>
        <br />
                <?php // Change or Add the radio values/labels/css classes to suit your needs ?>
                <input id="public_or_private" name="public_or_private" type="radio" class="" value="option1" <?php echo $this->form_validation->set_radio('public_or_private', 'option1'); ?> />
        		<label for="public_or_private" class="">Radio option 1</label>

        		<input id="public_or_private" name="public_or_private" type="radio" class="" value="option2" <?php echo $this->form_validation->set_radio('public_or_private', 'option2'); ?> />
        		<label for="public_or_private" class="">Radio option 2</label>
</p>


<p>
        <label for="list_name">List Name <span class="required">*</span></label>
        <?php echo form_error('list_name'); ?>
        
        <?php // Change the values in this array to populate your dropdown as required ?>
        <?php $options = array(
                                                  ''  => 'Please Select',
                                                  'example_value1'    => 'example option 1'
                                                ); ?>

        <br /><?php echo form_dropdown('list_name', $options, set_value('list_name'))?>
</p>                                             
                        
<p>
        <label for="task_name">Task Name <span class="required">*</span></label>
        <?php echo form_error('task_name'); ?>
        <br /><input id="task_name" type="text" name="task_name" maxlength="256" value="<?php echo set_value('task_name'); ?>"  />
</p>

<p>
        <label for="task_decription">Task Decription</label>
        <?php echo form_error('task_decription'); ?>
        <br /><input id="task_decription" type="text" name="task_decription"  value="<?php echo set_value('task_decription'); ?>"  />
</p>

<p>
        <label for="file_url">File Upload</label>
        <?php echo form_error('file_url'); ?>
        <br /><input id="file_url" type="text" name="file_url" maxlength="250" value="<?php echo set_value('file_url'); ?>"  />
</p>

<p>
        <label for="task_status">Task Status <span class="required">*</span></label>
        <?php echo form_error('task_status'); ?>
        <br />
                <?php // Change or Add the radio values/labels/css classes to suit your needs ?>
                <input id="task_status" name="task_status" type="radio" class="" value="option1" <?php echo $this->form_validation->set_radio('task_status', 'option1'); ?> />
        		<label for="task_status" class="">Radio option 1</label>

        		<input id="task_status" name="task_status" type="radio" class="" value="option2" <?php echo $this->form_validation->set_radio('task_status', 'option2'); ?> />
        		<label for="task_status" class="">Radio option 2</label>
</p>



<p>
        <?php echo form_submit( 'submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>
