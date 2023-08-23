<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;
use Nette\Utils\Strings;

class advertisementPostController extends Controller
{
    public function index(){
        return view('/pages/advertisement');
    }

    public function store(Request $request){
        $advertisement = new Advertisement;
        $advertisement->post_title = $request->post_title;
        $advertisement->image = $request->image;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('img/', $filename);
            
            $advertisement->image = $filename;
        } else {
            return $request;
            $advertisement->image = '';
        }
        $advertisement->start_date = $request->start_date;
        $advertisement->end_date = $request->end_date;
        $advertisement->status = $request->status;
        $advertisement->save();
        return response()->json(['msg'=>'successfull']);
        

    }

    public function show(){
        $ads = Advertisement::all();
        $data = compact('ads');
        return view('pages/view-advertisement')->with($data);
    }
    public function edit(String $id){
        $ad = Advertisement::find($id);
        $data = compact('ad');
        return view('pages/edit-advertisement')->with($data);
    }

    public function update(Request $request, String $id){
        $advertisement = Advertisement::find($id);
        $advertisement->post_title = $request->post_title;
        $advertisement->image = $request->image;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('img/', $filename);
            
            $advertisement->image = $filename;
        } else {
            return $request;
            $advertisement->image = '';
        }
        $advertisement->start_date = $request->start_date;
        $advertisement->end_date = $request->end_date;
        $advertisement->status = $request->status;
        $advertisement->save();
        return response()->json(['msg'=>'successfull']);
    }

    public function delete(String $id){
        $ad = Advertisement::find($id);
        // dd($ad);
        $ad->delete();
        return response()->json(['msg'=>'successfull']);
    }
}
