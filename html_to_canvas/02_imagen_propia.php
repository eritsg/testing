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
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Origen (Imagen precargada)
                    </div>
                    <div class="card-body text-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-4">
                                </div>
                                <div class="col-8">
                                    <div id="capture">
                                        <img 
                                            src="https://news.cgtn.com/news/77416a4e3145544d326b544d354d444d3355444f31457a6333566d54/img/37d598e5a04344da81c76621ba273915/37d598e5a04344da81c76621ba273915.jpg" 
                                            width="500"
                                            height="200"
                                            class="img-fluid"
                                        >
                                        <div class="centrado">Centrado</div>
                                    </div>
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
        html2canvas(document.querySelector("#capture"),{useCORS: true,}).then(canvas => {
            // document.body.appendChild(canvas)
            // canvas.addClass('img-fluid');
            $("#canvas_destino").html(canvas);
            console.log(canvas.classList.add("newClass"))
        });
        //5570587171
    </script>
</body>
</html>