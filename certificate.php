<?php

if (!(isset($_GET['email']) and isset($_GET['contest']))) header("Location:index.php");


$db = mysqli_connect("localhost", "root", "", "csi");
// $email = "pavan@csi.com";
$email = $_GET['email'];
$contest = $_GET['contest'];
$sql = "SELECT * FROM certificates where email='$email' and contest='$contest'";
$res = mysqli_query($db, $sql);
$data = mysqli_fetch_array($res);
// echo $data['rank'];

?>


<!DOCTYPE html>
<html>
<head>
	<title>CSI Certificate</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

	<style type="text/css">
		/* .certificate
		{
			position: relative;
			text-align: center;
			width: 90%;	
			margin-left: 5%;
		} */
		.name
		{
			text-align: center;
			position: absolute;
			font-size: 25px;
			min-width: 900px;
			/* width: 100%; */
			width: 300px;
			/*left: 100px;*/
			/* left: 22%; */
			margin-top: 280px;
			margin-left: 120px;
			/* margin-right: -500px; */
		}
		
		.cid
		{
			/* color: #FFD700; */
			font-size: 10px;
			color : #fff;
			margin-top: -30px;
			margin-right: 30px;
			text-align: right;
		}
		.link
		{
			font-size: 10px;
			margin-top: -1px;
			margin-right: 30px;
			text-align: right;
		}
		.link a
		{
			text-decoration: none;
			color : #fff;
		}
		.link:hover
		{
			color: #fff;
			text-decoration: none;
		}


		.print
		{
			text-align: center;
		}
		.print button
		{
			position: relative;
			width: 100px;
			height: 30px;
			margin-top: 10px;
			margin-bottom: 10px;
			background-color: rgba(0, 181, 204, 1);
			border: none;
			outline: none;
			border-radius: 20px;
		}
		@media print {
		  .certificate
		  {
		  	margin-top: 150px;
		  	/*transform: translate(-50%,0);*/
		  	transform: rotate(90deg);
		  }
		  .print {
		    display: none;
		    margin: 0;
		  }
		}
	</style>
</head>
<body>
	<!-- <div class="certificate">
		<div class="name">Sample Name</div>
		<img style="width: 800px;" src="Gold.png">
		<div class="cid">Certificate id : asda7sd756as5d</div>
	</div> -->
	<div class="container">
		<div class="row">
			<div class="col-sm-1"></div>
			<?php #if ($data['rank']==1) { ?>

			<div class="col-sm-10" style="width: 100%;">
				<div class="name"><?php echo $data['name']; ?></div>
				<?php 
				$ctype = "";

				if ($data['rank']==0) $ctype = "Participation";
				else if ($data['rank']==1) $ctype = "Gold";
				else if ($data['rank']==2) $ctype = "Silver";
				else if ($data['rank']==3) $ctype = "Bronze";
				
				?>
				<img style="width: 900px;" src="certificates/<?php echo $ctype; ?>.png">
				<div class="cid">Certificate id : <?php echo $data['contest'].dechex($data['id']); ?></div>
				<div class="link"><a href="https://google.com">Verify</a></div>
			</div>

			<?php #} ?>
			<div class="col-sm-1"></div>
		</div>
	</div>
	<div class="print"><button onClick="window.print();">Print</button></div>
</body>
</html>