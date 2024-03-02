<?php
// app/Http/Controllers/BarcodeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Milon\Barcode\DNS1D;

class BarcodeController extends Controller
{
    public function generateBarcode()
    {
        Error: Trying to access array offset on value of type int in /path/to/your/file.php on line XX

        $barcode = DNS1D::getBarcodeHTML(1, 'C128');
        $numbers = [42, 56, 78];
        var_dump($numbers);  // Check the content and type of $numbers
        $value = $numbers[0]; // This is correct, accessing the first element of the array
        
        // Continue with the rest of your code        
        
        // Return the barcode view or any response you need
        return view('barcode', compact('barcode'));
    }
}