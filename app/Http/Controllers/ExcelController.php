<?php

namespace App\Http\Controllers;

use App\Imports\MedicamentImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function excel(Request $request): Void
    {
        ini_set('memory_limit', '-1');

        Excel::import(new MedicamentImport(), $request->file);
    }
}
