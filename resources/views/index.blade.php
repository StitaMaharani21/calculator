<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calculator</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

  <div class="card">
    <div class="card-header">
      Form Calculator
    </div>
    <div class="card-body">
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <form action="calculator" method="POST">
        @csrf
        <div class="mb-3">
          <label class="form-label">Bilangan Pertama</label>
          <input type="number" id="firstnumber" name="firstnumber" class="form-control" placeholder="Masukan Bilangan Pertama Anda" step=".01">
        </div>
        <div class="mb-3">
          <label class="form-label">Operator</label>
          <select class="form-select" id="operator" name="operator" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="/">/</option>
            <option value="*">*</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Bilangan Kedua</label>
          <input type="number" id="secondnumber" name="secondnumber" class="form-control" placeholder="Masukan Bilangan Kedua Anda" step=".01">
        </div>
        <button type="submit" class="btn btn-primary" name="btn">Submit</button>
        <button type="reset" class="btn btn-warning" name="btn">Reset</button>
      </form>
      <div class="mb-3 mt-3">
        <label class="form-label">Hasil</label>
        @if(session('info'))
        <div class="alert alert-light" role="alert">
          {{session('info')}}
        </div>
        @elseif(session('info') == '0')
        <div class="alert alert-warning" role="alert">
          0
        </div>
        @endif
      </div>
    </div>
  </div>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>