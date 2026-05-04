<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$results = DB::table('appointments')->limit(5)->get();
echo "\nAppointments Data:\n";
print_r($results->toArray());
