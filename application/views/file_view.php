
<?php 
	echo form_open_multipart('welcome/do_upload');
	$mtype = "video/mp4";
	echo '<input type="hidden" name="list_name" value="'. $list_name.'"/>';				
	echo "<h2><u>List Name: ". $list_name."</u></h2>";
?>
	<b>Upload a File for this list</b><p></p>
	
    <?php 
    	echo form_label('Select File:&nbsp', 'userfile');
		echo form_upload('userfile');
		echo '<p>';
		echo form_submit('submit', 'Upload File');
		echo form_close();
		?>
		<p></p>

<?php form_close();
//echo '<img src="'.base_url().'uploads/w.jpg" />' 
	$this->load->database();
	$videos = $this->db->query('SELECT * FROM files WHERE list_name="'.$list_name.'"');
	
	foreach ($videos->result() as $video)
	{
		echo '<hr>';
		$video = $video->file_name;
		$videopath = base_url().'uploads/'.$video;
		
		$file_extension = substr($video, -3);

		
		
		/* THIS IS THE HTML5 embedded player
		echo $videopath;
		echo "<b>File Name: </b>".$video;
	    echo '<video width="320" height="240" controls="controls">';
		echo '<source src="'.$videopath.'" type="video/mp4" />';
		echo '</video>';
		*/
		
		echo '<p><b><u>File Name<b></u>: '. $video;
		//$data['list_name'] = $list_name;
		//$data['file_name'] = $video;
		$attributes = array('class' => '', 'id' => '');
		echo form_open('welcome/delete_file', $attributes); 
		echo '<input type="hidden" name="list_name" value="'.$list_name.'"/>';		
		echo '<input type="hidden" name="file_name" value="'.$video.'"/>';			
		echo form_submit('submit', 'Delete File');
		echo form_close();
		echo '<p></p>';
		
		if ($file_extension == 'mp4')
		{
			// other video player
			$poster = base_url().'poster/rain.jpg';
			echo '<video id="my_video_1" class="video-js vjs-default-skin" controls preload="auto" width="640" height="264" poster="'.$poster.'" data-setup="{}">';
			echo '<source src="'.$videopath.'" type="video/mp4">';
			echo '<source src="my_video.webm" type="video/webm">';
			echo 'Your browser does not support the video element';
			echo '</video><p><p>';
		}

		if ($file_extension == 'mp3')
		{
			//echo $videopath;
			echo '<audio controls="controls">';
			echo '<source src="'.$videopath.'" type="audio/mp3"/>';
			echo 'Your browser does not support the audio element';
			echo '</audio>'; 
		}
		
	}
		
	
?>
<hr>
<p></p><b><a href="<?php echo site_url('welcome') ?>">Go Back to Lists</a></b>
	
