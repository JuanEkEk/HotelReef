@extends('layout.master')
@section('titulo','Lista empleado')

@section('panel')
	@include('areas.contenido.panel')
@endsection


@section('contenido')
<script>
function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toString();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ";//Se define todo el abecedario que se quiere que se muestre.
    especiales = [8, 37, 39, 46, 6]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }
    if(letras.indexOf(tecla) == -1 && !tecla_especial){
        return false;
    }
}

</script>

<script type="text/javascript">
function soloNumeros(e)
{
var keynum = window.event ? window.event.keyCode : e.which;
if ((keynum == 8) || (keynum == 46))
return true;
return /\d/.test(String.fromCharCode(keynum));
}
</script>
<div id="empleado">

	<!-- titulo y boton de agregar -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-10">
				    <h1 class="m-0 text-dark">COLABORADORES DEL ÁREA DE DIVISIÓN | CUARTOS</h1>
				    <div class="image">
                        <!-- <img src="dist/img/reef.jpeg" class="img-rectangle elevation-2"  width="70" height="50" alt="User Image"> -->
                    </div><br>  
				</div><!-- /.col -->
				<div class="col-sm-2">
				    <a @click="mostrarModal">
				        <button class="btn btn-primary btn-xl float-right"><i class="fas fa-plus"></i></button> 
				    </a>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- fin de boton agregar -->

	<!-- inicia contenedor -->
	<div class="content">
        <div class="container-fluid">
         	<div class="row">
            	<div class="col-lg-12">
             		<div class="card">

	             		<!-- inicia input buscar -->
	             		<div class="card card-primary">
						    <div class="card-header">
						        <div class="row">
                  <div class="col-md-8">
                    <h3 class="card-title">Lista de colaboradores</h3>
                  </div>
                  <div class="col-md-4">
                    <div class="card-tools">  
                      <div class="input-group input-group-sm">
                        <input type="text" class="form-control float-right" placeholder="Ingrese el nombre del colaborador" v-model="buscar" onkeypress="return soloLetras(event);">
                      </div>
                    </div>
                  </div>
                </div> 
						    </div>
						</div>
						<!-- fin de input buscar -->  

						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap table-bordered">
								<thead>
									<th>ID</th>
									<th>NOMBRE</th>
									<th>UNE</th>
									<th>DEPARTAMENTO</th>
									<th>PUESTO</th>
									<th>FECHA DE ALTA</th>
									<th>ESTADO</th>
									<th>OPCIONES</th>
								</thead>
								<tbody>
									<tr v-for="(empleado,index) in filtroEmpleados">
										<td>@{{index+1}}</td>
										<td>@{{empleado.nombre}}</td>
										<td>@{{empleado.une}}</td>
										<td>@{{empleado.departamento}}</td>
										<td>@{{empleado.puesto}}</td>
										<td>@{{empleado.fecha_alta}}</td>
										<td class="bg-success text-white">@{{empleado.estado}}</td>
										<td align="center">
											<button style="margin-right: 10px" class="btn btn-sm" @click="editandoEmpleado(empleado.id_empleado)">
												<i class="fas fa-edit"></i>
											</button>
											<button class="btn btn-sm" @click="editarDatosRestantes(empleado.id_empleado)">
												<i class="fas fa-user-cog"></i>
											</button>
											<button class="btn btn-sm" @click="verDatosEmpleado(empleado.id_empleado)">
												<i class="fas fa-eye"></i>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
	<!-- fin contenedor -->	

	<!-- Modal -->
	<div class="modal fade" id="modalEmpleado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==true">AGREGAR NUEVO EMPLEADO</h5>
                    <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==false">EDITANDO EMPLEADO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
	        	<div class="modal-body">
            <form action="">         
	        		<!-- <input type="file" class="form-control" placeholder="" v-model="foto"><br> -->
              <label>Nombre completo del colaborador:</label>
	            <input type="text" class="form-control" placeholder="Nombre del colaborador" v-model="nombre" onkeypress="return soloLetras(event);" required><br>
              <label>UNE:</label>
	           	<select class="form-control" v-model="une" required>
                  <option value="" disabled>Seleccione el UNE</option>
                  <option value="Hotel Reef">Hotel Reef</option>
                </select><br>
              <label>Departamento:</label> 
	          	<select class="form-control" v-model="departamento" required>
	              <option value="" disabled>Seleccione el área</option>
	             	<option value="División | Cuartos">División | Cuartos</option>
	          	</select><br>
              <label>Puesto:</label>
	          	<select class="form-control" v-model="puesto" required>
	           		<option value="" disabled="">Seleccione el puesto</option>
            		<option value="Encargado de División de Cuartos">Hotel Reef | División Cuartos | Encargado de División de Cuartos</option>
	           		<option value="Ama de Llaves">Hotel Reef | División Cuartos | Ama de Llaves</option>
	          		<option value="Auxiliar de Ama de LLaves">Hotel Reef | División Cuartos | Auxiliar de Ama de LLaves</option>
	          		<option value="Camarista">Hotel Reef | División Cuartos | Camarista</option>
	          		<option value="Bell Boy">Hotel Reef | División Cuartos | Bell Boy</option>
	          		<option value="Encargada de Recepción">Hotel Reef | División Cuartos | Encargada de Recepción</option>
	          		<option value="Recepcionista">Hotel Reef | División Cuartos | Recepcionista</option>
	           		<option value="Personal de Limpieza">Hotel Reef | División Cuartos | Personal de Lim</option>
	           		<option value="Encargado de Lavandería">Hotel Reef | División Cuartos | Encargado de Lavandería</option>
	          		<option value="Auxiliar de Lavandería">Hotel Reef | División Cuartos | Auxiliar de Lavandería</option>
	          	</select><br>
              <label>Fecha de alta:</label>
	           	<input type="date" class="form-control" placeholder="Fecha de alta" v-model="fecha_alta" required> <br>
              <label>Estado:</label>
            	<select class="form-control" v-model="estado" required>
	             	<option value="" disabled="">Seleccione el estado actual del empleado</option>
	            	<option value="Alta">Alta</option>
	             	<option value="Baja">Baja</option>
             	</select>
            </form>
	            	<!-- <input type="text" class="form-control" placeholder="Estado" v-model="estado"><br> -->
	        	</div>

            	<div class="modal-footer">
                	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                	<button type="button" class="btn btn-primary" dato-dismiss="modal" @click="guardarEmpleado" v-if="agregando==true">Guardar</button>
            	    <button type="button" class="btn btn-primary" dato-dismiss="modal" @click="actualizarEmpleado()" v-if="agregando==false">Guardar</button>
            	</div>
        	</div>
        </div>
    </div> 
	<!-- FIN MODAL -->

	<!-- MODAL COMPLETAR DATOS -->
	<div class="modal fade" id="modalCDatos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">COMPLETAR INFORMACIÓN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
	        	<div class="modal-body">
	        		<!-- {{-- identificar los datos que estan llegando solo de este formulario --}} -->
                        <!-- @csrf -->
                    <!-- @{{n}} -->
	        		<div class="card text-center">
  						<div class="card-header bg-secondary text-white">
    						<h5><b>Datos personales</b></h5>
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Fecha de nacimiento:</label>
    									<input type="date" class="form-control" v-model="fechanac">
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Dirección:</label>
    									<input type="text" class="form-control" v-model="direccion">
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Colonia:</label>
    									<input type="text" class="form-control" v-model="colonia">
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Código Postal:</label>
    									<input type="text" class="form-control" v-model="codigopostal" maxlength="5" onkeypress="return soloNumeros(event);">
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Teléfono:</label>
    									<input type="text" class="form-control" v-model="telefono" maxlength="10" onkeypress="return soloNumeros(event);">
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Sexo:</label>
    									<select class="form-control" v-model="sexo">
               								<option value="" disabled="">Seleccione el sexo</option>
	              							<option value="Hombre">Hombre</option>
	              							<option value="Mujer">Mujer</option>
	       								</select>
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Población:</label>
    									<input type="text" class="form-control" v-model="poblacion" onkeypress="return soloLetras(event);">
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Entidad federativa del domicilio:</label>
    									<select class="form-control" v-model="entidaddom">
               								<option value="" disabled="">Seleccione la entidad</option>
	              							<option value="Yucatán">Yucatán</option>
	       								</select>
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Nacionalidad:</label>
    									<select class="form-control" v-model="nacionalidad">
               								<option value="" disabled="">Seleccione la nacionalidad</option>
	              							<option value="Mexicana">Mexicana</option>
	              							<option value="Extranjera">Extranjera</option>
	       								</select>
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Vive con:</label>
    									<select class="form-control" v-model="vivecon">
               								<option value="" disabled="">Vive con...</option>
	              							<option value="Sus padres">Sus padres</option>
	              							<option value="Su familia">Su familia</option>
	              							<option value="Pariente">Pariente</option>
	              							<option value="Otros">Otros</option>
	       								</select>
   									</div>
   								</div>
  								<div class="col-md-4">
  									<label>Estado civil:</label>
    								<select class="form-control" v-model="estadocivil">
               							<option value="" disabled="">Seleccione el estado civil</option>
	              						<option value="Soltero">Soltero</option>
	           							<option value="Casado">Casado</option>
	           							<option value="Divorciado">Divorciado</option>
	           							<option value="Unión libre">Unión libre</option>
	   								</select>
  								</div>
  							</div><hr>
  							<div class="row">
  								<div class="col-md-3">
  									<div class="form-group">
    									<label>Lugar de nacimiento:</label>
    									<input type="text" class="form-control" v-model="lugarnac" onkeypress="return soloLetras(event);">
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Ciudad de nacimiento:</label>
    									<input type="text" class="form-control" v-model="ciudadnac" onkeypress="return soloLetras(event);">
   									</div>
  								</div>
  								<div class="col-md-5">
  									<div class="form-group">
    									<label>Entidad federativa del nacimiento:</label>
    									<select class="form-control" v-model="entidadnac">
               								<option value="" disabled="">Seleccione la entidad</option>
	           								<option value="Yucatán">Yucatán</option>
	       								</select>
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Tipo de contrato:</label>
    									<select class="form-control" v-model="tipocontrato">
           									<option value="" disabled="">Seleccione la tipo</option>
	           								<option value="Por tiempo determinado">Por tiempo determinado</option>
      									</select>
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Correo corporativo:</label>
    									<input type="email" class="form-control" v-model="emailcorp">
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Correo personal:</label>
    									<input type="email" class="form-control" v-model="emailper">
   									</div>
  								</div>
  							</div>
  						</div>
					</div>
					<div class="card text-center">
  						<div class="card-header bg-secondary text-white">
    						<h5><b>Documentación</b></h5>
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>CURP:</label>
    									<input type="text" class="form-control" v-model="curp" maxlength="18" style="text-transform: uppercase;">
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>RFC:</label>
    									<input type="text" class="form-control" v-model="rfc" maxlength="13" style="text-transform: uppercase;">
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Número de Seguro Social:</label>
    									<input type="text" class="form-control" v-model="nss" maxlength="11" onkeypress="return soloNumeros(event);">
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Licencia de manejo:</label>
    									<select class="form-control" v-model="licmanejo">
               								<option value="" disabled="">Seleccione la opción</option>
	              							<option value="Si">Si</option>
	              							<option value="No">No</option>
	       								</select>
   									</div>
  								</div>
  							</div>
  						</div>
					</div>
					<div class="card text-center">
  						<div class="card-header bg-secondary text-white">
    						<h5><b>Salud</b></h5>
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>¿Cómo considera su estado de salud actual?</label>
    									<select class="form-control" v-model="estadosalud">
               								<option value="" disabled="">Seleccione la opción</option>
	              							<option value="Bueno">Bueno</option>
	              							<option value="Regular">Regular</option>
	              							<option value="Malo">Malo</option>
	       								</select>
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>¿Padece de alguna enfermedad crónica?</label>
    									<input type="text" class="form-control" v-model="enfermedadcronica" onkeypress="return soloLetras(event);">
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>¿Qué deporte practica?</label>
    									<input type="text" class="form-control" v-model="deporte" onkeypress="return soloLetras(event);">
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>¿Pertenece a algún Club Social Deportivo?</label>
    									<input type="text" class="form-control" v-model="club">
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>¿Cuál es su pasatiempo favorito?</label>
    									<input type="text" class="form-control" v-model="pasatiempo" onkeypress="return soloLetras(event);">
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>¿Cuál es su meta en la vida?</label>
    									<input type="text" class="form-control" v-model="metavida" onkeypress="return soloLetras(event);">
   									</div>
  								</div>
  							</div>
  						</div>
					</div>
					<div class="card text-center">
  						<div class="card-header bg-secondary text-white">
  							<h5><b>Datos familiares</b></h5>
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Nombre del padre:</label>
    									<input type="text" class="form-control" v-model="nompa" onkeypress="return soloLetras(event);">
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Vive:</label>
    									<select class="form-control" v-model="vivepa">
               								<option value="" disabled="">Seleccione la opción</option>
	              							<option value="Si">Si</option>
	              							<option value="No">No</option>
	       								</select>
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Dirección:</label>
    									<input type="text" class="form-control" v-model="direccionpa">
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Ocupación:</label>
    									<input type="text" class="form-control" v-model="ocupacionpa" onkeypress="return soloLetras(event);">
   									</div>
  								</div>
  							</div><hr>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Nombre de la madre:</label>
    									<input type="text" class="form-control" v-model="nomma" onkeypress="return soloLetras(event);">
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Vive:</label>
    									<select class="form-control" v-model="vivema">
               								<option value="" disabled="">Seleccione la opción</option>
	              							<option value="Si">Si</option>
	              							<option value="No">No</option>
	       								</select>
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Dirección:</label>
    									<input type="text" class="form-control" v-model="direccionma">
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Ocupación:</label>
    									<input type="text" class="form-control" v-model="ocupacionma" onkeypress="return soloLetras(event);">
   									</div>
  								</div>
  							</div><hr>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Esposo (a):</label>
    									<input type="text" class="form-control" v-model="nomes" onkeypress="return soloLetras(event);">
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Vive:</label>
    									<select class="form-control" v-model="vivees">
               								<option value="" disabled="">Seleccione la opción</option>
	              							<option value="Si">Si</option>
	              							<option value="No">No</option>
	       								</select>
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Dirección:</label>
    									<input type="text" class="form-control" v-model="direcciones">
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Ocupación:</label>
    									<input type="text" class="form-control" v-model="ocupaciones" onkeypress="return soloLetras(event);">
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-12">
  									<div class="form-group">
    									<label>Nombre y edad de los hijos:</label>
    									<input type="text" class="form-control" v-model="nomedadhijos">
   									</div>
  								</div>
  							</div>
  						</div>
					</div>
					<div class="card text-center">
  						<div class="card-header bg-secondary text-white">
  							<h5><b>Escolaridad (último nivel de estudio)</b></h5>
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Estudio:</label>
    									<select class="form-control" v-model="estudio">
               								<option value="" disabled="">Seleccione el nivel</option>
	              							<option value="Primaria">Primaria</option>
	              							<option value="Secundaria">Secundaria</option>
	              							<option value="Bachillerato">Bachillerato</option>
	              							<option value="Universidad">Universidad</option>
	       								</select>
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Nombre de la escuela:</label>
    									<input type="text" class="form-control" v-model="nomescuela">
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Dirección:</label>
    									<input type="text" class="form-control" v-model="direccionescuela">
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Año inicial:</label>
    									<input type="text" class="form-control" v-model="añoinicial" maxlength="4" onkeypress="return soloNumeros(event);">
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Año final:</label>
    									<input type="text" class="form-control" v-model="añofinal" maxlength="4" onkeypress="return soloNumeros(event);">
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Título recibido:</label>
    									<input type="text" class="form-control" v-model="titulo" onkeypress="return soloLetras(event);">
   									</div>
  								</div>
  							</div>
  						</div>
					</div>
					<div class="card text-center">
  						<div class="card-header bg-secondary text-white">
  							<h5><b>Referencias personales</b></h5>
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Nombre:</label>
    									<input type="text" class="form-control" v-model="nomrefuno" onkeypress="return soloLetras(event);">
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Dirección:</label>
    									<input type="text" class="form-control" v-model="direccionrefuno">
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Teléfono:</label>
    									<input type="text" class="form-control" v-model="telefonorefuno" maxlength="10" onkeypress="return soloNumeros(event);">
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Ocupación:</label>
    									<input type="text" class="form-control" v-model="ocupacionrefuno" onkeypress="return soloLetras(event);">
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Tiempo de conocerlo:</label>
    									<input type="text" class="form-control" v-model="tiempoconoceruno">
   									</div>
  								</div>
  							</div><hr>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Nombre:</label>
    									<input type="text" class="form-control" v-model="nomrefdos" onkeypress="return soloLetras(event);">
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Dirección:</label>
    									<input type="text" class="form-control" v-model="direccionrefdos">
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Teléfono:</label>
    									<input type="text" class="form-control" v-model="telefonorefdos" maxlength="10" onkeypress="return soloNumeros(event);">
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Ocupación:</label>
    									<input type="text" class="form-control" v-model="ocupacionrefdos" onkeypress="return soloLetras(event);">
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Tiempo de conocerlo:</label>
    									<input type="text" class="form-control" v-model="tiempoconocerdos">
   									</div>
  								</div>
  							</div>
  						</div>
					</div>
					<div class="card text-center">
  						<div class="card-header bg-secondary text-white">
  							<h5><b>Horario, periodo y días de contrato</b></h5>
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-12">
  									<div class="form-group">
    									<label>Horario:</label>
    									<select class="form-control" v-model="horario">
               								<option value="" disabled="">Seleccione la opción</option>
	              							<option value="Inmobiliaria Hotelera Montecristo SA de CV">Inmobiliaria Hotelera Montecristo SA de CV</option>
	       								</select>
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Periodo:</label>
    									<select class="form-control" v-model="periodo">
               								<option value="" disabled="">Seleccione la opción</option>
	              							<option value="Quincenal">Quincenal</option>
	       								</select>
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Días del contrato:</label>
    									<input type="text" class="form-control" v-model="diascontrato">
   									</div>
  								</div>
  							</div>
  						</div>
					</div>
					<div class="card text-center">
  						<div class="card-header bg-secondary text-white">
  							<h5><b>Sueldo</b></h5>
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Tipo de cotización:</label>
    									<select class="form-control" v-model="cotizacion">
               								<option value="" disabled="">Seleccione la opción</option>
	              							<option value="Mixto">Mixto</option>
	              							<option value="Fijo">Fijo</option>
	       								</select>
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Jefe directo:</label>
    									<select class="form-control" v-model="jefedirecto">
               								<option value="" disabled="">Seleccione la opción</option>
	              							<option value="Can Mendonza Alexis">Can Mendonza Alexis</option>
	              							<option value="Cetz Burgos Irene">Cetz Burgos Irene</option>
	              							<option value="Cortes Luis Alberto">Cortes Luis Alberto</option>
	              							<option value="Erguera Bacab Braulio">Erguera Bacab Braulio</option>
	              							<option value="Mota Castro Emilio">Mota Castro Emilio</option>
	              							<option value="Pat Jesús">Pat Jesús</option>
	              							<option value="Puch Tec Luis">Puch Tec Luis</option>
	              							<option value="Solis García Bayro Orlando">Solis García Bayro Orlando</option>
	              							<option value="Yah Kuk Carlos Román">Yah Kuk Carlos Román</option>
	       								</select>
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Sueldo bruto mensual total:</label>
    									<input type="text" class="form-control" v-model="sueldototal">
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Sueldo diario:</label>
    									<input type="text" class="form-control" v-model="sueldodiario">
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-12">
  									<div class="form-group">
    									<label>Explique la forma de pago:</label>
    									<input type="text" class="form-control" placeholder="Forma en que se pagará su sueldo, sueldo bruto o sueldo más comisiones, etc." v-model="formapago">
   									</div>
  								</div>
  							</div>
  						</div>
					</div>
					<div class="card text-center">
  						<div class="card-header bg-secondary text-white">
  							<h5><b>Observaciones</b></h5>
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-12">
  									<div class="form-group">
    									<label>Expediente:</label>
    									<textarea class="form-control" v-model="expediente"></textarea>
   									</div>
  								</div>
  							</div>
  						</div>
					</div>					        
	        	</div>
            	<div class="modal-footer">
                	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        	        <button type="button" class="btn btn-primary" dato-dismiss="modal" @click="actualizarDatosRestantes()">Guardar</button>
            	</div>
           	</div>
        </div>
    </div>
	<!-- FIN MODAL COMPLETAR DATOS -->

	<!-- INICIO MODAL VER DATOS COMPLETADOS NO FUNCIONA -->
	<div class="modal fade" id="modalVDatos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">DATOS DEL COLABORADOR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
	        	<div class="modal-body">
	        		<div class="card text-center">
  						<div class="card-header bg-secondary text-white">
    						<h5><b>Datos del empleado</b></h5>
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Nombre completo:</label><br>
    									<label style="font-weight: normal;">@{{nombre}}</label>
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>UNE:</label><br>
    									<label style="font-weight: normal;">@{{une}}</label>
    									<!-- <input type="text" class="form-control" v-model="direccion"> -->
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Departamento:</label><br>
    									<label style="font-weight: normal;">@{{departamento}}</label>
    									<!-- <input type="text" class="form-control" v-model="colonia"> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Puesto:</label><br>
    									<label style="font-weight: normal;">@{{puesto}}</label>
    									<!-- <input type="text" class="form-control" v-model="codigopostal" maxlength="5" onkeypress="return soloNumeros(event);"> -->
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Fecha de alta:</label><br>
    									<label style="font-weight: normal;">@{{fecha_alta}}</label>
    									<!-- <input type="text" class="form-control" v-model="telefono" maxlength="10" onkeypress="return soloNumeros(event);"> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Estado actual:</label><br>
    									<label style="font-weight: normal;">@{{estado}}</label>
    									<!-- <select class="form-control" v-model="sexo">
               								<option value="" disabled="">Seleccione el sexo</option>
	              							<option value="Hombre">Hombre</option>
	              							<option value="Mujer">Mujer</option>
	       								</select> -->
   									</div>
  								</div>
  							</div>
  						</div>
					</div>
	        	    <div class="card text-center">
  						<div class="card-header bg-secondary text-white">
    						<h5><b>Datos personales</b></h5>
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Fecha de nacimiento:</label><br>
    									<label style="font-weight: normal;">@{{fechanac}}</label>
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Dirección:</label><br>
    									<label style="font-weight: normal;">@{{direccion}}</label>
    									<!-- <input type="text" class="form-control" v-model="direccion"> -->
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Colonia:</label><br>
    									<label style="font-weight: normal;">@{{colonia}}</label>
    									<!-- <input type="text" class="form-control" v-model="colonia"> -->
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Código Postal:</label><br>
    									<label style="font-weight: normal;">@{{codigopostal}}</label>
    									<!-- <input type="text" class="form-control" v-model="codigopostal" maxlength="5" onkeypress="return soloNumeros(event);"> -->
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Teléfono:</label><br>
    									<label style="font-weight: normal;">@{{telefono}}</label>
    									<!-- <input type="text" class="form-control" v-model="telefono" maxlength="10" onkeypress="return soloNumeros(event);"> -->
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Sexo:</label><br>
    									<label style="font-weight: normal;">@{{sexo}}</label>
    									<!-- <select class="form-control" v-model="sexo">
               								<option value="" disabled="">Seleccione el sexo</option>
	              							<option value="Hombre">Hombre</option>
	              							<option value="Mujer">Mujer</option>
	       								</select> -->
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Población:</label><br>
    									<label style="font-weight: normal;">@{{poblacion}}</label>
    									<!-- <input type="text" class="form-control" v-model="poblacion" onkeypress="return soloLetras(event);"> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Entidad federativa del domicilio:</label><br>
    									<label style="font-weight: normal;">@{{entidaddom}}</label>
    									<!-- <select class="form-control" v-model="entidaddom">
               								<option value="" disabled="">Seleccione la entidad</option>
	              							<option value="Yucatán">Yucatán</option>
	       								</select> -->
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Nacionalidad:</label><br>
    									<label style="font-weight: normal;">@{{nacionalidad}}</label>
    									<!-- <select class="form-control" v-model="nacionalidad">
               								<option value="" disabled="">Seleccione la nacionalidad</option>
	              							<option value="Mexicana">Mexicana</option>
	              							<option value="Extranjera">Extranjera</option>
	       								</select> -->
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Vive con:</label><br>
    									<label style="font-weight: normal;">@{{vivecon}}</label>
    									<!-- <select class="form-control" v-model="vivecon">
               								<option value="" disabled="">Vive con...</option>
	              							<option value="Sus padres">Sus padres</option>
	              							<option value="Su familia">Su familia</option>
	              							<option value="Pariente">Pariente</option>
	              							<option value="Otros">Otros</option>
	       								</select> -->
   									</div>
   								</div>
  								<div class="col-md-4">
  									<label>Estado civil:</label><br>
  									<label style="font-weight: normal;">@{{estadocivil}}</label>
    									<!-- <select class="form-control" v-model="estadocivil">
               								<option value="" disabled="">Seleccione el estado civil</option>
	              							<option value="Soltero">Soltero</option>
	              							<option value="Casado">Casado</option>
	              							<option value="Divorciado">Divorciado</option>
	              							<option value="Unión libre">Unión libre</option>
	       								</select> -->
  								</div>
  							</div><hr>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Lugar de nacimiento:</label><br>
    									<label style="font-weight: normal;">@{{lugarnac}}</label>
    									<!-- <input type="text" class="form-control" v-model="lugarnac" onkeypress="return soloLetras(event);"> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Ciudad de nacimiento:</label><br>
    									<label style="font-weight: normal;">@{{ciudadnac}}</label>
    									<!-- <input type="text" class="form-control" v-model="ciudadnac" onkeypress="return soloLetras(event);"> -->
   									</div>
  								</div>
  								
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Entidad federativa del nacimiento:</label><br>
    									<label style="font-weight: normal;">@{{entidadnac}}</label>
    									<!-- <select class="form-control" v-model="entidadnac">
               								<option value="" disabled="">Seleccione la entidad</option>
	              							<option value="Yucatán">Yucatán</option>
	       								</select> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Tipo de contrato:</label><br>
    									<label style="font-weight: normal;">@{{tipocontrato}}</label>
    									<!-- <select class="form-control" v-model="tipocontrato">
               								<option value="" disabled="">Seleccione la tipo</option>
	              							<option value="Por tiempo determinado">Por tiempo determinado</option>
	       								</select> -->
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Correo corporativo:</label><br>
    									<label style="font-weight: normal;">@{{emailcorp}}</label>
    									<!-- <input type="email" class="form-control" v-model="emailcorp"> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Correo personal:</label><br>
    									<label style="font-weight: normal;">@{{emailper}}</label>
    									<!-- <input type="email" class="form-control" v-model="emailper"> -->
   									</div>
  								</div>
  							</div>
  						</div>
					</div>
					<div class="card text-center">
  						<div class="card-header bg-secondary text-white">
    						<h5><b>Documentación</b></h5>
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>CURP:</label><br>
    									<label style="font-weight: normal;">@{{curp}}</label>
    									<!-- <input type="text" class="form-control" v-model="curp" maxlength="18" style="text-transform: uppercase;"> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>RFC:</label><br>
    									<label style="font-weight: normal;">@{{rfc}}</label>
    									<!-- <input type="text" class="form-control" v-model="rfc" maxlength="13" style="text-transform: uppercase;"> -->
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Número de Seguro Social:</label><br>
    									<label style="font-weight: normal;">@{{nss}}</label>
    									<!-- <input type="text" class="form-control" v-model="nss" maxlength="11" onkeypress="return soloNumeros(event);"> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Licencia de manejo:</label><br>
    									<label style="font-weight: normal;">@{{licmanejo}}</label>
    									<!-- <select class="form-control" v-model="licmanejo">
               								<option value="" disabled="">Seleccione la opción</option>
	              							<option value="Si">Si</option>
	              							<option value="No">No</option>
	       								</select> -->
   									</div>
  								</div>
  							</div>
  						</div>
					</div>
					<div class="card text-center">
  						<div class="card-header bg-secondary text-white">
    						<h5><b>Salud</b></h5>
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>¿Cómo considera su estado de salud actual?</label><br>
    									<label style="font-weight: normal;">@{{estadosalud}}</label>
    									<!-- <select class="form-control" v-model="estadosalud">
               								<option value="" disabled="">Seleccione la opción</option>
	              							<option value="Bueno">Bueno</option>
	              							<option value="Regular">Regular</option>
	              							<option value="Malo">Malo</option>
	       								</select> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>¿Padece de alguna enfermedad crónica?</label><br>
    									<label style="font-weight: normal;">@{{enfermedadcronica}}</label>
    									<!-- <input type="text" class="form-control" v-model="enfermedadcronica" onkeypress="return soloLetras(event);"> -->
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>¿Qué deporte practica?</label><br>
    									<label style="font-weight: normal;">@{{deporte}}</label>
    									<!-- <input type="text" class="form-control" v-model="deporte" onkeypress="return soloLetras(event);"> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>¿Pertenece a algún Club Social Deportivo?</label><br>
    									<label style="font-weight: normal;">@{{club}}</label>
    									<!-- <input type="text" class="form-control" v-model="club"> -->
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-12">
  									<div class="form-group">
    									<label>¿Cuál es su pasatiempo favorito?</label><br>
    									<textarea class="form-control" disabled style="height: auto;">@{{pasatiempo}}</textarea>
    									<!-- <input type="text" class="form-control" v-model="pasatiempo" onkeypress="return soloLetras(event);"> -->
   									</div>
  								</div>
  								
  							</div>
  							<div class="row">
  								<div class="col-md-12">
  									<div class="form-group">
    									<label>¿Cuál es su meta en la vida?</label><br>
    									<textarea class="form-control" disabled>@{{metavida}}</textarea>
    									<!-- <input type="text" class="form-control" v-model="metavida" onkeypress="return soloLetras(event);"> -->
   									</div>
  								</div>
  							</div>
  						</div>
					</div>
					<div class="card text-center">
  						<div class="card-header bg-secondary text-white">
  							<h5><b>Datos familiares</b></h5>
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Nombre del padre:</label><br>
    									<label style="font-weight: normal;">@{{nompa}}</label>
    									<!-- <input type="text" class="form-control" v-model="nompa" onkeypress="return soloLetras(event);"> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Vive:</label><br>
    									<label style="font-weight: normal;">@{{vivepa}}</label>
    									<!-- <select class="form-control" v-model="vivepa">
               								<option value="" disabled="">Seleccione la opción</option>
	              							<option value="Si">Si</option>
	              							<option value="No">No</option>
	       								</select> -->
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Dirección:</label><br>
    									<label style="font-weight: normal;">@{{direccionpa}}</label>
    									<!-- <input type="text" class="form-control" v-model="direccionpa"> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Ocupación:</label><br>
    									<label style="font-weight: normal;">@{{ocupacionpa}}</label>
    									<!-- <input type="text" class="form-control" v-model="ocupacionpa" onkeypress="return soloLetras(event);"> -->
   									</div>
  								</div>
  							</div><hr>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Nombre de la madre:</label><br>
    									<label style="font-weight: normal;">@{{nomma}}</label>
    									<!-- <input type="text" class="form-control" v-model="nomma" onkeypress="return soloLetras(event);"> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Vive:</label><br>
    									<label style="font-weight: normal;">@{{vivema}}</label>
    									<!-- <select class="form-control" v-model="vivema">
               								<option value="" disabled="">Seleccione la opción</option>
	              							<option value="Si">Si</option>
	              							<option value="No">No</option>
	       								</select> -->
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Dirección:</label><br>
    									<label style="font-weight: normal;">@{{direccionma}}</label>
    									<!-- <input type="text" class="form-control" v-model="direccionma"> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Ocupación:</label><br>
    									<label style="font-weight: normal;">@{{ocupacionma}}</label>
    									<!-- <input type="text" class="form-control" v-model="ocupacionma" onkeypress="return soloLetras(event);"> -->
   									</div>
  								</div>
  							</div><hr>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Esposo (a):</label><br>
    									<label style="font-weight: normal;">@{{nomes}}</label>
    									<!-- <input type="text" class="form-control" v-model="nomes" onkeypress="return soloLetras(event);"> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Vive:</label><br>
    									<label style="font-weight: normal;">@{{vivees}}</label>
    									<!-- <select class="form-control" v-model="vivees">
               								<option value="" disabled="">Seleccione la opción</option>
	              							<option value="Si">Si</option>
	              							<option value="No">No</option>
	       								</select> -->
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Dirección:</label><br>
    									<label style="font-weight: normal;">@{{direcciones}}</label>
    									<!-- <input type="text" class="form-control" v-model="direcciones"> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Ocupación:</label><br>
    									<label style="font-weight: normal;">@{{ocupaciones}}</label>
    									<!-- <input type="text" class="form-control" v-model="ocupaciones" onkeypress="return soloLetras(event);"> -->
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-12">
  									<div class="form-group">
    									<label>Nombre y edad de los hijos:</label><br>
    									<textarea class="form-control" disabled>@{{nomedadhijos}}</textarea>
    									<!-- <input type="text" class="form-control" v-model="nomedadhijos"> -->
   									</div>
  								</div>
  							</div>
  						</div>
					</div>
					<div class="card text-center">
  						<div class="card-header bg-secondary text-white">
  							<h5><b>Escolaridad (último nivel de estudio)</b></h5>
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Estudio:</label><br>
    									<label style="font-weight: normal;">@{{estudio}}</label>
    									<!-- <select class="form-control" v-model="estudio">
               								<option value="" disabled="">Seleccione el nivel</option>
	              							<option value="Primaria">Primaria</option>
	              							<option value="Secundaria">Secundaria</option>
	              							<option value="Bachillerato">Bachillerato</option>
	              							<option value="Universidad">Universidad</option>
	       								</select> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Nombre de la escuela:</label><br>
    									<label style="font-weight: normal;">@{{nomescuela}}</label>
    									<!-- <input type="text" class="form-control" v-model="nomescuela"> -->
   									</div>
  								</div>
  								
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Dirección:</label><br>
    									<label style="font-weight: normal;">@{{direccionescuela}}</label>
    									<!-- <input type="text" class="form-control" v-model="direccionescuela"> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Título recibido:</label><br>
    									<label style="font-weight: normal;">@{{titulo}}</label>
    									<!-- <input type="text" class="form-control" v-model="titulo" onkeypress="return soloLetras(event);"> -->
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Año inicial:</label><br>
    									<label style="font-weight: normal;">@{{añoinicial}}</label>
    									<!-- <input type="text" class="form-control" v-model="añoinicial" maxlength="4" onkeypress="return soloNumeros(event);"> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Año final:</label><br>
    									<label style="font-weight: normal;">@{{añofinal}}</label>
    									<!-- <input type="text" class="form-control" v-model="añofinal" maxlength="4" onkeypress="return soloNumeros(event);"> -->
   									</div>
  								</div>
  								
  							</div>
  						</div>
					</div>
					<div class="card text-center">
  						<div class="card-header bg-secondary text-white">
  							<h5><b>Referencias personales</b></h5>
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Nombre:</label><br>
    									<label style="font-weight: normal;">@{{nomrefuno}}</label>
    									<!-- <input type="text" class="form-control" v-model="nomrefuno" onkeypress="return soloLetras(event);"> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Dirección:</label><br>
    									<label style="font-weight: normal;">@{{direccionrefuno}}</label>
    									<!-- <input type="text" class="form-control" v-model="direccionrefuno"> -->
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Teléfono:</label><br>
    									<label style="font-weight: normal;">@{{telefonorefuno}}</label>
    									<!-- <input type="text" class="form-control" v-model="telefonorefuno" maxlength="10" onkeypress="return soloNumeros(event);"> -->
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Ocupación:</label><br>
    									<label style="font-weight: normal;">@{{ocupacionrefuno}}</label>
    									<!-- <input type="text" class="form-control" v-model="ocupacionrefuno" onkeypress="return soloLetras(event);"> -->
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Tiempo de conocerlo:</label><br>
    									<label style="font-weight: normal;">@{{tiempoconoceruno}}</label>
    									<!-- <input type="text" class="form-control" v-model="tiempoconoceruno"> -->
   									</div>
  								</div>
  							</div><hr>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Nombre:</label><br>
    									<label style="font-weight: normal;">@{{nomrefdos}}</label>
    									<!-- <input type="text" class="form-control" v-model="nomrefdos" onkeypress="return soloLetras(event);"> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Dirección:</label><br>
    									<label style="font-weight: normal;">@{{direccionrefdos}}</label>
    									<!-- <input type="text" class="form-control" v-model="direccionrefdos"> -->
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Teléfono:</label><br>
    									<label style="font-weight: normal;">@{{telefonorefdos}}</label>
    									<!-- <input type="text" class="form-control" v-model="telefonorefdos" maxlength="10" onkeypress="return soloNumeros(event);"> -->
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Ocupación:</label><br>
    									<label style="font-weight: normal;">@{{ocupacionrefdos}}</label>
    									<!-- <input type="text" class="form-control" v-model="ocupacionrefdos" onkeypress="return soloLetras(event);"> -->
   									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
    									<label>Tiempo de conocerlo:</label><br>
    									<label style="font-weight: normal;">@{{tiempoconocerdos}}</label>
    									<!-- <input type="text" class="form-control" v-model="tiempoconocerdos"> -->
   									</div>
  								</div>
  							</div>
  						</div>
					</div>
					<div class="card text-center">
  						<div class="card-header bg-secondary text-white">
  							<h5><b>Horario, periodo y días de contrato</b></h5>
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-12">
  									<div class="form-group">
    									<label>Horario:</label><br>
    									<label style="font-weight: normal;">@{{horario}}</label>
    									<!-- <select class="form-control" v-model="horario">
               								<option value="" disabled="">Seleccione la opción</option>
	              							<option value="Inmobiliaria Hotelera Montecristo SA de CV">Inmobiliaria Hotelera Montecristo SA de CV</option>
	       								</select> -->
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Periodo:</label><br>
    									<label style="font-weight: normal;">@{{periodo}}</label>
    									<!-- <select class="form-control" v-model="periodo">
               								<option value="" disabled="">Seleccione la opción</option>
	              							<option value="Quincenal">Quincenal</option>
	       								</select> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Días del contrato:</label><br>
    									<label style="font-weight: normal;">@{{diascontrato}}</label>
    									<!-- <input type="text" class="form-control" v-model="diascontrato"> -->
   									</div>
  								</div>
  							</div>
  						</div>
					</div>
					<div class="card text-center">
  						<div class="card-header bg-secondary text-white">
  							<h5><b>Sueldo</b></h5>
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Tipo de cotización:</label><br>
    									<label style="font-weight: normal;">@{{cotizacion}}</label>
    									<!-- <select class="form-control" v-model="cotizacion">
               								<option value="" disabled="">Seleccione la opción</option>
	              							<option value="Mixto">Mixto</option>
	              							<option value="Fijo">Fijo</option>
	       								</select> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Jefe directo:</label><br>
    									<label style="font-weight: normal;">@{{jefedirecto}}</label>
    									<!-- <select class="form-control" v-model="jefedirecto">
               								<option value="" disabled="">Seleccione la opción</option>
	              							<option value="Can Mendonza Alexis">Can Mendonza Alexis</option>
	              							<option value="Cetz Burgos Irene">Cetz Burgos Irene</option>
	              							<option value="Cortes Luis Alberto">Cortes Luis Alberto</option>
	              							<option value="Erguera Bacab Braulio">Erguera Bacab Braulio</option>
	              							<option value="Mota Castro Emilio">Mota Castro Emilio</option>
	              							<option value="Pat Jesús">Pat Jesús</option>
	              							<option value="Puch Tec Luis">Puch Tec Luis</option>
	              							<option value="Solis García Bayro Orlando">Solis García Bayro Orlando</option>
	              							<option value="Yah Kuk Carlos Román">Yah Kuk Carlos Román</option>
	       								</select> -->
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Sueldo bruto mensual total:</label><br>
    									<label style="font-weight: normal;">@{{sueldototal}}</label>
    									<!-- <input type="text" class="form-control" v-model="sueldototal"> -->
   									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
    									<label>Sueldo diario:</label><br>
    									<label style="font-weight: normal;">@{{sueldodiario}}</label>
    									<!-- <input type="text" class="form-control" v-model="sueldodiario"> -->
   									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-12">
  									<div class="form-group">
    									<label>Explique la forma de pago:</label><br>
    									<label style="font-weight: normal;">@{{formapago}}</label>
    									<!-- <input type="text" class="form-control" placeholder="Forma en que se pagará su sueldo, sueldo bruto o sueldo más comisiones, etc." v-model="formapago"> -->
   									</div>
  								</div>
  							</div>
  						</div>
					</div>
					<div class="card text-center">
  						<div class="card-header bg-secondary text-white">
  							<h5><b>Observaciones</b></h5>
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-12">
  									<div class="form-group">
    									<label>Expediente:</label>
    									<textarea class="form-control" disabled>@{{expediente}}</textarea>
    									<!-- <textarea class="form-control" v-model="expediente"></textarea> -->
   									</div>
  								</div>
  							</div>
  						</div>
					</div>
	        	</div>
            	<div class="modal-footer">
                	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                	<!-- <button type="button" class="btn btn-primary" dato-dismiss="modal" @click="guardarEmpleado" v-if="agregando==true">Guardar</button>
        	        <button type="button" class="btn btn-primary" dato-dismiss="modal" @click="actualizarEmpleado()" v-if="agregando==false">Guardar</button> -->
            	</div>
           	</div>
        </div>
    </div> 
	<!-- FIN MODAL VER DATOS COMPLETADOS -->


	<!-- INICIO TABLA DESACTIVADOS -->
	<div class="content">
        <div class="container-fluid">
         	<div class="row">
            	<div class="col-lg-12">
             		<div class="card">

	             		<!-- inicia input buscar -->
	             		<div class="card card-primary">
						    <div class="card-header">
						        <div class="row">
                    <div class="col-md-8">
                      <h3 class="card-title">Lista de colaboradores</h3>
                    </div>
                    <div class="col-md-4">
                      <div class="card-tools">         
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control float-right" placeholder="Escriba el nombre del colaborador" v-model="buscardes" onkeypress="return soloLetras(event);">
                        </div>
                            
                    </div>
                    </div>
                  </div>
						    </div>
						</div>
						<!-- fin de input buscar -->  

						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap table-bordered">
								<thead>
									<th>ID</th>
									<th>NOMBRE</th>
									<th>UNE</th>
									<th>DEPARTAMENTO</th>
									<th>PUESTO</th>
									<th>FECHA DE ALTA</th>
									<th>ESTADO</th>
									<th>OPCIONES</th>
								</thead>
								<tbody>
									<tr v-for="(empleadod,index) in filtroEmpleadosDes">
										<td>@{{index+1}}</td>
										<td>@{{empleadod.nombre}}</td>
										<td>@{{empleadod.une}}</td>
										<td>@{{empleadod.departamento}}</td>
										<td>@{{empleadod.puesto}}</td>
										<td>@{{empleadod.fecha_alta}}</td>
										<td class="bg-danger text-white">@{{empleadod.estado}}</td>
										<td align="center">
											<button class="btn btn-sm" @click="eliminarEmpleado(empleadod.id_empleado)">
												<i class="fas fa-trash"></i>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
	<!-- FIN TABLA DESACTIVADOS -->

</div>
<!--FIN DE VUE-->
@endsection





@push('scripts')
<script type="text/javascript" src="js/apis/apiEmpleado.js"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">