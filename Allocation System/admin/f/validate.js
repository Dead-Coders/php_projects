// Vatsal Jagani    #

function Validate() {
        var id = document.getElementById("id").value;
        if (isNaN(id) || id.length>6 || id.length<1) {
            alert("Provide proper ID");
            return false;
        }
        
        var name = document.getElementById("name").value;
        if (name.length>25 || name.length<2) {
            alert("Provide name length at max 25");
            return false;
        }
        
	
        return true;
}