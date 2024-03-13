<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
                {{-- form input data --}}
                <form action="{{ url('/edit', $materialData->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Past Number</label>
                        <input type="text" id="partnum" name="partnum" class="form-control"
                            value="{{ old('partnum', $materialData->partnum) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ old('partnum', $materialData->name) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">UM</label>
                        <input type="text" id="um" name="um" class="form-control"
                            value="{{ old('partnum', $materialData->um) }}">
                    </div>
                    <button type="submit" class="btn btn-primary" name="btn">Update</button>
                    <a href="{{ url('/crud') }}">
                        <button type= "button" class="btn btn-warning">Cancel</button>
                    </a>

                </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
