function moneyToText($money, $currency){
		if ($currency == '€'){
			$cash="EURO";
			$change="CENT";
		}else if ($currency == 'TL'){
			$cash="TÜRK LİRASI";
			$change="KURUŞ";
		}else if ($currency == '$'){
			$cash="DOLAR";
			$change="CENT";
		}else{
			$cash="EURO";
			$change="CENT";
		}
		$split = str_split($money);
		$numbers = array("1","2","3","4","5","6","7","8","9","0");
		$numbersD = array("11","12","13","14","15","16","17","18","19","0");
		$number = array("ONE","TWO","THREE","FOUR","FIVE","SIX","SEVEN","EIGHT","NINE"," ");
		$ten = array("TEN","TWENTY","THIRTY","FOURTY","FIFTY","SIXTY","SEVENTY","EIGHTY","NINETY"," ");
		$tenth = array("ELEVEN","TWELVE","THIRTEEN","FOURTEEN","FIFTEEN","SIXTEEN","SEVENTEEN","EIGHTEEN","NINETEEN"," "); 
		$newMoney;
		$isCent=0;
		if ($split[1]=='.'){
			if ($split[2] == '1'){$first = 'HUNDRED';} 
			else if ($split[2] == '0'){$first = ' ';} 
			else {$first = str_replace($numbers, $number , $split[2] ).' HUNDRED ';}
			if ($split[0] == '1'){$firstNumer = 'THOUSAND';} 
			else {$firstNumer = str_replace($numbers, $number , $split[0] ).' THOUSAND';}
			$newMoney = $firstNumer.' '.$first.' '.str_replace($numbers, $ten , $split[3]).' '.str_replace($numbers, $number, $split[4]).'" '.$cash;
		}else if($split[2]=='.'){
			
			if ($split[3] == '1'){$first = 'HUNDRED';} 
			else if ($split[3] == '0'){$first = ' ';}
			else {$first = str_replace($numbers, $number, $split[3] ).' HUNDRED ';}
			if (in_array($split[0].$split[1],$numbersD)){
				$tentyh = str_replace($numbersD, $tenth, $split[0].$split[1]);
			}else{
				$tentyh = str_replace($numbers, $ten , $split[0]).' '.str_replace($numbers, $number, $split[1]);
			}
			$newMoney = $tentyh.' THOUSAND '.$first.str_replace($numbers, $ten , $split[4]).' '.str_replace($numbers, $number, $split[5]).'" '.$cash;
		}else if($split[3]=='.' ){
			if ($split[0] == '1'){$hnd = 'HUNDRED';} 
			else if ($split[0] == '0'){$hnd = ' ';} 
			else {$hnd = str_replace($numbers, $number , $split[0]).' HUNDRED ';}
			if ($split[4] == '1'){$first = 'HUNDRED';} 
			elseif ($split[4] == '0'){$first = '';}
			else {$first = str_replace($numbers, $number , $split[4]).' HUNDRED ';}
			if (in_array($split[1].$split[2],$numbersD)){
				$tentyh = str_replace($numbersD, $tenth, $split[1].$split[2]);
			}else{
				$tentyh = str_replace($numbers, $ten , $split[1]).' '.str_replace($numbers, $number, $split[2]);
			}
			
			$newMoney = $hnd.' '.$tentyh.' THOUSAND '.$first.' '.str_replace($numbers, $ten , $split[5]).' '.str_replace($numbers, $number, $split[6]).'" '.$cash;
		}else {
			if (empty($split[1])){$first = str_replace($numbers, $number , $split[0]).' ';}
			else if (empty($split[2])){$second = str_replace($numbers, $number , $split[1]); if ($split[0] == '1'){$first = 'ON';} else {$first = str_replace($numbers, $ten , $split[0]).' ';}}
			else{if ($split[0] == '1'){$first = 'HUNDRED';$second = str_replace($numbers, $ten , $split[1]);} else {$first = str_replace($numbers, $number , $split[0]).' HUNDRED ';$second = str_replace($numbers, $ten , $split[1]);}}
			$newMoney = $first.$second.' '.str_replace($numbers, $number, $split[2].'"  '.$cash);
		}
		if ($split[count($split)-3]==','){
			$centLast = $split[count($split)-1];
			$centFirst = $split[count($split)-2];
			$centos = '"'.str_replace($numbers, $ten , $centFirst).' '.str_replace($numbers, $number , $centLast).'" '.$change;
			$isCent=1;
		}
		if ($isCent == 0){
		return 'ONLY "'.$newMoney;
		} else {
			return 'ONLY "'.$newMoney.' '.$centos;
		}
	}
	
