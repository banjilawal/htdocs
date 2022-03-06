<?php
    // paths
    define ('ROOT_PATH', realpath(__FILE__));
    define ('PROJECT_PATH', ROOT_PATH);

    define ('PUBLIC_PATH', ROOT_PATH . '\public');
    define ('STYLE_PATH', ROOT_PATH . '\style');
    define ('SOURCE_PATH', ROOT_PATH . '\src');
    define ('LIBRARY_PATH', SOURCE_PATH . '\lib');
    define ('CLASS_PATH', SOURCE_PATH . '\class');

    define ('ASSET_PATH', ROOT_PATH . '\assets');
    define ('IMAGE_DIRECTORY', ASSET_PATH . '\sneakers');

    // constants
    define ('SHOE_CATALOG_SIZE', 10);
    define ('MIN_SHOE_SIZE', 7);
    define ('MAX_SHOE_SIZE', 13);
    define ('DEFAULT_SHOE_SIZE', 10);

    define ('LOWEST_PRICE', 19);
    define ('HIGHEST_PRICE', 199);

    define ('SALES_TAX_RATE', 0.10);
    define ('MAX_BRANDS_ON_SALE', 5);
    define ('SALE_BRANDS_DISCOUNT_RATE', 0.4);
    define ('MAX_REGULAR_DISCOUNT_RATE', 0.6);
    define ('MAX_COMBINED_DISCOUNT_RATE', 0.6);


    //define ('IMAGE_DIRECTORY', 'C:/xampp/htdocs/labs/lab-04/assets/sneakers/'); //'../assets/sneakers/');
    define ('LETTERS', array('A','B','C','D','E','F','G','H','J','K','L','M','N','P','Q','R','S','T','U','V','W','X','Y','Z'));
    define ('BRAND_NAMES', array("Bata","Clarks","Nike","Vans","Boston","Salomon","Testoni","Berluti","Reebok","Skechers","Red Wing","Keen","Ecco","Heely","New Balance","Asics","Puma","Adidas"));

    define ('MODELS', array("Bakhchiev","Pavlocich","Belisario","Elysees","Greinacher","Pays","Busching","Threnos","Tomasche","Oyle","Eschenbach","Pilss","Granat","Hands",
        "Margueite","Fleisher","Didjeridu","Saraban","Espan","Guttler","Firkusny","Yorkshire","Nowell","Selles","Vroons","Schicksalslie","Teramo","Bernfeld","Naegele",
        "Aeria","Busching","Noferi","Dizzi","Bars","Bester","Glauser","Bogaerts","Veils","Manzoni","Amorosa","Urbini","Nono","Cire","Wiklund","Soloist","Ponkin","Larviksp",
        "Leuchten","Dino","Piccinini","Michala","Iwasaki","Hearted","Bihlmaier","Viaggio","Viljakainen","Meylan","Ives","Reverence","Freibert","Knut","Garvelmann","Evenhymn",
        "Bresden","Honours","Lentz","Kober","Sephardim","Pasino","Chambon","Rheinla","Instrumentalis","Gorne","Nyffenegger","Paladins","Dushchenko","Anaosov","Rochberg",
        "Iwaki","Conversione","Pellie","Reznikoff","Postilion","Lizst","Dubar","Foldes","Lluna","Cata","Bondi","Althann","Jaroslav","Ranzani","Presenting","Temps","Watching",
        "Konzerstuck","Veyron","Biarent","Higginson","Mercre","Turetschek","Harty","Pomerian","Zagorinsky","Grammy","Wilm","Soren","Volpi","Germa","Misterio","Rotterdam",
        "Tabakov","Siegf","Kabaiwanska","Resurrection","Palma","Grasso","Haselboeck","Duos","Asheknazy","Visions","Dreame","Omar","Krafft","Alta","Sommerfest","Symphonists",
        "Sensations","Leande","Redel","Leman","Kerner","Entertainment","Cavasanti","Misha","Witwe","Nikolaeva","Reyna","Markus","Wildhaber","Waggoner","Adeste"));
?>