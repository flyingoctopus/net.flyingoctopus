<?
if ($name = strstr ($HTTP_USER_AGENT, "MSIE")) 
{ 
?>
<link rel="stylesheet" href="styles/internet-explorer-stylesheet.css">
<?
} 
else if ($name = strstr ($HTTP_USER_AGENT, "Netscape")) 
{ 
?>
<link rel="stylesheet" href="styles/netscape-stylesheet.css">
<?
} 

else if ($name = strstr ($HTTP_USER_AGENT, "Safari")) 
{ 
?>
<link rel="stylesheet" href="styles/safari-stylesheet.css">
<?
} 

else
{ 
?>
<link rel="stylesheet" href="styles/other-stylesheet.css">
<?
} 
?>
