<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

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
                @foreach ($material as $index => $item)
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

                            <button class="btn btn-outline-danger" onclick="confirmDelete('{{ $item->id }}')">Delete</button>

                            <form id="delete-material-{{ $item->id }}" action="{{ url('/delete', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>