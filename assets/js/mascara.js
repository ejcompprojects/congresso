$(document).ready(function(){

	$('#cpf').mask('999.999.999-99');
	$('#celular').focusout(function(){
		var phone, element;
		element = $(this);
		element.unmask();
		phone = element.val().replace(/\D/g, '');
		if(phone.length > 10) {
			element.mask("(99) 99999-9999");
		} else {
			element.mask("(99) 9999-99999");
		}
	}).trigger('focusout');
	$('#telefone').mask('(99) 9999-9999');
	$('#cep').mask('99999-999');
});
