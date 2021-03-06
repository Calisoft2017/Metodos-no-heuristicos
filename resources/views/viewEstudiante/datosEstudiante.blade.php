@extends('layouts.principal')

@section('navegacion')
<div class="titulo">ESTUDIANTE</div>
<div class="contenedor-tabla100">
  <table><tr>
    <form method="POST" action="datosEstudiante">
      <input type="hidden" name="id_estudiante" id="id_estudiante">
      <th style="width: 33.33%;"><button name="datosEvaluador" class="" id="menu_boton" onclick="guardar2(this)" value="">ver datos</button></th>
    </form>
    <form method="POST" action="documentosproyecto">
    <input type="hidden" name="h_id_usuario" id="h_id_usuario">
      <th><button name="subirDocumento" class="menu_est" id="menu_boton" onclick="guardar_id_usuario(this)" value="">Subir documentación</button></th>
    </form>
    <form method="POST" action="verEvaluador">
      <input type="hidden" name="id_usuario" id="id_usuario">
      <th  style="width: 33.33%;"><button name="verEvaluador" class="menu_est" id="menu_boton" onclick="guardar(this)" value="">Ver evaluacion</button></th>
    </form>
  </tr></table>
</div> 
@stop

@section('content')
<link href="../css/registro.css"rel="stylesheet" type="text/css" >
<style type="text/css">
  .espacio1{
    float:left;
  }
  .espacio2{
    float:right;
  }
