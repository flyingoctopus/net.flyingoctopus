<?
if ($name = strstr ($HTTP_USER_AGENT, "MSIE")) 
{ 
?>
<link rel="stylesheet" href="internet-explorer-stylesheet.css">
<?
} 
else if ($name = strstr ($HTTP_USER_AGENT, "Netscape")) 
{ 
?>
<link rel="stylesheet" href="netscape-stylesheet.css">
<?
} 
else
{ 
?>
<link rel="stylesheet" href="other-stylesheet.css">

<?
if ($name = strstr ($HTTP_USER_AGENT, "Safari")) 
{ 
?>
<link rel="stylesheet" href="safari-explorer-stylesheet.css">

<?
} 
?>