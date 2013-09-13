<?php
	function limitar($txt, $limita = 100, $limpar = true){
		if($limpar=true){
			$txt = strip_tags($txt);				
		}
		
		if(strlen($txt) <= $limita){
			return $txt;	
		}
		
		$limita_txt = substr($txt, 0, $limita);
		$ultimo = strrpos($limita_txt, ' ');
		
		return substr($txt,0,$ultimo);	
	}
?>