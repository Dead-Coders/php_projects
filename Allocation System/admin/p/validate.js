// Vatsal Jagani    #

function Validate() {
        var id = document.getElementById("id").value;
        if (isNaN(id) || id.length>6 || id.length<1) {
            alert("Provide proper ID");
            return false;
        }
        
        var name1 = document.getElementById("definition").value;
        if (name1.length>25 || name1.length<1) {
            alert("Provide description length at max 25");
            return false;
        }
        
        var name2 = document.getElementById("description").value;
        if (name2.length>50 || name2.length<1) {
            alert("Provide description length at max 50");
            return false;
        }
	
        return true;
}