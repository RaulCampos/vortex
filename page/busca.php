	<link type="text/css" rel="stylesheet" href="CSS/style.css" media="all"/>

<?php
	if(isset($_GET['pag'])){
		$pg = (int)$_GET['pag'];		
	}else{
		$pg = 1;
	}
	$maximo = 3;
	$inicio = ($pg * $maximo) - $maximo;
	
	
	$pesquisado = $_GET['pesquisa'];
	$pesTratar = str_replace('+',' ',$pesquisado);
	$selecionaPosts = mysql_query("SELECT * FROM filmes WHERE titulo LIKE '%$pesTratar%' OR titulo_original LIKE '%$pesTratar%' LIMIT $inicio, $maximo") or die (mysql_error());
	$contaPosts = @mysql_num_rows($selecionaPosts);
	
	if($contaPosts <= 0 || $_GET['pesquisa'] == ''){
	}else{
		while($linhaTb = mysql_fetch_array($selecionaPosts)){
			$idPost = $linhaTb['id'];
?>
   			<div id="post">
   				<a href="?single=true&id=<?php echo $idPost;  ?> "><img src="painel/imagens-posts/<?php echo $linhaTb['formato_imagem']; ?>" title="<?php echo utf8_encode($linhaTb['titulo_original']); ?>"></a>
            	<h2><a href="?single=true&id=<?php echo $idPost;  ?> "><?php echo utf8_encode($linhaTb['titulo']); ?></a>  (<?php echo $linhaTb['ano']; ?>)</h2>
                <h5> Elenco: <?php echo utf8_encode($linhaTb['elenco']); ?> | Exibições: <?php echo $linhaTb['visitas']; ?></h5>
                <a href="?single=true&id=<?php echo $idPost;  ?> "> </a>
                <p><?php echo utf8_encode($linhaTb['sinopse']); ?>
                 </div>
<?php }} ?>
<?php 
	$selecionaSerie = mysql_query("SELECT * FROM series WHERE serie LIKE '%$pesTratar%' LIMIT $inicio, $maximo") or die (mysql_error());
	$contaSeries = @mysql_num_rows($selecionaSerie);
	if($contaSeries <= 0 && $contaPosts <=0 || $_GET['pesquisa'] == ''){
		echo '<h2> Não foram encontrados nenhum resultado para a busca: <a>'.$pesquisado.'</a>'; 
	}else{
		while($linhaSeries = mysql_fetch_array($selecionaSerie)){
			$idSerie = $linhaSeries['id'];
?>
		<div id="post">
   				<a href="?single_series=true&id=<?php echo $idSerie;  ?> "><img src="painel/imagens-posts/<?php echo $linhaSeries['formato_imagem']; ?>" title="<?php echo utf8_encode($linhaSeries['serie']); ?>"></a>
            	<h2><a href="?single_series=true&id=<?php echo $idSerie;  ?> "><?php echo utf8_encode($linhaSeries['serie']); ?></a>  (<?php echo $linhaSeries['ano']; ?>)</h2>
                <h5> Elenco: <?php echo utf8_encode($linhaSeries['elenco']); ?> </h5>
                <a href="?single=true&id=<?php echo $idSerie;  ?> "> </a>
                <p><?php echo utf8_encode($linhaSeries['sinopse']); ?>
        </div>
<?php        
	}
}
 ?>

<div class="paginacao">
<?php
	$selSql = mysql_query("SELECT id FROM filmes WHERE titulo LIKE '%$pesTratar%' ");
	$totalPosts = @mysql_num_rows($selSql);
	
	$pags = ceil($totalPosts/$maximo);
	$links = 2;
	
	if($totalPosts <= $maximo || $_GET['pesquisa'] == ''){
	}else{
	
	echo "<a href=\"?pesquisa=$pesquisado&pag=1\"><< Primeira Página</a>";
	
	for($i = $pg - $links; $i <= $pg - 1; $i ++){
		if($i<=0){}else{
			echo "<a href=\"?pesquisa=$pesquisado&pag=$i\">$i</a>";	
		}	
	}
		
		 echo '<div class="page">'.$pg.'</div>';
		
	for($i = $pg +1; $i <= $pg + $links; $i++){
		if($i > $pags){}else{
			echo "<a href=\"?pesquisa=$pesquisado&pag=$i\">$i</a>";	
		}
	}
	
			echo "<a href=\"?pesquisa=$pesquisado&pag=$pags\">Ultima Página >></a>";
	}
?>
</div>