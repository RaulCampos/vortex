<?php 
	include_once("config.php");
	include("funcoes.php");

?>
<!DOCTYPE html>
<html lang="pt-BR">	
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title> Vortex </title>  
<!-- CSS files -->
<link type="text/css" rel="stylesheet" href="public/css/style.css" media="all"/>
<link type="text/css" rel="stylesheet" href="CSS/style.css" media="all"/>
<link type="text/css" rel="stylesheet" href="public/css/nivo-slider.css" media="all"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link type="text/css" rel="Stylesheet" href="bjqs.css" />
<link rel="stylesheet" href="kwicks/style.css" type="text/css" media="screen" />


<!-- jQuery files -->
<script type='text/javascript' src='kwicks/jquery-1.2.6.min.js'></script>
<script type='text/javascript' src='kwicks/kwicks.js'></script>
<script type='text/javascript' src='kwicks/custom.js'></script>
<script type="text/javascript" src="includes/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="includes/js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="includes/js/autocomplete.js"></script>
<script type="text/javascript" src="includes/js/jquery-library.js"></script>


<script src="http://code.jquery.com/jquery-latest.js"></script>
    <script>

    // This is the first thing we add ------------------------------------------
    $(document).ready(function() {
        
        $('.rate_widget').each(function(i) {
            var widget = this;
            var out_data = {
                widget_id : $(widget).attr('id'),
                fetch: 1
            };
            $.post(
                'ratings.php',
                out_data,
                function(INFO) {
                    $(widget).data( 'fsr', INFO );
                    set_votes(widget);
                },
                'json'
            );
        });
    

        $('.ratings_stars').hover(
            // Handles the mouseover
            function() {
                $(this).prevAll().andSelf().addClass('ratings_over');
                $(this).nextAll().removeClass('ratings_vote'); 
            },
            // Handles the mouseout
            function() {
                $(this).prevAll().andSelf().removeClass('ratings_over');
                // can't use 'this' because it wont contain the updated data
                set_votes($(this).parent());
            }
        );
        
        
        // This actually records the vote
        $('.ratings_stars').bind('click', function() {
            var star = this;
            var widget = $(this).parent();
            
            var clicked_data = {
                clicked_on : $(star).attr('class'),
                widget_id : $(star).parent().attr('id')
            };
            $.post(
                'ratings.php',
                clicked_data,
                function(INFO) {
                    widget.data( 'fsr', INFO );
                    set_votes(widget);
                },
                'json'
            ); 
        });
        
        
        
    });

    function set_votes(widget) {

        var avg = $(widget).data('fsr').whole_avg;
        var votes = $(widget).data('fsr').number_votes;
        var exact = $(widget).data('fsr').dec_avg;
    
        window.console && console.log('and now in set_votes, it thinks the fsr is ' + $(widget).data('fsr').number_votes);
        
        $(widget).find('.star_' + avg).prevAll().andSelf().addClass('ratings_vote');
        $(widget).find('.star_' + avg).nextAll().removeClass('ratings_vote'); 
        $(widget).find('.total_votes').text( votes + ' Votos Computados (' + exact + ' Pontuação)' );
    }
    // END FIRST THING
    



    
    
    
    
    </script>
    
    <style>
        .rate_widget {
            overflow:   visible;
            padding:    10px;
            position:   relative;
            width:      210px;
            height:     32px;
        }
        .ratings_stars {
            background: url('star_empty.png') no-repeat;
            float:      left;
            height:     35px;
            padding:    2px;
            width:      37px;
        }
        .ratings_stars:hover{
          cursor: pointer;
        }
        .ratings_vote {
            background: url('star_full.png') no-repeat;
        }
        .ratings_over {
            background: url('star_highlight.png') no-repeat;
        }
        .total_votes {
            font: 15px;
            width: 220px;
            font: 9px Arial, Helvetica, sans-serif; color:#000;
            text-align: center;
            color: #fff;
            top: 58px;
            left: 0;
            padding: 5px;
            position:   absolute;  
        } 
        .movie_choice {
            font: 13px Arial, Helvetica, sans-serif; color:#000;
            margin: 20px auto 40px auto;
            width: 230px;
            height: 90px;
            border: 2px #09c solid;
            background: #ccc;
            border-radius: 1em;
            padding: 10px;
        }
    </style>


