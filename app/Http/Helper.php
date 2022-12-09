<?php
if (! function_exists('get_current_userObj')) {
  function get_current_userObj($company_id='')
  {
    if(!Auth::check() && $company_id != '')
    {
      \Session::put('company', ['company_id' => $company_id]);
      $result['company_id'] = $company_id;
      return $result;
    }

    if(Auth::check())
    {
      $result['user_id'] = Auth::user()->id;
    }

    $result['company_id'] = \Session::get('company')['company_id'];
    return $result;
  }
}

if (! function_exists('pmode')) {
  function pmode($data, $is_end = 1)
  {
     echo "<pre>";
     print_r($data);
     echo "<br>";

     if($is_end == 1){
      die('end of print mode');
     }
  }
} 

if(! function_exists('pwrite')) {

      /**
     * @author      Muruga
     * @date        10/31/2022
     * @description This will be return the fclose Data.
     **/
    function pwrite($text, $fileName = 'noname.txt', $isPublic = true)
    {
        if (!is_array($text)) {
            $text .= ' - ' . date('Y-m-d H:i:s') . "\n";
        }

        if ($isPublic) {
            $file = public_path($fileName);
        } else {
            $file = storage_path($fileName);
        }

        $myfile = fopen($file, 'a');
        fwrite($myfile, print_r($text, true));
        fclose($myfile);
    }

}

if(! function_exists('getBalanceSheetAccountsType')) {
  function getBalanceSheetAccountsType()
  {
    return ['Other Current Asset', 'Fixed Asset', 'Other Asset', 'Other Current Liability', 'Long Term Liability', 'Accounts Payable', 'Accounts Receivable', 'Bank', 'Credit Card', 'Equity'];
  }
}

if(! function_exists('getProfitAndLossAccountsType')) {
  function getProfitAndLossAccountsType()
  {
    return ['Income', 'Expense', 'Other Income', 'Other Expense', 'Cost of Goods Sold'];
  }
}

if (! function_exists('dec_enc')) {
  function dec_enc($action, $string) 
  {
      $output = false;
   
      $encrypt_method = "AES-256-CBC";
      $secret_key     = 'smarT!@#123';
      $secret_iv      = 'reporT!@#123';
   
      // hash
      $key = hash('sha256', $secret_key);
      
      // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
      $iv = substr(hash('sha256', $secret_iv), 0, 16);
   
      if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = substr(base64_encode($output), 0, -2);
      }
      else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
      }
   
      return $output;
  }
}

if (! function_exists('getRoutes')){  
  function getRoutes()
  {
    $allRoutes = []; 

    foreach (\Route::getRoutes()->getRoutes() as $route) {
        $action = $route->getAction();
        if (array_key_exists('as', $action)) {
            $commonRoutes[] = $action['as'];
        }
    }

    $allRoutes['common_routes']       = array_slice($commonRoutes, 14, 2);  //14 to 15
    $allRoutes['view_all_companies']  = array_slice($commonRoutes, 16, 25); //16 to 39
    $allRoutes['report_config']       = array_slice($commonRoutes, 41, 2);  //41 to 40
    $allRoutes['report_list']         = array_slice($commonRoutes, 43, 11); //43 to 51
    $allRoutes['user_list']           = array_slice($commonRoutes, 54, 11); //54 to 64
    $allRoutes['company_group']       = array_slice($commonRoutes, 65, 10); //65 to 74
    $allRoutes['view_report_package'] = array_slice($commonRoutes, 75, 11); //70 to 80
    $allRoutes['redirect_global']     = array_slice($commonRoutes, 86, 1); //70 to 80

    return $allRoutes;
  }
}

if (! function_exists('dentalSuppliers')){  
  function dentalSuppliers()
  {
    $topSuppliers = [
      "John Wick",
      "Dwayne Johnson",
      "Ryan Reynolds",
      "Dave Bautista",
      "Chris Evans",
      "Robert Downey Jr",
      "Tony Stark",
      "Pepper Potts",
      "Sam",
      "Hugh Jackman"
    ];

    return $topSuppliers;
  }
}

if(! function_exists('getQuarter')){
  function getQuarter(\DateTime $DateTime, $year) {
		$y = $DateTime->format('Y');
		$m = $DateTime->format('m');
		switch($m) {
			case $m >= 1 && $m <= 3:
				$start = $year.'-01-01';
				$end = (new DateTime('03/1/'.$year))->modify('Last day of this month')->format('Y-m-d');
				$title = 'Q1 '.$year;
				break;
			case $m >= 4 && $m <= 6:
				$start = $year.'-04-01';
				$end = (new DateTime('06/1/'.$year))->modify('Last day of this month')->format('Y-m-d');
				$title = 'Q2 '.$year;
				break;
			case $m >= 7 && $m <= 9:
				$start = $year.'-07-01';
				$end = (new DateTime('09/1/'.$year))->modify('Last day of this month')->format('Y-m-d');
				$title = 'Q3 '.$year;
				break;
			case $m >= 10 && $m <= 12:
				$start = $year.'-10-01';
				$end = (new DateTime('12/1/'.$year))->modify('Last day of this month')->format('Y-m-d');
				$title = 'Q4 '.$y;
				break;
		}
		return array(
				'start' => $start,
				'end' => $end,
				'title'=>$title,
				'start_nix' => strtotime($start),
				'end_nix' => strtotime($end)
		);
	}
}

if(! function_exists('dateDifference')){
  function dateDifference($start_date, $end_date)
  {
      // calulating the difference in timestamps 
      $diff = strtotime($start_date) - strtotime($end_date);
      
      // 1 day = 24 hours 
      // 24 * 60 * 60 = 86400 seconds
      return ceil(abs($diff / 86400));
  }
}

if (! function_exists('monthDifferenceBtwDates')) {
  function monthDifferenceBtwDates($start, $end)
  {
    $origin = new DateTime($start);
    $target = new DateTime($end);
    $target->modify('+1 day');

    $interval = $origin->diff($target);

    $years = $interval->format('%y');
    $months = $interval->format('%m');
    $days = $interval->format('%d');

    $numberOfMonths = ($years * 12) + ($months) + ($days / 30);

    return round($numberOfMonths, 2);
  }
}

if( ! function_exists('currentQuarterNumber')) {
  function currentQuarterNumber()
  {
      $month = date('n');

      if ($month <= 3) return 1;
      if ($month <= 6) return 2;
      if ($month <= 9) return 3;

      return 4;
  }
}

if (!function_exists('getMonthsOfTheQuarter')) {
  function getMonthsOfTheQuarter($quarter){
      switch($quarter) {
          case 1: return array('Jan', 'Feb', 'Mar');
          case 2: return array('Apr', 'May', 'Jun');
          case 3: return array('Jul', 'Aug', 'Sep');
          case 4: return array('Oct', 'Nov', 'Dec');
      }
  }
}
