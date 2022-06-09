var ruta = document.querySelector("[name=route]").value;
var apiEmpleadoDivision=ruta + '/apiDivision';
var apiEmpleadoDesactivado = ruta + '/apiDivisionDes';

new Vue({

    http:{
        headers:{
            'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
    },

    el:"#empleado",

    data:{
        prueba:'Esta es una prueba de nuevo',
        empleados:[],
        empleadosdes:[],

        nombre:'',
        une:'',
        departamento:'',
        puesto:'',
        fecha_alta:'',
        estado:'',
        id_empleado:'',
        buscar:'',
        buscardes:'',
        agregando:true,
        id:'',

        //datos restantes
        //personales
        direccion:'',
        colonia:'',
        codigopostal:'',
        telefono:'',
        sexo:'',
        poblacion:'',
        entidaddom:'',
        fechanac:'',
        nacionalidad:'',
        vivecon:'',
        estadocivil:'',
        lugarnac:'',
        ciudadnac:'',
        entidadnac:'',
        tipocontrato:'',
        emailcorp:'',
        emailper:'',

        //documentacion
        curp:'',
        rfc:'',
        nss:'',
        licmanejo:'',

        //salud
        estadosalud:'',
        enfermedadcronica:'',
        deporte:'',
        club:'',
        pasatiempo:'',
        metavida:'',

        //datos familiares
        nompa:'',
        vivepa:'',
        direccionpa:'',
        ocupacionpa:'',
        nomma:'',
        vivema:'',
        direccionma:'',
        ocupacionma:'',
        nomes:'',
        vivees:'',
        direcciones:'',
        ocupaciones:'',
        nomedadhijos:'',

        //escolaridad
        estudio:'',
        nomescuela:'',
        direccionescuela:'',
        añoinicial:'',
        añofinal:'',
        titulo:'',

        //referencias personales
        nomrefuno:'',
        direccionrefuno:'',
        telefonorefuno:'',
        ocupacionrefuno:'',
        tiempoconoceruno:'',
        nomrefdos:'',
        direccionrefdos:'',
        telefonorefdos:'',
        ocupacionrefdos:'',
        tiempoconocerdos:'',

        //horario
        horario:'',
        periodo:'',
        diascontrato:'',

        //sueldo
        cotizacion:'',
        sueldototal:'',
        jefedirecto:'',
        sueldodiario:'',
        formapago:'',

        //observaciones
        expediente:'',

    },

    //AL CREARSE LA PAGINA
    created:function(){
        this.obtenerEmpleados();
        this.obtenerEmpleadosDes();
    },

    methods:{
        obtenerEmpleados:function(){
            this.$http.get(apiEmpleadoDivision).then(function(json){
                this.empleados=json.data;
                console.log(json.data);
            }).catch(function(json){
                console.log(json);
            });
        },

        obtenerEmpleadosDes:function(){
            this.$http.get(apiEmpleadoDesactivado).then(function(json){
                this.empleadosdes=json.data;
                console.log(json.data);
            }).catch(function(json){
                console.log(json);
            });
        },

        mostrarModal:function(){
            this.agregando=true;
            this.nombre='';
            this.une='';
            this.departamento='';
            this.puesto='';
            this.fecha_alta='';
            this.estado='';

            $('#modalEmpleado').modal('show');

        },

        guardarEmpleado:function(){
            var empleado={nombre:this.nombre,une:this.une,departamento:this.departamento,puesto:this.puesto,fecha_alta:this.fecha_alta,estado:this.estado};

            //Se envia los datos al controlador
            this.$http.post(apiEmpleadoDivision,empleado).then(function(json){
                this.obtenerEmpleados();
                this.obtenerEmpleadosDes();
                this.id_empleado='';
                this.nombre='';
                this.une='';
                this.departamento='';
                this.puesto='';
                this.fecha_alta='';
                $('#modalEmpleado').modal('hide');
                var confir= confirm('Los datos se guardaron correctamente');
            }).catch(function(json){
                var confir= confirm('Verifique que todos los campos se encuentren llenos');
                console.log(json);
            });

            
            console.log(empleado);
        },

        eliminarEmpleado:function(id){
            var confir= confirm('¿Está seguro de eliminar al colaborador?');

            if(confir)
            {
                this.$http.delete(apiEmpleadoDesactivado + '/' + id).then(function(json){
                    //this.obtenerEmpleados();
                    this.obtenerEmpleadosDes();
                }).catch(function(json){
                    console.log(json)
                });
            }
        },

        editandoEmpleado:function(id){
            this.agregando=false;
            this.id_empleado=id;

            this.$http.get(apiEmpleadoDivision + '/' + id).then(function(json){
                this.nombre=json.data.nombre;
                this.une=json.data.une;
                this.departamento=json.data.departamento;
                this.puesto=json.data.puesto;
                this.fecha_alta=json.data.fecha_alta;
                this.estado=json.data.estado;

            });

            $('#modalEmpleado').modal('show');
        },

        actualizarEmpleado:function(){
            var jsonEmpleado ={nombre:this.nombre,
                               une:this.une,
                               departamento:this.departamento,
                               puesto:this.puesto,
                               fecha_alta:this.fecha_alta,
                               estado:this.estado
                           };

            this.$http.patch(apiEmpleadoDivision + '/' + this.id_empleado,jsonEmpleado).then(function(json){
                this.obtenerEmpleados();
                this.obtenerEmpleadosDes();
                var confir= confirm('Los datos se actualizaron correctamente');
                $('#modalEmpleado').modal('hide');
            }).catch(function(json){
                var confir= confirm('Verifique que todos los campos se encuentren llenos');
                console.log(json);
            });
            
        },

        verDatosEmpleado:function(id){
            this.id_empleado=id;

            this.$http.get(apiEmpleadoDivision + '/' + id).then(function(json){
                // this.id = json.data.id_empleado;
                this.nombre=json.data.nombre;
                this.une=json.data.une;
                this.departamento=json.data.departamento;
                this.puesto=json.data.puesto;
                this.fecha_alta=json.data.fecha_alta;
                this.estado=json.data.estado;
                //personales
                this.direccion = json.data.direccion;
                this.colonia = json.data.colonia;
                this.codigopostal = json.data.codigopostal;
                this.telefono = json.data.telefono;
                this.sexo = json.data.sexo;
                this.poblacion = json.data.poblacion;
                this.entidaddom = json.data.entidaddom;
                this.fechanac = json.data.fechanac;
                this.nacionalidad = json.data.nacionalidad;
                this.vivecon = json.data.vivecon;
                this.estadocivil = json.data.estadocivil;
                this.lugarnac = json.data.lugarnac;
                this.ciudadnac = json.data.ciudadnac;
                this.entidadnac = json.data.entidadnac;
                this.tipocontrato = json.data.tipocontrato;
                this.emailcorp = json.data.emailcorp;
                this.emailper = json.data.emailper;

                //documentacion
                this.curp = json.data.curp;
                this.rfc = json.data.rfc;
                this.nss = json.data.nss;
                this.licmanejo = json.data.licmanejo;

                //salud
                this.estadosalud = json.data.estadosalud;
                this.enfermedadcronica = json.data.enfermedadcronica;
                this.deporte = json.data.deporte;
                this.club = json.data.club;
                this.pasatiempo = json.data.pasatiempo;
                this.metavida = json.data.metavida;

                //datos familiares
                this.nompa = json.data.nompa;
                this.vivepa = json.data.vivepa;
                this.direccionpa = json.data.direccionpa;
                this.ocupacionpa = json.data.ocupacionpa;
                this.nomma = json.data.nomma;
                this.vivema = json.data.vivema;
                this.direccionma = json.data.direccionma;
                this.ocupacionma = json.data.ocupacionma;
                this.nomes = json.data.nomes;
                this.vivees = json.data.vivees;
                this.direcciones = json.data.direcciones;
                this.ocupaciones = json.data.ocupaciones;
                this.nomedadhijos = json.data.nomedadhijos;

                //escolaridad
                this.estudio = json.data.estudio;
                this.nomescuela = json.data.nomescuela;
                this.direccionescuela = json.data.direccionescuela;
                this.añoinicial = json.data.añoinicial;
                this.añofinal = json.data.añofinal;
                this.titulo = json.data.titulo;

                //referencias personales
                this.nomrefuno = json.data.nomrefuno;
                this.direccionrefuno = json.data.direccionrefuno;
                this.telefonorefuno = json.data.telefonorefuno;
                this.ocupacionrefuno = json.data.ocupacionrefuno;
                this.tiempoconoceruno = json.data.tiempoconoceruno;
                this.nomrefdos = json.data.nomrefdos;
                this.direccionrefdos = json.data.direccionrefdos;
                this.telefonorefdos = json.data.telefonorefdos;
                this.ocupacionrefdos = json.data.ocupacionrefdos;
                this.tiempoconocerdos = json.data.tiempoconocerdos;

                //horario
                this.horario = json.data.horario;
                this.periodo = json.data.periodo;
                this.diascontrato = json.data.diascontrato;

                //sueldo
                this.cotizacion = json.data.cotizacion;
                this.sueldototal = json.data.sueldototal;
                this.jefedirecto = json.data.jefedirecto;
                this.sueldodiario = json.data.sueldodiario;
                this.formapago = json.data.formapago;

                //observaciones
                this.expediente = json.data.expediente;
            });

            $('#modalVDatos').modal('show');
        },

        editarDatosRestantes:function(id){
            //this.agregando=false;
            this.id_empleado=id;

            this.$http.get(apiEmpleadoDivision + '/' + id).then(function(json){
                this.nombre=json.data.nombre;
                this.une=json.data.une;
                this.departamento=json.data.departamento;
                this.puesto=json.data.puesto;
                this.fecha_alta=json.data.fecha_alta;
                this.estado=json.data.estado;
                //personales
                this.direccion = json.data.direccion;
                this.colonia = json.data.colonia;
                this.codigopostal = json.data.codigopostal;
                this.telefono = json.data.telefono;
                this.sexo = json.data.sexo;
                this.poblacion = json.data.poblacion;
                this.entidaddom = json.data.entidaddom;
                this.fechanac = json.data.fechanac;
                this.nacionalidad = json.data.nacionalidad;
                this.vivecon = json.data.vivecon;
                this.estadocivil = json.data.estadocivil;
                this.lugarnac = json.data.lugarnac;
                this.ciudadnac = json.data.ciudadnac;
                this.entidadnac = json.data.entidadnac;
                this.tipocontrato = json.data.tipocontrato;
                this.emailcorp = json.data.emailcorp;
                this.emailper = json.data.emailper;

                //documentacion
                this.curp = json.data.curp;
                this.rfc = json.data.rfc;
                this.nss = json.data.nss;
                this.licmanejo = json.data.licmanejo;

                //salud
                this.estadosalud = json.data.estadosalud;
                this.enfermedadcronica = json.data.enfermedadcronica;
                this.deporte = json.data.deporte;
                this.club = json.data.club;
                this.pasatiempo = json.data.pasatiempo;
                this.metavida = json.data.metavida;

                //datos familiares
                this.nompa = json.data.nompa;
                this.vivepa = json.data.vivepa;
                this.direccionpa = json.data.direccionpa;
                this.ocupacionpa = json.data.ocupacionpa;
                this.nomma = json.data.nomma;
                this.vivema = json.data.vivema;
                this.direccionma = json.data.direccionma;
                this.ocupacionma = json.data.ocupacionma;
                this.nomes = json.data.nomes;
                this.vivees = json.data.vivees;
                this.direcciones = json.data.direcciones;
                this.ocupaciones = json.data.ocupaciones;
                this.nomedadhijos = json.data.nomedadhijos;

                //escolaridad
                this.estudio = json.data.estudio;
                this.nomescuela = json.data.nomescuela;
                this.direccionescuela = json.data.direccionescuela;
                this.añoinicial = json.data.añoinicial;
                this.añofinal = json.data.añofinal;
                this.titulo = json.data.titulo;

                //referencias personales
                this.nomrefuno = json.data.nomrefuno;
                this.direccionrefuno = json.data.direccionrefuno;
                this.telefonorefuno = json.data.telefonorefuno;
                this.ocupacionrefuno = json.data.ocupacionrefuno;
                this.tiempoconoceruno = json.data.tiempoconoceruno;
                this.nomrefdos = json.data.nomrefdos;
                this.direccionrefdos = json.data.direccionrefdos;
                this.telefonorefdos = json.data.telefonorefdos;
                this.ocupacionrefdos = json.data.ocupacionrefdos;
                this.tiempoconocerdos = json.data.tiempoconocerdos;

                //horario
                this.horario = json.data.horario;
                this.periodo = json.data.periodo;
                this.diascontrato = json.data.diascontrato;

                //sueldo
                this.cotizacion = json.data.cotizacion;
                this.sueldototal = json.data.sueldototal;
                this.jefedirecto = json.data.jefedirecto;
                this.sueldodiario = json.data.sueldodiario;
                this.formapago = json.data.formapago;

                //observaciones
                this.expediente = json.data.expediente;
            });

            $('#modalCDatos').modal('show');
            //$('#modalVDatos').modal('show');

        },

        actualizarDatosRestantes:function(){
            var jsonEmpleado ={
                            nombre:this.nombre,
                            une:this.une,
                            departamento:this.departamento,
                            puesto:this.puesto,
                            fecha_alta:this.fecha_alta,
                            estado:this.estado,
                            //datos restantes
                            //personales
                            direccion:this.direccion,
                            colonia:this.colonia,
                            codigopostal:this.codigopostal,
                            telefono:this.telefono,
                            sexo:this.sexo,
                            poblacion:this.poblacion,
                            entidaddom:this.entidaddom,
                            fechanac:this.fechanac,
                            nacionalidad:this.nacionalidad,
                            vivecon:this.vivecon,
                            estadocivil:this.estadocivil,
                            lugarnac:this.lugarnac,
                            ciudadnac:this.ciudadnac,
                            entidadnac:this.entidadnac,
                            tipocontrato:this.tipocontrato,
                            emailcorp:this.emailcorp,
                            emailper:this.emailper,

                            //documentacion
                            curp:this.curp,
                            rfc:this.rfc,
                            nss:this.nss,
                            licmanejo:this.licmanejo,

                            //salud
                            estadosalud:this.estadosalud,
                            enfermedadcronica:this.enfermedadcronica,
                            deporte:this.deporte,
                            club:this.club,
                            pasatiempo:this.pasatiempo,
                            metavida:this.metavida,

                            //datos familiares
                            nompa:this.nompa,
                            vivepa:this.vivepa,
                            direccionpa:this.direccionpa,
                            ocupacionpa:this.ocupacionpa,
                            nomma:this.nomma,
                            vivema:this.vivema,
                            direccionma:this.direccionma,
                            ocupacionma:this.ocupacionma,
                            nomes:this.nomes,
                            vivees:this.vivees,
                            direcciones:this.direcciones,
                            ocupaciones:this.ocupaciones,
                            nomedadhijos:this.nomedadhijos,

                            //escolaridad
                            estudio:this.estudio,
                            nomescuela:this.nomescuela,
                            direccionescuela:this.direccionescuela,
                            añoinicial:this.añoinicial,
                            añofinal:this.añofinal,
                            titulo:this.titulo,

                            //referencias personales
                            nomrefuno:this.nomrefuno,
                            direccionrefuno:this.direccionrefuno,
                            telefonorefuno:this.telefonorefuno,
                            ocupacionrefuno:this.ocupacionrefuno,
                            tiempoconoceruno:this.tiempoconoceruno,
                            nomrefdos:this.nomrefdos,
                            direccionrefdos:this.direccionrefdos,
                            telefonorefdos:this.telefonorefdos,
                            ocupacionrefdos:this.ocupacionrefdos,
                            tiempoconocerdos:this.tiempoconocerdos,

                            //horario
                            horario:this.horario,
                            periodo:this.periodo,
                            diascontrato:this.diascontrato,

                            //sueldo
                            cotizacion:this.cotizacion,
                            sueldototal:this.sueldototal,
                            jefedirecto:this.jefedirecto,
                            sueldodiario:this.sueldodiario,
                            formapago:this.formapago,

                            //observaciones
                            expediente:this.expediente
                           };

            this.$http.patch(apiEmpleadoDivision + '/' + this.id_empleado,jsonEmpleado).then(function(json){
                var confir= confirm('Los datos se guardaron correctamente');
                this.obtenerEmpleados();
                this.obtenerEmpleadosDes();
            });
            $('#modalCDatos').modal('hide');
        },


        

    },

    //inicio filtro
    computed:{
        filtroEmpleados:function(){
            return this.empleados.filter((em)=>{
                return em.nombre.toLowerCase().match(this.buscar.toLowerCase().trim())
            });
        },

        filtroEmpleadosDes:function(){
            return this.empleadosdes.filter((emdes)=>{
                return emdes.nombre.toLowerCase().match(this.buscardes.toLowerCase().trim())
            });
        }
    }

})