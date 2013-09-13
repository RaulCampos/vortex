<?php
	include_once('config.php');
	
	session_start();
	
		if(!isset($_SESSION['nome']) || !isset($_SESSION['senha'])){
			header("Location:index.php");	
		}elseif(isset($_GET['acao']) && $_GET['acao'] == 'sair'){
		unset($_SESSION['nome']);
		unset($_SESSION['senha']);
		
		session_destroy();
		header("Location:index.php");	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>;
<script type="text/javascript" src="opcoes.js"></script>;
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciador de Conteudo</title>
<link href="CSS/style.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#ccccccc">
<?php
	$nomeUser = $_SESSION['nome'];
	$senhaUser = $_SESSION['senha'];
	
	$selUser = mysql_query("SELECT * FROM usuarios WHERE nome = '$nomeUser' AND senha = '$senhaUser'");
	while($lnLineUser = mysql_fetch_array($selUser)){
		$nome = $lnLineUser['nome'];
		$senha = $lnLineUser['senha'];
		$tipo = $lnLineUser['tipo'];
	}
?>

<div id="centro">
	
    <div id="topo">
		
        <div id="sair">
     		<a href="?acao=sair">Logout</a>   
        </div>
    
    <i>Bem vindo, </i><?php echo $tipo.": <b> ".$nome."</b><br>"; ?>
    <?php echo date('y,m,Y');?>
    </div>
    
    <div id="topo2">
    	<div id="logo">
        	<a href="#"><img src="../Images/completao.png" alt="Primeiro Site" title="Primeiro Site"></a>
        </div>
        </div>
    <div id="conteudo">
	
    	<div id="esquerda">
    
        	<div id="menu">
            	<ul>
                <li><a href="admin.php?pg=postagem"> Inserir Filme</a></li>
                <li><a href="admin.php?pg=list-edit"> Editar Filme</a></li>
                <li><a href="admin.php?pg=episodio"> Inserir Episodio</a></li>
                <li><a href="admin.php?pg=list-edit-episodio"> Editar Episodio</a></li>
                <li><a href="admin.php?pg=comentarios"> Moderar Comentários</a></li>
                <?php if($tipo == 'admin'){?>
                <li><a href="admin.php?pg=contato"> Moderar Mensagens</a></li>
                 <?php } ?>
                </ul>
            </div>
        </div>
        
        <div id="direita">
        	<?php
            	if(isset($_GET['pg']) && $_GET['pg'] == 'postagem'){
					include('pages/postagem.php');
				}elseif(isset($_GET['pg']) && $_GET['pg'] == 'episodio'){
					include('pages/episodio.php');					
				}elseif(isset($_GET['pg']) && $_GET['pg'] == 'comentarios'){
					include('pages/comentarios.php');
				}elseif(isset($_GET['pg']) && $_GET['pg'] == 'contato'){
					include('pages/contato.php');
				}elseif(isset($_GET['pg']) && $_GET['pg'] == 'list-edit'){
					include('pages/list-edit.php');
				}elseif(isset($_GET['pg']) && $_GET['pg'] == 'editar'){
					include('pages/editar.php');
				}	
			?>
        </div>
     </div>
</div>
<div id="rodape">
	Gerenciador de Conteudo !
    </div>
    </body>
    </html>