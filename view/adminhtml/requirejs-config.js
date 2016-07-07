var config = {
    map: {
        '*': {
            'pengo/note': 'Pengo_Bannerslider/js/jquery/slider/jquery-ads-note',
        },
    },
    paths: {
        'pengo/flexslider': 'Pengo_Bannerslider/js/jquery/slider/jquery-flexslider-min',
        'pengo/evolutionslider': 'Pengo_Bannerslider/js/jquery/slider/jquery-slider-min',
        'pengo/zebra-tooltips': 'Pengo_Bannerslider/js/jquery/ui/zebra-tooltips',
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
