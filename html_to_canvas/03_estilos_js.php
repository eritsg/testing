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
            </div>
            <div class="col-6">
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
                                        <div class="text-center my-4">
                                            <h5>Orientacion</h5>
                                            <button id='orientacion-h' class="mx-4 btn btn-lg btn-default">
                                                <i class="fas fa-arrows-alt-h"></i>
                                            </button>
                                            <button id='orientacion-v' class="mx-4 btn btn-lg btn-default">
                                                <i class="fas fa-arrows-alt-v"></i>
                                            </button>
                                        </div>

                                        <label for="upload" class="btn btn-primary btn-block">Nueva Imagen</label>
                                        <input type="file" id="upload" class="d-none">

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

                                        <div id="controles_para_editar" class="my-3 text-center d-none">


                                            <h5 class='mt-4'>Tamaño de letra</h5>
                                            <button id='sizeDown' class="mx-4 btn btn-lg btn-default">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button id='sizeUp' class="mx-4 btn btn-lg btn-default">
                                                <i class="fas fa-plus"></i>
                                            </button>


                                            <h5 class='mt-4'>Orientación (Izquierda a derecha)</h5>
                                            <button id='moveLeft' class="mx-4 btn btn-lg btn-default">
                                                <i class="fas fa-arrow-alt-circle-left"></i>
                                            </button>
                                            <button id='moveRight' class="mx-4 btn btn-lg btn-default">
                                                <i class="fas fa-arrow-alt-circle-right"></i>
                                            </button>


                                            <h5 class='mt-4'>Orientación (Arriba a Abajo)</h5>
                                            <button id='moveUp' class="mx-4 btn btn-lg btn-default">
                                                <i class="fas fa-arrow-alt-circle-up"></i>
                                            </button>
                                            <button id='moveDown' class="mx-4 btn btn-lg btn-default">
                                                <i class="fas fa-arrow-alt-circle-down"></i>
                                            </button>


                                        </div>

                                        <button class="btn btn-info my-4" id='btn_texto'>Agregar a la imagen</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Gestion de texto de imagen
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Texto ingresado</th>
                                                    <th scope="col">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody id='tabla_textos'>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <button id="btn-crear" class="btn btn-success btn-block my-4">Crear plantilla</button>

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

        let editando = false
        let tsid_editando =  undefined
        let orientacion = 'horizontal'
        let textos_de_imagen = []
        
        var interval_;


        

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
        
        function modificarTabla(){
            let html = ''
            textos_de_imagen.forEach(registro => {
                html += `
                <tr>
                    <td>
                        ${registro.texto}
                    </td>
                    <td>
                        <button class='btn btn-success btn_mod' data-id='${registro.tsid}'>
                            <i class="fas fa-edit" aria-hidden="true"></i>
                        </button>
                        <button class='btn btn-danger btn_del' data-id='${registro.tsid}'>
                            <i class="fas fa-trash" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
                `
            });

            $('#tabla_textos').html(html)
        }

        function buscarRegistro(id){
            for (let index = 0; index < textos_de_imagen.length; index++) {
                
                if (textos_de_imagen[index].tsid === id) {
                    return textos_de_imagen[index]
                }
                
            }
        }

        function cambiarFormulario(editando){
            /* 
                1.- cambia el color y texto del boton de acción
                2.- cambia el valor de la caja de texto y caja de color
                3.- muestra/oculta el panel de edición
            */
            if (editando) {
                $('#btn_texto').text('Terminar edición')
                $('#btn_texto').removeClass('btn-info')
                $('#btn_texto').addClass('btn-success')

                $('#texto_imagen').val(tsid_editando.texto)
                $('#color_texto').val(tsid_editando.color)

                $('#controles_para_editar').removeClass('d-none')

                $('#collapseTwo').collapse('show')
            }else{
                $('#btn_texto').text('Agregar a la imagen')
                $('#btn_texto').removeClass('btn-success')
                $('#btn_texto').addClass('btn-info')

                $('#texto_imagen').val('')
                $('#color_texto').val('')

                $('#controles_para_editar').addClass('d-none')

                $('#collapseThree').collapse('show')
            }
        }

        function fontResize(){
            $(`#texto_${tsid_editando.tsid}`).css('font-size', `${tsid_editando.fontSize}px`)
        }

        function move(coordenada, signo){

            // console.log(coordenada, signo)
            if (coordenada === 'left') {
                if (signo === '-') {
                    tsid_editando.left = tsid_editando.left - 5
                }else{
                    tsid_editando.left = tsid_editando.left + 5
                }
                $(`#texto_${tsid_editando.tsid}`).css('left', `${tsid_editando.left}px`)
            }else{
                if (signo === '-') {
                    tsid_editando.top = tsid_editando.top - 5
                }else{
                    tsid_editando.top = tsid_editando.top + 5
                }
                $(`#texto_${tsid_editando.tsid}`).css('top', `${tsid_editando.top}px`)
            }
        }


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

        // orientacion de la mesa de trabajo
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

        // Agregar nuevo texto
        $('#btn_texto').click(function(){
            if (!editando) {
                
                let html = ''
                let tsid = Date.now()
                let texto = $('#texto_imagen').val()
                let color = $('#color_texto').val()
                let fontSize = 20
                let top = 0
                let left = 0

                let styles = `
                    display: inline-block;
                    position: absolute;
                    top:${top};
                    left:${left};
                    font-size:${fontSize}px;
                    color:${color};
                `

                let nuevo_texto = {tsid,texto,color,fontSize,top,left}

                html = `
                <p id='texto_${Date.now()}' style='${styles}'>
                    ${texto}
                </p>
                `

                $('#capture').append(html)
                textos_de_imagen.push(nuevo_texto)
                modificarTabla()

                tsid_editando = nuevo_texto
                editando = true
                cambiarFormulario(editando)

            }else{
                editando = false
                cambiarFormulario(editando)
            }
        })

        // Cambiar de tamaño de letra
            $('#sizeDown').click(function(){
                tsid_editando.fontSize = tsid_editando.fontSize - 5
                fontResize()
            })
            $('#sizeUp').click(function(){
                tsid_editando.fontSize = tsid_editando.fontSize + 5
                fontResize()
            })
        // Cambiar de tamaño de letra

        // Mover de izquierda a derecha
            $('#moveLeft').mousedown(function(){
                interval_ = setInterval(function(){ 
                    move('left', '-')
                }, 50);
            })
            $('#moveLeft').mouseup(function(){
                clearInterval(interval_);
            });
            $('#moveLeft').click(function(){
                move('left', '-')
            })

            $('#moveRight').mousedown(function(){
                interval_ = setInterval(function(){ 
                    move('left', '+')
                }, 50);
            })
            $('#moveRight').mouseup(function(){
                clearInterval(interval_);
            });
            $('#moveRight').click(function(){
                move('left', '+')
            })
        // Mover de izquierda a derecha

        // Mover de arriba a abajo
            $('#moveDown').mousedown(function(){
                interval_ = setInterval(function(){ 
                    move('top', '+')
                }, 50);
            })
            $('#moveDown').mouseup(function(){
                clearInterval(interval_);
            });
            $('#moveDown').click(function(){
                move('top', '+')
            })
            $('#moveUp').mousedown(function(){
                interval_ = setInterval(function(){ 
                    move('top', '-')
                }, 50);
            })
            $('#moveUp').mouseup(function(){
                clearInterval(interval_);
            });
            $('#moveUp').click(function(){
                move('top', '-')
            })
        // Mover de arriba a abajo

        // Cuando cambie el texto
            $('#texto_imagen').on('propertychange input', function (e) {
                var valueChanged = false;

                if (e.type=='propertychange') {
                    valueChanged = e.originalEvent.propertyName=='value';
                } else {
                    valueChanged = true;
                }
                if (valueChanged) {
                    if (editando) {
                        $(`#texto_${tsid_editando.tsid}`).text(e.target.value)
                    }
                }
            });
        // Cuando cambie el texto

        // Cuando cambie el color
            $('#color_texto').change(function(e){
                if (editando) {
                    $(`#texto_${tsid_editando.tsid}`).text(e.target.value)
                }
            })
        // Cuando cambie el color

        formatearDocumento(config)
    </script>

    <script>

        // Funciona solamente con elementos dinamicos (que ya se crearon en el DOM)

        // Para modificar algun texto ya creado
        $(document.body).on('click', '.btn_mod' ,function(){

            tsid_editando = buscarRegistro( $(this).data('id') )
            editando = true
            cambiarFormulario(editando)

        })
    </script>
</body>
</html>