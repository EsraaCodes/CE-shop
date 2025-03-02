
function signUp(event) {
    event.preventDefault(); 

    
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    
    if (!email || !password) {
        alert("Please fill in all fields!");
        return;
    }


    fetch("email.php", {
        method: "POST", 
        headers: { "Content-Type": "application/json" }, 
        body: JSON.stringify({ email, password }), 
    })
        .then(response => response.json()) 
        .then(data => {
            
            if (data.success) {
                alert("You are ready to login and start shopping!"); 
                window.location.href = "login.html"; 
            } else {
                alert("Error: " + data.message); 
            }
        })
        .catch(error => {
            console.error("Error:", error); 
            alert("Something went wrong. Please try again."); 
        });
}


function googleSignUp() {
    const googleLoginURL = "https://accounts.google.com/signin"; 
    window.location.href = googleLoginURL; 
}


function facebookLogin() {
    const facebookLoginURL = "https://www.facebook.com/login"; 
    window.location.href = facebookLoginURL; 
}
