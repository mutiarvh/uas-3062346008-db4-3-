<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

/** @var \Illuminate\Contracts\Console\Kernel $kernel */
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;

$t = time();
$email = "test{$t}@example.test";

$rec = Pendaftaran::create([
    'nama_lengkap' => 'Test ' . $t,
    'nama_panggilan' => 'T' . $t,
    'email' => $email,
    'no_telepon' => '081' . substr($t, -6),
    'jalur_masuk' => 'reg',
    'program_studi1' => 'A',
    'program_studi2' => 'B',
    'divisi_yang_diinginkan' => [['divisi_1' => 'D1', 'divisi_2' => 'D2']],
    'alamat_asal' => 'Jl. Contoh No.1',
    'alamat_asal_phone' => '081234567890',
    'alamat_di_malang' => 'Jl. Malang No.1',
    'alamat_di_malang_phone' => '081987654321',
]);

echo "Created ID: {$rec->id}\n";
echo "Model accessor returns:\n";
print_r($rec->divisi_yang_diinginkan);

echo "Raw DB row:\n";
$row = DB::table('pendaftarans')->where('id', $rec->id)->first();
print_r($row);

echo "Done.\n";
