<?php
ob_start('ob_gzhandler');
header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<html lang="en" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
	<head>
		<meta charset="utf-8">
		<title>Criador de logo para o TEDx</title>
		<meta name="description" content="TEDx logo creator">
		<meta name="author" content="Bart van Merriënboer">
    <meta property="og:title" content="TEDx logo creator">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://bartvanmerrienboer.nl/tedxlogo/">
    <meta property="og:image" content="http://bartvanmerrienboer.nl/tedxlogo/img/facebook-thumbnail.png">
    <meta property="og:site_name" content="TEDx logo creator">
    <meta property="fb:admins" content="bart.vanmerrienboer">
    <meta property="og:description"
          content="Create your own TEDx event logo automatically.">
    <link rel="image_src" href="http://bartvanmerrienboer.nl/tedxlogo/img/facebook-thumbnail.png">
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				/* This script hides the font color option if the background isn't set to transparent */
				if($("input[name=transparency]").prop('checked') == true) {
					$("select[name=format]").parent().parent().hide();				
				} else {
					$("select[name=format]").parent().parent().show();	
				}		
				$("input[name=transparency]").change(function() {
					if($(this).prop('checked') == true) {
						$("select[name=format]").parent().parent().hide();		
						$("option[value=png32]").attr('selected', true);		
					} else {
						$("select[name=format]").parent().parent().show();	
					}
				});
				
				/* This script keeps the height and width the same if square is selected */
				$("input[name=square]").change(function() {
					if($(this).prop('checked') == true) {
						$("input[name=maxheight]").val($("input[name=maxwidth]").val());
						$("input[name=setheight]").prop('checked', true);
						$("input[name=maxheight]").prop('disabled', false);
						$("input[name=setwidth]").prop('checked', true);
						$("input[name=maxwidth]").prop('disabled', false);
					}
				});
				$("input[name=maxwidth]").change(function() {
					if($("input[name=square]").prop("checked") == true) {
						$("input[name=maxheight]").val($("input[name=maxwidth]").val());
					}
				});
				
				$("input[name=maxheight]").change(function() {
					if($("input[name=square]").prop("checked") == true) {
						$("input[name=maxwidth]").val($("input[name=maxheight]").val());
					}
				});
				
				/* This enables the help popovers */
				$("a[rel=popover]").popover({
					trigger: 'hover',
					placement: 'right'
				});
				
				if($("input[name=setheight]").prop('checked') == false) {
						$("input[name=maxheight]").prop('disabled', true);
				}
				if($("input[name=setwidth]").prop('checked') == false) {
						$("input[name=maxwidth]").prop('disabled', true);
				}				
				
				/* This enables and disables the height and width */
				$("input[name=setheight]").change(function() {
					if($("input[name=setheight]").prop('checked') == true) {
						$("input[name=maxheight]").prop('disabled', false);
					} else {
						$("input[name=maxheight]").prop('disabled', true);
						$("input[name=setwidth]").prop('checked', true);
						$("input[name=maxwidth]").prop('disabled', false);
						$("input[name=square]").prop("checked", false);
					}
				});
				$("input[name=setwidth]").change(function() {
					if($("input[name=setwidth]").prop('checked') == true) {
						$("input[name=maxwidth]").prop('disabled', false);
					} else {
						$("input[name=maxwidth]").prop('disabled', true);
						$("input[name=setheight]").prop('checked', true);
						$("input[name=maxheight]").prop('disabled', false);
						$("input[name=square]").prop("checked", false);
					}
				});
				
				/* Create loading button */
				$('button[type=submit]').click(function() {
					$('button[type=submit]').button('loading');
				});
				
				/* Error checking */
				$('form').submit(function() {
					if($('input[name=eventname]').val() == '') {
						$('button').button('reset');
						$('input[name=eventname]').parent().parent().addClass('error');
						return false;
					} else {
						return true;
					}
				});
				$('input[name=eventname]').focus(function() {
					$(this).parent().parent().removeClass('error');
				});

				/* Form elements */		
				$('div.btn-group[data-toggle-name=*]').each(function(){
					var group   = $(this);
					var form    = group.parents('form').eq(0);
					var name    = group.attr('data-toggle-name');
					var hidden  = $('input[name="' + name + '"]', form);
					$('button', group).each(function(){
						var button = $(this);
						button.live('click', function(){
								hidden.val($(this).val());
						});
						if(button.val() == hidden.val()) {
							button.addClass('active');
						}
					});
				});
			});
		</script>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style type="text/css">
			@media (min-width: 768px) and (max-width: 979px) {
				input, textarea, .uneditable-input, select {
					width: 140px;
				}
				
				.form-horizontal .control-label {
					width: 100px;
				}
				
				.form-horizontal .controls {
					margin-left: 120px;
				}
			}
			
			section {
				padding-top: 30px;
			}
			
			/* Jumbotrons
			-------------------------------------------------- */
			
			/* Base class
			------------------------- */
			.jumbotron {
				position: relative;
				padding: 40px 0;
				color: #fff;
				text-align: center;
				text-shadow: 0 1px 3px rgba(0,0,0,.4), 0 0 30px rgba(0,0,0,.075);
				background: #ff2b06; /* Old browsers */
				background: -moz-linear-gradient(45deg,  #ff2b06 0%, #7C1303 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,#ff2b06), color-stop(100%,#7C1303)); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(45deg,  #ff2b06 0%,#7C1303 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(45deg,  #ff2b06 0%,#7C1303 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(45deg,  #ff2b06 0%,#7C1303 100%); /* IE10+ */
				background: linear-gradient(45deg,  #ff2b06 0%,#7C1303 100%); /* W3C */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff2b06', endColorstr='#7C1303',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
				-webkit-box-shadow: inset 0 3px 7px rgba(0,0,0,.2), inset 0 -3px 7px rgba(0,0,0,.2);
					 -moz-box-shadow: inset 0 3px 7px rgba(0,0,0,.2), inset 0 -3px 7px rgba(0,0,0,.2);
								box-shadow: inset 0 3px 7px rgba(0,0,0,.2), inset 0 -3px 7px rgba(0,0,0,.2);
			}
			.jumbotron h1 {
				font-size: 80px;
				font-weight: bold;
				letter-spacing: -1px;
				line-height: 1;
			}
			.jumbotron p {
				font-size: 24px;
				font-weight: 300;
				line-height: 30px;
				margin-bottom: 30px;
			}
			
			/* Link styles (used on .masthead-links as well) */
			.jumbotron a {
				color: #fff;
				color: rgba(255,255,255,.5);
				-webkit-transition: all .2s ease-in-out;
					 -moz-transition: all .2s ease-in-out;
								transition: all .2s ease-in-out;
			}
			.jumbotron a:hover {
				color: #fff;
				text-shadow: 0 0 10px rgba(255,255,255,.25);
			}
			
			/* Pattern overlay
			------------------------- */
			.jumbotron .container {
				position: relative;
				z-index: 2;
			}
			.jumbotron:after {
				content: '';
				display: block;
				position: absolute;
				top: 0;
				right: 0;
				bottom: 0;
				left: 0;
				opacity: .4;
			}
			
			/* Subhead (other pages)
			------------------------- */
			.subhead {
				text-align: left;
				border-bottom: 1px solid #ddd;
			}
			.subhead h1 {
				font-size: 60px;
			}
			.subhead p {
				margin-bottom: 20px;
			}
			.subhead .navbar {
				display: none;
			}
			
			/* Footer
			-------------------------------------------------- */
			
			.footer {
				padding: 20px 0;
				margin-top: 20px;
				border-top: 1px solid #e5e5e5;
				border-bottom: 1px solid #e5e5e5;
				background-color: #f5f5f5;
			}
			.footer p {
				margin-bottom: 0;
				color: #777;
			}
			.footer-links {
				margin: 10px 0;
			}
			.footer-links li {
				display: inline;
				margin-right: 10px;
			}

			
			/* Tablet
			------------------------- */
			@media (max-width: 767px) {
			
				/* Widen masthead and social buttons to fill body padding */
				.jumbotron {
					padding: 40px 20px;
					margin-right: -20px;
					margin-left:  -20px;
				}
			
				/* Unfloat the back to top link in footer */
				.footer {
					margin-left: -20px;
					margin-right: -20px;
					padding-left: 20px;
					padding-right: 20px;
				}
				.footer p {
					margin-bottom: 9px;
				}
			}
			
			/* Landscape phones
			------------------------- */
			@media (max-width: 480px) {
				/* Remove padding above jumbotron */
			
				/* Downsize the jumbotrons */
				.jumbotron h1 {
					font-size: 60px;
				}
				.jumbotron p,
				.jumbotron .btn {
					font-size: 20px;
				}
				.jumbotron .btn {
					display: block;
					margin: 0 auto;
				}
			
				/* center align subhead text like the masthead */
				.subhead h1,
				.subhead p {
					text-align: center;
				}

			}
		</style>
	</head>
	<body>
		<header class="jumbotron subhead" id="overview">
			<div class="container">
				<h1>Criador de logo para TEDx</h1>
				<p class="lead">Use para criar logos para o seu evento TEDx! Leia as regras de como usar a logo no <a href="http://www.ted.com/pages/creating_your_tedx_logo">site do TED</a>.</p>
			</div>
		</header>
		<div class="container">
		<section>
			<div class="row show-grid">
				<div class="span12">
					<script src="js/bootstrap.min.js"></script>
					<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST" class="form-horizontal row">
						<div class="span6">
						<fieldset>
							<legend>Nome do seu evento</legend>
							<div class="control-group">
								<label class="control-label">TEDx&hellip;</label>
								<div class="controls">
									<input type="text" name="eventname" value="<?php echo ($_POST['eventname'] ? $_POST['eventname'] : ''); ?>">
								</div>
							</div>
						</fieldset>
						<fieldset>
							<legend>Cores e layout</legend>
							<div class="control-group">
								<label class="control-label"><a href="#" rel="popover" data-content="Um fundo sólido, branco ou preto deve ser usado. (Para o perfil do seu evento no TED.com, é recomendável um fundo branco.)" data-original-title="Fundo"><i class="icon-question-sign"></i></a> Cores</label>
								<div class="controls">
									<div class="btn-group" data-toggle="buttons-radio" data-toggle-name="color">
										<button type="button" value="black" class="btn">Branco</button>
										<button type="button" value="white" class="btn btn-inverse">Preto</button>
									</div>
									<input type="hidden" name="color" value="<?php echo ($_POST['color'] ? $_POST['color'] : 'black'); ?>">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">
									<a href="#" rel="popover" data-content="É possível criar uma imagem com fundo transparente, mas lembre-se de não colocar o logotipo do seu evento TEDx em outras cores além de preto e branco ou em fundos fotográficos, estampados ou ilustrativos." data-original-title="Fundo transparente"><i class="icon-question-sign"></i></a> Sem fundo
								</label>
								<div class="controls">
									<label class="checkbox">
										<input type="checkbox" name="transparency" value="true" <?php echo ($_POST['transparency'] ? 'checked="checked"' : ''); ?>>
									</label>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label"><a href="#" rel="popover" data-content="O logotipo do slogan de uma linha é preferível. No entanto, em situações em que não há espaço suficiente para usar um logotipo dessa largura, o logotipo do slogan de duas linhas pode ser usado. Além disso, para nomes de locais que contêm letras minúsculas com descendentes (p, q, g, j, y), use o slogan empilhado de duas linhas para que os descendentes não toquem no slogan." data-original-title="Tagline"><i class="icon-question-sign"></i></a> Tagline</label>
								<div class="controls">
									<select name="tagline">
										<option value="1" <?php echo ($_POST['tagline'] == '1' ?  'selected="selected"' : ''); ?>>Uma linha</option>
										<option value="2" <?php echo ($_POST['tagline'] == '2' ?  'selected="selected"' : ''); ?>>Duas linhas</option>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label"><a href="#" rel="popover" data-content="Use apenas o modelo de duas linhas para nomes de locais mais longos." data-original-title="Place name"><i class="icon-question-sign"></i></a> Posição do nome</label>
								<div class="controls">
									<select name="eventline">
										<option value="1" <?php echo ($_POST['eventline'] == '1' ?  'selected="selected"' : ''); ?>>Na mesma linha do "TEDx"</option>
										<option value="2" <?php echo ($_POST['eventline'] == '2' ?  'selected="selected"' : ''); ?>>Na segunda linha</option>
									</select>
								</div>
							</div>
						</fieldset>
						</div>
						<div class="span6">
						<fieldset>
							<legend>Tamanho e formato</legend>
							<div class="control-group">
								<label class="control-label"><a href="#" rel="popover" data-content="Para garantir legibilidade, nunca use o logotipo do seu evento TEDx com uma largura total inferior a 2,0 polegadas. Em larguras menores que 2,0 polegadas, o slogan ficará ilegível." data-original-title="Largura"><i class="icon-question-sign"></i></a> Largura máxima</label>
								<div class="controls">
									<div class="input-append input-prepend">
										<span class="add-on"><input type="checkbox" name="setwidth" value="true" <?php echo (!isset($_POST['setwidth']) || !is_null($_POST['setwidth']) ? 'checked="checked"' : ''); ?>> <i class="icon-resize-horizontal"></i></span>
										<input class="input-medium" type="number" name="maxwidth" value="<?php echo ($_POST['maxwidth'] ? $_POST['maxwidth'] : '550'); ?>">
										<span class="add-on">px</span>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Altura máxima</label>
								<div class="controls">
									<div class="input-append input-prepend">
										<span class="add-on"><input type="checkbox" name="setheight" value="true" <?php echo (!is_null($_POST['setheight']) ? 'checked="checked"' : ''); ?>> <i class="icon-resize-vertical"></i></span>
										<input class="input-medium" type="number" name="maxheight" value="<?php echo ($_POST['maxheight'] ? $_POST['maxheight'] : '200'); ?>">
										<span class="add-on">px</span>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label"><a href="#" rel="popover" data-content="
Para permanecer completamente legível e garantir que o logotipo do seu evento TEDx seja apresentado da melhor maneira possível, uma zona de buffer mínima de espaço livre deve sempre ser mantida em todo o perímetro do logotipo. Outros logotipos, gráficos ou cópias devem ser mantidos fora desta zona." data-original-title="Espaço em branco"><i class="icon-question-sign"></i></a> Espaço em branco</label>
								<div class="controls">
									<div class="input-append input-prepend">
										<span class="add-on"><i class="icon-fullscreen"></i></span>
										<input class="input-medium" type="number" name="border" value="<?php echo (isset($_POST['border']) ? $_POST['border'] : '20'); ?>">
										<span class="add-on">px</span>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">
									<a href="#" rel="popover" data-content="Uma imagem quadrada pode ser útil para criar ícones que podem ser usados, por exemplo, Twitter, Facebook e Flickr." data-original-title="Imagem quadrada"><i class="icon-question-sign"></i></a> Quadrado?
								</label>
								<div class="controls">
									<label class="checkbox">
										<input type="checkbox" name="square" value="true" <?php echo ($_POST['square'] ? 'checked="checked"' : ''); ?>>
									</label>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label"><a href="#" rel="popover" data-content="PNG é o formato recomendado. Use apenas JPEG quando precisar." data-original-title="Formato da imagem"><i class="icon-question-sign"></i></a> Formato da imagem</label>
								<div class="controls">
									<select name="format">
										<option value="png32" <?php echo ($_POST['format'] == 'png32' ?  'selected="selected"' : ''); ?>>PNG</option>
										<option value="jpeg" <?php echo ($_POST['format'] == 'jpeg' ?  'selected="selected"' : ''); ?>>JPEG (Qualidade: 90)</option>
									</select>
								</div>
							</div>
						</fieldset>
						</div>
						<button type="submit" class="btn btn-large btn-block span12" data-loading-text="Loading...">Criar logo</button>
					</form>
					<?php
					if (isset($_POST['eventname'])) {
						$query_string = 'logo.php?';
						foreach ($_POST as $field => $value) {
							if($field != 'setwidth' && $field != 'setheight') {
								$query_string .= urlencode($field) . '=' . urlencode($value) . '&';
							}
						}
						$query_string = substr($query_string, 0, -1);
						$path_info = pathinfo($_SERVER['SCRIPT_NAME']);
						$image_content = file_get_contents('http://' . $_SERVER['SERVER_NAME'] . htmlentities($path_info['dirname']) . '/' . $query_string);
						if($image = imagecreatefromstring($image_content)) {
							echo '<div style="text-align: center; overflow: scroll;"><p><img style="max-width: none;" src="data:image/png;base64,' . base64_encode($image_content) . '" alt="TEDx' . htmlentities($_POST['eventname']) . ' logo" class="img-polaroid"></p></div>';
						} else {
							echo '<p style="text-align: center;">Sorry, the following error occurred: ' . $image_content . '</p>';
						}
						echo '<pre style="text-align: center;">Largura: ' . imagesx($image) . ' Altura: ' . imagesy($image) . '<br>Clique com o botão direito e escolha "Salvar imagem como" para salvar no seu computador.</pre>';
					}
					?>
				</div>
			</div>
			</section>
		</div>
		<footer class="footer">
			<div class="container">
				<p>Feito por Bart van Merriënboer (<a href="mailto:bart@tedxwarwick.com">bart@tedxwarwick.com)</a></p>
			</div>
		</footer>
	</body>
</html>
<?php ob_end_flush(); ?>