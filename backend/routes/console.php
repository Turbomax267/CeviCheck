<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('health:check', function () {
    $this->comment('CeviCheck backend is ready.');
});

