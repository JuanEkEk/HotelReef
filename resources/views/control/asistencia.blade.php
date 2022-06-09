@extends('layout.master')
@section('titulo', 'Asistencias')

@section('panel')
    @include('areas.contenido.panel')
@endsection


@section('contenido')
    <script>
        function soloLetras(e) {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toString();
            letras =
                " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ"; //Se define todo el abecedario que se quiere que se muestre.
            especiales = [8, 37, 39, 46, 6]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.

            tecla_especial = false
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }
            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        }
    </script>

    <script type="text/javascript">
        function soloNumeros(e) {
            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46))
                return true;
            return /\d/.test(String.fromCharCode(keynum));
        }
    </script>
    <div>

        <!-- titulo y boton de agregar -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-10">
                        {{-- <h1 class="m-0 text-dark">COLABORADORES DEL ÁREA DE DIVISIÓN | CUARTOS</h1> --}}
                        <h1 class="m-0 text-dark">CONTROL DE ASISTENCIA</h1>
                        <div class="image">
                            <!-- <img src="dist/img/reef.jpeg" class="img-rectangle elevation-2"  width="70" height="50" alt="User Image"> -->
                        </div><br>
                    </div><!-- /.col -->
                    <div class="col-sm-2">
                        {{-- <a @click="mostrarModal">
                            <button class="btn btn-primary btn-xl float-right"><i class="fas fa-plus"></i></button>
                        </a> --}}
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- fin de boton agregar -->

        {{-- Inicio agenda --}}
        <div class="container card card-primary">
            <div class="card-header">
                <h5 class="card-title text-center">Agenda de actividades</h5>
            </div>
            <div id="agenda" class="card-body" style="text-transform: uppercase;">
            </div>
        </div>
        {{-- Fin agenda --}}
    </div>
    <!--FIN DE VUE-->
@endsection





@push('scripts')
    {{-- <script type="text/javascript" src="js/apis/apiEmpleado.js"></script> --}}
@endpush

<input type="hidden" name="route" value="{{ url('/') }}">
