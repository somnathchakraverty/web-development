<?php

return [
	'payment_methods' => [
		'paytm' =>	[
			'id'			=>	'paytm_1',
			'label' 		=> 	'Pay With PayTm',
			'name' 			=> 	'PayTm',
			'img'			=>	'/img/paytm_payment.png',
			'is_online'		=>	1,
			'coupon_code'	=>	'paytm'
		],
		'mobikwik' =>	[
			'id'			=>	'mobikwik_2',
			'label' 		=> 	'Pay with MobiKwik',
			'name' 			=> 	'mobiKwik',
			'img'			=>	'/img/mobikwik_payment.png',
			'is_online'		=>	1,
			'coupon_code'	=>	'mobikwik'
		],
		'payu' =>	[
			'id'			=>	'payu_3',
			'label' 		=> 	'Pay with Credit Card / Debit Card / Netbanking / PayU Wallet',
			'name' 			=> 	'PayU',
			'img'			=>	'/img/payu_payment.png',
			'is_online'		=>	1,
			'coupon_code'	=>	'payu'
		],
		'cash'	=>	[
			'id'			=>	'cash_4',
			'label' 		=> 	'Cash/Card on Sample Collection (Card Swiping Machine available)',
			'name' 			=> 	'cash',
			'img'			=>	'/img/cash_payment.png',
			'is_online'		=>	0,
			'coupon_code'	=>	'cod'
		]
	],
	'donation_method' =>	[
		'yuvraj_foundation'	=>	[
							'id'			=>	'yuvraj_foundation_1',
							'label' 		=> 	'Donation to Yuvraj Singh Foundation',
							'name' 			=> 	'yuvraj_foundation',
							'donation_amt'	=>	10,
							'detail_link'	=>	'url'
						]
	],
	'extra_features' =>	[
		'hard_copy'	=>	[
						'id'			=>	'hard_copy_1',
						'label' 		=> 	'Want to hard Copy of Report?',
						'name' 			=> 	'hard_copyd',
						'donation_amt'	=>	50,
						'detail_link'	=>	'url'
					]
	]
];