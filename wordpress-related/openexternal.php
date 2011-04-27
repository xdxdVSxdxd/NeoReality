<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Open External Link</title>
<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">
jQuery.noConflict();
jQuery(document).ready(function(){
	//qui
});
</script>
<style>
html,body{
margin:0px;
padding:0px;
width:100%;
height:100%;
background:#000000;
color: #FFFFFF;
font: 12px Arial, Helvetica, sans-serif;
}
div#maindiv{
float: left;
width: 100%;
height: 100%;
padding: 0px;
margin: 0px;
}
div#headerdiv{
float: left;
width: 100%;
height: 10%;
padding: 0px;
margin: 0px;
}
div#iframediv{
float: left;
width: 100%;
height: 90%;
padding: 0px;
margin: 0px;
}
a, a:visited{
text-decoration: none;
color: #FFFFFF;
font: 14px Arial, Helvetica, sans-serif;
margin-left: 15px;
}
a:hover{
color: #00FF00;
}
</style>
</head>
<body>
<?php 
	$externalurl = "#";
	if(isset($_GET["url"])){
		
		$externalurl = $_GET["url"];
	}
?>
<div id="maindiv">

	<div id="headerdiv"><a href="javascript:window.close();" title="CLICK HERE TO GO BACK"><< CLICK HERE TO GO BACK</a></div>
    <div id="iframediv">
    	<?php 
			if($externalurl<>"#"){
		?>
    	<iframe width="100%" height="100%" scrolling="auto" frameborder="0" src="<?php echo($externalurl); ?>" hspace="0" name="external-content-frame" id="external-content-frame"></iframe>
        <?php
			}
		?>
    </div>

</div>
</body>
</html>
