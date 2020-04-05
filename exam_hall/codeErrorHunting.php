<?php
	include '../includes/misc.inc';
	$id = $_SESSION['id'] = 1;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Code Error Hunting</title>
  <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="language" content="english">
<meta name="viewport" content="width=device-width">

<meta name="description" content="Quill is a free, open source WYSIWYG editor built for the modern web. With its modular architecture and expressive API, it is completely customizable to fit any need.">

<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@quilljs">

<meta name="twitter:title" content="Snow Theme - Quill">

<meta name="twitter:description" content="Quill is a free, open source WYSIWYG editor built for the modern web.">
<meta name="twitter:image" content="http://quilljs.com/assets/images/brand-asset.png">
<meta property="og:type" content="website">
<meta property="og:url" content="http://quilljs.com/standalone/snow/">
<meta property="og:image" content="http://quilljs.com/assets/images/brand-asset.png">
<meta property="og:title" content="Snow Theme - Quill">
<meta property="og:site_name" content="Quill">
 
<link type="application/atom+xml" rel="alternate" href="https://quilljs.com/feed.xml" title="Quill - Your powerful, rich text editor" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.6.0/katex.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/styles/monokai-sublime.min.css" />
<link rel="stylesheet" href="../quill/quill.snow.css" />

<link href="../css/bootstrap.min.css" rel="stylesheet"> <!--My bootstrap File theme-->

<style>
  .standalone-container {
    width: 900px;
  }
  #snow-container {
    height: 350px;
  }
</style>

</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand" href"#"> <STRONG>Code E Salsa</STRONG> </a>
				<STRONG><a class='navbar-brand' align='right' id='clock'></a></STRONG>
            <!-- Collect the nav links, forms, and other content for toggling -->
        </div>
        <!-- /.container -->
    </nav>
<BR><BR><BR>

<div class='col-md-3'>
<div class='question-set'>
</div>
</div>

<div class="standalone-container col-md-offset-4 col-md-8">
  <div id="snow-container"></div><BR>
</div>

<BR/>
<div class="standalone-container col-md-offset-4 col-md-8">
  <div id="snow-container-you"></div><BR>
</div>

<div class='button-set col-md-offset-4 col-md-8'>
	<div class='col-md-2'><button class='btn btn-success' onclick='getFormattedData()'>Compile</button></div>
	<div class='col-md-8'><input class='form-control' rows='3' placeholder='Enter your standard input'></div>
	<button class='btn btn-warning' onclick='get_code()'>Execute</button><BR>
</div>

<div class='console col-md-offset-4 col-md-8'>
<BR><label>Console : </label>
	<div class='panel panel-default' class='form-control'>
	<div class='panel-body'><p id='console'></p></div></div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.6.0/katex.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/highlight.min.js"></script>
<script type="text/javascript" src="../quill/quill.min.js"></script>
<script type="text/javascript">
  var quill = new Quill('#snow-container', {
    placeholder: 'Think Twice Code Once..',
    theme: 'snow'
  });
  
  var quill2 = new Quill('#snow-container-you', {
    placeholder: 'Think Twice Code Once..',
    theme: 'snow'
  });
  
  function getFormattedData()
  {
	 var formatted_code = quill.root.innerHTML;
	 quill2.root.innerHTML = formatted_code;
			var ajaxRequest;  // The variable that makes Ajax possible!
			try
			{
					// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
			}catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					}catch (e) {
         
						try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
							}
						catch (e){
						// Something went wrong
							alert("Your browser broke!");
							return false;
								 }//end of catch blcok	
								}
					  }
   
				ajaxRequest.onreadystatechange = function(){
				if(ajaxRequest.readyState == 4)
				{
					var ajaxDisplay = document.getElementById('console');
					ajaxDisplay.innerHTML = ajaxRequest.responseText;
				}
			}
			document.getElementById('snow-container').style.height = '250px';
			alert("formatted_code="+formatted_code+"--------------------------------------------"+formatted_code2);
			//ajaxRequest.open("POST", "../bigdata/functions/process_code.php",true);
			//ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			//ajaxRequest.send("formatted_code="+formatted_code);
	}
</script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>

</body>
</html>
