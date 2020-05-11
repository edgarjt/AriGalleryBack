<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class PdfController extends Controller
{
    public function getIndex()
    {
        return view('pdf.index');
    }

}