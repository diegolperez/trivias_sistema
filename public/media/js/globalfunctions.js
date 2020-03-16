// JavaScript Document
$(document).ready(function(){
	jQuery.extend(jQuery.validator.messages, {
		required: 'Este campo es obligatorio.',
		textOnly: 'Este campo admite s&oacute;lo texto.',
		alphaNumeric: 'Este campo admite s&oacute;lo caracteres alfa - num&eacute;ricos.',
		date: 'Este campo tiene un formato dd/mm/YYYY.',
		digits: 'Este campo admite s&oacute;lo d&iacute;gitos.',
		number: 'Este campo debe ser un n&uacute;mero v&aacute;lido.',
		alphaNumericSpecial: 'Este campo admite s&oacute;lo caracteres alfa - num&eacute;ricos.',
		email: 'Este campo admite el formato <i>direccion@dominio.com</i>.',
		url: "Ingrese un URL v&aacute;lido.",
		dateISO: "Ingrese una fecha v&acute;lida (ISO).",
		numberDE: "Bitte geben Sie eine Nummer ein.",
		percentage: "Este campo debe tener un porcentaje v&aacute;lido.",
		validarUserName: "Nombre de Usuario no v\u00E1lido.",
		creditcard: "Ingrese un n&uacute;mero de tarjeta de cr&eacute;dito v&aacute;lido.",
		equalTo: "Las direcciones de correo no coinciden.",
		notEqualTo: "Ingrese un valor diferente.",
		accept: "Ingrese un valor con una extensi&oacute;n v&aacute;lida.",
		maxlength: $.validator.format("Este campo debe tener m&aacute;ximo {0} caracteres."),
		minlength: $.validator.format("Este campo debe tener m&iacute;nimo {0} caracteres."),
		rangelength: $.validator.format("Ingrese un valor entre {0} y {1} caracteres."),
		range: $.validator.format("Ingrese un valor entre {0} y {1}."),
		max: $.validator.format("Ingrese un valor menor o igual a {0}."),
		min: $.validator.format("Ingrese un valor mayor o igual a {0}."),
		cedulaEcuador: "Por favor ingrese una c&eacute;dula v&aacute;lida.",
		dateLessThan: $.validator.format("Ingrese una fecha menor o igual a {0}."),
		dateMoreThan: $.validator.format("Ingrese una fecha mayor o igual a {0}."),
        minStrict_zero:'El valor debe ser mayor o igual a cero',
        minStrict:'El valor debe ser mayor a cero'
	});

    jQuery.validator.addMethod("notEqualTo", function(value, element, param) {
        return this.optional(element) || value != $(param).val();
    }, "This has to be different");

    jQuery.validator.addMethod("cedulaEcuador", function(value, element) {
        var texto = value;
        if(texto != ''){
            if(texto.charAt(9)!='' && texto.charAt(10)==''){
                var digitos=new Array(parseInt(texto.charAt(0)),parseInt(texto.charAt(1)),parseInt(texto.charAt(2)),parseInt(texto.charAt(3)),parseInt(texto.charAt(4)),parseInt(texto.charAt(5)),parseInt(texto.charAt(6)),parseInt(texto.charAt(7)),parseInt(texto.charAt(8)),parseInt(texto.charAt(9)));
                var aux;
                var suma=0;

                for(i=0; i<9; i++){
                    if(i%2 == 0){
                        aux=digitos[i]*2;
                        if(aux>=10)
                            suma+=aux-9;
                        else
                            suma+=aux;
                    }else
                        suma+=digitos[i];
                }

                if(suma < 10)
                {
                    var unidad=parseInt(String(suma).charAt(0));
                    var decena=0;
                }else
                {
                    var unidad=parseInt(String(suma).charAt(1));
                    var decena=parseInt(String(suma).charAt(0));
                }

                if(unidad==0){
                    if(texto.charAt(9)=='0')
                        return true;
                    else
                        return false;
                }else{
                    var comprobador=(decena+1)*10;
                    if(comprobador-suma==digitos[9])
                        return true;
                    else
                        return false;
                }
            }else
                return false;
        }else{
            return true;
        }
    }, "Ingrese una cédula válida");

    jQuery.validator.addMethod('minStrict', function (value, el, param) {
        if (value!=''){
            return value > param;
        }else{
            return true;
        }

    });

    jQuery.validator.addMethod("time", function(value, element) {
        return this.optional(element) || /^(([0-1]?[0-9])|([2][0-3])):([0-5]?[0-9])(:([0-5]?[0-9]))?$/i.test(value);
    }, "Ingrese un formato de hora válido (Horas:minutos).");

    jQuery.validator.addMethod("notEqualToGroup", function(value, element, options) {
        // Get all elements send to the form with the same class.
        var elems = $(element).parents('form').find(options[0]);
       // The current element value.
        var valueToCompare = value;
       // counter
        var matchesFound = 0;
       // Search each element and compare her value with the value of the current element
       // and increase the counter every time that find a repeated value.
        jQuery.each(elems, function() {
            thisVal = $(this).val();
            if (thisVal == valueToCompare) {
                matchesFound++;
            }
        });
       // the counter can be 0 o 1 o mayor
        if (this.optional(element) || matchesFound <= 1) {
       //            elems.removeClass('error');
            return true;
        } else {
       //            elems.addClass('error');
        }
    }, jQuery.format("Tipo de precio ya seleccionado."));

});

function show_ajax_loader(){
    $("#container_loader").css('display','block');
    $("#loader").css('display','block');
}

function hide_ajax_loader(){
    $("#container_loader").css('display','none');
    $("#loader").css('display','none');
}

$(function() {
    $('#main-menu').smartmenus();
});




