var formfield = document.getElementById('arole');
var input_tags = formfield.getElementsByTagName('div');

function add() {

    if (input_tags.length < 3) {
        var newField = document.createElement('div');
        newField.setAttribute('id', 'ligne ' + (input_tags.length + 1));
        newField.setAttribute('class', 'rolep');
        formfield.appendChild(newField);

        var Perso = document.createElement('input');
        Perso.setAttribute('type', 'text');
        Perso.setAttribute('name', 'personnage_' + (input_tags.length));
        Perso.setAttribute('class', 'perso');
        Perso.setAttribute('placeholder', 'Personnage');
        Perso.setAttribute('required', '');
        newField.appendChild(Perso);

        var Nom = document.createElement('input');
        Nom.setAttribute('type', 'text');
        Nom.setAttribute('name', 'nom_' + (input_tags.length));
        Nom.setAttribute('class', 'name');
        Nom.setAttribute('placeholder', 'Nom');
        Nom.setAttribute('required', '');
        newField.appendChild(Nom);

        var Prenom = document.createElement('input');
        Prenom.setAttribute('type', 'text');
        Prenom.setAttribute('name', 'prenom_' + (input_tags.length));
        Prenom.setAttribute('class', 'name');
        Prenom.setAttribute('placeholder', 'Prenom');
        Prenom.setAttribute('required', '');
        newField.appendChild(Prenom);

        var Delete = document.createElement('button');
        Delete.setAttribute('type', 'button');
        Delete.setAttribute('name', 'supr');
        Delete.setAttribute('onclick', 'remove()');

        let text = document.createTextNode("Delete");

        Delete.appendChild(text);
        newField.appendChild(Delete);
    }
}

function remove(ligne) {
    if (input_tags.length >= 2) {
        formfield.removeChild(input_tags[(input_tags.length) - 1]);
    }
}
