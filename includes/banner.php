 
<?php 
  $selecionaBanner = mysql_query("SELECT * FROM filmes ORDER BY id DESC LIMIT 8");
  $contaBanner = @mysql_num_rows($selecionaBanner);
  if($contaBanner <= 0 ){

  }else{
?>
 <selection class="slider-wrapper tamanho12">
    	<div id="slider">
        <?php while($lnBanner = mysql_fetch_array($selecionaBanner)){ 
            $banner = $lnBanner['banner'];
            $titulo = $lnBanner['titulo_original'];
            $bannerID = $lnBanner['id'];
          ?>
        	<a href="?single=true&id=<?php echo $bannerID; ?>"><img src="painel/imagens-posts/banners/<?php echo $banner; ?>" alt="<?php echo $titulo; ?>" title="<?php echo $titulo; ?>"></a>
        <?php }} ?>
        </div>
    </selection>        
    
    </div>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="public/js/lib/jquery.nivo.slider.js">  </script>
    <script src="public/js/script.js">  </script>
<div id="conteudo">