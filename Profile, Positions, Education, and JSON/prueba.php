



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nuevo Mensaje</title>
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/addm.css" rel="stylesheet">

</head>

<body>


    <nav class="navbar navbar-expand-md navbar-dark fixed-top " style="background-color: #de0f2b;">
        <a class="navbar-brand" href="#">Mensaje</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item"> <a class="nav-link " href="index.php">Home</a></li>

                <li class="nav-item"> <a class="nav-link active" href="addMensaje.php">Nuevo Mensaje</a></li>

                <li class="nav-item"> <a class="nav-link" href="editarmensaje.php">Editar Mensaje</a></li>

                <li class="nav-item"> <a class="nav-link" href="eliminarmensaje.php">Eliminar Mensaje</a></li>

                <li class="nav-item"> <a class="nav-link" href="mensajes.php">Mensajes</a></li>


            </ul>
        </div>
    </nav>


    <div class="container">
        <div class="jumbotron" style="margin-top: 100px;">
            <h1>Mensaje</h1>
        </div>
        <form action="prueba.php" method="POST" class="was-validated" enctype="multipart/form-data">
           
            <div class="mb-3">
            <label class="form-check-label" for="archivo">Imagen</label>
                <input type="file" name="archivo" id="archivo" class="form-control" aria-label="file example" n>
                
            </div>

            <div class="mb-3">
                <button class="btn btn-primary" type="submit" name="enviar" >Enviar</button>
            </div>

        </form>

    </div>

    <?php 
    print_r($_REQUEST);
    
    
    //Si se quiere subir una imagen
if (isset($_FILES['archivo'])) {
    $file=$_FILES['archivo'];
    $filename=$file['name'];
    $mimetype=$file['type'];

    
    $allowed_types = array("image/jpg","image/jpeg","image/png");

    if(!in_array($mimetype,$allowed_types)){
    header("Location:prueba.php");   
    }

    if(!is_dir("imagenes")){
        mkdir("imagenes",0777);
    }
    move_uploaded_file($file['tmp_name'],'imagenes/'.$filename);
}else {
    //header("Location:addMensaje.php");   
 }
    ?>
    <script>
        var fileInput = document.getElementById("enviar");
        var filestatus = document.querySelector(".file-status");

        fileInput.addEventListener('change',function(){
            filestatus.textContent = this.files[0].name;
        });

    </script>

    <script>
        // Ejemplo de JavaScript inicial para deshabilitar el envío de formularios si hay campos no válidos
(function () {
  'use strict'

  // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
  var forms = document.querySelectorAll('.needs-validation')

  // Bucle sobre ellos y evitar el envío
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
    </script>

</body>

</html>