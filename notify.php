<?php


	define('CB_SECRET_KEY', '*****'); // Your ClickBank Secret Key.
	define('FROM_EMAIL_ADDRESS', 'noreply@yourdomain.com'); // E.g. noreply@yourdomain.com
	define('TO_EMAIL_ADDRESS', 'Your email address@gmail.com'); // Your email address.

	define('LOG_TXT_ERRORS', 'requests-bad.txt');	// The log-file for all failed transactions (txt). Leave it empty to disable this feature.
	define('LOG_TXT_GOOD', 'requests-good.txt');	// The log-file for all successful transactions (txt). Leave it empty to disable this feature.
	define('LOG_TXT_ALL', 'requests-all.txt');		// The log-file for all transactions (txt). Leave it empty to disable this feature.

	define('EXIT_ON_TEST', 1); // 0 or 1. In case of 1, you won't receive email notifications for TEST-transactions.

function logInput($file_name, $input) {
	if ($file_name != '') {
		file_put_contents($file_name, trim($input) . "\n", FILE_APPEND | LOCK_EX);
	}
}

function formatPrice($price, $currency, $showSign = true) {
	$ret = $showSign || $price < 0 ? ($price >= 0 ? '+' : '-') : '';
	$ret .= $currency == 'USD' ? '$' : '';
	$ret .= number_format(abs($price), 2);
	$ret .= $currency != 'USD' && $currency != '?' ? " $currency" : '';
	return $ret;
}

function mail_utf8($from, $to, $subject = '(No subject)', $message = '', $header = '') {
	$header_ = ($from != '' ? "From: $from\r\n" : '')
		. "MIME-Version: 1.0\r\n"
		. "Content-type: text/html; charset=UTF-8\r\n";
	mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $message, $header_ . $header);
}

