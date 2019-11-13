function removeClassTXT(obj){
	if (obj.value.trim() != '') obj.classList.remove('is-invalid');
}

function removeClassNumber(obj){
    if (parseFloat(obj.value) != 0) obj.classList.remove('is-invalid');
}

function ValidaCaracter(e) {
    var evt = e || window.event;
    var tecla = evt.which || evt.keyCode;

    var string = '';
    var invalido;

    invalido = '<>/\\"|\'';

    var caracter = String.fromCharCode(tecla);

    if (invalido.indexOf(caracter) != -1) {
        if (evt.preventDefault) {
            evt.preventDefault();
        } else {
            evt.returnValue = false;
        }
    }
}

function remplazarEspeciales(objeto) {
    if ($(objeto).val().length == 0) return;

    var nuevoValor = '';
    var valor = $(objeto).val();
    var invalido;

	invalido = '<>/\\"|' + "'";

    for (i = 0; i < valor.length; i++) {
        if (invalido.indexOf(valor.substr(i, 1)) == -1) {
            nuevoValor += valor.substr(i, 1);
        }
    }
    nuevoValor = $.trim(nuevoValor);
    $(objeto).val(nuevoValor);
}

function removeClassCmb(obj){
	if (obj.selectedIndex != 0) obj.classList.remove('is-invalid');
}