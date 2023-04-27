<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PriceList;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

class ListController extends Controller
{
    public function createList(Request $request)
    {
        $request->validate([
            'product_name' => 'required|max:30',
            'product_image' => [
                'required',
                File::types(['jpg', 'jpeg', 'png'])
            ],
            'product_description' => 'required|max:200',
            'product_stock' => 'required',
            'product_price' => 'required|min_digits:4',

        ]);

        $data_user = User::where('name', Auth::user()->name)->first();
        $data = PriceList::create([
            'name' => $data_user->name,
            'slug' => $data_user->slug,
            'product_name' => $request->product_name,
            'product_image' => Str::random(10) . '.' . $request->product_image->getClientOriginalExtension(),
            'product_description' => $request->product_description,
            'product_stock' => $request->product_stock,
            'product_price' => $request->product_price,
        ]);

        if($request->hasFile('product_image'))
        {
            $fileName = Str::random(10) . '.' . $request->file('product_image')->getClientOriginalExtension();
            $request->file('product_image')->storeAs('public/listImages/', $fileName);
            $data->product_image = $fileName;
            $data->save();
        }


        return redirect('/settings');
    }

    public function deleteList($name, $productId)
    {
        if(User::where('slug', $name)->first()){
            $data = PriceList::where('id', $productId)->first();
            Storage::delete('public/listImages/' . $data->product_image);
            $data->delete();
            return redirect('/settings');
        }
    }
}
