<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TesKompleksitasController extends Controller
{
    public function analyze(Request $request): View
    {
        // Ambil input n (ukuran input untuk algoritma)
        $n = $request->input('n', 10000);

        // Mulai hitung waktu & memori awal
        $startTime = microtime(true);
        $startMemory = memory_get_usage(true);

        // ================================
        // Algoritma O(n)
        // ================================
        $sum = 0;
        for ($i = 0; $i < $n; $i++) {
            $sum += $i;
        }

        // Hitung setelah eksekusi
        $endTime = microtime(true);
        $endMemory = memory_get_usage(true);

        return view('tes-kompleksitas', [
            'input_n' => $n,
            'result' => $sum,
            'time_ms' => round(($endTime - $startTime) * 1000, 3),
            'memory_kb' => round(($endMemory - $startMemory) / 1024, 3),
            'estimated_complexity' => 'O(n)', // informasi statis untuk edukasi
        ]);
    }

    public function analyzeMultiple(Request $request): View
    {
        $n = $request->input('n', 2000);

        return view('tes-kompleksitas-multiple', [
            'n' => $n,
            'O1' => $this->measure(fn() => 1),
            'On' => $this->measure(fn() => $this->linear($n)),
            'On2' => $this->measure(fn() => $this->quadratic($n)),
            'Ologn' => $this->measure(fn() => $this->logarithmic($n)),
        ]);
    }

    private function measure(Closure $func)
    {
        $startTime = microtime(true);
        $startMemory = memory_get_usage(false);

        $func();

        return [
            'time_ms' => round((microtime(true) - $startTime) * 1000, 3),
            'memory_kb' => round((memory_get_usage(false) - $startMemory) / 1024, 3),
        ];
    }

    private function linear($n)
    {
        $x = 0;
        for ($i = 0; $i < $n; $i++) {
            $x += $i;
        }
    }

    private function quadratic($n)
    {
        $x = 0;
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $x += $i + $j;
            }
        }
    }

    private function logarithmic($n)
    {
        $i = 1;
        while ($i < $n) {
            $i *= 2;
        }
    }
}
