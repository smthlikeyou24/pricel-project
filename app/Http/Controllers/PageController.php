<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PriceList;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function pricelist($name)
    {
        if(User::where('slug', $name)->first())
        {
            $data = User::where('slug', $name)->first();

            $data_list = PriceList::where('slug', $name)->get();

            return view('pages.list', compact('data', 'data_list'));
        }
        return redirect('/');
    }

    public function settings(Request $request)
    {
        $data = PriceList::where('name', Auth::user()->name)->get();
        return view('pages.settings', compact('data'));
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => [
                'required',
                File::types(['jpg', 'jpeg', 'png'])
            ],
        ]);

        $data_user = User::where('name', Auth::user()->name)->first();
        if($data_user->image != "shopImage.png") {
            Storage::delete('public/profileImages/' . $data_user->image);
         }
        $data_user->image = Str::random(10) . '.' . $request->image->getClientOriginalExtension();
        $data_user->update();

        if($request->hasFile('image'))
        {
            $fileName = Str::random(10) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/profileImages/', $fileName);
            $data_user->image = $fileName;
            $data_user->save();
        }

        return redirect('/settings');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'max:25',
                Rule::unique('users')->ignore(auth()->user()->id),
                'uppercase'
              ],
            'description' => 'required|max: 200',
            'wa_number' => 'max_digits: 15',
            'ig_username' => 'max: 30',
        ]);
        

        $data_user = User::where('name', Auth::user()->name)->first();
        $data_user->name = $request->name;
        $data_user->slug = Str::slug($request->name,'-');
        $data_user->description = $request->description;
        $data_user->wa_number = $request->wa_number;
        $data_user->ig_username = $request->ig_username;
        $data_user->save();

        if($data_list = PriceList::where('name', Auth::user()->name)->get())
        {
            foreach($data_list as $list)
            {
                $list->name = $request->name;
                $list->save();
            }

            foreach($data_list as $list)
            {
                $list->slug = Str::slug($request->name,'-');
                $list->save();
            }
        }

        return redirect('/settings');

    }
}
