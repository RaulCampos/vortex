<?php
	include_once('config.php');
	
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Painel de Administração</title>
<link href="CSS/style.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#CCCCCCCC">
<div id="boxLogin">
	<h2>Painel de Administração</h2>
    <div id="boxLoginCenter">
    	<form action="" method="post" enctype="multipart/form-data">
		<span>Usuário:</span> <br /> <input type="text" name="nome" maxlength="200" /><br /><br />
    	<span>Senha:</span> <br /> <input type="password" name="senha" maxlength="200"/><br />	<br />
    	<input type="hidden" name="acao" value="logar" />
        <input type="submit" value="Logar" class="btn"; />
        </form>
	</div>
    <?php
		if(isset($_POST['acao']) && $_POST['acao'] == 'logar'){
			$nome = $_POST['nome'];
			$senha = $_POST['senha'];
			
			if(empty($nome) || empty($senha)){
				echo '<script>alert("Preencha todos os Campos");</script>';		
			
			}else{
				$selecionaUsuario = mysql_query("SELECT * FROM usuarios WHERE nome='$nome' AND senha='$senha' ");
				$conta = @mysql_num_rows($selecionaUsuario);
				
				if($conta <= 0){
					echo '<script>alert("Usuário ou Senha incorretos.");</script>';
					
				}else{
					while($lnUser = mysql_fetch_array($selecionaUsuario)){
						$_SESSION['nome'] = $lnUser['nome'];
						$_SESSION['senha'] = $lnUser['senha'];	
						
						echo '<script>location.href="admin.php";</script>';
					}
				}
			}
						
		}
	?>
</div>
 

</body>
</html>