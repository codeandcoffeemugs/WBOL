<?php
function makeRich($text)
{
/* 
 * Replacing '@user' and 'http' with hypertext
 */

$pattern = "/(http:\/\/\S+)/";

if(preg_match($pattern, $text))
{
$text = preg_replace($pattern, "<a href='$1'>$1</a>", $text);
}

if(preg_match("/@([^()#@\s\,]+)/", $text))
{
$text = preg_replace("/@([^()#@\s\,]+)/", "<a href='http://twitter.com/$1'>@$1</a>", $text);
}
$text = str_replace("#wbol", "", $text);
return $text;
}

?>
