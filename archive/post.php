<?php
$pid = $_GET["id"];

try {
    $mbd = new PDO('mysql:host=localhost;dbname=db_aqua_projekt', "user", "user");
	$fila = $mbd->query('SELECT * from tb_posts WHERE p_id = '.$pid)->fetch();
	$img = $fila['p_img'];
	$idata = getimagesizefromstring($img);
	$type = $idata["mime"];
	$eimg = base64_encode($img);
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
		          <a class="nav-link" href="">Inicio</a>
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
			<div class="card mb-3">
				<img src="data:<?=$type.';base64,'.$eimg?>" alt="" class="card-img-top" height="384">
				<small class="card-footer">FOTO: <a href="<?=$fila["p_img_ref"]?>"><?=$fila["p_img_ref"]?></a></small>
			</div>
			<h1><?=$fila["p_title"]?></h1>
			<div class="w-75 border border-primary border-2 mb-2"></div>
<?php
$date = $fila["p_date"];

?>
			<div class="text-muted mb-2 ms-2">
				28/04/2023
				<b class="vr text-black mx-1"></b>
				<i class="bi bi-clock"></i> 20:34
			</div>
			<?=$fila["p_content"]?>
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
					<h5 class="card-header">Explorar</h5>
					<div class="card-body" id="explore">
<?php
foreach($mbd->query('SELECT * from tb_posts') as $explore) {
	$img = $explore['p_img'];
	$idata = getimagesizefromstring($img);
	$type = $idata["mime"];
	$eimg = base64_encode($img);
?>
						<a href="Post/<?=$explore['p_id']?>/<?=url_encode($explore['p_title'])?>/" class="btn btn-dark">
							<b><?=$explore['p_title']?></b>
							<hr>
							<p><?=$explore['p_description']?></p>
						</a>
<?php } ?>
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
$mbd = null;
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>