<?php

namespace App\Http\Controllers\Backend;


use App\Footer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FooterController extends Controller
{
    public function index(Request $request)
    {
    }

    public function create()
    {
        return view('backend.footer.create');
    }

    public function store(Request $request)
    {
        try {
            $requestData = $request->all();
            $footer = new Footer();
            $footer->description = $requestData['description'];
            $footer->save();
            $output = [
                'success' => true,
                'msg' => ('Created Successfully!!!'),
            ];

            return redirect()->back()->with('status', $output);
        } catch (\Throwable $e) {

            dd($e->getmessage());

            return redirect()->back();
        }
    }

    public function edit()
    {
    }

    public function update()
    {
    }
}