<script type="text/javascript">
$(document).ready(function(){
  $('.lancamentos').css('background', '09c');
  $('.destaques').click(function(){
    $('.destaques').css('background', '09c');
    $('.lancamentos').css('background', 'none');
    $('#ultimos-filmes #container1').css('display', 'none');
    $('#ultimos-filmes #container2').fadeIn();
    $('#ultimos-filmes #container2').css('display', 'block');
  });
  $('.lancamentos').click(function(){
    $('.lancamentos').css('background', '09c');
    $('.destaques').css('background', 'none');

    $('#ultimos-filmes #container1').fadeIn();
    $('#ultimos-filmes #container1').css('display', 'block');
    $('#ultimos-filmes #container2').css('display', 'none');
  });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
  $('.lancamentos-series').css('background', '09c');
  $('.destaques-series').click(function(){
    $('.destaques-series').css('background', '09c');
    $('.lancamentos-series').css('background', 'none');
    $('#ultimos-filmes #container-series2').fadeIn();
    $('#ultimos-filmes #container-series1').css('display', 'none');
    $('#ultimos-filmes #container-series2').css('display', 'block');
  });
  $('.lancamentos-series').click(function(){
    $('.lancamentos-series').css('background', '09c');
    $('.destaques-series').css('background', 'none');
    $('#ultimos-filmes #container-series1').fadeIn();
    $('#ultimos-filmes #container-series1').css('display', 'block');
    $('#ultimos-filmes #container-series2').css('display', 'none');
  });
});
</script>
<script type="text/javascript">
  function lookup(inputString) {
    if(inputString.length == 0) {
      // Hide the suggestion box.
      $('#suggestions').fadeOut(500);
    } else {
      $.post("rpc.php", {queryString: ""+inputString+""}, function(data){
        if(data.length >0) {
          $('#suggestions').fadeIn(500);
          $('#autoSuggestionsList').html(data);
        }
      });
    }
  } // lookup
  
  function fill(thisValue) {
    $('#inputString').val(thisValue);
    setTimeout("$('#suggestions').fadeOut(500);", 400);
  }
</script>

<script type="text/javascript">
   $(function(){
   $("#ultimos-filmes a").hover(function(e){
         var title = $(this).attr('title');
         var jNode = $('<div class="tooltip">'+$(this).attr('id')+'</div>');
         jNode.hide();
         $(this).data('titleText', title).removeAttr('title');
         $("body").append(jNode);
         jNode.fadeIn();
         
         $('.tooltip').css({
                     top : e.pageY - 50,
                     left : e.pageX + 20
                     });
       
   }, function(){
      $(this).attr('title', $(this).data('titleText'));
      $('.tooltip').remove();
   }).mousemove(function(e){
      $('.tooltip').css({
                     top : e.pageY - 50,
                     left : e.pageX + 20
                     })
   })
    
});
   </script>
</head>
<body>
<div id="main" class="grid-12">
    	<header id="header" class="tamanho12">
        	<div id="logs">
            <a href="index.php" id="logo"> Vortex Novo Site </a>
            <a href="index.php" class="logo2">Vortex Novo Site</a>
            </div>
            <div class="right  tamanho4">
            	<div id="social">
                <a href="http://twiter.com" class="twiter" target="_blank" title="Twiter">twiter</a>
                <a href="http://facebook.com/raulsinho26" class="facebook"target="_blank" title="Facebook">facebook</a>
                <a href="http://linkedin.com" class="linkedin" target="_blank"title="Linkedin">linkedin</a>
                </div>
                
                <div class="clear"></div>
                 

    <form>
      <div id="conteudo2">
        Type your county:
        <br />
        <input type="text" name="pesquisa" size="30" value="" id="inputString"autocomplete="off" onkeyup="lookup(this.value);" onblur="fill();" placeholder="Faça aqui sua Busca"  />
      </div>
      <ul>
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="autoSuggestionsList">
          &nbsp;</ul>
    </form>
            </div>  
        </header>
      <nav id="menu">
<ul class="kwicks">  
     <li id="kwick1"><a href="index.php">Home</a></li>  
     <li id="kwick2"><a href="?page=contato#menu">Contact</a></li>  
     <li id="kwick3"><a href="?page=filmes">Filmes</a></li>  
     <li id="kwick4"><a href="#">Series</a></li>  
 </ul> 
    </nav>
<div id="main" class="grid-12">
 <div id="conteudo">  
</body>
</html>