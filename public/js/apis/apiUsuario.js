var ruta = document.querySelector("[name=route]").value;
var urlPerfilUsuario = ruta + '/apiPerfil';

new Vue({
	http: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
    },

	el:'#usuarioperfil',

	data:{
		usuarios:[],
		nombre:'',
		usuario:'',
		password:'',
		id_usuario:'',
		id:'',
	},

	created:function(){
		this.getPerfilUsuario();
	},

	methods:{
		getPerfilUsuario:function(){
			this.$http.get(urlPerfilUsuario)
			.then(function(json){
				this.usuarios = json.data;
				console.log(json);
			});
		},

		editarDatos:function(id){
			this.$http.get(urlPerfilUsuario + '/' + id).then(function(json){
				this.nombre = json.data.nombre;
				this.usuario = json.data.usuario;
				this.password = json.data.password;
				this.id = json.data.id_usuario;
				$('#Mostrar').modal('show');
			});
		},

		actualizarDatos:function(){

			if(this.nombre && this.usuario && this.password){
				var datos = {
				id_usuario:this.id,
				nombre:this.nombre,
				usuario:this.usuario,
				password:this.password
				};
				this.$http.patch(urlPerfilUsuario + '/' + this.id,datos)
				.then(function(json){
					this.getPerfilUsuario();
					$('#Mostrar').modal('hide');

				});
				var confir= confirm('Los datos fueron guardados correctamente');
			}else{
				// catch(function(json){
				// console.log(json);
				// });
				var confir= confirm('Verifique que todos los campos se encuentren llenos');
			}




			
		}
	}
});