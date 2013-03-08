//==========Contribuyentes==========//

$(function(){
		// creación de ventana con formulario con jquery ui
		$('#agregarContri').dialog({
			autoOpen: false,
			modal:true,
			width:305,
			height:'auto',
			resizable: false,
			close:function(){
				$('#formContri fieldset > span').removeClass('error').empty();
				$('#formContri input[type="text"]').val('');
		    	$('#formContri select > option').removeAttr('selected');
		    	$('#id_user').val('0');
			}
		});

		// funcionalidad del botón que abre el formulario
		$('#goNuevoContri').on('click',function(){
			// Asignamos valor a la variable acción
			$('#accion').val('addContri');

			// Abrimos el Formulario
			$('#agregarContri').dialog({
				title:'Agregar Contribuyente',
				autoOpen:true
			});
		});

		// Validar Formulario
		$('#formContri').validate({
		    submitHandler: function(){
		        
		        var str = $('#formContri').serialize();

		        // alert(str);

		        $.ajax({
		            beforeSend: function(){
		                $('#formContri .ajaxLoader').show();
		            },
		            cache: false,
		            type: "POST",
		            dataType: "json",
		            url:"includes/phpAjaxContri.inc.php",
		            data:str + "&id=" + Math.random(),
		            success: function(response){

		            	// Validar mensaje de error
		            	if(response.respuesta == false){
		            		alert(response.mensaje);
		            	}
		            	else{

		            		// si es exitosa la operación
		                	$('#agregarContri').dialog('close');

		                	// alert(response.contenido);
		                	
		                	if($('#sinDatos').length){
		                		$('#sinDatos').remove();
		                	}
		                	
		                	// Validad tipo de acción
		                	if($('#accion').val() == 'editContri'){
		                		$('#listaContribuyenteOK').empty();
		                	}

		                	$('#listaContribuyenteOK').append(response.contenido);

						}

		            	$('#formContri .ajaxLoader').hide();

		            },
		            error:function(){
		                alert('ERROR GENERAL DEL SISTEMA, INTENTE MAS TARDE');
		            }
		        });

		        return false;

		    },
		    errorPlacement: function(error, element) {
		        error.appendTo(element.prev("span").append());
		    }
		});



		// Edición de Registros
		$('body').on('click','#listaContribuyenteOK a',function (e){
			e.preventDefault();

			// alert($(this).attr('href'));

			// Valor de la acción
			$('#accion').val('editContri');

			// Id Contribuyentes
			$('#id_user').val($(this).attr('href'));

			// Llenar el formulario con los datos del registro seleccionado
			$('#id_contribuyente').val($(this).parent().parent().children('td:eq(0)').text());
			$('#nomb_contribuyente').val($(this).parent().parent().children('td:eq(1)').text());
			$('#categ_contribuyente').val($(this).parent().parent().children('td:eq(2)').text());
			$('#dir_contribuyente').val($(this).parent().parent().children('td:eq(3)').text());
			$('#ciud_contribuyente').val($(this).parent().parent().children('td:eq(4)').text());

			// Abrimos el Formulario
			$('#agregarContri').dialog({
				title:'Editar Contribuyente',
				autoOpen:true
			});

		});
});