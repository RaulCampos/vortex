<?php


	$selecionaEpisodio = mysql_query("SELECT * FROM episodios ORDER BY id DESC LIMIT 5");
	$selecionaEpisodioRanking = mysql_query("SELECT * FROM episodios ORDER BY visitas DESC LIMIT 5");
	$contaEpis = @mysql_num_rows($selecionaEpisodio);

	if($contaEpis <= 0){
		echo "não há nenhuma série cadastrada";
	}else{

?>

<div id="filmes">
<div id="topo" >
	<div class="titulo">Séries</div>
	<div id="links">
		<ul>
			<li><a class= "lancamentos-series" name="lancamentos">Lançamentos</a></li>
			<li><a class="destaques-series" name="destaques">Destaques</a></li>
		</ul>
	</div>
</div>
<div id="ultimos-filmes">
	<ul>	
			<?php while($lnEpi = mysql_fetch_array($selecionaEpisodio)){
				$idSerie = utf8_encode($lnEpi['id']);
				$serieEpi = utf8_encode($lnEpi['serie']);
				$temporada = utf8_encode($lnEpi['temporada']);
				$episodio = utf8_encode($lnEpi['episodio']);
				$idioma = utf8_encode($lnEpi['idioma']);
				$legenda = utf8_encode($lnEpi['legenda']);
				$genero = utf8_encode($lnEpi['genero']);
				$duracao = utf8_encode($lnEpi['duracao']);
				$numeroEpi = utf8_encode($lnEpi['numero_epi']);

			 ?>
			 <div id="container-series1">
			<a id= "<h4><a><b><?php echo $episodio; ?></b></a></h4> <b><?php echo $serieEpi; ?></b><hr><a>Genero:</a> <?php echo $genero; ?>   |   <a>Idioma:</a> <?php echo $idioma; ?>   |   <a>Legenda:</a> <?php echo $legenda;?>  |   <a>Duração:</a> <?php echo $duracao;?> <br><hr> <b>Temporada:</b> <?php echo $temporada ?>  <b>Episodio:</b> <?php echo $numeroEpi; ?>" href="?single_serie=true&id=<?php echo $idSerie;  ?> ">
			<div id="canvas">
				<div class="icone"></div>
					<li><img src="painel/imagens-posts/capas/<?php echo $lnEpi['formato_imagem']; ?>" alt="Serie1"></li>
					<div class="canvas">
					<span id="series_span" ><?php echo $episodio; ?></span>
					</div>
		</div></a>	
	</div>
		<?php } ?>	
			<?php while($lnEpi = mysql_fetch_array($selecionaEpisodioRanking)){
				$idSerie = utf8_encode($lnEpi['id']);
				$serieEpi = utf8_encode($lnEpi['serie']);
				$temporada = utf8_encode($lnEpi['temporada']);
				$episodio = utf8_encode($lnEpi['episodio']);
				$idioma = utf8_encode($lnEpi['idioma']);
				$legenda = utf8_encode($lnEpi['legenda']);
				$genero = utf8_encode($lnEpi['genero']);
				$duracao = utf8_encode($lnEpi['duracao']);
				$numeroEpi = utf8_encode($lnEpi['numero_epi']);

			 ?>
			 <div id="container-series2">
			 <a id= "<h4><a><b><?php echo $episodio; ?></b></a></h4> <b><?php echo $serieEpi; ?></b><hr><a>Genero:</a> <?php echo $genero; ?>   |   <a>Idioma:</a> <?php echo $idioma; ?>   |   <a>Legenda:</a> <?php echo $legenda;?>  |   <a>Duração:</a> <?php echo $duracao;?> <br><hr> <b>Temporada:</b> <?php echo $temporada ?>  <b>Episodio:</b> <?php echo $numeroEpi; ?>" href="?single_serie=true&id=<?php echo $idSerie;  ?> ">
			<div id="canvas">
				<div class="icone"></div>
					<li><img src="painel/imagens-posts/capas/<?php echo $lnEpi['formato_imagem']; ?>" alt="Serie1"></li>
					<div class="canvas">
					<span id="series_span" ><?php echo $episodio; ?></span>
					</div>
		</div></a>

		</div>	
		<?php }} ?>	
	</ul>
</div>
</div>