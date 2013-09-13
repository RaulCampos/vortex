<h2>Mensagens de Contatos: </h2>
<?php 
	
		if(isset($_GET['pag'])){
			$pg = (int)$_GET['pag'];		
		}else{
			$pg = 1;
		}
		$maximo = 10;
		$inicio = ($pg * $maximo) - $maximo;
		
	if($tipo == 'admin'){
	$selecionaPosts = mysql_query("SELECT * FROM filmes ORDER BY id ASC");
	$conta = @mysql_num_rows($selecionaPosts);
	}else{$selecionaPosts = mysql_query("SELECT * FROM filmes WHERE autor = '$nome' ORDER BY id ASC LIMIT $inicio, $maximo");
		  $conta = @mysql_num_rows($selecionaPosts);
	}
		
		
	if($conta != 0){
		while($lnMsg = mysql_fetch_array($selecionaPosts)){
						
				
?>
    <div id="msgs">
		<h3><?php echo '<b>'.utf8_encode($lnMsg['titulo']).'</b> ('.$lnMsg['titulo_original']. ') Adicionado no dia: '.$lnMsg['data_adicao'].'</i>'; ?></h3>
        <a href="admin.php?pg=editar&id=<?php echo $lnMsg['id'];?>" class="lk">Editar Caracteristicas do Filme</a>
	</div>
<?php 
}}else{
	echo "<p>Nenhuma mensagem de Contato</p>" ;
	
}

	if(isset($_GET['action']) && $_GET['action'] == 'excluir'){
		$identifica = $_GET['id'];
		$deleta = mysql_query("DELETE FROM contato WHERE id = '$identifica'");
		echo '<script>alert("Mensagem deletada com sucesso !");</script>';	
	}
?>
<div class="paginacao">
<?php
	$selSql = mysql_query("SELECT id FROM postagens");
	$totalPosts = @mysql_num_rows($selSql);
	
	$pags = ceil($totalPosts/$maximo);
	$links = 2;
	
	echo "<a href=\"?pg=list-edit&pag=1\"><< Primeira Página</a>";
	
	for($i = $pg - $links; $i <= $pg - 1; $i ++){
		if($i<=0){}else{
			echo "<a href=\"?pg=list-edit&pag=$i\">$i</a>";	
		}	
	}
		
		 echo '<div class="page">'.$pg.'</div>';
		
	for($i = $pg +1; $i <= $pg + $links; $i++){
		if($i > $pags){}else{
			echo "<a href=\"?pg=list-edit&pag=$i\">$i</a>";	
		}
	}
	
			echo "<a href=\"?pg=list-edit&pag=$pags\">Ultima Página >></a>";
?>
</div>