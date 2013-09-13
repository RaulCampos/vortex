<div id="left">
	
<?php	

	$pegaId = $_GET['id'];
	$selecionaFilm = mysql_query("SELECT * FROM filmes WHERE id = '$pegaId' LIMIT 1");
	$contaFilms = @mysql_num_rows($selecionaFilm);
	

	if($contaFilms <= 0){
		echo "<p>Não há nenhuma postagem cadastrada</p>";
	}else{
		while($linhaTb = mysql_fetch_array($selecionaFilm)){
					$idFilm = $linhaTb['id'];
					$idFilm = $linhaTb['id'];
					$idFilm = $linhaTb['id'];
					$tituloFilm = utf8_encode($linhaTb['titulo_original']);
					$tituloFilm1 = utf8_encode($linhaTb['titulo']);
					$elencoFilm = utf8_encode($linhaTb['elenco']);
					$dataFilm = $linhaTb['ano'];
					$direcaoFilm = utf8_encode($linhaTb['direcao']);
					$generoFilm = utf8_encode($linhaTb['genero']);
					$idiomaFilm = utf8_encode($linhaTb['idioma']);
					$legendaFilm = utf8_encode($linhaTb['legenda']);
					$sinopseFilm = limitar(utf8_encode($linhaTb['sinopse']), 400);
					$duracaoFilm = utf8_encode($linhaTb['duracao']);
?>
					<div id="infosFilmes">																										
						<img  src="painel/imagens-posts/capas/<?php echo $linhaTb['formato_imagem']; ?>" />

						<h2><a><?php echo $tituloFilm; ?></a> (<?php echo $dataFilm; ?>)</h2>
						<p><?php echo $sinopseFilm; ?> (...)</p><hr>
						<a>Elenco:</a> <?php echo $elencoFilm; ?> <br><a>Direção:</a> <?php echo $direcaoFilm; ?><hr>
						<a>Genero:</a> <?php echo $generoFilm; ?>   |   <a>Idioma:</a> <?php echo $idiomaFilm; ?>   |   <a>Legenda:</a> <?php echo $legendaFilm;?>  |   <a>Duração:</a> <?php echo $duracaoFilm;?>
																												
					</div>

   			<div id="post2">
            	<h1><a href="#"><?php echo utf8_encode($linhaTb['titulo']); ?></a></h1>
					<div id="frame">
						<?php echo $linhaTb['formato_video']; ?>
					</div>

					<div class='movie_choice'>
    Dê-nos sua opnião sobre esse Filme !
    <div id="<?php echo $pegaId ?>" class="rate_widget">
        <div class="star_1 ratings_stars" title="Horrivel"></div>
        <div class="star_2 ratings_stars" title="Ruim"></div>
        <div class="star_3 ratings_stars" title="Razoável"></div>
        <div class="star_4 ratings_stars" title="Bom"></div>
        <div class="star_5 ratings_stars" title="Muito Bom"></div>
        <div class="total_votes"></div>
    </div>
</div>
			</div>
            
<?php }} ?>
<div id="comentariosStil">
	<h2>Comentários:</h2>
</div>
<div id="mostracoments2">
<?php
	$atualizaVisualizacoes = mysql_query("UPDATE filmes SET visitas = visitas +1 WHERE id = '$idFilm'");
	$selecionaComents = mysql_query("SELECT * FROM comentarios_filmes WHERE id_film = '$idFilm' AND status = 'sim'");
	$contaComents = @mysql_num_rows($selecionaComents);
	
	if($contaComents <=0){
		echo "<span class='span'>Seja o Primeiro a Comentar ! <i>(Sujeito à Moderação)</i></span>";
	}else{
		while($lnSelDados = mysql_fetch_array($selecionaComents)){
		
		$nmUser = $lnSelDados['email'];	
		$comUser = $lnSelDados['comentario'];
		$dataUser = $lnSelDados['data'];		
 ?>
<div id="mostra_coments">
	<img class="normalimg"src="Images/user.png" alt="<?php echo $nmUser; ?>" title="<?php echo $nmUser; ?>" />
	<h3><a><i><?php echo "<b>".$nmUser."</b>, comentou no dia: ".$dataUser; ?></i></a></h3>
	<p><?php echo $comUser; ?></p>
</div>
<?php }} ?>
<?php
	date_default_timezone_set('America/Sao_Paulo');
	
	$dia = date('d');
	$mes = date('m');
	$ano = date('Y');
	
	switch($mes){
		
		case 1:
		$newmes = "Janeiro";
		break;				
		case 2:
		$newmes = "Fevereiro";
		break;		
		case 3:
		$newmes = "Março";
		break;		
		case 4:
		$newmes = "Abril";
		break;
		case 5:
		$newmes = "Maio";
		break;
		case 6:
		$newmes = "Junho";
		break;
		case 7:
		$newmes = "Julho";
		break;
		case 8:
		$newmes = "Agosto";
		break;
		case 9:
		$newmes = "Setembro";
		break;
		case 10:
		$newmes = "Outubro";
		break;
		case 11:
		$newmes = "Novembro";
		break;
		case 12:
		$newmes = "Dezembro";
		break;
	}
?>
<div id="form">
	<form action="" method="post" enctype="multipart/form-data">
	<span>Nome*</span><br><br /><input type="text" name="nome" maxlength="25" placeholder="Seu Nome (...)" /><br /><br />
	<span>Email</span><br><span><i>(Não aparecerá !)</i></span><br><br /><input type="text" name="email" maxlength="25" placeholder="seu@email.com (...)" /><br /><br />
	<span>Comentário*</span><br /><br /><textarea name="msg" maxlength="1000" cols="400" rows="10" placeholder="Digite aqui seu comentário (...)"></textarea><br /><br />
	<input type="submit" class="btn2" value="Enviar Comentário" />
	<input type="hidden" value="<?php echo $dia.' de '.$newmes.' de '.$ano.' as: '.date('H:i'); ?>" name="data" />
	<input type="hidden" value="env-com" name="acao" />
</form>
</div>

<?php 
	if(isset($_POST['acao']) && $_POST['acao'] == 'env-com'){

		$nome = trim(strip_tags(ucwords($_POST['nome'])));
		$email = strip_tags($_POST['email']);
		$comentario = ucfirst(strip_tags(trim($_POST['msg'])));
		$data = $_POST['data'];
		if(empty($nome) || empty($comentario)){
			echo '<script>alert("Preencha todos os Campos Obrigatórios (*) !")</script>';	

		}else{
				
			if(!empty($email) && preg_match("/^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\-]+\.[a-z]{2,4}$/i",$email)){
				$status = 'nao';
				$inserirComentarios = mysql_query("INSERT INTO comentarios_filmes (id_film, email, nome, comentario, data, status) VALUES ('$idFilm','$nome','$email','$comentario','$data','$status')" );
				echo '<script>alert("Comentário enviado com Sucesso (Sujeito à Moderação) !")</script>';
			}elseif(empty($email)){
				$status = 'nao';
				$inserirComentarios = mysql_query("INSERT INTO comentarios_filmes (id_film, email, nome, comentario, data, status) VALUES ('$idFilm','$nome','$email','$comentario','$data','$status')" );
				echo '<script>alert("Comentário enviado com Sucessu (Sujeito à Moderação) !")</script>';	

			}else{
				echo "<script>alert('Email Invalido !');</script>";	
			}
		}
	}
?>
</div>
</div>