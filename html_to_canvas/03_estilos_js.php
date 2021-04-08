<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML a Canvas</title>
    <?php include('../components/links_bootstrap.php')?>
</head>
<body>
    
    <?php include('../components/navbar.php')?>

    <style>
        .centrado{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-weight: bold;
            font-size:30px
        }
    </style>
    <div class="container-fluid mt-3">
        <div class="row my-3">
            <div class="col-6">
                <label for="upload" class="btn btn-primary btn-block">Nueva Imagen</label>
            </div>
            <div class="col-6">
                <button id="btn-crear" class="btn btn-success btn-block">Crear plantilla</button>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Origen (Imagen precargada)
                    </div>
                    <div class="card-body text-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div id="capture">
                                        <img 
                                            src="../libs/img/no-preview.png"
                                            id="custom_image"
                                            class="img-fluid"
                                        >
                                        <div class="centrado">Centrado</div>
                                    </div>
                                    <input type="file" id="upload" class="d-none">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Destino (el script se ejecuta al instante y genera la imagen)
                    </div>
                    <div class="card-body text-center">
                        <div class="container">
                            <div class="col-12" id="canvas_destino"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('../components/scripts_bootstrap.php')?>
    <script src="../libs/js/html2canvas.min.js"></script>
    <script>
        function crearCaptura(){
            html2canvas(document.querySelector("#capture"),{useCORS: true,}).then(canvas => {
                // document.body.appendChild(canvas)
                // canvas.addClass('img-fluid');
                $("#canvas_destino").html(canvas);
                console.log(canvas.classList.add("newClass"))
            });
        }
        //5570587171

        $('#upload').change(function(){
            var input = this;
            var url = $(this).val();
            
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            // console.log(ext)
            if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
            {
                var reader = new FileReader();

                reader.onload = function (e) {
                $('#custom_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
            else
            {
                $('#custom_image').attr('src', '../libs/img/no_preview.png');
            }
        });

        $('#btn-crear').click(function(){
            crearCaptura()
        })
    </script>
</body>
</html>