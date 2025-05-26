function verif() {
    alert("vbn,;");
    nom=document.getElementById("Nom").value;
    cin=document.getElementById("CIN").value;
    date=document.getElementById("jour").value;
    let dateToCompare = Date.parse(date);
    v=document.getElementById("Voiture");
    m=document.getElementById("Motocyclette");
    b=document.getElementById("Bicyclette");
    checkbox=0;
    if (v.checked) {
        checkbox++;
    }
    if (m.checked) {
        checkbox++;
    }
    if (b.checked) {
        checkbox++;
    }
    if (nom.length==0) {
        alert("le Nom est un champs obligatoire");
        return false;
    }
    else{
        if (cin.length!=8) {
            alert("le CIN il faut être composé de 8 chiffre");
            return false;
        }
        else{
            if (!date || dateToCompare < Date.now()) {
                alert("le Date est un champs obligatoire");
                return false;
            }
            else{
                if (checkbox==0 ) {
                    alert("Veuillez sélectionner un véhicule");
                    return false;
                }
                if (checkbox>1 ) {
                    alert("Veuillez sélectionner un seul véhicule");
                    return false;
                }
                else{
                    document.getElementById("formulaire").submit();
                    return true;
                }
                
            }
        }
    }
}
