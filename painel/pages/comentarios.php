<h2>Moderar Comentários: </h2>
<?php 
	
		if(isset($_GET['pag'])){
			$pg = (int)$_GET['pag'];		
		}else{
			$pg = 1;
		}
		$maximo = 3;
		$inicio = ($pg * $maximo) - $maximo;

	$selecionaComentarios = mysql_query("SELECT * FROM comentarios_filmes WHERE status = 'nao' ORDER BY id ASC LIMIT $inicio, $maximo");
	$conta = @mysql_num_rows($selecionaComentarios);
			
	if($conta != 0){
		while($lnMsg = mysql_fetch_array($selecionaComentarios)){
		$numidPost = $lnMsg['id_film'];
		
		$selecionaPost1 = mysql_query("SELECT * FROM filmes WHERE id = '$numidPost'");
		$lnPost1 = mysql_fetch_array($selecionaPost1);				
				
?>
    <div id="msgs">
		<h3><?php echo '<b>'.$lnMsg['nome']. '</b><i> Enviou-lhe o seguinte Comentário referente ao post "'.utf8_encode($lnPost1['titulo']).'": </i>';?></h3>
		<p><?php echo $lnMsg['comentario']; ?></p>
        <h5><br>O que deseja fazer com ele? <a href="?pg=comentarios&action=excluir&id=<?php echo $lnMsg['id']; ?>" class="lk">Exclui-lo?</a> ou <a href="?pg=comentarios&action=validar&id=<?php echo $lnMsg['id']; ?>" class="lk2">Valida-lo?</a></h5>
        
	</div>
<?php 
}}else{
	echo "<p>Nenhuma mensagem de Contato</p>" ;
	
}

	if(isset($_GET['action']) && $_GET['action'] == 'excluir'){
		$identifica = $_GET['id'];
		$deleta = mysql_query("DELETE FROM comentarios_filmes WHERE id = '$identifica'");
		echo '<script>alert("Comentário excluido com Sucesso !");</script>';	
	}
	
	if(isset($_GET['action']) && $_GET['action'] == 'validar'){
		$identifica = $_GET['id'];
		$aceitar = mysql_query("UPDATE comentarios_filmes SET status = 'sim' WHERE id = '$identifica'");
		echo '<script>alert("Comentário validado com Sucesso !");</script>';	
	}
?>
<div class="paginacao">
<?php
	$selSql = mysql_query("SELECT id FROM comentarios_filmes");
	$totalPosts = @mysql_num_rows($selSql);
	
	$pags = ceil($totalPosts/$maximo);
	$links = 2;
	
	echo "<a href=\"?pg=comentarios&pag=1\"><< Primeira Página</a>";
	
	for($i = $pg - $links; $i <= $pg - 1; $i ++){
		if($i<=0){}else{
			echo "<a href=\"?pg=comentarios&pag=$i\">$i</a>";	
		}	
	}
		
		 echo '<div class="page">'.$pg.'</div>';
		
	for($i = $pg +1; $i <= $pg + $links; $i++){
		if($i > $pags){}else{
			echo "<a href=\"?pg=comentarios&pag=$i\">$i</a>";	
		}
	}
	
			echo "<a href=\"?pg=comentarios&pag=$pags\">Ultima Página >></a>";
?>
</div>