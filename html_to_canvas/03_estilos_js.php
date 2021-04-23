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
        #capture{
            width:100%;
            height:800px;
            position:relative;
            background-repeat: no-repeat;
            background-size: 100%;
            background-position: center center;
            cursor:pointer;
        }
    </style>
    <div class="container-fluid mt-3">
        <div class="row my-3">
            <div class="col-6">
                <label for="upload" class="btn btn-primary btn-block">Nueva Imagen</label>
                <input type="file" id="upload" class="d-none">
            </div>
            <div class="col-6">
                <button id="btn-crear" class="btn btn-success btn-block">Crear plantilla</button>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <h5 class="card-header">
                        Editor de imagenes
                    </h5>
                    <div class="card-body">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Config. de proyecto
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <!-- Nombre de proyecto -->
                                        <label for="nombre-publicidad">Nombre de publicidad</label>
                                        <input type="text" class="form-control mb-4" id='nombre-publicidad' placeholder='Ingresa el nombre de tu publicidad'>
                                        <!-- Orientacion -->
                                        <div class="text-center">
                                            <h5>Orientacion</h5>
                                            <button id='orientacion-h' class="mx-4 btn btn-lg btn-default">
                                                <i class="fas fa-arrows-alt-h"></i>
                                            </button>
                                            <button id='orientacion-v' class="mx-4 btn btn-lg btn-default">
                                                <i class="fas fa-arrows-alt-v"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Gestión de texto de la imagen
                                    </button>
                                </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body d-flex justify-content-center flex-column">
                                        <label for="texto_imagen">Texto a ingresar</label>
                                        <input type="text" id='texto_imagen' class="form-control" placeholder='Este texto se visualizara en la imagen'>

                                        <label for="color_texto">Color del texto</label>
                                        <input type="color" id='color_texto' class="form-control">

                                        <button class="btn btn-info my-4" id='btn_texto'>Agregar a la imagen</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Collapsible Group Item #3
                                    </button>
                                </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        Origen (Imagen precargada)
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div id="capture" class="container" style="background-image:url('../libs/img/no-preview.png');">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
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

    <script src="https://kit.fontawesome.com/1a78bd2af6.js" crossorigin="anonymous"></script>
    <script src="../libs/js/html2canvas.min.js"></script>
    <script>

        let orientacion = 'horizontal'
        let textos_de_imagen = []

        let config = {
            orientacion
        }

        function formatearDocumento(config){
            let {orientacion} = config
            cambiarOrientacion(orientacion)
        }

        function cambiarOrientacion(orientacion){
            
            if (orientacion === 'horizontal') {
                $('#orientacion-h').removeClass('btn-default')
                $('#orientacion-h').addClass('btn-info')

                $('#orientacion-v').removeClass('btn-info')
                $('#orientacion-v').addClass('btn-default')
                $('#capture').css('height','800px')
                $('#capture').removeClass('col-5')
            }else{
                $('#orientacion-h').removeClass('btn-info')
                $('#orientacion-h').addClass('btn-default')

                $('#orientacion-v').removeClass('btn-default')
                $('#orientacion-v').addClass('btn-info')
                $('#capture').css('height','1000px')
                $('#capture').addClass('col-5')
            }

        }

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
                $('#capture').css('background-image', `url('${e.target.result}')`);
                }
                reader.readAsDataURL(input.files[0]);
            }
            else
            {
                $('#capture').css('background-image', `url('${'../libs/img/no-preview.png'}')`);
            }
        });

        $('#capture').click(function(){
            $('#upload').trigger('click')
        })

        $('#btn-crear').click(function(){
            crearCaptura()
        })

        $('#orientacion-h').click(function(){
            config.orientacion = 'horizontal'
            formatearDocumento(config)
            console.log(config);
        })
        $('#orientacion-v').click(function(){
            config.orientacion = 'vertical'
            formatearDocumento(config)
            console.log(config);
        })

        $('#btn_texto').click(function(){
            let html = ''
            let texto = $('#texto_imagen').val()
            let color = $('#color_texto').val()
            let fontSize = '20px'
            let top = 0
            let left = 0

            let styles = `
                display: inline-block;
                position: absolute;
                top:${top};
                left:${left};
                font-size:${fontSize};
                color:${color};
            `

            let nuevo_texto = {texto,color,fontSize,top,left}

            html = `
            <p id='texto_${Date.now()}' style='${styles}'>
                ${texto}
            </p>
            `

            $('#capture').append(html)
            textos_de_imagen.push(nuevo_texto)

        })

        formatearDocumento(config)
    </script>
</body>
</html>