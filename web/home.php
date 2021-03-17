<!DOCTYPE html>
<html>
<head>
	<title>Renzmer Music Web</title>
	<?php require "connectDB.php";?>
        <?php $query = $conexion->query("SELECT * FROM music"); ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../img/RenzmerMusic-Cover.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
      let listAudio=[];
      let listCover=[];
      let listTitle=[];
      let listArtist=[];
      
      listAudio.push("../audio/destino-remake.mp3");
      listAudio.push("../audio/cambiar-el-mundo.mp3");
      listAudio.push("../audio/max-vr-trapeadores.mp3");
      listAudio.push("../audio/de-mi-depende-maikel-piscco.mp3");
      <?php 
		if($query->num_rows > 0){ 
            while($row = $query->fetch_assoc()){ ?>
                //listAudio.push(<?php echo '"data:audio/mp3;base64, '.base64_encode($row['song']).'"'?>);
                listCover.push(<?php echo '"data:image/jpg;base64, '.base64_encode($row['cover']).'"'?>);
                listTitle.push("<?php echo $row['titulo'];?>");
                listArtist.push("<?php echo $row['artista'];?>");
       <?php } } ?>
       function sizeListAudio(){
           return listAudio.length;
       }
  </script>
</head>
<body onload="elementos(sizeListAudio())">
<!--debe de reproducir la primera en la lista-->
<audio id="music" src="" type="audio/mpeg"></audio>
<!--NavBar-->
<nav class="navbar navbar-expand-md bg-black navbar-dark fixed-top" style="height: 10vh">
  <a class="navbar-brand" href="#">
    <img src="../img/RenzmerMusic-Cover.png" alt="logo" style="width:40px;">
  </a>

  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#">Admin</a>
    </li>
  </ul>
</nav>
<!--Lista de canciones-->

<table class="table table-dark text-white table-hover bg-list list-body ">
    <thead>
      <tr>
      	<th class="sticky" id="control-List"></th>
        <th class="sticky">Cover</th>
        <th class="sticky">Titulo</th>
        <th class="sticky">Artista</th>
      </tr>
    </thead>
    <tbody>
    	<?php 
		$i=0;
		$query = $conexion->query("SELECT * FROM music");
		if($query->num_rows > 0){ 
            while($row = $query->fetch_assoc()){ ?> 
	
      <tr>
          <td class="align-middle text-center" id="control-List2"><a href="#" onclick="setAudio(<?php echo $i?>)"><i class="fa fa-play" id="play-pause2-<?php echo $i?>"></i></a></td>
        <?php echo '<td class="align-middle"><img src="data:image/jpg;base64, '.base64_encode($row['cover']).'" alt="logo" style="width:45px;"></td>'?>
        <td class="align-middle"><?php echo $row['titulo'];?></td>
        <td class="align-middle"><?php echo $row['artista'];?></td>
      </tr>
      <!--?php echo '"data:audio/mp3;base64, '.base64_encode($row['song']).'"'?-->
  <?php $i++;} } ?> 
    </tbody>
  </table>

 
<!--Reproductor-->
<div class="fixed-bottom bg-black R-height border border-secondary border-right-0 border-bottom-0 border-left-0">
	<div class="row R-height">
		<!--Music info-->
		<div class="col-sm-4 d-flex flex-wrap align-content-center" id="M-info">
			<div class="row" id="M-info2">
				<div class="col-sm-12 ml-3">
					<div class="row">
						<div class="ml-2" style="width: 80px;">
                                                    <img id="imgCover" src="../img/RenzmerMusic-Cover.png" alt="logo" style="width:65px;">
						</div>
						<div class="d-flex flex-wrap align-content-center">
							<div >
                                                            <p id="music-Title" class="text-white " style="width: 150px; margin-bottom: 0px;">Titulo de la canción</p><!--Max 20 caracteres-->
                                                            <p id="music-Artist" class="text-white " style="font-size: 12px; margin-bottom: 0px;">Artista</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--Controles-->
		<div class="col d-flex flex-wrap align-content-center justify-content-center">
			<div class="row" id="controlBox">
				<div class="col-sm-12 " id="controles">
                                        <a href="#" class="min mx-3" onclick="activarRandom()"><i class="fa fa-random"></i></a>
                                        <a href="#" class="min mx-3" onclick="previous()"><i class="fa fa-step-backward"></i></a>
					<a href="#" class="max mx-3"><i class="fa fa-play-circle" id="play-pause"></i></a>
                                        <a href="#" class="min mx-3" onclick="next()"><i class="fa fa-step-forward"></i></a>
                                        <a href="#" class="min mx-3" onclick="activarRepe()"><i class="fa fa-refresh"></i></a>
				</div>
                            <div class="mt-1" id="barra" >
					<div id="progreso"></div>
				</div>
					<div class="d-flex justify-content-between" style="width: 100%;">
					<div class="pro text-white" style="font-size: 13px;">0:00</div>
					<div class="dur text-white" style="font-size: 13px;">0:00</div>
					</div>
			</div>
		</div>
		<!--Volumen-->
		<div class="col-sm-4 d-flex flex-wrap align-content-center justify-content-center" id="vol"></div>
	</div>
</div>

</body>
<script src="../js/audio.js"></script>
</html>