<?php

define("ID_APP_TIMER",  201);


define("PATH_SCRIPT",	dirname(__FILE__) . 	"\\");
define("PATH_DATA",		PATH_SCRIPT . 			"data\\");

include_once PATH_DATA . 'winbinder.php';
include_once PATH_DATA . 'interface.php';

global $start,$i;
$start = false;
$i = 2;

$a_list = ['Auto scan project','Scan : Stop'];
wb_set_text($list, $a_list);


	//echo '-- Auto scan project -- ' . PHP_EOL ;
	
	global $scantes,$scantab;
			$xt =  time() * 1000;
			$fp = fopen('phprefresh.json', 'w');
			fwrite($fp, '{"time":"' . $xt .'"}');
			fclose($fp);	
	
	$scantab = [];
	$scantes = [];
	scan(PATH_SCRIPT . 'test');
	$scantes = $scantab;

//while(true){ sleep(1); echo $i++%11 . PHP_EOL; }

wb_set_handler($winmain, 'process_main');
wb_create_timer($winmain, ID_APP_TIMER, 1000);     // One second interval
wb_set_image($winmain, PATH_DATA . "logo1.ico");
wb_main_loop();
	
function process_main($window, $id){
	global	$list,$winmain, $a_list, $i, $scantes,$scantab, $start, $edbx;	
	
	
	switch($id) {
		case ID_APP_TIMER:
           // Show the current time in hours, minutes and seconds
			if($start) {
			clearstatcache();
			if($scantes != $scantab){		
				$xt =  time() * 1000;
				if($i%11 == 0) { $i=0; $a_list = []; }
				$a_list[ ($i++%11) ] = date("Y-m-d H:i:s");
				wb_set_text($list, $a_list);
				$fp = fopen('phprefresh.json', 'w');
				fwrite($fp, '{"time":"' . $xt .'"}');
				fclose($fp);
				$scantes = $scantab;
			}
			$scantab = [];
			scan(wb_get_text($edbx));
			//var_dump($scantab);
			}
        break;

		case IDC_PUSHBUTTON1002: //start
		 $start = true;
		 wb_set_image($winmain, PATH_DATA . "logo2.ico");
			if($i%11 == 0) { $i=0; $a_list = []; }
			$a_list[ ($i++%11) ] = 'Scan : Start';
			wb_set_text($list, $a_list);
		break;
		case IDC_PUSHBUTTON1003: //stop
		 $start = false;
		 wb_set_image($winmain, PATH_DATA . "logo1.ico");
			if($i%11 == 0) { $i=0; $a_list = []; }
			$a_list[ ($i++%11) ] = 'Scan : Stop';
			wb_set_text($list, $a_list);
		break;
		
		case IDCLOSE:
			wb_destroy_window($window);
		break;
	}
	
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

