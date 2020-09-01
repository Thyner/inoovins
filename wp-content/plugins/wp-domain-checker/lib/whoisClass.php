<?php
#######################################################################
#	PHP Whois Lookup Class
#	Script Url: http://99webtools/php-whois-script.php
#	Author: Sunny Verma
#	Email: er.sunny.verma@gmail.com
#	Website: http://99webtools.com
#	License: GPL 2.0, @see http://www.gnu.org/licenses/gpl-2.0.html
########################################################################
class wdcWhois{



public function whoislookup($domain)
{

			$file_dir = plugin_dir_path( __FILE__ ).'whois.json';
			$file_dir_open = fopen($file_dir,'r');
			$file = fread($file_dir_open, filesize($file_dir));
			fclose($file_dir_open);


	$WHOIS_SERVERS = json_decode($file,true);
	$domain = trim($domain); //remove space from start and end of domain
	if(substr(strtolower($domain), 7) == "http://") $domain = substr($domain,7); // remove http:// if included
	if(substr(strtolower($domain), 4) == "www.") $domain = substr($domain,4);//remove www from domain
	if(preg_match("/^(?!-)(xn--)?[a-zA-Z0-9][a-zA-Z0-9-_]{0,61}[a-zA-Z0-9]{0,1}\.(?!-)(xn--)?([a-zA-Z0-9\-]{1,50}|[a-zA-Z0-9-]{1,30}\.[a-zA-Z]{2,})$/i",$domain))
	{
		$domain_parts = explode(".", $domain,2);
		$tld = strtolower(array_pop($domain_parts));
		$server = $WHOIS_SERVERS[$tld][0];
		if(!$server) {
			return "Error: No appropriate Whois server found for $domain domain!";
		}
		$res=$this->queryWhois($server,$domain);
			// while(preg_match_all("/Whois Server: (.*)/", $res, $matches))
			// {
			// 	$server=array_pop($matches[1]);
			// 	$res=$this->queryWhois($server,$domain);
			// }
		return $res;
	}
	else
	return "Invalid Input";
}

private function queryWhois($server,$domain)
{
	$port = 43;
	list($dom, $ext) = explode('.', $domain, 2);

	if($ext == 'ch'){
		$port = 4343;
	}
	$transient = get_transient( 'wdc_'.$domain );

		  // Yep!  Just return it and we're done.
		  if( ! empty( $transient ) ) {

		    // The function will return here every time after the first time it is run, until the transient expires.
		    return $transient;

		  // Nope!  We gotta make a call.
		}
	$fp = @fsockopen($server, $port, $errno, $errstr, 20) or die("Socket Error " . $errno . " - " . $errstr);
	if($server=="whois.verisign-grs.com")
		$domain="=".$domain;
		fputs($fp, $domain . "\r\n");
		$out = "";
		while(!feof($fp)){
			$out .= fgets($fp);
		}
	fclose($fp);
	return $out;
}
}
?>
