<h2>Editar Postagem:</h2>
<?php 
	$pegaId = $_GET['id'];
	$selecionaPostsEditar = mysql_query("SELECT * FROM filmes WHERE id = '$pegaId' LIMIT 1");
	$linha = mysql_fetch_array($selecionaPostsEditar);

		$legenda = utf8_encode($linha['legenda']);
		$genero = utf8_encode($linha['genero']);
		$video = $linha['formato_video'];
		$direcao = utf8_encode($linha['direcao']);
		$pais_orig = utf8_encode($linha['pais_origem']);
		$elenco = utf8_encode($linha['elenco']);
		$duracao = $linha['duracao'];
		$idioma = utf8_encode($linha['idioma']);
		$titulo_original = utf8_encode($linha['titulo_original']);
		$ano = $linha['ano'];
		$titulo = utf8_encode($linha['titulo']);
		$sinopse = utf8_encode($linha['sinopse']);

 ?>

<div id="msgs">
	<form method="post" enctype="multipart/form-data">
		<span>Titulo:</span><br><input type="text" value="<?php echo $titulo; ?>" name="titulo"><br /><br />
        <span>Titulo Original:</span><br><input type="text" value="<?php echo $titulo_original; ?>" name="titulo_original"><br /><br />
    	<span>Ano:</span><br><input type="text" name="ano" value="<?php echo $ano; ?>"><br /><br />
        <span>Imagem:</span><br /><input type="file" name="img" /><br /><br />
        <input type="hidden" value="cadastrar" name="acao" />
    	<span>Sinopse:</span><br><textarea name="sinopse" cols="63" rows="20"><?php echo $sinopse ?></textarea><br /><bR />
        <input type="submit" value="Editar Caracteristicas" class="btn" />
	</form>
    
<?php
	if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){
		$titulo_editado = utf8_decode(trim(ucfirst($_POST['titulo'])));
		$titulo_original_editado = utf8_decode(trim(ucfirst($_POST['titulo_original'])));
		$ano_editado = trim(ucfirst($_POST['ano']));	
		$sinopse_editado = utf8_decode(trim(ucfirst($_POST['sinopse'])));
		
		
		$pasta = 'imagens-posts';
		$permite = array('image/jpg','image/jpeg','image/pjpeg');
		
		$imagem = $_FILES['img'];
		$destino = $imagem['tmp_name'];
		$nomeImg = $imagem['name'];
		$tipo = $imagem['type'];
		
		require('funcao.php');
		
		if(empty($titulo_editado) || empty($titulo_original_editado) || empty($ano_editado) || empty($sinopse_editado)){
			
			echo '<script>alert("Preencha todos os Campos !");</script>';
			
		}else{
			
			if(!empty($nomeImg) && in_array($tipo, $permite)){
				
				upload($destino, $nomeImg, 460, $pasta);
				
				$insereDados = mysql_query("UPDATE filmes SET titulo = '$titulo_editado', sinopse = '$sinopse_editado', formato_imagem = '$nomeImg', titulo_original = '$titulo_original_editado', ano = '$ano_editado' WHERE id = '$pegaId'");	
				echo '<script>alert("Caracteristicas Editadas com Sucesso !");</script>';
			}elseif(empty($nomeImg)){
					$insereDados = mysql_query("UPDATE filmes SET titulo = '$titulo_editado', sinopse = '$sinopse_editado', titulo_original = '$titulo_original_editado', ano = '$ano_editado' WHERE id = '$pegaId'");	
				echo '<script>alert("Caracteristicas Editadas com Sucesso !");</script>';
			}else{
				echo '<script>alert("Aceitamos apenas imagens no formato JPEG !");</script>';
			}
		}
	}
?>
</div>