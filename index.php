<?php include_once("includes/header.php"); ?>
<?php
	$permite = array('contato', 'filmes'); 
	
	if(isset($_GET['pesquisa']) && $_GET['pesquisa'] != ''){
		include('page/busca.php');
	}elseif(isset($_GET['serie']) && $_GET['serie'] != ''){
		include('page/series.php');	
	}elseif(isset($_GET['single']) && $_GET['single'] != ''){
		include('page/single.php');
	}elseif(isset($_GET['single_serie']) && $_GET['single_serie'] != ''){
	include('page/single_serie.php');
	}elseif(!isset($_GET['page']) || $_GET['page'] == ''){
		include('home.php');	
	}elseif(isset($_GET['page']) && in_array($_GET['page'], $permite)){
		include('page/'.$_GET['page'].'.php');	
	}else{
		include('page/erro.php');
	}
?>
<?php include_once("includes/rodape.php"); ?>