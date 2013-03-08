//==========Salarios==========//

$(function(){
		// creación de ventana con formulario con jquery ui
		$('#agregarSalario').dialog({
			autoOpen: false,
			modal:true,
			width:305,
			height:'auto',
			resizable: false,
			close:function(){
				$('#formSalario fieldset > span').removeClass('error').empty();
				$('#formSalario input[type="text"]').val('');
		    	$('#formSalario select > option').removeAttr('selected');
		    	$('#id_user').val('0');
			}
		});

		// funcionalidad del botón que abre el formulario
		$('#goNuevoSalario').on('click',function(){
			// Asignamos valor a la variable acción
			$('#accion').val('addSalario');

			// Abrimos el Formulario
			$('#agregarSalario').dialog({
				title:'Agregar Salario',
				autoOpen:true
			});
		});

		// Validar Formulario
		$('#formSalario').validate({
		    submitHandler: function(){
		        
		        var str = $('#formSalario').serialize();

		        // alert(str);

		        $.ajax({
		            beforeSend: function(){
		                $('#formSalario .ajaxLoader').show();
		            },
		            cache: false,
		            type: "POST",
		            dataType: "json",
		            url:"includes/phpAjaxSalario.inc.php",
		            data:str + "&id=" + Math.random(),
		            success: function(response){

		            	// Validar mensaje de error
		            	if(response.respuesta == false){
		            		alert(response.mensaje);
		            	}
		            	else{

		            		// si es exitosa la operación
		                	$('#agregarSalario').dialog('close');

		                	// alert(response.contenido);
		                	
		                	if($('#sinDatos').length){
		                		$('#sinDatos').remove();
		                	}
		                	
		                	// Validad tipo de acción
		                	if($('#accion').val() == 'editSalario'){
		                		$('#listaSalariosOK').empty();
		                	}

		                	$('#listaSalariosOK').append(response.contenido);

						}

		            	$('#formSalario .ajaxLoader').hide();

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
		$('body').on('click','#listaSalariosOK a',function (e){
			e.preventDefault();

			// alert($(this).attr('href'));

			// Valor de la acción
			$('#accion').val('editSalario');

			// Id Salarioria
			$('#id_user').val($(this).attr('href'));

			// Llenar el formulario con los datos del registro seleccionado
			$('#año_sal').val($(this).parent().parent().children('td:eq(0)').text());
			$('#valor_sal').val($(this).parent().parent().children('td:eq(1)').text());

			// Abrimos el Formulario
			$('#agregarSalario').dialog({
				title:'Editar Salario',
				autoOpen:true
			});

		});
});