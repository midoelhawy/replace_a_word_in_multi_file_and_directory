<?php
$dir    = 'Multango/';
$arrayoldwords = array("Mulilanguage","mulilanguage","MULTILANGUAGE","MULTILANGUAGE_");
$arraynewwords = array("Multango","multango","MULTANGO","MULTANGO_");
$file_suc_edit = 0;
$dir_read	   = 0;
$tot_size      = 0;




echo "<body style=' background: #000;color: #fff; '>";
	echo "<ul>";
rnm($dir);






function rnm($dirct){
	global $tot_size,$dir_read,$file_suc_edit,$arrayoldwords,$arraynewwords;
	$files = scandir($dirct);
	foreach($files as $file){
	if(is_dir($dirct.$file) && ($file != "." && $file != "..")){
		rnm($dirct.$file);
		$dir_read++;
	}else{
			$oldfile = $file;
		if(($file != "." && $file != ".." && @!is_array(getimagesize($dirct.$oldfile)))){
			$fname = $dirct.$oldfile;
			$fhandle = @fopen($fname,"r");
			
			$content = @fread($fhandle,@filesize($fname));
			
			foreach($arrayoldwords as $kay=>$val){
				$content = str_replace($val,$arraynewwords[$kay], $content);
			}
				

			$fhandle = fopen($fname,"w");
			fwrite($fhandle,$content);
			fclose($fhandle);
			
			$file_suc_edit++;
			$tot_size += filesize($fname);
			echo "<li style=' background: #00c52a; padding: 6px; color: #fff;margin-bottom: 8px; '>";
				echo "<strong> ".$file." </strong> successfully edited!!";
			echo "</li>";
		}
	}
}
	
}
	echo "</ul>";
	
	
	echo "<br><hr><br> TOTAL EDITED FILES : ".$file_suc_edit."<br><br><hr><br>";
	echo "<br><hr><br> FOLDERS READED     : ".$file_suc_edit."<br><br><hr><br>";
	echo "<br><hr><br> TOTAL SIZE         : ".round(($tot_size/1024), 2)." KB<br><br><hr><br>";
	
echo "</body>";

?>
