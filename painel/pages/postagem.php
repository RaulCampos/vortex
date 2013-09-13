<h2>Cadastrar nova Postagem:</h2>
<?php
	$dia = date('d');
	$mes = date('m');
	$ano = date('Y');
	
	date_default_timezone_set('America/Sao_Paulo');

?>
<div id="msgs">
	<form method="post" enctype="multipart/form-data">
		<span>Titulo:</span><br><input type="text" name="titulo"><br /><br />
		<span>Titulo Original:</span><br><input type="text" name="titulo_original"><br /><br />
    	<span>Ano:</span><br><input type="text" name="ano"><br /><br />
    	<span>Duração:</span><br><input type="text" name="duracao"><br /><br />
    	<span>Idioma:</span><br><input type="text" name="idioma"><br /><br />
    	<span>Legenda:</span><br><input type="text" name="legenda"><br /><br />
    	<span>Formato do Video:</span><br><input type="text" name="video"><br /><br />
    	<span>Direção:</span><br><input type="text" name="direcao"><br /><br />
    	<span>Pais de Origem:</span><br><input type="text" name="pais_orig"><br /><br />
    	<span>Elenco:</span><br><input type="text" name="elenco"><br /><br />
    	<span>Genero:</span><br><input type="text" name="genero"><br /><br />
    	<span>Data de adição:</span><br><input type="text" name="data" value="<?php echo $dia.'/'.$mes.'/'.$ano; ?>"><br /><br />
        <span>Capa:</span><br /><input type="file" name="img" /><br /><br />
        <span>Banner:</span><br /><input type="file" name="banner" /><br /><br />
        <input type="hidden" value="cadastrar" name="acao" />
    	<span>Sinopse:</span><br><textarea name="sinopse" cols="63" rows="20"></textarea><br /><bR />
        <input type="submit" value="Cadastrar Postagem" class="btn" />
	</form>
    
<?php
	if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){
		$legenda = utf8_decode(trim(ucfirst($_POST['legenda'])));
		$genero = utf8_decode(trim(ucfirst($_POST['genero'])));
		$video = $_POST['video'];
		$direcao = utf8_decode(trim(ucfirst($_POST['direcao'])));
		$pais_orig = utf8_decode(trim(ucfirst($_POST['pais_orig'])));
		$elenco = utf8_decode(trim(ucwords($_POST['elenco'])));
		$duracao = $_POST['duracao'];
		$idioma = utf8_decode(trim(ucfirst($_POST['idioma'])));
		$titulo_original = utf8_decode(trim(ucfirst($_POST['titulo_original'])));
		$ano = $_POST['ano'];
		$titulo = utf8_decode(trim(ucfirst($_POST['titulo'])));
		$autor = utf8_decode(trim(ucfirst($_SESSION['nome'])));
		$data = trim(ucfirst($_POST['data']));
		$visitas = 0;
		$conteudo = utf8_decode(trim(ucfirst($_POST['sinopse'])));

		$pastaBanner = 'imagens-posts/banners';
		$permiteBanner = array('image/jpg','image/jpeg','image/pjpeg');		
		$imagemBanner = $_FILES['banner'];
		$destinoBanner = $imagemBanner['tmp_name'];
		$nomeImgBanner = $imagemBanner['name'];
		$tipoBanner = $imagemBanner['type'];

		$pasta = 'imagens-posts/capas';
		$permite = array('image/jpg','image/jpeg','image/pjpeg');		
		$imagem = $_FILES['img'];
		$destino = $imagem['tmp_name'];
		$nomeImg = $imagem['name'];
		$tipo = $imagem['type'];
		
		require('funcao.php');
		
		if(empty($titulo) || empty($autor) || empty($data) || empty($conteudo)){
			
			echo '<script>alert("Preencha todos os Campos !");</script>';
			
		}else{
			
			if(!empty($nome) && in_array($tipo, $permite)){
				
				upload($destino, $nomeImg, $pasta);
				upload($destinoBanner, $nomeImgBanner, 975, $pastaBanner);
				
				$insereDados = mysql_query("INSERT INTO filmes (titulo, titulo_original, ano, duracao, idioma, legenda, formato_imagem, banner, formato_video, direcao, pais_origem, elenco, sinopse, data_adicao, visitas, genero) VALUES ('$titulo','$titulo_original','$ano','$duracao','$idioma', '$legenda','$nomeImg', '$nomeImgBanner' ,'$video','$direcao','$pais_orig', '$elenco', '$conteudo', '$data','$visitas', '$genero')");	
				echo '<script>alert("Postagem Enviada com Sucesso !");</script>';
			}else{
				echo "Aceitamos apenas imagens no formato JPEG";
			
			}
		}
	}
?>
</div>