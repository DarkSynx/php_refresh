<?php
	
	define( "PATH_SCRIPT",		dirname(__FILE__) 	. "\\");
	
	echo '-- Auto scan project -- ' . PHP_EOL ;
	
	global $scantes,$scantab;
			$xt =  time();
			$fp = fopen('phprefresh.json', 'w');
			fwrite($fp, '{"time":"' . $xt .'"}');
			fclose($fp);	
	
	$scantab = [];
	$scantes = [];
	scan(PATH_SCRIPT . 'test');
	$scantes = $scantab;


	while(true){ 
		usleep(1000000);
		clearstatcache();
		if($scantes != $scantab){
			$xt =  time();
			echo '> Change '  . $xt . PHP_EOL ;
			$fp = fopen('phprefresh.json', 'w');
		fwrite($fp, '{"time":"' . $xt .'"}');
			fclose($fp);
			$scantes = $scantab;
		}
		$scantab = [];
		scan(PATH_SCRIPT . 'test');
		//var_dump($scantab);

	}
	
	
	function scan($path,$level=1,$i=0) : int {
		global $scantab;
		$d = dir($path);
		//echo str_repeat("\t",$level - 1) . "Chemin : " . $d->path . PHP_EOL;
		while (false !== ($entry = $d->read())) {
		   
		   if( $entry[0] != '.' ) {
			   //echo str_repeat("\t",$level) . $entry . PHP_EOL;
			   
			   $scantab[] = [fileatime($d->path . '\\' . $entry) - filemtime($d->path . '\\' . $entry), $entry];
			   $i++;
			   
			   if(is_dir($d->path . '\\' . $entry)) {
					$i += scan($d->path . '\\' . $entry . '\\',$level+1);
			   }

		   
			}
		}
		$d->close();
		return $i;
	}
	
?>

