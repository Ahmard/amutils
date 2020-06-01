<?php

function removeMuzmoId($file){
	if($file){
		
		//Remove muzmo id
		$exp1 = explode("_", $file);
		$count1 = ((count($exp1)) -1);
		
		$exp2 = explode(".", $exp1[$count1]);
		$muzmo_file_id = $exp2[0];
		
		$oldLen = strlen($muzmo_file_id);
		
		if(settype($muzmo_file_id, 'int')){
			if(strlen($muzmo_file_id) == $oldLen){
				
				$loopCount = 0;
				$mCount = $count1 - 1;
				
				$name = "";
				while(1){
					$uScore = (($loopCount != 0) ? ("_") : (""));
					$name .= $uScore . $exp1[$loopCount];
					if($loopCount == $mCount){
						$newfile = "$name.".$exp2[1]."";
						return $newfile;
						break;
					}
					$loopCount++;
				}
			}
		}
	}
}

function removeMuzmoName($file){
	if($file){
		
		if(strstr($file, "muzmo_ru_")){
			$exp = explode("muzmo_ru_", $file);
			return $exp[1];
		}
	}
}

$folder = "/sdcard/Ahmardy/media/mp3";
$dir = opendir($folder);
$c = 0;

while ($file = readdir($dir)) {
	if(strlen($file) > 3){
		
		//Remove "muzmo_ru"
		$oldfile = "$folder/$file";
		
		//$removeName = removeMuzmoName($file, $folder);
		//if($removeName){
			//$removeId = removeMuzmoId($removeName, $folder);
			$removeId = removeMuzmoId($file, $folder);
			if($removeId){
				$newfile = "$folder/$removeId";
				
				if(rename($oldfile, $newfile)){
					print "<font color='green'>$removeId</font> <br/>";
				}else{
					print "<font color='red'>$removeId</font> <br/>";
				}
				
			//}
		}
	}
	$c++;
}

