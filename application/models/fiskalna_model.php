<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fiskalna_model extends CI_Model {

	public function fiskallna_smetka($naracka_naziv_artikli,$naracka_cena,$naracka_kolicina,$naracka_popust){

		// LOG HEADER
		date_default_timezone_set('Europe/Skopje'); // used for log
		$date_time = date("d/m/Y h:i:s"); // used for log
		$log_file = "./fiskallna/log.txt"; // log
		$fp_log = fopen( $log_file, "a" ) or die("Couldn't open $log_file");
		fwrite( $fp_log, PHP_EOL . PHP_EOL . "***************************************************************** " . PHP_EOL); // log
		fwrite( $fp_log, "Koha: " . $date_time . PHP_EOL);
		fwrite( $fp_log, "Porosia: " . PHP_EOL); // log
		fwrite( $fp_log, "---------- " . PHP_EOL); // log
		// LOG HEADER END
		
	 
		if ($fh = fopen ( './fiskallna/llogaria1.txt', 'w' )) {
			flock( $fh, LOCK_EX ); // lock the file while writting into it
			$stringData = chr(32).chr(48).'1,0001,1';
			fwrite ( $fh, $stringData, 1024 );
			fwrite( $fp_log, $stringData); // log 
			for ($i=0; $i<count($naracka_naziv_artikli); $i++){		
				$sekvenca = $i + 35;
				//$str = PHP_EOL.chr('$sekvenca').chr(49).$naracka_naziv_artikli[$i].chr(10).' '+chr(9)+chr(195).$naracka_cena[$i].'*'.$naracka_kolicina[$i]	;
	     		$pjesa_1 = substr($naracka_naziv_artikli[$i],0,22);
	     		$pjesa_2 = substr($naracka_naziv_artikli[$i],22,strlen($naracka_naziv_artikli[$i]));
	     		// chr(195) -- kirilica G - nuk osht ddv obverznik MUND TE NDRYSHOJE
	     		// chr(42) -- *
	     		// chr(49) -- 1 - ashtu duhet tiet perher
	     		// chr(10) -- new line - ashtu duhet tiet
	     		// chr(42) -- *
	     		// chr(44) -- , - per nfund popust
	     		// pa popust -- per backup -- nrast se spunon me popust
	     		//$str = PHP_EOL.chr($sekvenca).chr(49).$pjesa_1.chr(10).$pjesa_2.chr(9).chr(195).number_format($naracka_cena[$i],2,'.','').chr(42).number_format($naracka_kolicina[$i],3,'.','');
	     		$str = PHP_EOL.chr($sekvenca).chr(49).$pjesa_1.chr(10).$pjesa_2.chr(9).chr(195).number_format($naracka_cena[$i],2,'.','').chr(42).number_format($naracka_kolicina[$i],3,'.','').chr(44).number_format($naracka_popust[$i],2,'.','');

	     		fputs($fh, $str, 1024);

	     		fwrite($fp_log, $str); // log
			}
			// chr(120) -- random ashtu duhet tiet per tqon karakter ma ndryshe se paraardhesi
			// chr(121) -- random ashtu duhet tiet per tqon karakter ma ndryshe se paraardhesi
			// ose ne vend te chr(120) = chr(36)
			$strG = PHP_EOL.chr(120).chr(53).chr(9);
			fputs($fh, $strG, 1024);
			fwrite( $fp_log, $strG); // log 
			// ose ne vend te chr(121) = chr(37)
			$strG = PHP_EOL.chr(121).chr(56);
			fputs($fh, $strG, 1024);	
			fwrite( $fp_log, $strG); // log 
			flock( $fh, LOCK_UN ); // added 07/11/2015

			fclose ( $fh );
			exec ( "C:\\wamp\\www\\pronto\\fiskallna\\david32.exe C:\\wamp\\www\\pronto\\fiskallna\\llogaria1.txt" , $output, $return_var);
			
			fwrite( $fp_log, PHP_EOL . "---------- "); // log
			for ($i=0; $i < count($output) ; $i++) { 
				fwrite( $fp_log, PHP_EOL . "Returned: " . $output[$i]); // log result from exe
			}
			//$myFile = "./fiskallna/Razvigorec.log";
			//unlink($myFile);
			//$this->load->view('header');
			//$this->load->view('login_view');
		}else{
			fwrite( $fp_log, "CAN'T EVEN OPEN THE FILE!!!!!!! " . PHP_EOL); // log
		}
		fclose( $fp_log );
	}

	public function raport_fiscal($tip){
		// $tip == 1 - RAPORT PA MBYLLJE DITORE
		// $tip == 2 - HYRJE ZYRTARE
		// $tip == 3 - DALJE ZYRTARE
		// $tip == 4 - RAPORT I SHKURTE
		// $tip == 5 - RAPORT DETAL
		// $tip == 6 - RAPORT ME MBYLLJE DITORE !!!

		// LOG HEADER
		date_default_timezone_set('Europe/Skopje'); // used for log
		$date_time = date("d/m/Y h:i:s"); // used for log
		$log_file = "./fiskallna/log_raport.txt"; // log per raportet
		$fp_log = fopen( $log_file, "a" ) or die("Couldn't open $log_file");
		fwrite( $fp_log, PHP_EOL . PHP_EOL . "***************************************************************** " . PHP_EOL); // log
		fwrite( $fp_log, "Koha: " . $date_time . PHP_EOL);
		fwrite( $fp_log, "RAPORT FISKAL" . PHP_EOL); // log
		fwrite( $fp_log, "---------- " . PHP_EOL); // log
		// LOG HEADER END

		if ($tip == 1){ // RAPORT PA MBYLLJE DITORE
			fwrite( $fp_log, PHP_EOL . "-- TIPI: RAPORT PA MBYLLJE DITORE -- "); // log
			exec("C:\\wamp\\www\\pronto\\fiskallna\\david32.exe C:\\wamp\\www\\pronto\\fiskallna\\Dneven_bez.txt" , $output, $return_var);
			for ($i=0; $i < count($output) ; $i++) { 
				fwrite( $fp_log, PHP_EOL . "Returned: " . $output[$i]); // log result from exe
			}
		}else if($tip == 2){ // HYRJE ZYRTARE
			if ($fh = fopen ('./fiskallna/hyrje_zyrtare.txt', 'w')){
				$suma = $this->input->post('suma_hyrje');

				if (isset($suma) && $suma != ''){
					fwrite( $fp_log, PHP_EOL . "-- TIPI: HYRJE ZYRTARE , suma = ". $suma ." -- "); // log
					$stringData = chr(67).chr(70).number_format($suma,2,'.','');
					fwrite ( $fh, $stringData, 1024 );
				
					fclose ($fh);
					exec ("C:\\wamp\\www\\liquid\\fiskallna\\david32.exe C:\\wamp\\www\\liquid\\fiskallna\\hyrje_zyrtare.txt" , $output, $return_var);
					
					for ($i=0; $i < count($output) ; $i++) { 
						fwrite( $fp_log, PHP_EOL . "Returned: " . $output[$i]); // log result from exe
					}
				}
			}else{
				echo "Error in hyrje_zyrtare";
			}
		}else if($tip == 3){ // DALJE ZYRTARE
			if ($fh = fopen ('./fiskallna/dalje_zyrtare.txt', 'w')){
				$suma = $this->input->post('suma_dalje');
				if (isset($suma) && $suma != ''){
					fwrite( $fp_log, PHP_EOL . "-- TIPI: DALJE ZYRTARE , suma = ". $suma ." -- "); // log
					$stringData = chr(67).chr(70).chr(45).number_format($suma,2,'.','');
					fwrite ( $fh, $stringData, 1024 );

					fclose ($fh);
					exec ("C:\\wamp\\www\\liquid\\fiskallna\\david32.exe C:\\wamp\\www\\liquid\\fiskallna\\dalje_zyrtare.txt" , $output, $return_var);
					for ($i=0; $i < count($output) ; $i++) { 
						fwrite( $fp_log, PHP_EOL . "Returned: " . $output[$i]); // log result from exe
					}
				}
			}else{
				echo "Error in dalje_zyrtare";
			}
		}else if($tip == 4){ // RAPORT I SHKURTE
			$date_start = $this->input->post('date_start_shkurt');
			$date_end = $this->input->post('date_end_shkurt');
			
			if(isset($date_start) && $date_start != '' && isset($date_end) && $date_end != '' && $date_start <= $date_end){
				$date_start_formated = date_format(DateTime::createFromFormat('d/m/Y', $date_start),"dmy");
				$date_end_formated = date_format(DateTime::createFromFormat('d/m/Y', $date_end),"dmy");
			}else{
				echo "Error in dateformat";
				exit();
			}
	
			if ($fh = fopen ( './fiskallna/Raport_shkurte.txt', 'w' )) {
				fwrite( $fp_log, PHP_EOL . "-- TIPI: RAPORT I SHKURTE , DATA START = ". $date_start ." DATA END = ". $date_end ."-- "); // log
				$stringData = chr(55).chr(79).$date_start_formated.','.$date_end_formated;
				fwrite ( $fh, $stringData, 1024 );
				fclose ( $fh );

				exec ( "C:\\wamp\\www\\liquid\\fiskallna\\david32.exe C:\\wamp\\www\\liquid\\fiskallna\\Raport_shkurte.txt" , $output, $return_var);
				for ($i=0; $i < count($output) ; $i++) { 
					fwrite( $fp_log, PHP_EOL . "Returned: " . $output[$i]); // log result from exe
				}
			}else{
				echo "Error in raport_shkurte";
			}
		}else if($tip == 5){ // RAPORT DETAL
			$date_start = $this->input->post('date_start_detal');
			$date_end = $this->input->post('date_end_detal');

			if(isset($date_start) && $date_start != '' && isset($date_end) && $date_end != '' && $date_start <= $date_end){
				$date_start_formated = date_format(DateTime::createFromFormat('d/m/Y', $date_start),"dmy");
				$date_end_formated = date_format(DateTime::createFromFormat('d/m/Y', $date_end),"dmy");
			}else{
				echo "Error in dateformat";
				exit();
			}

			if ($fh = fopen ( './fiskallna/Raport_detal.txt', 'w' )) {
				fwrite( $fp_log, PHP_EOL . "-- TIPI: RAPORT DETAL , DATA START = ". $date_start ." DATA END = ". $date_end ."-- "); // log
				$stringData = chr(55).chr(94).$date_start_formated.','.$date_end_formated;
				fwrite ( $fh, $stringData, 1024 );
				fclose ( $fh );

				exec ( "C:\\wamp\\www\\liquid\\fiskallna\\david32.exe C:\\wamp\\www\\liquid\\fiskallna\\Raport_detal.txt" , $output, $return_var );
				for ($i=0; $i < count($output) ; $i++) { 
					fwrite( $fp_log, PHP_EOL . "Returned: " . $output[$i]); // log result from exe
				}
			}else{
				echo "Error in raport_detal";
			}
		}else if($tip == 6){
			fwrite( $fp_log, PHP_EOL . "--TIPI: RAPORT ME MBYLLJE DITORE-- ");
			exec("C:\\wamp\\www\\pronto\\fiskallna\\david32.exe C:\\wamp\\www\\pronto\\fiskallna\\Dneven_so.txt" , $output, $return_var);
			for ($i=0; $i < count($output) ; $i++) { 
				fwrite( $fp_log, PHP_EOL . "Returned: " . $output[$i]); // log result from exe
			}
		}
		fclose($fp_log); // close log file
	}
}

/* End of file fiskalna_modal.php */
/* Location: ./application/models/fiskalna_modal.php */