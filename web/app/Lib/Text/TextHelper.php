<?php

class TextHelper {
	
	/**
    * Converts all special characters including spaces to - (dash/high fan) 
    * output is lowecased
    * 
    * @name safeText
    * @param string text Text to convert
    * @param string par Type of input
    * @return string Converted text
    */
	public static function safeText($text, $par=NULL) {
		$text = trim($text);
		$badtext  = 'ěščřžýáíéúůüňöäĺĚŠČŘŽÝÁÍÉÚÙŮŇĹABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$goodtext = 'escrzyaieuuunoalescrzyaieuuunlabcdefghijklmnopqrstuvwxyz';
		$badtext  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$goodtext = 'abcdefghijklmnopqrstuvwxyz';
		$altext   = 'abcdefghijklmnopqrstuvwxyz1234567890_'; 
		if ($par == 'file') {
			$goodtext .= '.';
			$badtext .= '.';
		}
		if ($par=='dir') {
			$goodtext .= '/.';
			$badtext .= '/.';
		}
		if ($par=='email') {
			$goodtext .= '.@0';
			$badtext .= '.@0';
		}
		$text = strtr($text, $badtext, $goodtext);
		$ltext = strlen($text);
		for ($i=0; $i < $ltext; $i++) if (!strstr($altext, $text[$i])) {
			if(isset($goodtext[strpos($badtext, $text[$i])]) && strstr($badtext, $text[$i])) $text[$i] = $goodtext[strpos($badtext, $text[$i])];
			else $text[$i]="-";
		}
		return preg_replace("/[-]+/", "-", trim($text, "-"));
	}
	
	/**
    * If the text longer than $limit, cuts the rest after the last word and puts '...' (three dots) 
    * on the end of the string 
    * 
    * @name cutText
    * @param string text Text to cut
    * @param int limit Maximal number of letters in the output string
    * @return string Checked text
    */
	public static function cutText($text, $limit) {
		if (strlen($text) <= $limit) $text = $text; 
		else { 
			$text = substr($text, 0, $limit+1); 
			$pos = strrpos($text, ' ');
			$text = substr($text, 0, ($pos ? $pos : -1)) . ' ...'; 
		}
		return $text;
	}
		
}