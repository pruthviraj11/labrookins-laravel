<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\OrderDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return OrderDetail::select('date_and_time', 'fname', 'email', 'street_address1', 'mobile', 'total_amount', 'order_type')->get();
    }

    public function headings(): array
    {
        return [
            'Ordered Date',
            'Name',
            'Email',
            'Address',
            'Mobile',
            'Total Amount',
            'Order Type',
        ];
    }
}
