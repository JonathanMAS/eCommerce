function checkPass()
{
    var champA = document.getElementById("mdp").value;
    var champB = document.getElementById("mdp_c").value;
    
    if(champA == champB)
    {
        document.form.submit();
    }
    else
    {
        alert("Mot de passe différents");
    }
}

function checkInputMdp()
{
    var champA = document.getElementById("mdp").value;
    var champB = document.getElementById("mdp_c").value;
    
    if(champA == champB)
    {
        document.getElementById("mdp_id").style.color = "green";
        document.getElementById("mdp_id2").style.color = "green";
    }
    else
    {
        document.getElementById("mdp_id").style.color = "red";
        document.getElementById("mdp_id2").style.color = "red";
    }
}
