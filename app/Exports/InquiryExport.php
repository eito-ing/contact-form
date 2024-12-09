<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;

class InquiryExport implements FromCollection
{
    public function collection()
    {
        // 全ての問い合わせ内容を取得
        return Contact::all();
    }
}
