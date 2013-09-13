<?php include ("conn.php") ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Sistema de votação simples com PHP/JQuery/AJAX</title>
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>

<script type="text/javascript">
$(function($) {
    // Quando clicando em uma imagem da div que tem CLASS = frase
    $("div.frase img").click(function() {
        // Recupera o ID da frase que está na propriedade LANG da DIV-PAI da imagem e que tem CLASS = frase
        var id = $(this).parent("div.frase").attr("lang");
        // Recupera o tipo (bom|ruim) que está na propriedade ALT da imagem clicada
        var tipo = $(this).attr("alt");
        // Seleciona o SPAN onde estão os votos
        var votos =  $("div[lang="+id+"] span."+tipo+" span.valor");
        // Seleciona a DIV onde serão colocadas as mensagens
        var status = $("div[lang="+id+"] div.status");
        
        // Mensagem de carregando
        status.html("<img src='imagens/loader.gif' alt='Carregando...' />");
        
        // Faz a requisição AJAX
        $.post("ajax/votar.php", {id: id, tipo: tipo}, function(resposta) {
            // Se houver uma mensagem na resposta, exibe a mensagem
            if (resposta) 
            {
                status.html(resposta);
            } 
            // Quando a resposta for FALSE 
            else 
            {
                // Incrementa mais um aos votos
                votos.html(parseInt(votos.html()) + 1);
                // Mensagem de sucesso
                status.html("Obrigado por votar!");
            }
        });

    }); 
});
</script>

<style type="text/css">
body {
    font-family: "Trebuchet MS";
    font-size: 12px;
    margin-left: 15px;
}

h1 {
    font-size: 16px;
    border-bottom: 1px dashed #CCC;
}

div.frase {
    margin-bottom: 15px;
}

div.frase span.bom {
    color: green;
}

div.frase span.ruim {
    color: red;
}

div.frase img {
    vertical-align: bottom;
    cursor: pointer;
}

div.frase div.status {
    color: #999;
}
</style>

</head>

<body>
<h1>Sistema de votação simples com PHP/JQuery/AJAX</h1>

<?php
// Selecionando todas as frases
$query = mysql_query("SELECT * FROM filmes ORDER BY id DESC");
// Passando frase por frase
while ($frase = mysql_fetch_object($query)):
?>

<div class="frase" lang="<?php echo $frase->id; ?>">
    <div class="texto"><?php echo $frase->titulo; ?></div>
    
    <img src="imagens/bom.png" alt="bom" />
    <span class="bom">
        (<span class="valor"><?php echo $frase->pontos; ?></span>)
    </span>
    
    <img src="imagens/ruim.png" alt="ruim" />
    <span class="ruim">
        (<span class="valor"><?php echo $frase->votos; ?></span>)
    </span>
    
    <div class="status"></div>
</div>

<?php endwhile; ?>
</body>
</html>