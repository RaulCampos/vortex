<h2>Cadastrar novo Episodio:</h2>
<?php
	
	$dia = date('d');
	$mes = date('m');
	$ano = date('Y');
	
	date_default_timezone_set('America/Sao_Paulo');

?>
<div id="msgs">
	<form method="post" enctype="multipart/form-data">
		<span>Série:</span><br>
		<select name="series">
			<option value="0" selected="selected">Selecione A Série...</option>
			<?php 
				$selSeries = "SELECT * FROM series ORDER BY id DESC";
				$qrSeries = mysql_query($selSeries);
				while($linhaSerie = mysql_fetch_array($qrSeries)){
				?>
					<option value="<?php  echo $linhaSerie['id'];?>"> 
					<?php echo $linhaSerie['serie']; ?> </option>
					
				<?php } ?>
		</select><br><br>
		<span>Serie:</span><br><input type="text" name="serie_nome"><br /><br />
		<span>Temporada:</span><br><input type="text" name="temporada"><br /><br />
    	<span>Episodio Nome:</span><br><input type="text" name="episodio_nome"><br /><br />
    	<span>Episodio Nº:</span><br><input type="text" name="episodio_n"><br /><br />
    	<span>Duração:</span><br><input type="text" name="duracao"><br /><br />
    	<span>Idioma:</span><br><input type="text" name="idioma"><br /><br />
    	<span>Legenda:</span><br><input type="text" name="legenda"><br /><br />
    	<span>Formato do Video:</span><br><input type="text" name="video"><br /><br />
    	<span>Genero:</span><br><input type="text" name="genero"><br /><br />
    	<span>Data de adição:</span><br><input type="text" name="data" value="<?php echo $dia.'/'.$mes.'/'.$ano; ?>"><br /><br />
        <span>Imagem:</span><br /><input type="file" name="img" /><br /><br />
        <input type="hidden" value="cadastrar" name="acao" />
        <input type="submit" value="Cadastrar Postagem" class="btn" />
	</form>
    
<?php
	if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){
		$id_serie = $_POST['series'];
		
		$serie_nome = trim(ucfirst($_POST['serie_nome']));
		$temporada = $_POST['temporada'];
		$epi_name = utf8_decode(trim(ucfirst($_POST['episodio_nome'])));
		$epi_n = utf8_decode($_POST['episodio_n']);
		$video = $_POST['video'];
		$legenda = utf8_decode($_POST['legenda']);
		$genero = trim(ucfirst($_POST['genero']));
		$video = $_POST['video'];
		$duracao = $_POST['duracao'];
		$idioma = utf8_decode(trim(ucfirst($_POST['idioma'])));
		$data = trim(ucfirst($_POST['data']));
		$visitas = 0;
		
		
		
		$pasta = 'imagens-posts';
		$permite = array('image/jpg','image/jpeg','image/pjpeg');		
		$imagem = $_FILES['img'];
		$destino = $imagem['tmp_name'];
		$nomeImg = $imagem['name'];
		$tipo = $imagem['type'];
		
		require('funcao.php');
		
		if(empty($epi_name) || empty($epi_n) || empty($genero) || empty($serie_nome)){
			
			echo '<script>alert("Preencha todos os Campos !");</script>';
			
		}else{
			
			if(!empty($nome) && in_array($tipo, $permite)){
				
				upload($destino, $nomeImg, 460, $pasta);
				
				$insereDados = "INSERT INTO episodios (id_serie, serie, temporada, episodio, idioma, legenda, formato_imagem, formato_video, data_adicao, visitas, genero, duracao, numero_epi) VALUES ('$id_serie', '$serie_nome', '$temporada', '$epi_name', '$idioma', '$legenda', '$nomeImg' , '$video', '$data', '$visitas', '$genero', '$duracao', '$epi_n')";
				$query = mysql_query($insereDados) or die(mysql_error());
				echo $id_serie, $serie_nome, $temporada, $epi_name, $epi_n, $video, $legenda, $genero, $video, $duracao, $idioma, $data, $visitas;
			}else{
				echo "Aceitamos apenas imagens no formato JPEG";
			
			}
		}
	}
?>
</div>