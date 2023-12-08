
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BuilDoc</title>
    <link rel="shortcut icon" href="{{ asset('imagenes\iconlogo.png') }}" >
    <link rel="stylesheet" href="{{ asset('css\header.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
</head>

<body class="container-fluid">

    <header class="Header p-3">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="{{ asset('imagenes\logoblancobuildoc.png') }}" alt="Logo" width="100" height="32">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="#DescripcionId" class="nav-link px-2 text-white">Descripcion General</a></li>
                    <li><a href="#FuncionesId" class="nav-link px-2 text-white">Funciones</a></li>
                    <li><a href="#PreciosId" class="nav-link px-2 text-white">Precios</a></li>
                    <li><a href="#ClientesId" class="nav-link px-2 text-white">Clientes</a></li>
                </ul>

                <div class="text-end">
                    <a href="{{ url('login') }}">
                        <button type="button" class="btn btn-outline-light me-2">Iniciar sesión</button>
                    </a>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
    </header>

  
</body>

