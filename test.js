"use strict";

var brands = ["Testoni","Aetrex","Aldo","Alegria","Alexander Mcqueen","Allen-Edmonds","Anne Klein","Annie","Armani","Beeko","Ben Sherman","Bernardo",
    "Betsey Johnson","Big Buddha","Blowfish","Blundstone","Bogs","Born","Boss black","Bostonian","Bottega veneta","Brighton","Bruno magli","Calvin klein","Camper",
    "Cesare paciotti","Chaco","Clarks","Cobb hill","Cobian","Cole haan","Costume national","Crocs","Cushe","Dansko","Deer stags","DKNY","Dockers","Dolce & gabbana",
    "Dolce vita","Dr. martens","Dr. scholl's","Dsquared2","Dunham","Eastland","Ecco","Elephantito","Emerald by element","Emerica","Fendi","Fiel","Finn comfort",
    "Fitflop","Fitzwell","Florsheim","Fly flot","Footmates","Fossil","Franco sarto","Fratelli","Frye","Garvalin","Gbx","Gentle souls","Geox","Giorgio brutini",
    "Giuseppe zanotti","Gordon rush","Gravati","Guess","Havaianas","Hush puppies","Jambu","Johnston & murphy","Juicy couture","Kalso earth","Kamik",
    "Kate spade new york","Keds","Keen","Kelsi dagger","Kenneth cole","Lacoste","Lassen","Ralph lauren","Lifestride","Livie & luca","Lloyd","Lucky brand","Lumiani",
    "Madden girl","Magnanni","Marc jacobs","Matisse","Mephisto","Merrell","Michael Kors","Minnetonka","Naturino","Nautilus","Old friend","Olukai","Original penguin",
    "Patagonia","Pikolinos","Rockport","Romika","Roper","Ros hommerson","Roxy","Salvatore ferragamo","Sam edelman","Santoni","Sanuk","Seavees","Sebago","Sesto meucci",
    "Seychelles","Skechers","Softwalk","Sorel","Spenco","Sperry top-sider","Splendid","Spring step","Stacy adams","Steve Madden","Stuart Weitzman","Taryn Rose",
    "Ted baker","Teva","Timberland","Tommy bahama","Tommy Hilfiger","Trotters","Ugg","Vaneli","Versace collection","Vince camuto","Vivienne westwood","White Mountain",
    "Wolky","Wolverine","Woolrich","Yellow box"];

var models = ["Bakhchiev","Pavlocich","Belisario","Elysees","Greinacher","Pays","Busching","Threnos","Tomasche","Oyle","Eschenbach","Pilss","Granat","Hands",
    "Margueite","Fleisher","Didjeridu","Saraban","Espan","Guttler","Firkusny","Yorkshire","Nowell","Selles","Vroons","Schicksalslie","Teramo","Bernfeld","Naegele",
    "Aeria","Busching","Noferi","Dizzi","Bars","Bester","Glauser","Bogaerts","Veils","Manzoni","Amorosa","Urbini","Nono","Cire","Wiklund","Soloist","Ponkin",
    "Larviksp","Leuchten","Dino","Piccinini","Michala","Iwasaki","Hearted","Bihlmaier","Viaggio","Viljakainen","Meylan","Ives","Reverence","Freibert","Knut",
    "Garvelmann","Evenhymn","Bresden","Honours","Lentz","Kober","Sephardim","Pasino","Chambon","Rheinla","Instrumentalis","Gorne","Nyffenegger","Paladins",
    "Dushchenko","Anaosov","Rochberg","Iwaki","Conversione","Pellie","Reznikoff","Postilion","Lizst","Dubar","Foldes","Lluna","Cata","Bondi","Althann","Jaroslav",
    "Ranzani","Presenting","Temps","Watching","Konzerstuck","Veyron","Biarent","Higginson","Mercre","Turetschek","Harty","Pomerian","Zagorinsky","Grammy","Wilm",
    "Soren","Volpi","Germa","Misterio","Rotterdam","Tabakov","Siegf","Kabaiwanska","Resurrection","Palma","Grasso","Haselboeck","Duos","Asheknazy","Visions",
    "Dreame","Omar","Krafft","Alta","Sommerfest","Symphonists","Sensations","Leande","Redel","Leman","Kerner","Entertainment","Cavasanti","Misha","Witwe",
    "Nikolaeva","Reyna","Markus","Wildhaber","Waggoner","Adeste"];

var styles = ["Casual Shoes", "Dress Shoes", "Boots", "High Heels", "Sneakers"];

var discountedBrands = [];
var sizeList = [];

var brand = "";
var style = "";
var model = "";

var tax = 0.00;
var price = 50.00;
var percentDiscount = 0;

var size = 10;
var shoe = null;

var element = document.getElementById("changi")
element.outerText="Rice";
