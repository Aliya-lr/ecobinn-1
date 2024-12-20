<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Все статьи</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Подключение Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Главная</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @if (auth()->check())
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="nav-form">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Выйти</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Вход</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="container mt-5">
<h2 class="section-title">Все статьи</h2>

    <!-- Форма поиска -->
    <form method="GET" action="{{ route('search') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Поиск по названию" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="buttonn" type="submit">Поиск</button>
            </div>
        </div>
    </form>

    <div class="row">
@foreach($articles as $article)
    <div class="col-md-4 mb-4">
        <div class="article-card">
            <!-- Проверка на наличие медиафайла в коллекции 'images' -->
            @if($article->hasMedia('images'))
                <img src="{{ $article->getFirstMediaUrl('images') }}" class="card-img-top" alt="{{ $article->title }}">
            @else
                <!-- Если изображения нет, показываем изображение по умолчанию -->
                <img src="{{ asset('images/default_image.jpg') }}" class="card-img-top" alt="Изображение по умолчанию">
            @endif

                    
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($article->content, 150) }}</p>
                        <a href="{{ route('articles.show', $article->id) }}" class="button">Читать статью</a>
                    </div>
            </div>
        @endforeach
    </div>

  
</div>
<footer>
        <div class="footer-logo">EcoBin</div>
    </footer>

<!-- Подключение Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>
