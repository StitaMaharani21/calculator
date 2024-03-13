<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="card">
        <div class="card-header">
            Create Data
        </div>
        <div class="card-body">
            {{-- alert error --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- form input data --}}
            <form action="{{ url('/create') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Part Number</label>
                    <input type="text" id="partnum" name="partnum" class="form-control" placeholder="Input your past number data" value="{{ old('partnum') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Input your name" value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">UM</label>
                    <input type="text" id="um" name="um" class="form-control" placeholder="Input your UM" value="{{ old('um') }}">
                </div>
                <button type="submit" class="btn btn-primary" name="btn">Submit</button>
                <button type="reset" class="btn btn-warning" name="btn">Reset</button>
            </form>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>