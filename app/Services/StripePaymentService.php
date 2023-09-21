<?php

namespace App\Services;

class StripePaymentService
{
    public function paymentData($item)
    {
        if ($item->service_id) {
            $info['product_id']         = $item->service_id;
        } else {
            $info['product_id']         = $item->product_id;
        }

        $info['product_name']           = $item->product_name;
        $info['plan']                   = $item->plan;
        $info['bill']                   = $item->bill;
        $info['table_name']             = $item->table_name;
        $info['description']            = $item->description;

        if ($item->upgrade) {
            $info['upgrade']            = $item->upgrade ?? null;
        }

        if ($item->url) {
            $info['url']                = $item->url ?? null;
        }

        // dd($item->toArray());
        // $info['output'] = [
        //     'success'               => true,
        //     'msg'                   => ('Successfull!'),
        // ];

        // return redirect('stripe')
        //     ->with([
        //         'product_id'        => $info['product_id'],
        //         'product_name'      => $info['product_name'],
        //         'bill'              => $info['bill'],
        //         'plan'              => $info['plan'],
        //         'table_name'        => $info['table_name'],
        //         'description'       => $info['description'],
        //         // 'output'            => $info['output'],
        //         'upgrade'           => $info['upgrade'],
        //         'url'               => $info['url'],
        //     ]);

        return $info;
    }
}
