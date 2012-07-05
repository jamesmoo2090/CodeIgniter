<html>
	<head>
		<title></title>
	</head>
	<body>
		<h1>View Loaded</h1>
		<?php
			echo $plane;
			echo "<p>";
			
			foreach($sql->result() as $row)
    		{
        		echo  $row->text;
    		}
			
		
		?>
	</body>
</html>