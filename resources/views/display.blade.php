<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Process CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    @include('layouts.header')


    @if (Session::has('alert-success'))
        <div class="alert alert-success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{-- <li>{{ $error }}</li> --}}
        @endforeach
    @endif

    <div class="card">
        <div class="card-header">
            <div class="d-grid gap-2 d-md-block">
                <a href="{{ url('/create') }}">
                    <button class="btn btn-outline-primary" type="button">ADD DATA</button>
                </a>
                <a href="{{ url('/exportexcel') }}">
                    <button class="btn btn-outline-success" type="button">EXPORT TO EXCEL</button>
                </a>
                <a href="{{ url('/exportpdf') }}">
                    <button class="btn btn-outline-danger" type="button">EXPORT TO PDF</button>
                </a>
                
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    IMPORT FROM EXCEL
                </button>

                {{-- form search --}}
                <form action="{{ url('/search') }}" method="GET">
                    <div class="row mt-3">
                        <div class="col">
                            <input type="search" name="search" class="form-control" placeholder="Search Part Number"
                                value="{{ request('search') }}">
                        </div>
                        <div class="col">
                            <button class="btn btn-outline-dark" type="submit">SEARCH</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Part Number</th>
                        <th scope="col">Name</th>
                        <th scope="col">UM</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($error))
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @else
                        @foreach ($materials as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->partnum }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->um }}</td>
                                <td>

                                    <div class="gap-2">
                                        <a href="{{ url('/edit', $item->id) }}">
                                            <button class="btn btn-outline-secondary" type="button">Edit</button>
                                        </a>

                                        <button class="btn btn-outline-danger"
                                            onclick="confirmDelete('{{ $item->id }}')">Delete</button>

                                        <form id="delete-material-{{ $item->id }}"
                                            action="{{ url('/delete', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Upload File Excel</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Input File Excel</label>
                            <input class="form-control" type="file" id="formFile" name="importFile">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        function confirmDelete(itemId) {
            var confirmation = confirm('Are you sure you want to delete this item?');

            if (confirmation) {
                document.getElementById('delete-material-' + itemId).submit();
            }
        }
    </script>
</body>

</html>
