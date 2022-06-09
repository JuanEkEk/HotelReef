@extends('layout.master')
@section('titulo','Perfil')

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
<div id="usuarioperfil">
	<!-- Titulo -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-12">
					<h1 class="m-0 text-dark">MI PERFIL</h1><br>
				</div>
			</div>
		</div>
	</div>

	<!-- Contenedor -->
	<div class="content">
		<div class="container-fluid">
			<div>
				<div class="row">
					<div hidden="true">@{{id="{!!Session::get('id_usuario')!!}"}}</div>
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<form v-for="perus in usuarios">
							<div class="card text-center">
  								<div class="card-header bg-primary">
  									<h3 class="card-title">Datos del @{{perus.rol}}</h3>
    								
  								</div>
  								<div class="card-body">
    								<div class="row">
    									<div class="col-md-6">
    										<div class="form-group">
    											<label>Nombre completo:</label><br>
    											<label style="font-weight: normal;">@{{perus.nombre}}</label>
    										</div>
    									</div>
    									<div class="col-md-6">
    										<div class="form-group">
    											<label>Rol:</label><br>
    											<label style="font-weight: normal;">@{{perus.rol}}</label>
    										</div>
    									</div>
    								</div>
    								<div class="row">
    									<div class="col-md-6">
    										<div class="form-group">
    											<label>Usuario actual:</label><br>
    											<label style="font-weight: normal;">@{{perus.usuario}}</label>
    										</div>
    									</div>
    									<div class="col-md-6">
    										<div class="form-group">
    											<label>Contraseña actual:</label><br>
    											<label style="font-weight: normal;">@{{perus.password}}</label>
    										</div>
    									</div>
    								</div>
  								</div>
  								<div class="card-footer">
    								<button type="button" class="btn btn-primary" @click="editarDatos(perus.id_usuario)">
    									<i class="fas fa-cog"></i>&nbsp;Editar datos
    								</button>
  								</div>
							</div>
						</form>
					</div>
					<div class="col-md-2"></div>	
				</div>

				<!-- Ventana modal -->
				<div class="modal fade" id="Mostrar" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Actualizar datos</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="">
									<div class="form-group">
										<label>Nombre del administrador:</label>
										<input type="text" class="form-control" v-model="nombre" onkeypress="return soloLetras(event);" placeholder="Ingrese el nombre completo">
									</div>
									<div class="form-group">
										<label>Usuario:</label>
										<input type="text" class="form-control" v-model="usuario" placeholder="Ingrese el nuevo usuario">
									</div>
									<div class="form-group">
										<label>Contraseña:</label>
										<input type="text" class="form-control" v-model="password" placeholder="Ingrese la nueva contraseña">
									</div>
								</form>
								<div class="modal-footer">
									<button type="button" class="btn btn-success" @click="actualizarDatos()">Actualizar</button>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script type="text/javascript" src="js/apis/apiUsuario.js"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">