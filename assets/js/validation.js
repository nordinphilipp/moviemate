function validateLogin() {
    var emailFormat = /^[a-zA-Z]+[a-zA-Z0-9_.-]*@[a-zA-Z0-9-.]+\.[a-zA-Z.]{2,5}$/;		//Fixa denna så att den enbart kollar .@.
    var pwFormat = /^[a-zA-Z0-9_.-]{3,20}$/;

    var errormsg = "";

    var email = document.getElementById('staticEmail');
    var pw = document.getElementById('inputPassword');

    if (email.value.trim() == "") 				    // Kollar om "namn" i form är tom efter borttagning av whitspace
    {
        errormsg = errormsg + "\n Du har missat att fylla i email";
    }
    if (pw.value.trim() == "")	            // Kollar password är tomt efter borttagning av whitespace.
    {
        errormsg = errormsg  + "\n Du har missat att välja ett lösenord";
    }
    if(!email.value.match(emailFormat)){
        errormsg = errormsg + "\n Fel format för email";
    }
    if(!pw.value.match(pwFormat)){
        errormsg = errormsg + "\n Fel format för lösenord";
    }
    if(email.value.match(emailFormat) && pw.value.match(pwFormat)){
        return true;
    }else{
        alert(errormsg);
        pw.value="";
        return false;
    }
}

function validateReg() {
    var emailFormat = /^[a-zA-Z]+[a-zA-Z0-9_.-]*@[a-zA-Z0-9-.]+\.[a-zA-Z.]{2,5}$/;
    var pwFormat = /^[a-zA-Z0-9_.-]{3,20}$/;

    var errormsg = "";

    var email = document.getElementById('staticEmail');
    var pw = document.getElementById('inputPassword');
    var pwConf = document.getElementById('repeatPassword');

    if (email.value.trim() == "") 				// Kollar om "namn" i form är tom  OBS!! Fixa så att en tom sträng inte fungerar för att uppfylla detta villkor!!
    {
        errormsg = errormsg + "\n Du har missat att fylla i namn";
    }
    if (pw.value.trim() == "")	            // Kollar om "m i form är skrivet i rätt format i form.
    {
        errormsg = errormsg + "\n Du har missat att välja ett lösenord";
    }
    if (!email.value.match(emailFormat)) {
        errormsg = errormsg + "\n Fel format för email";
    }
    if (!pw.value.match(pwFormat)) {
        errormsg = errormsg + "\n Fel format för lösenord";
    }
    if(pw.value !== pwConf.value){
        errormsg = errormsg + "\n Lösenorden stämmer inte överens";
    }
    if (email.value.match(emailFormat) && pw.value.match(pwFormat) && pw.value === pwConf.value) {
        return true;
    } else {
        alert(errormsg);
        pw.value = "";
        pwConf.value = "";
        return false;
    }
}