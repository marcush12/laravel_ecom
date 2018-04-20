<?php

return array(
	# Account credentials from developer portal
	'Account' => array(
		// 'ClientId' => env('PAYPAL_CLIENT_ID', 'Af8hJk9EsuwX512rQaw4HAByZtTcZZxwFM1nLB63czWlEyVXPMbk5NsCR0_YEPgEipP_33Z6SdcHssSM'),
		// 'ClientSecret' => env('PAYPAL_CLIENT_SECRET', 'ELXwffXzhVXqE6YGNFxn1yjgX-pWdA-hsv9OoqZ3_T2fSf5rlP0_1Wo8Vmi5ZQrXQSDjMbASDoRkkeUi'),
		'ClientId' => 'Af8hJk9EsuwX512rQaw4HAByZtTcZZxwFM1nLB63czWlEyVXPMbk5NsCR0_YEPgEipP_33Z6SdcHssSM',
		'ClientSecret' => 'ELXwffXzhVXqE6YGNFxn1yjgX-pWdA-hsv9OoqZ3_T2fSf5rlP0_1Wo8Vmi5ZQrXQSDjMbASDoRkkeUi'
	),

	# Connection Information
	'Http' => array(
		// 'ConnectionTimeOut' => 30,
		'Retry' => 1,
		//'Proxy' => 'http://[username:password]@hostname[:port][/path]',
	),

	# Service Configuration
	'Service' => array(
		# For integrating with the live endpoint,
		# change the URL to https://api.paypal.com!//de verdade aqui
		'EndPoint' => 'https://api.sandbox.paypal.com',
	),


	# Logging Information
	'Log' => array(
		//'LogEnabled' => true,

		# When using a relative path, the log file is created
		# relative to the .php file that is the entry point
		# for this request. You can also provide an absolute
		# path here
		'FileName' => '../PayPal.log',

		# Logging level can be one of FINE, INFO, WARN or ERROR
		# Logging is most verbose in the 'FINE' level and
		# decreases as you proceed towards ERROR
		//'LogLevel' => 'FINE',
	),
);
