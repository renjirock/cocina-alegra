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
                        <li class="nav-item"><a class="nav-link" href="{{ route('orders') }}">Pedidos</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('ingredients') }}">Ingredientes</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Orders section-->
        @if (session('success'))
            <div class="container mt-3">
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <section id="about">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-12">
                        <div class="row row-cols-1 row-cols-md-3">
                            @foreach ($orders as $order)
                                <div class="col mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title">Peido #{{ $order['id'] }}</h5>
                                            <p class="card-text">Nombre del platillo: {{$order['name']}}</p>
                                            <p class="card-text"><strong>{{$order['is_available'] }}</strong></p>
                                            <p class="card-text"><small class="text-muted">Creado el {{$order['created_at'] }}</small></p>
                                        </div>
                                    </div>
                              </div>
                            @endforeach
                        </div>
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
