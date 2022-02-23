//"use strict";

const MIN_SHOE_SIZE = 7;
const MAX_SHOE_SIZE = 13;
const DEFAULT_SHOE_SIZE = 10;

const LOWEST_PRICE = 19;
const HIGHEST_PRICE = 199;

const SALES_TAX_RATE = 0.05;
const MAX_BRANDS_ON_SALE = 5;
const MAX_DISCOUNT_PERCENTAGE = 50;
const MAX_PER_MODEL_INVENTORY = 150;


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

var element = null;


// --- Helper functions 
function trimComma (string) {
    return string = string.replace(/,\s*$/, "");

} // close trimComma

function randomBrand () {
    var index = Math.floor(Math.random() * brands.length);
    return brands[index];

} // close randomBrand

function randomModel () {
    var index = Math.floor(Math.random() * models.length);
    return models[index];

} // close randomModel


function randomStyle () {
    var index = Math.floor(Math.random() * styles.length);
    return styles[index]; 

} // close randomStyle

function randomPrice () { 
    return (Math.floor(((Math.random() * (HIGHEST_PRICE - LOWEST_PRICE)) + LOWEST_PRICE)) + 0.99);

} // close randomPrice

function randomPercentDiscount () {
    return Math.floor(Math.random() * MAX_DISCOUNT_PERCENTAGE);

} // close discountPercent

function calculateTax (saleAmount) { 
    return (saleAmount * SALES_TAX_RATE); 

} // close calculateTax

function getDiscountBrands () {
    var list = [];

    for (var index = 0; index < MAX_BRANDS_ON_SALE; index++) {
        var brand = randomBrand();

        while (list.indexOf(brand) != -1) {
            brand = randomBrand(); 
        }
        list.push(brand);
    }

    return list;

} // close getDiscountBrands


class ShoeSize {
    constructor (size) {
        this.size = size;
        this.inWide = (Math.random() > 0.75);
    } // close constructor

    toString() {
        if (this.inWide) { 
            return this.size + "/" + this.size + "(W)"; 
        }
        else { return this.size; }
    } // close toString

} // end class ShoeSize

class ShoeSizeList {
    constructor() {
        this.list = [];

        for (index = MIN_SHOE_SIZE; index < MAX_SHOE_SIZE; index++) {
            var size = new ShoeSize(index);
            list.push(size);

            if (Math.random() > 0.6) {
                list.push(new ShoeSize(index + 0.5));
            }
        }       
    } // close constructor

    subset () {
        var items = [];

        this.list.forEach(element => {
            if (Math.random() > 0.45) {
                items.push(element);
            }
        });
        return items;
    } // close subset

    toString () {
        var text = "";

        this.list.forEach(element => {
            text += element.toString() + ", "
        });

        return trimComma(text);
    } // close toString

} // end class ShoeSizeList

function addSizeOptions () {
    var select = document.body.getElementByID("shoe-style-selector");
    sizeList = new ShoeSizeList();

    sizeList.forEach(size => {
        alert(size);
        var option = document.createElement("option");
        option.text = size;
        option.value = size;
        select.appendChild(option);
    });

} // close addSizeOptions 
addSizeOptions();


class Shoe {
    constructor(style, brand, model) {
        this.model = model;
        this.brand = brand;
        this.style = style;
        this.regularPrice = randomPrice();

        this.sizes = (new ShoeSizeList()).subset();

        this.discountPercent = randomPercentDiscount();
        this.discountAmount = this.regularPrice * (this.discountPercent/100.00);
        this.currentPrice = this.regularPrice - this.discountAmount;

        this.inventory = Math.floor(Math.random() * MAX_PER_MODEL_INVENTORY);

    } // close constructor 

    sizeInfo() {
        text = ""
        this.sizes.forEach(size => {
            text += size.toString() + ", "
        });

        return trimComma(text);
    } // close

    priceInfo () {
        if (this.currentPrice == this.regularPrice) {
            return " at " + this.regularPrice;
        } 
        else {
            return ("discounted to: " + this.currentPrice + " from " + this.regularPrice);
        }

    } // close priceInfo

    toString () {
        let text = "brand: " + this.brand + ", style: " + this.style + ", model: " + this.model;
        text += " " + this.inventory + " in stock " + (princeInfo()) + (sizeInfo());

        return text;

    } // close toString

} // end class Shoe

function randomShoe (style, brand) {
    if (style === undefined) {
        var style = randomStyle();
    }

    if (brand === undefined) {
        var brand = randomBrand();
    }

    return (new Shoe());

} // close randomShoe