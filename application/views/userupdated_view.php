<?php
	$this->load->helper('url');
	
	echo '<h1>User has been Successfully updated</h1>';


?>
	<h2>Redirecting back to Login Screen....</h2>
		<p>&nbsp</p>
		<p>&nbsp</p>
		<p>&nbsp</p>
		<p>&nbsp</p>
		<p>&nbsp</p>
		<p>&nbsp</p>
		
<script type="text/JavaScript">

setTimeout("location.href = '<?php echo site_url('admin/logout') ?>';",5000);

</script>