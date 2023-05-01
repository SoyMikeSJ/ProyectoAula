<?php
try {
    $mbd = new PDO('mysql:host=localhost;dbname=db_aqua_projekt', "user", "user");
?>
<!DOCTYPE html>
<html lang="es_MX">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<base href="/">
	<link rel="stylesheet" href="css/styles.css?v=1">
	<link rel="stylesheet" href="res/bootstrap/icons-1.10.5/font/bootstrap-icons.css">
	<link href="res/bootstrap/css/bootstrap.css" rel="stylesheet">
	<script src="res/bootstrap/js/bootstrap.bundle.js"></script>
	<title>Proyecto Aula 2IM5</title>
</head>
<body style="background-color: #f7f5ff;">
	<header style="background-color: #edf4ff;">
		<nav class="container navbar navbar-expand-lg" style="background-color: #edf4ff;">
		  <div class="container-fluid">
		    <a class="navbar-brand fs-4" href="#">Proyecto Aula</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarSupportedContent">
		      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
		        <li class="nav-item">
		          <a class="nav-link active" aria-current="page">Inicio</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="#">Link</a>
		        </li>
		        <li class="nav-item dropdown">
		          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		            Dropdown
		          </a>
		          <ul class="dropdown-menu">
		            <li><a class="dropdown-item" href="#">Action</a></li>
		            <li><a class="dropdown-item" href="#">Another action</a></li>
		            <li><hr class="dropdown-divider"></li>
		            <li><a class="dropdown-item" href="#">Something else here</a></li>
		          </ul>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link disabled">Disabled</a>
		        </li>
		      </ul>
		    </div>
		      <div class="d-flex">
				<small class="ps-2 float-end m-0 fw-bold pt-4">CECyT No. 14 <i class="me-2">"Luis Enrique Erro"</i></small>
				<div class="position-relative">
					<img src="res/img/Banderin.png" height="67">
					<img src="res/img/EscudoCECyT14.png" alt="Logo CECyT 14" height="60" align="middle" class="position-absolute" style="right: 2.5px; top: 2.5px;">
				</div>
		      </div>
		  </div>
		</nav>
	</header>

	<main class="container mt-5 m-auto row">
		<article class="col">
				<h3 class="">Explorar</h3>
				<hr>
				<div class="card">
					<div id="Carousel" class="carousel slide">
					  <div class="carousel-inner">
<?php
$first = "active";
foreach($mbd->query('SELECT * from tb_posts') as $fila) {
	$img = $fila['p_img'];
	$idata = getimagesizefromstring($img);
	$type = $idata["mime"];
	$eimg = base64_encode($img);
?>
					    <a class="carousel-item <?=$first?>" style="max-height: 300px; overflow: hidden;">
							<img src="data:<?=$type.';base64,'.$eimg?>" class="d-block" width="100%">
							<div class="carousel-caption d-none d-md-block rounded px-2" style="background-color: rgba(0,0,0,0.6);">
								<h5><?=$fila['p_title']?></h5>
								<small><?=$fila['p_description']?></small>
							</div>
					    </a>
<?php  $first = ""; } $mbd = null; ?>
					  </div>
					  <button class="carousel-control-prev btn btn-dark rounded-0" type="button" data-bs-target="#Carousel" data-bs-slide="prev">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="visually-hidden">Previous</span>
					  </button>
					  <button class="carousel-control-next btn btn-dark rounded-0" type="button" data-bs-target="#Carousel" data-bs-slide="next">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="visually-hidden">Next</span>
					  </button>
					</div>
				</div>
		</article>

		<aside class="col-0 col-lg-4">
			<div>
				<div class="card mb-3">
					<h5 class="card-header">Búsqueda</h5>
					<div class="card-body">
				      <form class="d-flex btm-group" role="search">
				        <input class="form-control me-0 rounded-end-0" type="search" placeholder="Escribe algo..." aria-label="Buscar">
				        <button class="btn btn-outline-success rounded-start-0" type="submit"><i class="bi bi-search"></i></button>
				      </form>
					</div>
				</div>


				<div class="card mb-3">
					<h5 class="card-header">Acerca de</h5>
					<div class="card-body">
				      
					</div>
				</div>
			</div>
		</aside>
	</main>
	<br class="user-select-none"><br class="user-select-none">
	<footer class="w-100 text-center text-white pb-4" style="bottom: 0%; background-color: #edf4ff;">
	  <div class="container pt-4">
	    <div class="align-middle">
	      <a class="btn-guinda m-1" href="#!">CECyT 14</a>
	      <a class="btn-guinda m-1" href="#!">IPN</a>
	      <a class="btn btn-sm btn-info text-dark m-1" href="#!">Fundación Aquae</a>
	      <a class="btn btn-sm btn-success text-dark m-1" href="#!">Naciones Unidas</a>
	    </div>
	  </div>
	  <div class="container"><hr class="text-dark"></div>
	  <small class="text-center text-dark mb-5">
	    MikeSJ © 2023 - todos los derechos reservados.
	  </small>
	</footer>
</body>
</html>

<?php
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>