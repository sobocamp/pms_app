<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Kompleksitas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container px-3 py-3">
        <h3>Test Kompleksitas</h3>
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('tes-kompleksitas') }}" method="GET">
                    <div class="row mb-2">
                        <label for="n" class="col-md-3">Ukuran Input (n): </label>
                        <div class="col-md-9">
                            <input type="number" name="n" id="n" value="{{ old('n', request('n')) ?? 10000 }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary">Mulai Analisis</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <h4>Hasil Analisis</h4>
        <div class="card">
            <div class="card-body">
                <p>Ukuran Input (n): <b>{{ $input_n }}</b></p>
                <p>Hasil: <b>{{ $result }}</b></p>
                <p>Waktu (ms): <b>{{ $time_ms }}</b></p>
                <p>Memori (KB): <b>{{ $memory_kb }}</b></p>
                <p>Kompleksitas Waktu: <b>{{ $estimated_complexity }}</b></p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('tes-kompleksitas.multiple') }}" class="btn btn-primary">Tes Kompleksitas (Multiple)</a>
        </div>
    </div>
</body>

</html>
