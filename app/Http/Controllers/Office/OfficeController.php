<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Services\Office\OfficeService;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    protected $officeService;

    public function __construct(OfficeService $_menuService)
    {
        $this->officeService = $_menuService;
    }

    public function store(Request $request)
    {
        dd("test");
    }
}
