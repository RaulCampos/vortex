<div id="filmes-varios">
	<?php
		if(isset($_GET['pag'])){
			$pg = (int)$_GET['pag'];		
		}else{
			$pg = 1;
		}
		$maximo = 18;
		$inicio = ($pg * $maximo) - $maximo;

		$selecionaFilm = mysql_query("SELECT * FROM filmes ORDER BY id DESC LIMIT $inicio, $maximo");
		$contaFilm = @mysql_num_rows($selecionaFilm);
		
		if($contaFilm <= 0){
			echo "<h2>Não há nenhuma postagem cadastrada<br><br><br></h2>";
		}else{
	?>
								<div id="topo-varios">
										<h3><a>Ultimos Filmes Adicionados</a></h3>
								<div id="links-varios">
								</div>
								</div>
		<div id="ultimos-filmes-varios">
			<div id="margin">
				<ul>
				<?php while($linhaFilmesVarios = mysql_fetch_array($selecionaFilm)){ $idFilme = $linhaFilmesVarios['id']; ?>
					<li><a href="?single=true&id=<?php echo $idFilme;  ?> "><img src="painel/imagens-posts/capas/<?php echo $linhaFilmesVarios['formato_imagem']; ?>" title="<?php echo utf8_encode($linhaFilmesVarios['titulo']); ?>" alt="<?php echo utf8_encode($linhaFilmesVarios['titulo']); ?>"></a>	</li>
<?php } ?>					
				</ul>
			</div>
				<?php } ?>
		<div class="paginacao">
			<?php
				$selSql = mysql_query("SELECT id FROM filmes") or die(mysql_error());
				$totalFilms = @mysql_num_rows($selSql);
				
				$pags = ceil($totalFilms/$maximo);
				$links = 5;
				
				echo "<a href=\"?pag=1#filmes-varios\"><< Primeira Página</a>";
				
				for($i = $pg - $links; $i <= $pg - 1; $i ++){
					if($i<=0){}else{
						echo "<a href='?pag=$i#filmes-varios'>$i</a>";	
					}	
				}
					
					 echo '<div class="page">'.$pg.'</div>';
					
				for($i = $pg +1; $i <= $pg + $links; $i++){
					if($i > $pags){}else{
						echo "<a href=\"?pag=$i#filmes-varios\">$i</a>";	
					}
				}
				
						echo "<a href=\"?pag=$pags#filmes-varios\">Ultima Página >></a>";
			?>
		</div>
		</div>
</div>