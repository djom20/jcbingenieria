//==========Usuarios==========//

$(function(){
		// creación de ventana con formulario con jquery ui
		$('#agregarUser').dialog({
			autoOpen: false,
			modal:true,
			width:305,
			height:'auto',
			resizable: false,
			close:function(){
				$('#formUsers fieldset > span').removeClass('error').empty();
				$('#formUsers input[type="text"]').val('');
		    	$('#formUsers select > option').removeAttr('selected');
		    	$('#id_user').val('0');
			}
		});

		// funcionalidad del botón que abre el formulario
		$('#goNuevoUser').on('click',function(){
			// Asignamos valor a la variable acción
			$('#accion').val('addUser');

			// Abrimos el Formulario
			$('#agregarUser').dialog({
				title:'Agregar Usuario',
				autoOpen:true
			});
		});

		// Validar Formulario
		$('#formUsers').validate({
		    submitHandler: function(){
		        
		        var str = $('#formUsers').serialize();

		        // alert(str);

		        $.ajax({
		            beforeSend: function(){
		                $('#formUsers .ajaxLoader').show();
		            },
		            cache: false,
		            type: "POST",
		            dataType: "json",
		            url:"includes/phpAjaxUsers.inc.php",
		            data:str + "&id=" + Math.random(),
		            success: function(response){

		            	// Validar mensaje de error
		            	if(response.respuesta == false){
		            		alert(response.mensaje);
		            	}
		            	else{

		            		// si es exitosa la operación
		                	$('#agregarUser').dialog('close');

		                	// alert(response.contenido);
		                	
		                	if($('#sinDatos').length){
		                		$('#sinDatos').remove();
		                	}
		                	
		                	// Validad tipo de acción
		                	if($('#accion').val() == 'editUser'){
		                		$('#listaUsuariosOK').empty();
		                	}

		                	$('#listaUsuariosOK').append(response.contenido);

						}

		            	$('#formUsers .ajaxLoader').hide();

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
		$('body').on('click','#listaUsuariosOK a',function (e){
			e.preventDefault();

			// alert($(this).attr('href'));

			// Valor de la acción
			$('#accion').val('editUser');

			// Id Usuario
			$('#id_user').val($(this).attr('href'));

			// Llenar el formulario con los datos del registro seleccionado
			$('#usr_id').val($(this).parent().parent().children('td:eq(0)').text());
			$('#usr_nombre').val($(this).parent().parent().children('td:eq(1)').text());
			$('#usr_pass').val($(this).parent().parent().children('td:eq(2)').text());

			// Seleccionar tipo
			$('#usr_tipo option[value='+ $(this).parent().parent().children('td:eq(3)').text() +']').attr('selected',true);

			// Seleccionar estado
			$('#usr_estado option[value='+ $(this).parent().parent().children('td:eq(4)').text() +']').attr('selected',true);

			// Abrimos el Formulario
			$('#agregarUser').dialog({
				title:'Editar Usuario',
				autoOpen:true
			});

		});
});