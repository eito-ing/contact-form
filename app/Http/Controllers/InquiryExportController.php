<?php
namespace App\Http\Controllers;

use App\Exports\InquiryExport;
use Maatwebsite\Excel\Facades\Excel;

class InquiryExportController extends Controller
{
    public function export()
    {
        return Excel::download(new InquiryExport, 'inquiries.xlsx'); // CSVの場合は 'inquiries.csv'
    }
}
