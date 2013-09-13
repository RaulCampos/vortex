
<?php include_once("includes/header.php"); ?>
<?php 
error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP

//If the form is submitted
if(isset($_POST['submitted'])) {
	
	// require a name from user
	if(trim($_POST['contactName']) === '') {
		$nameError =  'Forgot your name!'; 
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}
	
	// need valid email
	if(trim($_POST['email']) === '')  {
		$emailError = 'Forgot to enter in your e-mail address.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
		
	// we need at least some content
	if(trim($_POST['comments']) === '') {
		$commentError = 'You forgot to enter a message!';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}
		
	// upon no failure errors let's email now!
	if(!isset($hasError)) {
		
		$emailTo = 'youremailhere@googlemail.com';
		$subject = 'Submitted message from '.$name;
		$sendCopy = trim($_POST['sendCopy']);
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: ' .' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
        
        // set our boolean completion value to TRUE
		$emailSent = true;
	}
}
?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en" lang="en"> 
<head> 
<title>HTML5/CSS Ajax Contact Form with jQuery</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<link href="styles.css" rel="stylesheet" type="text/css" />
</head>
    <!-- @begin contact -->
	<div id="contact" class="section">
		<div class="container content">
		
	        <?php if(isset($emailSent) && $emailSent == true) { ?>
                <p class="info">Your email was sent. Huzzah!</p>
            <?php } else { ?>
            
				<div class="desc">
					<h2>Contate-nos</h2>
					
					<p class="desc">Porfavor, ultilize o formulário de contato para enviarnos informações ulteis ! .</p>
				</div>
				
				<div id="contact-form">
					<?php if(isset($hasError) || isset($captchaError) ) { ?>
                        <p class="alert">Error submitting the form</p>
                    <?php } ?>
				
					<form id="contact-us" action="" method="post">
						<div class="formblock">
							<label class="screen-reader-text">Nome</label>
							<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="txt requiredField" placeholder="Seu Nome..." />
							<?php if($nameError != '') { ?>
								<br /><span class="error"><?php echo $nameError;?></span> 
							<?php } ?>
						</div>
                        
						<div class="formblock">
							<label class="screen-reader-text">Email</label>
							<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="txt requiredField email" placeholder="Seu@email.com" />
							<?php if($emailError != '') { ?>
								<br /><span class="error"><?php echo $emailError;?></span>
							<?php } ?>
						</div>
                        
						<div class="formblock">
							<label class="screen-reader-text">Messagem</label>
							 <textarea name="comments" id="commentsText" class="txtarea requiredField" placeholder="Messagem..."><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							<?php if($commentError != '') { ?>
								<br /><span class="error"><?php echo $commentError;?></span> 
							<?php } ?>
						</div>
							<button name="submit" type="submit" class="subbutton">Enviar</button>
							<input type="hidden" name="submitted" id="submitted" value="true" />
							<input type="hidden" value="env" name="acao" />
					</form>			
				</div>
				
			<?php } ?>
		</div>
    </div><!-- End #contact -->
    	<?php 
		if(isset($_POST['submitted'])){
			$nome = trim(strip_tags(ucwords($_POST['contactName'])));
			$email = strip_tags($_POST['email']);
			$msg = strip_tags(ucfirst($_POST['comments']));	
			
			if(empty($nome) || empty($email) || empty($msg)){
			
			}elseif(!preg_match("/^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\-]+\.[a-z]{2,4}$/i",$email)){
			
			}else{
				$insereDados = mysql_query("INSERT INTO contato (nome, email, msg) VALUES ('$nome','$email','$msg')");
				$conta = @mysql_num_rows($insereDados);
				echo '<script>alert("Mensagem Enviada com Sucesso !");</script>';

			}
		}
	?>
	
<script type="text/javascript">
	<!--//--><![CDATA[//><!--
	$(document).ready(function() {
		
		$('form#contact-us').submit(function() {

			$('form#contact-us .error').remove();
			var hasError = false;
			$('.requiredField').each(function() {
				if($.trim($(this).val()) == '') {
					var labelText = $(this).prev('label').text();
					$(this).parent().append('<span class="error">Campo Obrigatório ('+labelText+').</span>');
					$(this).addClass('inputError');
					hasError = true;
				} else if($(this).hasClass('email')) {
					var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
					if(!emailReg.test($.trim($(this).val()))) {
						var labelText = $(this).prev('label').text();
						$(this).parent().append('<span class="error">Desculpe, '+labelText+' inválido.</span>');
						$(this).addClass('inputError');
						hasError = true;
					}
				}
			});
			if(!hasError) {
				var formInput = $(this).serialize();
				$.post($(this).attr('action'),formInput, function(data){

					$('#contact').slideUp("fast", function() {
						$(this).before('<div id="contact"><p class="tick"><strong>Obrigado pela Participação !</strong> Sua Mensagem foi enviada com Sucesso !</p></div>');
					});
				});
			}
			
			return false;	
		});
	});
	//-->!]]>
</script>