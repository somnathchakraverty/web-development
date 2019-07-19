<?php

return [

	'relations'	=>[
		'spouse'		=>	'Spouse',
		'child'			=>	'Child',
		'parent'		=>	'Parent',
		'grand parent'	=>	'Grand parent',
		'sibling'		=>	'Sibling',
		'friend'		=>	'Friend',
		'relative'		=>	'Relative',
		'neighbour'		=>	'Neighbour',
		'colleague'		=>	'Colleague',
		'others'		=>	'Others'
	],
    'encrypt_keys'   =>  [
        'booking_id', 'mobile', 'contact_number'
    ],
    'remove_package_detail'	=>	[
    	'healthians-hba1c-test',	'healthians-vitamin-test',	'healthians-thyroid-test',	'healthians-preventive-health-checkup'
    ]

    
];  