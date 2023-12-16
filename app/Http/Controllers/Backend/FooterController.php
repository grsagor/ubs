<?php

namespace App\Http\Controllers\Backend;


use App\Footer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FooterController extends Controller
{
    public function index(Request $request)
    {
        $data = Footer::query()->get();
        return view('backend.footer.index', compact('data'));
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

    public function edit($id)
    {
        $footer = Footer::find($id);
        return view('backend.footer.edit', compact('footer'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'description' => 'required',
            ], [
                'description.required' => 'The description field is required.',
            ]);
            $footer = Footer::findOrFail($id);
            $footer->description = $validatedData['description'];
            $footer->save();

            $output = [
                'success' => true,
                'msg' => 'Updated Successfully!!!',
            ];
            return redirect()->back()->with('status', $output);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            dd($e->getMessage());
            return redirect()->back();
        }
    }
}
