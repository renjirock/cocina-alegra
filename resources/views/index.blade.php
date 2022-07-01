<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Cocina comunitaria</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <div class="container px-4">
                <a class="navbar-brand" href={{ route('index') }}>Cocinas comunitarias</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href={{ route('orders') }}>Pedidos</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('ingredients') }}">Ingredientes</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-primary bg-gradient text-white">
            <div class="container px-4 text-center">
                <h1 class="fw-bolder">Bienvenido al comedor comunitario</h1>
                <p class="lead">Al precionar el boton, generaremos un nuevo pedido en nuestra cocina</p>
                <form action={{ route('kitchen.create_order') }} method="POST">
                    @csrf
                    <button type="submit" class="btn btn-lg btn-light">Generar pedido</button>
                </form>
            </div>
        </header>
        <!-- Orders section-->
        @if (session('warning'))
            <div class="container mt-3">
                <div class="alert alert-warning mt-3">
                    {{ session('warning') }}
                </div>
            </div>
        @endif
        <section id="about">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center text-center">
                    <div class="col-lg-8">
                        <h2>Platillos</h2>
                        <p class="lead">recuerda que los platillos generados son aleatorios :</p>
                        <ul>
                            <li>Pollo al limon</li>
                            <li>Carne asada</li>
                            <li>Ensalada</li>
                            <li>Papas fritas</li>
                            <li>Carne BBQ</li>
                            <li>Arroz con pollo</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services section-->
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container px-4"><p class="m-0 text-center text-white">Copyright &copy; Mauricio Ballesteros 2022</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>
