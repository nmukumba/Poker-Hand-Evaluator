<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poker Hand Evaluator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1>Poker Hand Evaluator</h1>
            <form class="row g-3" method="post" action="/" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="cards">Cards</label>
                    <input type="text"
                           class="form-control {{ $errors->has('cards') ? ' is-invalid' : '' }}"
                           name="cards"
                           id="cards"
                           value="{{ old('cards')}}"
                           placeholder="Enter cards in the format below">
                    <div class="form-text">
                        Enter your cards in the format <code>AS 10C 10H 3D 3S</code>
                    </div>
                    @if ($errors->has('cards'))
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('cards') }}</strong>
                </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>

            @if(isset($evaluation))
                <div class="jumbotron jumbotron-fluid text-center mt-2">
                    <div class="alert alert-success mt-2" role="alert">
                        <h1 class="display-4">{{ $evaluation }}</h1>
                    </div>
                </div>
            @endif

            @if(isset($error))
                <div class="alert alert-danger mt-2" role="alert">
                    {{$error}}
                </div>
            @endif
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>
</html>
