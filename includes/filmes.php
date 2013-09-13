
<?php
	
	$selecionaFilm = mysql_query("SELECT * FROM filmes ORDER BY id DESC LIMIT 5");
	$selecionaFilmRanking = mysql_query("SELECT * FROM filmes ORDER BY visitas DESC LIMIT 5");
	$contaFilms = @mysql_num_rows($selecionaFilm);

	if($contaFilms <= 0){
	}else{	
?>

<div id="filmes">
	<div id="topo">
		<div class="titulo">Filmes</div>
		<div id="links">
			<ul class="menu">
			<li><a class= "lancamentos" name="lancamentos">Lançamentos</a></li>
			<li><a class="destaques" name="destaques">Destaques</a></li>
		</ul>
		</div>
	</div>
	
	<div id="ultimos-filmes">
			<ul>	

				<?php while($linhaTb = mysql_fetch_array($selecionaFilm)){
					$idFilm = $linhaTb['id'];
					$tituloFilm = $linhaTb['titulo_original'];
					$idFilm = $linhaTb['id'];
					$tituloFilm = utf8_encode($linhaTb['titulo_original']);
					$tituloFilm1 = utf8_encode($linhaTb['titulo']);
					$elencoFilm = utf8_encode($linhaTb['elenco']);
					$dataFilm = $linhaTb['ano'];
					$direcaoFilm = utf8_encode($linhaTb['direcao']);
					$generoFilm = utf8_encode($linhaTb['genero']);
					$idiomaFilm = utf8_encode($linhaTb['idioma']);
					$legendaFilm = utf8_encode($linhaTb['legenda']);
					$sinopseFilm = utf8_encode($linhaTb['sinopse']);
					$duracaoFilm = utf8_encode($linhaTb['duracao']);
					?>
				<div id="container1">	
				<a id="<h4><a><?php echo $tituloFilm1; ?></a> (<?php echo $dataFilm; ?>)</h4><p><?php echo $sinopseFilm; ?></p><hr><a>Elenco:</a> <?php echo $elencoFilm; ?> <br><a>Direção:</a> <?php echo $direcaoFilm; ?><hr><a>Genero:</a> <?php echo $generoFilm; ?>   |   <a>Idioma:</a> <?php echo $idiomaFilm; ?>   |   <a>Legenda:</a> <?php echo $legendaFilm;?>  |   <a>Duração:</a> <?php echo $duracaoFilm;?>" href="?single=true&id=<?php echo $idFilm;  ?> ">	<div id="canvas">
				<div class="icone"></div>
					<li><img src="painel/imagens-posts/capas/<?php echo $linhaTb['formato_imagem']; ?>" alt="<?php echo utf8_encode($tituloFilm) ?>"></li>
					<div class="canvas"><span><?php echo utf8_encode($tituloFilm) ?></span></div>
				</div></a>
			</div>
			<?php } ?>
			<?php while($linhaTb = mysql_fetch_array($selecionaFilmRanking)){
					$idFilm = $linhaTb['id'];
					$tituloFilm = $linhaTb['titulo_original'];
					$idFilm = $linhaTb['id'];
					$tituloFilm = utf8_encode($linhaTb['titulo_original']);
					$tituloFilm1 = utf8_encode($linhaTb['titulo']);
					$elencoFilm = utf8_encode($linhaTb['elenco']);
					$dataFilm = $linhaTb['ano'];
					$direcaoFilm = utf8_encode($linhaTb['direcao']);
					$generoFilm = utf8_encode($linhaTb['genero']);
					$idiomaFilm = utf8_encode($linhaTb['idioma']);
					$legendaFilm = utf8_encode($linhaTb['legenda']);
					$sinopseFilm = utf8_encode($linhaTb['sinopse']);
					$duracaoFilm = utf8_encode($linhaTb['duracao']);
					?>
			<div id="container2">	
				<a id="<h4><a><?php echo $tituloFilm1; ?></a> (<?php echo $dataFilm; ?>)</h4><p><?php echo $sinopseFilm; ?></p><hr><a>Elenco:</a> <?php echo $elencoFilm; ?> <br><a>Direção:</a> <?php echo $direcaoFilm; ?><hr><a>Genero:</a> <?php echo $generoFilm; ?>   |   <a>Idioma:</a> <?php echo $idiomaFilm; ?>   |   <a>Legenda:</a> <?php echo $legendaFilm;?>  |   <a>Duração:</a> <?php echo $duracaoFilm;?>" href="?single=true&id=<?php echo $idFilm;  ?> ">	<div id="canvas">
				<div class="icone"></div>
					<li><img src="painel/imagens-posts/capas/<?php echo $linhaTb['formato_imagem']; ?>" alt="film1"></li>
					<div class="canvas"><span><?php echo utf8_encode($tituloFilm) ?></span></div>
				</div></a>
			</div>
				<?php }} ?>


			</ul>
	</div>
</div>