</style>
    <div class="datos_usuario_titulo">DATOS DE USUARIO</div> 
    <hr>
    <?php 
    if(count($estudiante) > 0){ 
    ?>

      @foreach($estudiante as $eva)
            <div class="section_datos"  style=" float: left;">

            <form method="POST" action="actualizarDatosEst" id="actualizar_datos">
              <div class="datos_usuario_titulo">Actualizar datos</div> 
              <hr>

              <div  style="text-align: left;">
                <div class="datos_usuario_titulo">Nombre</div> 
                <input type="text" name="edit_nombre" id="edit_nombre" value="{{$eva->nombre}}" placeholder="nombre" autofocus required min="0" max="50"/>
              </div>
                <hr>
              <div  style="text-align: left;">
                <div class="datos_usuario_titulo">Apellido</div> 
                <input type="text" name="edit_apellido" id="edit_apellido" value="{{$eva->apellido}}" placeholder="nombre" autofocus required min="0" max="50"/>
              </div>
                <hr>
                <div class="datos_usuario_titulo">Código</div> 
                <div class="datos_usuario">{{$eva->id_usuario}}</div>
                <hr>
              <div  style="text-align: left;">
                <div class="datos_usuario_titulo">Correo</div> 
                <input type="email" name="edit_correo" id="edit_correo" value="{{$eva->correo}}" placeholder="Correo" autofocus required maxlength="50"/>
              </div>
                <hr>
                <div  style="text-align: left;">
                  <div class="datos_usuario_titulo">Usuario</div> 
                  <div class="datos_usuario">{{$eva->nom_usuario}}</div>
                  <!-- <input type="text" name="edit_nombre" value="{{$eva->nom_usuario}}" placeholder="nombre" autofocus required min="0" max="50"/> -->
                </div>
                <hr>
                <div class="datos_usuario_titulo">Estado</div> 
                <div class="datos_usuario">{{($eva->estado)}}</div>
                <input type="hidden" id="contrasena_user" value="{{decrypt($eva->contrasena)}}">

                <br>
                <div class="box-footer">
                  <input type="hidden" name="id_estudiante" id="id_estudiante5">
                  <button id="btn_actualizar" type="submit" class="" onclick="actualizar_datos(this)">Actualizar datos</button>
                </div>
              </form>
            </div>

            <div class="section_datos"  style=" float: right;">
              <div class="datos_usuario_titulo">Cambiar imagen</div> 
              <form method="POST" action="guardarImagenEst" id="enviar_imagen"  enctype="multipart/form-data">
                <hr>
                <div>
                  <input type="hidden" name="id_evaluador" i id="imagen_usuario" value="{{$eva->urlImagen}}">
                  <?php if($eva->urlImagen == null){ 
                          $eva->urlImagen="../imagenes/usuario.jpeg"; 
                        }
                        else{
                          $eva->urlImagen = "imagenUsuario/" . $eva->urlImagen;
                        }  ?>
                  <input style="height: 300px; width: 70%; cursor: default;" type="image" name="valor" src="{{$eva->urlImagen}}" />
                </div>
                <br>
                <div class="form-group col-xs-12"  >
                  <label>Agregar Imagen </label>
                  <input name="archivo_imagen" id="archivo_imagen" type="file"  class="" accept="image/*" required/><br /><br />
                </div>
               
                <div class="box-footer">
                  <input type="hidden" name="id_estudiante" id="id_estudiante6">
                  <button id="btn_actualizar" type="submit" class="btn btn-primary" onclick="guardar_imagen(this)">Actualizar imagen</button>
                </div>
              </form>
            </div>

            <div class="section_datos"  style="clear: both;">
              <div class="datos_usuario_titulo">Cambiar clave</div> 
              <hr>
              <form method="POST" action="guardarClaveEst" id="enviar_clave">
                <div style="text-align: left;">
                  <div class="datos_usuario_titulo">Contraseña actual</div>
                  <input type="password" class="form-control" id="password_usuario" name="password_usuario" placeholder="Contraseña actual" required>
                </div>

                <div  style="text-align: left;">
                  <div class="datos_usuario_titulo">Contraseña nueva</div>
                  <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Contraseña nueva" required>
                </div>

                <div  style="text-align: left;">
                  <div class="datos_usuario_titulo">Repita contraseña nueva</div>
                  <input type="password" class="form-control" id="repeat_new_password" name="repeat_new_password" placeholder="Repita contraseña nueva" required>
                </div>
                <br>
                <div class="box-footer">
                  <input type="hidden" name="id_estudiante" id="id_estudiante4">
                  <button id="btn_actualizar" type="submit" class="btn btn-primary" onclick="guardar_password(this)">Cambiar contraseña</button>
                </div>
              </form>
            </div>

      @endforeach   
    <?php 
    } 
    else{echo "pailas";}
    ?>


  <script type="text/javascript">
    window.onload = function() {
      if (sessionStorage.getItem('id_rol') != 3) {
        alert("No ha iniciado sesion");
        window.open('/calidad/public/','_self');
      }
      sessionStorage['urlImagen']= document.getElementById("imagen_usuario").value;

      $("#enviar_clave").submit(function(event)
                      {
                        
        var enviaForm = true;
        var campos = ["new_password", "repeat_new_password"];
        for(var i = 0; i < campos.length; i++)
        {
            if($("#" + campos[i]).val().length === 0)
            {
                alert("Contraseña no valida");
                enviaForm = false;
                break;
            }
            if($("#" + campos[i]).val().length >= 50)
            {
                alert("Contraseña no valida");
                enviaForm = false;
                break;
            }
        }
        if(enviaForm)
        {
            if(!($("#" + campos[0]).val() === $("#" + campos[1]).val()))
            {
                alert("Contraseña nueva no coincide");
                enviaForm = false;
            }
            if(($("#password_usuario").val()  != $("#contrasena_user").val()))
            {
                alert("Contraseña actual no valida");
                enviaForm = false;
            }
            if(!validaPassword($("#new_password").val()))
            {
                alert("Contraseña nueva no valida, La contraseña debe tener minimo 6 caracteres y al menos un numero y una letra");
                enviaForm = false;
            }
            if(enviaForm)
            {
                if(!confirm("esta seguro de cambiar su clave")){
                  enviaForm = false;
                }
            }
        }

                        return enviaForm;

      });
      $("#actualizar_datos").submit(function(event)
                      {
                        
        var enviaForm = true;
        var campos = ["edit_nombre", "edit_apellido"];
        for(var i = 0; i < campos.length; i++)
        {
            if($("#" + campos[i]).val().length === 0)
            {
                alert("Contraseña no valida");
                enviaForm = false;
                break;
            }
            if($("#" + campos[i]).val().length >= 50)
            {
                alert("Contraseña no valida");
                enviaForm = false;
                break;
            }
        }
        if(enviaForm)
        {
            if(enviaForm)
            {
                if(!confirm("esta seguro de cactualizar sus datos")){
                  enviaForm = false;
                }
            }
        }

        return enviaForm;

      });
      validaPassword = function(password){
          var passwordReg = /(?=^.{6,}$)((?=.*\d))(?=.*[A-Za-z]).*/;
          return passwordReg.test(password);
      }
    };
    function guardar(element){
      if (sessionStorage.getItem('id_usuario') != null) {
        document.getElementById("id_usuario").value = parseInt(sessionStorage['id_usuario']);
      }
      else{
        alert("Error, repita el proceso");
        window.open('/calidad/public/','_self');
      }
    }
    function guardar2(element){
      if (sessionStorage.getItem('id_usuario') != null) {
        document.getElementById("id_estudiante").value = sessionStorage['id_usuario'];
      }
      else{
        alert("Error, repita el proceso");
        window.open('estudiante','_self');
      }
    }
    function guardar3(element){
      if (sessionStorage.getItem('id_usuario') != null) {
        document.getElementById("id_estudiante2").value = sessionStorage['id_usuario'];
      }
      else{
        alert("Error, repita el proceso");
        window.open('estudiante','_self');
      }
    }
    function guardar4(element){
      if (sessionStorage.getItem('id_usuario') != null) {
        document.getElementById("id_estudiante3").value = sessionStorage['id_usuario'];
      }
      else{
        alert("Error, repita el proceso");
        window.open('estudiante','_self');
      }
    }
    function guardar_password(element){
      if (sessionStorage.getItem('id_usuario') != null) {
        document.getElementById("id_estudiante4").value = sessionStorage['id_usuario'];
      }
      else{
        alert("Error, repita el proceso");
        window.open('estudiante','_self');
      }
    }
    function actualizar_datos(element){
      if (sessionStorage.getItem('id_usuario') != null) {
        document.getElementById("id_estudiante5").value = sessionStorage['id_usuario'];
      }
      else{
        alert("Error, repita el proceso");
        window.open('estudiante','_self');
      }

    }
    function guardar_imagen(element){
      if (sessionStorage.getItem('id_usuario') != null) {
        document.getElementById("id_estudiante6").value = sessionStorage['id_usuario'];
      }
      else{
        alert("Error, repita el proceso");
        window.open('estudiante','_self');
      }

    }
    function guardar_id_usuario(element){
        document.getElementById("h_id_usuario").value = sessionStorage['id_usuario'];
    }
  </script>
@stop