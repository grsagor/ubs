<?php

namespace App\Http\Controllers\Backend;


use App\Footer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FooterController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->id != 5) {
            // abort(403, 'Unauthorized action.');
            $output = [
                'success' => False,
                'msg' => 'You are not allowed',
            ];
            return redirect()->back()->with('status', $output);
        }
        $data = Footer::query()->get();
        return view('backend.footer.index', compact('data'));
    }

    public function create()
    {
        if (auth()->user()->id != 5) {
            abort(403, 'Unauthorized action.');
        }
        // return view('backend.footer.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->id != 5) {
            abort(403, 'Unauthorized action.');
        }
        // try {
        //     $requestData = $request->all();
        //     $footer = new Footer();
        //     $footer->description = $requestData['description'];
        //     $footer->save();
        //     $output = [
        //         'success' => true,
        //         'msg' => ('Created Successfully!!!'),
        //     ];

        //     return redirect()->back()->with('status', $output);
        // } catch (\Throwable $e) {
        //     dd($e->getmessage());
        //     return redirect()->back();
        // }
    }

    public function edit($id)
    {
        if (auth()->user()->id != 5) {
            abort(403, 'Unauthorized action.');
        }
        $footer = Footer::find($id);
        return view('backend.footer.edit', compact('footer'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->id != 5) {
            abort(403, 'Unauthorized action.');
        }

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
            return redirect()->route('footer.index')->with('status', $output);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            dd($e->getMessage());
            return redirect()->back();
        }
    }
}
