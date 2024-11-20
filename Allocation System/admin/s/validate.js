// Vatsal Jagani    #

function Validate() {
        var id = document.getElementById("id").value;
        if (isNaN(id) || id.length>6 || id.length<1) {
            alert("Provide proper ID");
            return false;
        }
        
        var cpi = document.getElementById("cpi").value;
        if (isNaN(cpi) || cpi>10.0 || cpi<0.0) {
            alert("Provide proper CPI");
            return false;
        }
        
        var name1 = document.getElementById("name1").value;
        if (name1.length>15 || name1.length<1) {
            alert("Provide proper length first name");
            return false;
        }
        
        var name2 = document.getElementById("name2").value;
        if (name2.length>15 || name2.length<1) {
            alert("Provide proper length last name");
            return false;
        }
	
        return true;
}