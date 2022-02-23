
const SALES_TAX_RATE = 0.05;

let brands =  ["Bata", "Clarks", "Nike", "Vans", "Boston", "Testoni", "Berluti", "Skechers", "Red Wing", "Keen", "Ecco", "Heely"];
let models = ["Bakhchiev","Pavlocich","Belisario","Elysees","Greinacher","Pays","Busching","Threnos","Tomasche","Oyle","Eschenbach","Pilss","Granat","Hands",
    "Margueite","Fleisher","Didjeridu","Saraban","Espan","Guttler","Firkusny","Yorkshire","Nowell","Selles","Vroons","Schicksalslie","Teramo","Bernfeld","Naegele",
    "Aeria","Busching","Noferi","Dizzi","Bars","Bester","Glauser","Bogaerts","Veils","Manzoni","Amorosa","Urbini","Nono","Cire","Wiklund","Soloist","Ponkin","Larviksp",
    "Leuchten","Dino","Piccinini","Michala","Iwasaki","Hearted","Bihlmaier","Viaggio","Viljakainen","Meylan","Ives","Reverence","Freibert","Knut","Garvelmann","Evenhymn",
    "Bresden","Honours","Lentz","Kober","Sephardim","Pasino","Chambon","Rheinla","Instrumentalis","Gorne","Nyffenegger","Paladins","Dushchenko","Anaosov","Rochberg",
    "Iwaki","Conversione","Pellie","Reznikoff","Postilion","Lizst","Dubar","Foldes","Lluna","Cata","Bondi","Althann","Jaroslav","Ranzani","Presenting","Temps","Watching",
    "Konzerstuck","Veyron","Biarent","Higginson","Mercre","Turetschek","Harty","Pomerian","Zagorinsky","Grammy","Wilm","Soren","Volpi","Germa","Misterio","Rotterdam",
    "Tabakov","Siegf","Kabaiwanska","Resurrection","Palma","Grasso","Haselboeck","Duos","Asheknazy","Visions","Dreame","Omar","Krafft","Alta","Sommerfest","Symphonists",
    "Sensations","Leande","Redel","Leman","Kerner","Entertainment","Cavasanti","Misha","Witwe","Nikolaeva","Reyna","Markus","Wildhaber","Waggoner","Adeste"];

// Generate a random price between 35.99 and 120.99
function randomPrice() {
    return Math.floor((Math.random() * 120.99) + 35.99);
}

function salesTax (saleTotal) {
    return saleTotal * SALES_TAX_RATE;
}

function randomModel () {
    let index = Math.random() * models.length;
    return model[index]
}
randomModel();


function totalPrice ()

class Shoe {
    constructor(style, brand, model, price, sizes) {
      this.style = type;
      this.brand = brand;
      this.model = model;
      this.price = price;
    } // close constructor

  } // close shoe class