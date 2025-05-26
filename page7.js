function verif() {
    
    typec=document.getElementById("typecarte").value;
    numc=document.getElementById("numcarte").value;
    tic=document.getElementById("ticarte").value;
    if (typec.length==0) {
        alert("le Type de la carte est un champs obligatoire");
        return false;
    }
    else{
        if (numc.length==0) {
            alert("le Numéro de la carte est un champs obligatoire");
            return false;
        }
        else{
            if (tic.length==0) {
                alert("le Titulaire de la carte est un champs obligatoire");
                return false;
            }
            else{
               document.getElementById("formulaire").submit();
               return true; 
            }
            
        }
    }
}
