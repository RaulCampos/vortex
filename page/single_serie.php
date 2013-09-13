<div id="left">
	
<?php	

	$pegaId = $_GET['id'];
	$selecionaFilm = mysql_query("SELECT * FROM episodios WHERE id = '$pegaId' LIMIT 1");
	$contaFilms = @mysql_num_rows($selecionaFilm);
	

	if($contaFilms <= 0){
		echo "<p>Não há nenhuma postagem cadastrada</p>";
	}else{
		while($linhaTb = mysql_fetch_array($selecionaFilm)){
			$idFilm = $linhaTb['id'];
			
				$idSerie = utf8_encode($linhaTb['id']);
				$serieEpi = utf8_encode($linhaTb['serie']);
				$temporada = utf8_encode($linhaTb['temporada']);
				$episodio = utf8_encode($linhaTb['episodio']);
				$idioma = utf8_encode($linhaTb['idioma']);
				$legenda = utf8_encode($linhaTb['legenda']);
				$genero = utf8_encode($linhaTb['genero']);
				$duracao = utf8_encode($linhaTb['duracao']);
				$numeroEpi = utf8_encode($linhaTb['numero_epi']);
?>
				<div id="infosFilmes">
					<img  src="images/serie1.jpg" />
					<h2><a><b><?php echo $episodio; ?></b></a></h2> 
					<b><i><?php echo $serieEpi; ?></i></b><hr>
						<a>Genero:</a> <?php echo $genero; ?><br>
					   <a>Idioma:</a> <?php echo $idioma; ?><br>
					   <a>Legenda:</a> <?php echo $legenda;?><br>
					   <a>Duração:</a> <?php echo $duracao;?> <br><hr> 
						<b>Temporada:</b> <?php echo $temporada ?> <br> 
						<b>Episodio:</b> <?php echo $numeroEpi; ?><br> 
				</div>
   			<div id="post2">
            	<h1><a href="#"><?php echo utf8_encode($linhaTb['episodio']); ?> (<?php echo utf8_encode($linhaTb['serie']) ?>)</a></h1>
					<div id="frame">
						<?php echo $linhaTb['formato_video']; ?>
					</div>
			</div>
            
<?php }} ?>
<div id="comentariosStil">
	<h2>Comentários:<canvas width="120" height="24" style=" margin-left: 1px; display:block; border: 0px;"></canvas></h2>
</div>
<div id="mostracoments2">
<?php
	$atualizaVisualizacoes = mysql_query("UPDATE episodios SET visitas = visitas +1 WHERE id = '$idFilm'");
	$selecionaComents = mysql_query("SELECT * FROM comentarios_series WHERE id_film = '$idFilm' AND status = 'sim'");
	$contaComents = @mysql_num_rows($selecionaComents);
	
	if($contaComents <=0){
		echo "<span class='span'>Seja o Primeiro a Comentar ! <i>(Sujeito à Moderação)</i></span>";
	}else{
		while($lnSelDados = mysql_fetch_array($selecionaComents)){
		
		$nmUser = $lnSelDados['nome'];	
		$comUser = $lnSelDados['comentario'];
		$dataUser = $lnSelDados['data'];		
 ?>
<div id="mostra_coments">
	<img class="normalimg"src="Images/user.png" alt="<?php echo $nmUser; ?>" title="<?php echo $nmUser; ?>" />
	<h3><?php echo "<b>".$nmUser."</b>, comentou no dia: ".$dataUser; ?></h3>
	<p><?php echo $comUser; ?></p>
	<img class="aligncenter" title="" alt="" src="Images/UnderLine-v2.png" width="1000" height="10">
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
				$inserirComentarios = mysql_query("INSERT INTO comentarios_series (id_film, email, nome, comentario, data, status) VALUES ('$idFilm','$email','$nome','$comentario','$data','$status')" );
				echo '<script>alert("Comentário enviado com Sucesso (Sujeito à Moderação) !")</script>';
			}elseif(empty($email)){
				$status = 'nao';
				$inserirComentarios = mysql_query("INSERT INTO comentarios_series (id_film, email, nome, comentario, data, status) VALUES ('$idFilm','$email','$nome','$comentario','$data','$status')" );
				echo '<script>alert("Comentário enviado com Sucessu (Sujeito à Moderação) !")</script>';	

			}else{
				echo "<script>alert('Email Invalido !');</script>";	
			}
		}
	}
?>
</div>
</div>