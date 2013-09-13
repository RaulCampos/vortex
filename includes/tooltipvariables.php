	<?php
	
	$selecionaFilm = mysql_query("SELECT * FROM filmes ORDER BY id DESC LIMIT 5 ");
	$contaFilms = @mysql_num_rows($selecionaFilm);
	 while($linhaTb = mysql_fetch_array($selecionaFilm)){
					$idFilm = $linhaTb['id'];
					$tituloFilm = utf8_encode($linhaTb['titulo-original']);
					$tituloFilm1 = utf8_encode($linhaTb['titulo']);
					$elencoFilm = utf8_encode($linhaTb['elenco']);
					$dataFilm = $linhaTb['ano'];
					$direcaoFilm = utf8_encode($linhaTb['direcao']);
					$generoFilm = utf8_encode($linhaTb['genero']);
					$idiomaFilm = utf8_encode($linhaTb['idioma']);
					$legendaFilm = utf8_encode($linhaTb['legenda']);
					$sinopseFilm = utf8_encode($linhaTb['sinopse']);
					$duracaoFilm = utf8_encode($linhaTb['duracao']);
					}
	?>