//  Jagani Vatsal   #

function Validate() {
        var password = document.getElementById("passwd").value;
        var confirmPassword = document.getElementById("re-passwd").value;
	
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
		else{
			return true;
		}
}