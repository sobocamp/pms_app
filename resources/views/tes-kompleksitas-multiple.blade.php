<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Kompleksitas Multiple</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container px-3 py-3">
        <h3>Test Kompleksitas Multiple</h3>
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('tes-kompleksitas.multiple') }}" method="GET">
                    <div class="row mb-2">
                        <label for="n" class="col-md-3">Ukuran Input (n): </label>
                        <div class="col-md-9">
                            <input type="number" name="n" id="n" value="{{ old('n', request('n')) ?? 2000 }}"
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
        <p>Ukuran Input (n): <b>{{ $n }}</b></p>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kompleksitas</th>
                            <th>Waktu (ms)</th>
                            <th>Memori (KB)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>O(1)</td>
                            <td>{{ $O1['time_ms'] ?? '-' }}</td>
                            <td>{{ $O1['memory_kb'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>O(n)</td>
                            <td>{{ $On['time_ms'] ?? '-' }}</td>
                            <td>{{ $On['memory_kb'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>O(n2)</td>
                            <td>{{ $On2['time_ms'] ?? '-' }}</td>
                            <td>{{ $On2['memory_kb'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>O(log n)</td>
                            <td>{{ $Ologn['time_ms'] ?? '-' }}</td>
                            <td>{{ $Ologn['memory_kb'] ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('tes-kompleksitas') }}" class="btn btn-primary">Tes Kompleksitas (Single)</a>
        </div>
    </div>
</body>

</html>