$countries = array(
'AD'=>'ANDORRA','AE'=>'UNITED ARAB EMIRATES','AF'=>'AFGHANISTAN','AG'=>'ANTIGUA & BARBUDA','AI'=>'ANGUILLA','AL'=>'ALBANIA','AM'=>'ARMENIA','AN'=>'NETHERLANDS ANTILLES',
'AO'=>'ANGOLA','AQ'=>'ANTARCTICA','AR'=>'ARGENTINA','AS'=>'AMERICAN SAMOA','AT'=>'AUSTRIA','AU'=>'AUSTRALIA','AW'=>'ARUBA','AX'=>'ALAND ISLANDS','AZ'=>'AZERBAIJAN',
'BA'=>'BOSNIA AND HERZEGOVINA','BB'=>'BARBADOS','BD'=>'BANGLADESH','BE'=>'BELGIUM','BF'=>'BURKINA FASO','BG'=>'BULGARIA','BH'=>'BAHRAIN','BI'=>'BURUNDI',
'BJ'=>'BENIN','BM'=>'BERMUDA','BN'=>'BRUNEI DARUSSALAM','BO'=>'BOLIVIA','BR'=>'BRAZIL','BS'=>'BAHAMAS','BT'=>'BHUTAN','BV'=>'BOUVET IS','BW'=>'BOTSWANA',
'BY'=>'BELARUS','BZ'=>'BELIZE','CA'=>'CANADA','CC'=>'COCOS (KEELING) IS','CD'=>'CONGO, THE DEM REP OF','CF'=>'CENTRAL AFRICAN REP','CG'=>'CONGO','CH'=>'SWITZERLAND',
'CI'=>'COTE D IVOIRE','CK'=>'COOK ISLANDS','CL'=>'CHILE','CM'=>'CAMEROON','CN'=>'CHINA','CO'=>'COLOMBIA','CR'=>'COSTA RICA','CV'=>'CAPE VERDE','CW'=>'CURACAO',
'CX'=>'CHRISTMAS ISLAND','CY'=>'CYPRUS','CZ'=>'CZECH REP','DE'=>'GERMANY','DJ'=>'DJIBOUTI','DK'=>'DENMARK','DM'=>'DOMINICA','DO'=>'DOMINICAN REPUBLIC',
'DZ'=>'ALGERIA','EC'=>'ECUADOR','EE'=>'ESTONIA','EG'=>'EGYPT','EH'=>'WESTERN SAHARA','ER'=>'ERITREA','ES'=>'SPAIN','ET'=>'ETHIOPIA','FI'=>'FINLAND','FJ'=>'FIJI',
'FK'=>'FALKLAND IS','FM'=>'MICRONESIA','FO'=>'FAROE IS','FR'=>'FRANCE','GA'=>'GABON','GB'=>'UNITED KINGDOM','GD'=>'GRENADA','GE'=>'GEORGIA','GF'=>'FRENCH GUIANA',
'GG'=>'GUERNSEY','GH'=>'GHANA','GI'=>'GIBRALTAR','GL'=>'GREENLAND','GM'=>'GAMBIA','GN'=>'GUINEA','GP'=>'GUADELOUPE','GQ'=>'EQUATORIAL GUINEA','GR'=>'GREECE',
'GS'=>'SOUTH GEORGIA','GT'=>'GUATEMALA','GU'=>'GUAM','GW'=>'GUINEA-BISSAU','GY'=>'GUYANA','HK'=>'HONG KONG','HM'=>'HEARD AND MCDONALD IS','HN'=>'HONDURAS',
'HR'=>'CROATIA','HT'=>'HAITI','HU'=>'HUNGARY','IC'=>'CANARY IS','ID'=>'INDONESIA','IE'=>'IRELAND','IL'=>'ISRAEL','IM'=>'ISLE OF MAN','IN'=>'INDIA','IO'=>'BRIT INDIAN OCEAN TERR',
'IS'=>'ICELAND','IT'=>'ITALY','JE'=>'JERSEY','JM'=>'JAMAICA','JO'=>'JORDAN','JP'=>'JAPAN','KE'=>'KENYA','KG'=>'KYRGYZSTAN','KH'=>'CAMBODIA','KI'=>'KIRIBATI',
'KM'=>'COMOROS','KN'=>'ST KITTS & NEVIS','KR'=>'KOREA (SOUTH)','KW'=>'KUWAIT','KY'=>'CAYMAN IS','LB'=>'LEBANON','LC'=>'ST LUCIA','LI'=>'LIECHTENSTEIN',
'LK'=>'SRI LANKA','LR'=>'LIBERIA','LS'=>'LESOTHO','LT'=>'LITHUANIA','LU'=>'LUXEMBOURG','LV'=>'LATVIA','MA'=>'MOROCCO','MC'=>'MONACO','MD'=>'MOLDOVA, REPUBLIC OF',
'ME'=>'MONTENEGRO','MF'=>'ST MAARTEN','MG'=>'MADAGASCAR','MH'=>'MARSHALL ISLANDS','MK'=>'MACEDONIA','ML'=>'MALI','MM'=>'MYANMAR','MN'=>'MONGOLIA','MO'=>'MACAO',
'MP'=>'NORTHERN MARIANA IS','MQ'=>'MARTINIQUE','MR'=>'MAURITANIA','MS'=>'MONTSERRAT','MT'=>'MALTA','MU'=>'MAURITIUS','MV'=>'MALDIVES','MW'=>'MALAWI','MX'=>'MEXICO',
'MY'=>'MALAYSIA','MZ'=>'MOZAMBIQUE','NA'=>'NAMIBIA','NC'=>'NEW CALEDONIA','NE'=>'NIGER','NF'=>'NORFOLK IS','NG'=>'NIGERIA','NI'=>'NICARAGUA','NL'=>'NETHERLANDS',
'NO'=>'NORWAY','NP'=>'NEPAL','NR'=>'NAURU','NU'=>'NIUE IS','NZ'=>'NEW ZEALAND','OM'=>'OMAN','PA'=>'PANAMA','PE'=>'PERU','PF'=>'FRENCH POLYNESIA','PG'=>'PAPUA NEW GUINEA',
'PH'=>'PHILIPPINES','PK'=>'PAKISTAN','PL'=>'POLAND','PM'=>'ST PIERRE & MIQUELON','PN'=>'PITCAIRN IS','PR'=>'PUERTO RICO','PS'=>'PALESTINIAN TERRITORY',
'PT'=>'PORTUGAL','PW'=>'PALAU','PY'=>'PARAGUAY','QA'=>'QATAR','RE'=>'REUNION IS','RO'=>'ROMANIA','RS'=>'SERBIA','RU'=>'RUSSIAN FEDERATION','RW'=>'RWANDA',
'SA'=>'SAUDI ARABIA','SB'=>'SOLOMON IS','SC'=>'SEYCHELLES','SD'=>'SUDAN','SE'=>'SWEDEN','SG'=>'SINGAPORE','SH'=>'ST HELENA','SI'=>'SLOVENIA','SJ'=>'SVALBARD & JAN MAYEN IS',
'SK'=>'SLOVAK REP','SL'=>'SIERRA LEONE','SM'=>'SAN MARINO','SN'=>'SENEGAL','SO'=>'SOMALIA','SR'=>'SURINAME','ST'=>'SAO TOME & PRINCIPE','SV'=>'EL SALVADOR',
'SZ'=>'SWAZILAND','TC'=>'TURKS & CAICOS IS','TD'=>'CHAD','TF'=>'FR SOUTHERN TERR','TG'=>'TOGO','TH'=>'THAILAND','TJ'=>'TAJIKISTAN','TK'=>'TOKELAU','TL'=>'TIMOR-LESTE',
'TM'=>'TURKMENISTAN','TN'=>'TUNISIA','TO'=>'TONGA','TR'=>'TURKEY','TT'=>'TRINIDAD & TOBAGO','TV'=>'TUVALU','TW'=>'TAIWAN','TZ'=>'TANZANIA, UN REP OF','UA'=>'UKRAINE',
'UG'=>'UGANDA','UM'=>'USA MINOR OUTLYING IS','US'=>'UNITED STATES','UY'=>'URUGUAY','UZ'=>'UZBEKISTAN','VA'=>'HOLY SEE (VATICAN)','VC'=>'ST VINCENT & GRENADINES',
'VE'=>'VENEZUELA','VG'=>'VIRGIN IS (GB)','VI'=>'VIRGIN ISLANDS, U.S.','VN'=>'VIET NAM','VU'=>'VANUATU','WF'=>'WALLIS & FUTUNA IS','WS'=>'SAMOA','YE'=>'YEMEN',
'YT'=>'MAYOTTE','ZA'=>'SOUTH AFRICA','ZM'=>'ZAMBIA','ZW'=>'ZIMBABWE'
);



	$input = file_get_contents('php://input');
	logInput(LOG_TXT_ALL, $input);

	$message = json_decode($input);
	$encrypted = $message->{'notification'};
	$iv = $message->{'iv'};

	$decrypted = trim(
		openssl_decrypt(
			base64_decode($encrypted),
			'aes-256-cbc',
			substr(sha1(CB_SECRET_KEY), 0, 32),
			OPENSSL_RAW_DATA,
			base64_decode($iv)
		),
		"\0..\32"
	);


	$order = json_decode(mb_convert_encoding($decrypted, 'UTF-8'));

	if (!$order) {
		logInput(LOG_TXT_ERRORS, $input);
		exit('Error (verification)');
	} else {
		logInput(LOG_TXT_GOOD, $input);
	}

	if (EXIT_ON_TEST && strpos($order->transactionType, 'TEST') !== false) {
		exit();
	}

	$receipt = $order->receipt;
	$transactionType = $order->transactionType;

	$date = new DateTime($order->transactionTime);
	$date->setTimezone(new DateTimeZone('US/Pacific'));
	$d = $date->format('m/d/Y h:i A') . ' PST';

	$vendor = isset($order->vendor) ? $order->vendor : '';
	$affiliate = isset($order->affiliate) ? $order->affiliate : '';
	$role = isset($order->role) ? $order->role : '';
	$tids = isset($order->trackingCodes) ? $order->trackingCodes : array();

	$accountAmount = $order->totalAccountAmount;
	$accountAmountFormatted = formatPrice($accountAmount, 'USD'); // This amount is always in USD.
	$currency = isset($order->currency) ? $order->currency : '?';
	$orderAmount = $order->totalOrderAmount;
	$orderAmountFormatted = formatPrice($orderAmount, $currency);
	$paymentMethod = $order->paymentMethod;

	$isRecurring = false;
	foreach ($order->lineItems as $item) {
		if ($item->recurring) {
			$isRecurring = true;
			break;
		}
	}

	$customer = $state = $countryCode = $country = $postalCode = '';
	if (isset($order->customer) && isset($order->customer->billing)) {
		if (isset($order->customer->billing->email)) {
			$customer = $order->customer->billing->email;
		}
		if (isset($order->customer->billing->fullName)) {
			$customer = $order->customer->billing->fullName . ($customer != '' ? " ($customer)" : '');
		}
		if (isset($order->customer->billing->address)) {
			$address = $order->customer->billing->address;
			$state = isset($address->state) ? $address->state : '';
			$postalCode = isset($address->postalCode) ? $address->postalCode : '';
			$countryCode = isset($address->country) ? $address->country : '';
			$country = isset($countries[$countryCode]) ? $countries[$countryCode] : '';
		}
	}

	$subject = '>>> '
		. $order->transactionType
		. ($isRecurring && (strpos($transactionType, 'SALE') !== false || strpos($transactionType, 'RFND') !== false || strpos($transactionType, 'CGBK') !== false) ? '-RB' : '')
		. " $vendor"
		. (strpos($transactionType, 'CANCEL') === false ? " $accountAmountFormatted" : '')
		. " #$receipt $role";

	$msg = '<style type="text/css">td{font:13px Arial;padding:0 5px 0 0}</style><table>';
	$msg .= "<tr><td>Order #:</td><td><strong>$receipt</strong></td></tr>";
	$msg .= "<tr><td>Date:</td><td>$d</td></tr>";
	$msg .= "<tr><td>Transaction:</td><td>$transactionType " . ($isRecurring ? 'RECURRING' : 'STANDARD') . '</td></tr>';
	if (strpos($transactionType, 'CANCEL') === false) {
		$msg .= '<tr><td>Amount:</td><td><span style="font-weight:bold;color:#' . ($accountAmount >= 0 ? '090' : 'c00') . '">' . "$accountAmountFormatted</span> ($orderAmountFormatted) $paymentMethod</td></tr>";
	}
	$msg .= "<tr><td>Affiliate:</td><td>$affiliate</td></tr>";
	if (sizeof($tids) > 0) {
		$msg .= '<tr><td>Tracking:</td><td>' . implode(', ', $tids) . '</td></tr>';
	}

	$msg .= '<tr><td valign="top">Cart:</td><td><table><tr><td>***</td><td></td></tr>';
	foreach ($order->lineItems as $item) {
		$msg .= '<tr><td>Product Item:</td><td><a href="http://' . $item->itemNo . '.' . $vendor . '.pay.clickbank.net/" target="_blank">' . $item->itemNo . '</a></td></tr>'
			//. '<tr><td>Product Title:</td><td>' . htmlentities($item->productTitle, ENT_COMPAT, 'UTF-8') . '</td></tr>';
			. '<tr><td>Product Title:</td><td>' . $item->productTitle . '</td></tr>'
			. '<tr><td>Account Amount:</td><td><span style="color:#' . ($item->accountAmount >= 0 ? '090' : 'c00') . '">' . formatPrice($item->accountAmount, 'USD') . '</span></td></tr>';
		if ($item->recurring) {
			$status = $item->paymentPlan->rebillStatus;
			$freq = $item->paymentPlan->rebillFrequency;
			$rebill = formatPrice($item->paymentPlan->rebillAmount, $currency, false);
			$progress = $item->paymentPlan->paymentsProcessed . '/' . ($item->paymentPlan->paymentsProcessed + $item->paymentPlan->paymentsRemaining);

			$date = new DateTime($item->paymentPlan->nextPaymentDate);
			$date->setTimezone(new DateTimeZone('US/Pacific'));
			$rebillDate = $date->format('Y-m-d');

			$msg .= "<tr><td>Future:</td><td>$rebill on $rebillDate ($status $progress $freq)</td></tr>";
		}
		$msg .= '<tr><td>***</td><td></td></tr>';
	}
	$msg .= '</table></td></tr>';

	$msg .= $state != '' ? "<tr><td>State:</td><td>$state</td></tr>" : '';
	$msg .= "<tr><td>Country:</td><td>$countryCode" . ($country != '' ? " ($country)" : '') . '</td></tr>';
	if ($postalCode != '') {
		$msg .= '<tr><td>Zip:</td><td><a href="http://maps.google.com/?q=' . urlencode(($country != '' ? $country : $countryCode) . " $postalCode postal code") . '">' . $postalCode . '</a></td></tr>';
	}
	if ($customer != '') {
		$msg .= "<tr><td>Customer:</td><td>$customer</td></tr>";
	}

	if (isset($order->upsell)) {
		$msg .= '<tr><td valign="top">Upsell:</td><td><table>';
		if (isset($order->upsell->upsellOriginalReceipt)) {
			$msg .= '<tr><td>Original Receipt:</td><td>' . $order->upsell->upsellOriginalReceipt . '</td></tr>';
		}
		if (isset($order->upsell->upsellFlowId)) {
			$msg .= '<tr><td>Flow Id:</td><td>' . $order->upsell->upsellFlowId . '</td></tr>';
		}
		if (isset($order->upsell->upsellSession)) {
			$msg .= '<tr><td>Session:</td><td>' . $order->upsell->upsellSession . '</td></tr>';
		}
		if (isset($order->upsell->upsellPath)) {
			$msg .= '<tr><td>Path:</td><td>' . $order->upsell->upsellPath . '</td></tr>';
		}
		$msg .= '</table></td></tr>';
	}

	if (isset($order->vendorVariables)) {
		$msg .= '<tr><td valign="top">Variables:</td><td>';
		foreach (get_object_vars($order->vendorVariables) as $name=>$value) {
			$msg .= "$name=$value<br/>";
		}
		$msg .= '</td></tr>';
	}

	$msg .= '</table>';

@	mail_utf8(FROM_EMAIL_ADDRESS, TO_EMAIL_ADDRESS, $subject, $msg);

?>
OK