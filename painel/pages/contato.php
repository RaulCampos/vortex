<?php if($tipo == 'admin'){ ?>
<h2>Mensagens de Contatos: </h2>
<?php	
	
		if(isset($_GET['pag'])){
			$pg = (int)$_GET['pag'];		
		}else{
			$pg = 1;
		}
		$maximo = 3;
		$inicio = ($pg * $maximo) - $maximo;

	$selecionaContatos = mysql_query("SELECT * FROM contato ORDER BY id ASC LIMIT $inicio, $maximo");
	$conta = @mysql_num_rows($selecionaContatos);
			
	if($conta != 0){
		while($lnMsg = mysql_fetch_array($selecionaContatos)){
						
				
?>
    <div id="msgs">
		<h3><?php echo '<b>'.$lnMsg['nome'].'</b><i>, portador(a) do email: </i><b>'. $lnMsg['email']. '</b><i> Enviou-lhe a seguinte mensagem: </i>'; ?></h3>
		<p><?php echo $lnMsg['msg'] ?></p>
        <a href="?pg=contato&action=excluir&id=<?php echo $lnMsg['id']; ?>" class="lk">Excluir Mensagem</a>
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
	$selSql = mysql_query("SELECT id FROM contato");
	$totalPosts = mysql_num_rows($selSql);
	
	$pags = ceil($totalPosts/$maximo);
	$links = 2;
	
	echo "<a href=\"?pg=contato&pag=1\"><< Primeira Página</a>";
	
	for($i = $pg - $links; $i <= $pg - 1; $i ++){
		if($i<=0){}else{
			echo "<a href=\"?pg=contato&pag=$i\">$i</a>";	
		}	
	}
		
		 echo '<div class="page">'.$pg.'</div>';
		
	for($i = $pg +1; $i <= $pg + $links; $i++){
		if($i > $pags){}else{
			echo "<a href=\"?pg=contato&pag=$i\">$i</a>";	
		}
	}
	
			echo "<a href=\"?pg=contato&pag=$pags\">Ultima Página >></a>";
?>
</div>
<?php }else{ echo "Essa Página não eiste !"; }?>