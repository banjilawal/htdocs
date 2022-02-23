<!DOCTYPE html>
<html></html>
<head></head>
<body>
    
class ShoeSize {

    constructor (size) {
        this.size = size;
        this.inWide = (Math.random() > 0.75);
    } // close constructor

    info() {
        if (this.inWide) { 
            return this.size + "/" + this.size + "(W)"; 
        }
        else {
            return this.size;
        }
    } // close info

    static random () {
        var min = 7;
        var max = 13;
        
        var size = Math.ceil(Math.random() * (maxSize - min)) + min;

        return (new ShoeSize(size));
    }

    static buildList () {
        var minSize = 7;
        var maxSize = 13;
        var array = [];   
        
        for (index = minSize; index <= maxSize; index++) {
            var size = new ShoeSize(index);

            document.write("size: " + size.info() + "<br>");
            array.push(size);

            if (Math.random() > 0.6) {
                array.push(new ShoeSize(index + 0.5));
            }
        }
        
        return array;
    }

} // end class ShoeSize

var shoeSize = ShoeSize.random();
console.log(shoeSize);

</body>
</html> 
