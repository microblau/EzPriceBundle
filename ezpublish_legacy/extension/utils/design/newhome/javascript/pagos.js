(function ($) {
	$(document).ready( function()
	{		
		$("#aplazado").click(function(){
			$.post( '/ezjscore/call/pagos::getplazos',
					{},				
					function(data){						
						$("#modopagos").append( data.content.result );
						$("#npagos").change( function( ){
							$("#infopagando").remove();
							showplazos( $(this) );
						} );
					}, 'json'						
			);
		});
		
		$("#unico").click(function(){			
			$("#infopago").remove();
			showplazos( null );
		});	
	});
})(jQuery);

function showplazos( el )
{
	$.post( '/ezjscore/call/pagos::showplazos',
			{ 'node_id' : $(el).val() },				
			function(data){
				$("#amounttopay").val( data.content.importe );
				$("#plazos").val( data.content.plazos );
				$("#infopago").append( data.content.text );
				
			}, 'json'						
	);
}

function validaLibreta(i_entidad,i_oficina,i_digito,i_cuenta){
	// VALIDACIÓN DE CUALQUIER LIBRETA DE CUALQUIER ENTIDAD BANCARIA.
	// Funcion recibe como parámetro la entidad, la oficina,
	// el digito (concatenación del de control entidad-oficina y del de control entidad)
	// y la cuenta. Espera los valores con 0's a la izquierda.
	// Devuelve true o false.
	// NOTAS:
	// Formato deseado de los parámetros:
	// - i_entidad (4)
	// - i_oficina (4)
	// - i_digito (2)
	// - i_cuenta (10)
	var wtotal,wcociente, wresto;
	
	if (i_entidad.length != 4){
	return false;
	}
	if (i_oficina.length != 4){
	return false;
	}
	if (i_digito.length != 2){
	return false;
	}
	if (i_cuenta.length != 10){
	return false;
	}
	wtotal = i_entidad.charAt(0) * 4;
	wtotal += i_entidad.charAt(1) * 8;
	wtotal += i_entidad.charAt(2) * 5;
	wtotal += i_entidad.charAt(3) * 10;
	wtotal += i_oficina.charAt(0) * 9;
	wtotal += i_oficina.charAt(1) * 7;
	wtotal += i_oficina.charAt(2) * 3;
	wtotal += i_oficina.charAt(3) * 6;
	// busco el resto de dividir wtotal entre 11
	wcociente = Math.floor(wtotal / 11);
	wresto = wtotal - (wcociente * 11);
	//
	wtotal = 11 - wresto;
	if (wtotal == 11){
	wtotal=0;
	}
	if (wtotal == 10){
	wtotal=1;
	}
	if (wtotal != i_digito.charAt(0)){
	return false;
	}
	//hemos validado la entidad y oficina
	//-----------------------------------
	wtotal = i_cuenta.charAt(0) * 1;
	wtotal += i_cuenta.charAt(1) * 2;
	wtotal += i_cuenta.charAt(2) * 4;
	wtotal += i_cuenta.charAt(3) * 8;
	wtotal += i_cuenta.charAt(4) * 5;
	wtotal += i_cuenta.charAt(5) * 10;
	wtotal += i_cuenta.charAt(6) * 9;
	wtotal += i_cuenta.charAt(7) * 7;
	wtotal += i_cuenta.charAt(8) * 3;
	wtotal += i_cuenta.charAt(9) * 6;

	// busco el resto de dividir wtotal entre 11
	wcociente = Math.floor(wtotal / 11);
	wresto = wtotal - (wcociente * 11);
	//
	wtotal = 11 - wresto;
	if (wtotal == 11){wtotal=0;}
	if (wtotal == 10){wtotal=1;}

	if (wtotal != i_digito.charAt(1)){
	//alert(wtotal+' y no '+i_digito.charAt(1));
	return false;
	}
	// hemos validado la cuenta corriente

	return true;
}