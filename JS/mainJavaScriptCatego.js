//==========Categorias==========//

$(function(){
		// creación de ventana con formulario con jquery ui
		$('#agregarCatego').dialog({
			autoOpen: false,
			modal:true,
			width:305,
			height:'auto',
			resizable: false,
			close:function(){
				$('#formCatego fieldset > span').removeClass('error').empty();
				$('#formCatego input[type="text"]').val('');
		    	$('#formCatego select > option').removeAttr('selected');
		    	$('#id_user').val('0');
			}
		});

		// funcionalidad del botón que abre el formulario
		$('#goNuevoCatego').on('click',function(){
			// Asignamos valor a la variable acción
			$('#accion').val('addCatego');

			// Abrimos el Formulario
			$('#agregarCatego').dialog({
				title:'Agregar Categor&iacute;a',
				autoOpen:true
			});
		});

		// Validar Formulario
		$('#formCatego').validate({
		    submitHandler: function(){
		        
		        var str = $('#formCatego').serialize();

		        // alert(str);

		        $.ajax({
		            beforeSend: function(){
		                $('#formCatego .ajaxLoader').show();
		            },
		            cache: false,
		            type: "POST",
		            dataType: "json",
		            url:"includes/phpAjaxCatego.inc.php",
		            data:str + "&id=" + Math.random(),
		            success: function(response){

		            	// Validar mensaje de error
		            	if(response.respuesta == false){
		            		alert(response.mensaje);
		            	}
		            	else{

		            		// si es exitosa la operación
		                	$('#agregarCatego').dialog('close');

		                	// alert(response.contenido);
		                	
		                	if($('#sinDatos').length){
		                		$('#sinDatos').remove();
		                	}
		                	
		                	// Validad tipo de acción
		                	if($('#accion').val() == 'editCatego'){
		                		$('#listaCategoriasOK').empty();
		                	}

		                	$('#listaCategoriasOK').append(response.contenido);

						}

		            	$('#formCatego .ajaxLoader').hide();

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
		$('body').on('click','#listaCategoriasOK a',function (e){
			e.preventDefault();

			// alert($(this).attr('href'));

			// Valor de la acción
			$('#accion').val('editCatego');

			// Id Categoria
			$('#id_user').val($(this).attr('href'));

			// Llenar el formulario con los datos del registro seleccionado
			$('#nomb_categoria').val($(this).parent().parent().children('td:eq(0)').text());
			$('#sal_categoria').val($(this).parent().parent().children('td:eq(1)').text());

			// Abrimos el Formulario
			$('#agregarCatego').dialog({
				title:'Editar Categor&iacute;a',
				autoOpen:true
			});

		});
});