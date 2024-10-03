function moneyToText($money, $currency){
		if (strpos($currency, '€') !== false){
			$cash="EURO 'DUR";
			$change="CENT 'DİR";
		}else if (strpos($currency, 'TL') !== false){
			$cash="TÜRK LİRASI 'DUR";
			$change="KURUŞ 'TUR";
		}else if (strpos($currency, '$') !== false){ 
			$cash="DOLAR 'DIR";
			$change="CENT 'DİR";
		}else{
			$cash="TÜRK LİRASI 'DIR";
			$change="KURUŞ 'DUR";
		}
		$split = str_split($money);
		$numbers = array("1","2","3","4","5","6","7","8","9","0");
		$number = array("BİR","İKİ","ÜÇ","DÖRT","BEŞ","ALTI","YEDİ","SEKİZ","DOKUZ"," ");
		$ten = array("ON","YİRMİ","OTUZ","KIRK","ELLİ","ALTMIŞ","YETMİŞ","SEKSEN","DOKSAN"," "); 
		$newMoney;
		$isCent=0;
		if ($split[1]=='.'){
			if ($split[2] == '1'){$first = 'YÜZ';} 
			else if ($split[2] == '0'){$first = ' ';} 
			else {$first = str_replace($numbers, $number , $split[2] ).' YÜZ ';}
			if ($split[0] == '1'){$firstNumer = 'BİN';} 
			else {$firstNumer = str_replace($numbers, $number , $split[0] ).' BİN';}
			$newMoney = $firstNumer.' '.$first.' '.str_replace($numbers, $ten , $split[3]).' '.str_replace($numbers, $number, $split[4]).'" '.$cash;
		}else if($split[2]=='.'){
			
			if ($split[3] == '1'){$first = 'YÜZ';} 
			else if ($split[3] == '0'){$first = ' ';}
			else {$first = str_replace($numbers, $number, $split[3] ).' YÜZ ';}
			$newMoney = str_replace($numbers, $ten , $split[0]).' '.str_replace($numbers, $number, $split[1]).' BİN '.$first.str_replace($numbers, $ten , $split[4]).' '.str_replace($numbers, $number, $split[5]).'" '.$cash;
		}else if($split[3]=='.' ){
			if ($split[0] == '1'){$hnd = 'YÜZ';} 
			else if ($split[0] == '0'){$hnd = ' ';} 
			else {$hnd = str_replace($numbers, $number , $split[0]).' YÜZ ';}
			if ($split[4] == '1'){$first = 'YÜZ';} 
			elseif ($split[4] == '0'){$first = '';}
			else {$first = str_replace($numbers, $number , $split[4]).' YÜZ ';}
			$newMoney = $hnd.' '.str_replace($numbers, $ten , $split[1]).' '.str_replace($numbers, $number, $split[2]).' BİN '.$first.' '.str_replace($numbers, $ten , $split[5]).' '.str_replace($numbers, $number, $split[6]).'" '.$cash;
		}else {
			if (empty($split[1]) && $split[1] != 0){$first = str_replace($numbers, $number , $split[0]).' ';}
			else if (empty($split[2]) && $split[2] != 0){$second = str_replace($numbers, $number , $split[1]); if ($split[0] == '1'){$first = 'ON';} else {$first = str_replace($numbers, $ten , $split[0]).' ';}}
			else{if ($split[0] == '1'){$first = 'YÜZ';$second = str_replace($numbers, $ten , $split[1]);} else {$first = str_replace($numbers, $number , $split[0]).' YÜZ ';$second = str_replace($numbers, $ten , $split[1]);}}
			$newMoney = $first.$second.' '.str_replace($numbers, $number, $split[2].'"  '.$cash);
		}
		if ($split[count($split)-3]==','){
			$centLast = $split[count($split)-1];
			$centFirst = $split[count($split)-2];
			$centos = '"'.str_replace($numbers, $ten , $centFirst).' '.str_replace($numbers, $number , $centLast).'" '.$change;
			$isCent=1;
		}
		if ($isCent == 0){
		return 'YALNIZ "'.$newMoney.' FİYATLARIMIZA K.D.V. DAHİL DEĞİLDİR.';
		} else {
			return 'YALNIZ "'.$newMoney.' '.$centos.' FİYATLARIMIZA K.D.V. DAHİL DEĞİLDİR.';
		}
	}
