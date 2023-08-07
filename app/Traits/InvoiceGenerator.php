<?php

namespace App\Traits;

trait InvoiceGenerator
{
    public function invoice_number($object, $name)
    {
        $outputString = preg_replace('/[^0-9]/', '', $object);
        $number = $outputString;
        $invoice = (string) $name . (str_pad((int) $number, 7, '0', STR_PAD_LEFT));
        // $invoice = $name . (str_pad((int)$invoice + 1, 8, '0', STR_PAD_LEFT));
        return $invoice;
    }
}
