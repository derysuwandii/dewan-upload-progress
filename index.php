<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="icon" href="dk.png">
	<title>Dewan Upload With Progress bar</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-dark bg-danger fixed-top">
	  <a class="navbar-brand text-white" href="index.php">
	    Dewan Komputer
	  </a>
	</nav>

	<h2 align="center" style="margin: 70px 10px 30px 10px;">Demo Upload File dengan Progress Bar Dewan Komputer</h2>
	<div class="row">
		<div class="col-sm-6 offset-sm-3">
			<form id="upload_form">
				<div class="form-group mb-5">
					<label>Pilih File</label><br/>
					<input type="file" name="file" id="file" class="form-control">
				</div>

				<div class="form-group mb-5">
				  	<input type="button" id="upload" value="Upload File" class="btn btn-success">
				</div>

			  	<progress id="progressBar" value="0" max="100" style="width:100%; display: none;"></progress>
				<h3 id="status"></h3>
				<p id="loaded_n_total"></p>
			</form>
		</div>
	</div>
	
	<div class="navbar bg-dark fixed-bottom">
		<div class="text-white">© <?php echo date('Y'); ?> Copyright:
		    <a href="https://dewankomputer.com/"> Dewan Komputer</a>
		</div>
	</div>

	<script>
		function ambilId(file){
			return document.getElementById(file);
		}

		$(document).ready(function(){
			$("#upload").click(function(){
				ambilId("progressBar").style.display = "block";
				var file = ambilId("file").files[0];

				if (file!="") {
					var formdata = new FormData();
					formdata.append("file", file);
					var ajax = new XMLHttpRequest();
					ajax.upload.addEventListener("progress", progressHandler, false);
					ajax.addEventListener("load", completeHandler, false);
					ajax.addEventListener("error", errorHandler, false);
					ajax.addEventListener("abort", abortHandler, false);
					ajax.open("POST", "upload.php");
					ajax.send(formdata);
				}
			});
		});

		function progressHandler(event){
			ambilId("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
			var percent = (event.loaded / event.total) * 100;
			ambilId("progressBar").value = Math.round(percent);
			ambilId("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
		}
		function completeHandler(event){
			ambilId("status").innerHTML = event.target.responseText;
			ambilId("progressBar").value = 0;
		}
		function errorHandler(event){
			ambilId("status").innerHTML = "Upload Failed";
		}
		function abortHandler(event){
			ambilId("status").innerHTML = "Upload Aborted";
		}
	</script>
</body>
</html>