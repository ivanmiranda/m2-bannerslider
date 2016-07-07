var config = {
	map: {
		'*': {
			'pengo/note': 'Pengo_Bannerslider/js/jquery/slider/jquery-ads-note',
			'pengo/impress': 'Pengo_Bannerslider/js/report/impress',
			'pengo/clickbanner': 'Pengo_Bannerslider/js/report/clickbanner',
		},
	},
	paths: {
		'pengo/flexslider': 'Pengo_Bannerslider/js/jquery/slider/jquery-flexslider-min',
		'pengo/evolutionslider': 'Pengo_Bannerslider/js/jquery/slider/jquery-slider-min',
		'pengo/popup': 'Pengo_Bannerslider/js/jquery.bpopup.min',
	},
	shim: {
		'pengo/flexslider': {
			deps: ['jquery']
		},
		'pengo/evolutionslider': {
			deps: ['jquery']
		},
		'pengo/zebra-tooltips': {
			deps: ['jquery']
		},
	}
};
