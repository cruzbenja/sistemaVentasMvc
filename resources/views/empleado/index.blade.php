<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Empleados</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.1/css/all.min.css" integrity="sha512-ioRJH7yXnyX+7fXTQEKPULWkMn3CqMcapK0NNtCN8q//sW7ZeVFcbMJ9RvX99TwDg6P8rAH2IqUSt2TLab4Xmw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
   <body>
<br>
<br>
 
<section class="col-lg-12 col-md-12">  
  <div class="card">
              <div class="card-header">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-RegistrarEmpleado"><i class="fas fa-plus-circle"></i> Registrar Empleado</button>
               
                </div>
              </div>

    
              <!-- /.card-header -->
              <div class="card-body">
                <table  class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido P.</th>
                    <th>Apellido M.</th>
                    <th>Telefono</th>
                 
                  
                    <th  WIDTH="20%">Accion</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php $count=0; ?>
                @foreach ($empleados as $empleado)

                    <tr>
                   
                       <td><?php $count++; echo $count;?></td>
                          <td>{{$empleado->nombre}}</td>
                          <td> {{$empleado->apellidoP}}</td>
                          <td> {{$empleado->apellidoM}}</td>
                          <td> {{$empleado->telefono}}</td>
                        
                    
                         
                           
                                        
                            <td> 
                                <button type="button" class="btn btn-success" onclick="Editar('{{$empleado->nombre}}','{{$empleado->apellidoP}}','{{$empleado->apellidoM}}','{{$empleado->telefono}}')">Editar</button>
                                <form method="POST" action="/empleado/{{$empleado->id}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                 </form>
                            </td>
                        </tr>

                    @endforeach
                       
                       
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
    </section>


    <!-- modal registrar empleado -->

    <div class="modal fade" id="modal-RegistrarEmpleado">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><i class="nav-icon fas fa-pills"></i>  Registrar Nuevo Empleado</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/empleado" class="row g-3" id="formEmpleado">
                   @csrf
                  <div class="col-md-12">
                    <label for="inputName" class="form-label"><b>Nombre</b></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-file"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                    </div>                 
                  </div>             
                  <div class="col-md-12">
                    <label for="inputName" class="form-label"><b>Apellido Paterno</b></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-file"></i></span>
                        </div>
                        <input type="text" class="form-control" id="apellidoP" name="apellidoP" placeholder="Apellido Paterno">
                    </div>                 
                  </div>  
                  <div class="col-md-12">
                    <label for="inputName" class="form-label"><b>Apellido Materno</b></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-file-medical-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" id="apellidoM" name="apellidoM"  placeholder="Apellido Materno">
                    </div>                 
                  </div>   
                  <div class="col-md-12">
                    <label for="inputName" class="form-label"><b>Telefono</b></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
                        </div>
                        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono">
                    </div>                 
                  </div> 
                  <div class="col-md-12" id="alerta"></div>
                  
                  
                </form>
                <div class="modal-footer col-md-12">
              <button type="button" class="btn btn-primary" onclick="guardar()" >Registrar Empleado</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>            
            </div>
              </div>
           
          </div>
         
        </div>
        <!-- /.modal-dialog -->
    </div>
      <!-- /.modal -->




          <!-- modal Editar empleado -->

    <div class="modal fade" id="modal-EditarEmpleado">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><i class="nav-icon fas fa-pills"></i>  Editar Empleado</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/empleado" class="row g-3">
                   <!-- @csrf -->
                  <div class="col-md-12">
                    <label for="inputName" class="form-label"><b>Nombre</b></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-file"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nombreEd" name="nombreEd" placeholder="Nombre">
                    </div>                 
                  </div>             
                  <div class="col-md-12">
                    <label for="inputName" class="form-label"><b>Apellido Paterno</b></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-file"></i></span>
                        </div>
                        <input type="text" class="form-control" id="apellidoPEd" name="apellidoPEd" placeholder="Apellido Paterno">
                    </div>                 
                  </div>  
                  <div class="col-md-12">
                    <label for="inputName" class="form-label"><b>Apellido Materno</b></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-file-medical-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" id="apellidoMEd" name="apellidoMEd"  placeholder="Apellido Materno">
                    </div>                 
                  </div>   
                  <div class="col-md-12">
                    <label for="inputName" class="form-label"><b>Telefono</b></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
                        </div>
                        <input type="text" class="form-control" id="telefonoEd" name="telefonoEd" placeholder="Telefono">
                    </div>                 
                  </div>  
                  <div class="modal-footer col-md-12">
              <button type="submit" class="btn btn-primary" >Editar Empleado</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>            
            </div>
                         
                </form>
               
              </div>
           
          </div>
         
        </div>
        <!-- /.modal-dialog -->
    </div>
      <!-- /.modal -->

      <script type="text/javascript">

        function guardar(){


          var nombre=$('#nombre').val();
          var apellidoP=$('#apellidoP').val();
          var apellidoM=$('#apellidoM').val();
          var telefono=$('#telefono').val();
     

          if(nombre == null || nombre == ""){
          $('#alerta').html("'<div class='alert alert-danger' role='alert'>Debe introducir nombre!</div>'");

       
          setTimeout(function() {
              $("#alerta").fadeOut();           
          },2000);
            return false;
          }

          if(apellidoP == null || apellidoP == ""){
          $('#alerta').html("'<div class='alert alert-danger' role='alert'>Debe introducir Apellido Paterno!</div>'");

          
          setTimeout(function() {
              $("#alerta").fadeOut();           
          },2000);
            return false;
          }
          if(apellidoM == null || apellidoM == ""){
          $('#alerta').html("'<div class='alert alert-danger' role='alert'>Debe introducir Apellido Materno!</div>'");

        
          setTimeout(function() {
              $("#alerta").fadeOut();           
          },2000);
            return false;
          }

          if(telefono == null || telefono == ""){
          $('#alerta').html("'<div class='alert alert-danger' role='alert'>Debe introducir Nro  de Telefono!</div>'");

              
          setTimeout(function() {
              $("#alerta").fadeOut();           
          },2000);
            return false;
          }
        
        
        $("#formEmpleado").submit();

 
      
        }

        function Editar(nombre,apellidoP,apellidoM,telefono){
     

         $("#nombreEd").val(nombre);
         $("#apellidoPEd").val(apellidoP);
         $("#apellidoMEd").val(apellidoM);
         $("#telefonoEd").val(telefono);
     
         $('#modal-EditarEmpleado').modal();
     
        }
      </script>
     
 

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>