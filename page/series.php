<?php

?>
<div id="left">
	
<?php	

	$pegaId = $_GET['id'];
	$selecionaFilm = mysql_query("SELECT * FROM series WHERE id = '$pegaId' LIMIT 1");
	$contaFilms = @mysql_num_rows($selecionaFilm);
	

	if($contaFilms <= 0){
	}else{
		while($linhaTb = mysql_fetch_array($selecionaFilm)){
			$idFilm = $linhaTb['id'];
			
				$idSerie = utf8_encode($linhaTb['id']);
				$serieEpi = utf8_encode($linhaTb['serie']);
				$genero = utf8_encode($linhaTb['genero']);
				$duracao = utf8_encode($linhaTb['duracao']);
				$sinopse = utf8_encode($linhaTb['sinopse']);
				$ano = utf8_encode($linhaTb['ano']);
				$direcao = utf8_encode($linhaTb['direcao']);
				$elenco = utf8_encode($linhaTb['elenco']);
				$pais_orig = utf8_encode($linhaTb['pais_origem']);
				$tipo = utf8_encode($linhaTb['tipo']);

?>
				<div id="infosSeries">
					<div class='img'><img  src="images/serie1.jpg" /></div> 
					<b><h2><i><?php echo $serieEpi; ?> (<?php echo $tipo; ?>)</i></h2></b><hr>
					<?php echo $sinopse; ?><br><Br>
					<a>Elenco:</a> <?php echo $elenco; ?><br>
						<a>Direção:</a> <?php echo $direcao; ?><br>
						<a>Genero:</a> <?php echo $genero; ?><br>
					   <a>Duração:</a> <?php echo $duracao;?> <br>
					   <a>Pais de Origem:</a> <?php echo $pais_orig;?> <br>

				</div>
            
<?php }} ?>
<script type="text/javascript">
$(document).ready(function(){
  $('.temporada1').css('background', '09c');
  $('.temporada1').click(function(){
    $('.temporada1').css('background', '09c');
    $('.temporada2, .temporada3, .temporada4, .temporada5').css('background', 'none');
    $('#conteudo #temporadas .right #temporada1').fadeIn();
    $('#conteudo #temporadas .right #temporada1').css('display', 'block');
    $('#conteudo #temporadas .right #temporada2').css('display', 'none');
  });
  $('.temporada2').click(function(){
    $('.temporada2').css('background', '09c');
    $('.temporada1, .temporada3, .temporada4, .temporada5').css('background', 'none');
    $('#conteudo #temporadas .right #temporada2').fadeIn();
    $('#conteudo #temporadas .right #temporada2').css('display', 'block');
    $('#conteudo #temporadas .right #temporada1').css('display', 'none');
  });
});
</script>
<div id="temporadas">
	<div class="left">
		<h4> Temporadas </h4>

		<ul>
			<li class="temporada1"><a >Temporada 1</a></li>
			<li class="temporada2"><a>Temporada 2</a></li>
			<li class="temporada3"><a>Temporada 3</a></li>
			<li class="temporada4"><a>Temporada 4</a></li>
			<li class="temporada5"><a>Temporada 5</a></li>
		</ul>

	</div>
	
	<div class="right">
		<h4> Episodios </h4>
		<ul>
			<div id="temporada1">
			<?php
			
			$selecionaTemporada1 = mysql_query("SELECT * FROM episodios WHERE id_serie = '$pegaId' AND temporada = '01' ORDER BY numero_epi ASC") or die (mysql_error());
			$selecionaTemporada2 = mysql_query("SELECT * FROM episodios WHERE id_serie = '$pegaId' AND temporada = '02' ORDER BY numero_epi ASC") or die (mysql_error());
			$contaTemporadas = @mysql_num_rows($selecionaFilm);
			if($contaTemporadas <= 0){				
			}else{
				while($lnTemporada = mysql_fetch_array($selecionaTemporada1)){	
				$idSerie = $lnTemporada['id'];		
			?>
			
				<li><a href="?single_serie=true&id=<?php echo $idSerie;  ?>"><?php echo $lnTemporada['numero_epi']; ?> - <?php echo utf8_encode($lnTemporada['episodio']); ?> </a></li>
			
			<?php } ?>
			</div>
			<div id="temporada2">
			<?php while($lnTemporada2 = mysql_fetch_array($selecionaTemporada2)){ $idSerie = $lnTemporada2['id']; ?>
			
			<li><a href="?single_serie=true&id=<?php echo $idSerie;  ?>"><?php echo $lnTemporada2['numero_epi']; ?> - <?php echo utf8_encode($lnTemporada2['episodio']); ?> </a></li>
			
			<?php }} ?>
			</div>
		</ul>

	</div>

	</div>
</div>