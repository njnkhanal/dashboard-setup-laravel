<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // to use bootstrap pagination
        Paginator::useBootstrap();
        // grap user with latest user and paginate 20 users
        $users = User::latest()->paginate(20);
        // retur view user index
        return view('Admin.Pages.User.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Pages.User.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'numeric'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,gif', 'max:2048'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        // set all data from request to the variable $data
        $data = $request->all();

        // store image 
        $image_title = null;
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imgpath = 'upload/user/';
            $imgname = now()->format('ymdhis') . rand(10000, 99999) . '.' . $img->getClientOriginalExtension();
            $img->move($imgpath, $imgname);
            $image_title = $imgpath . $imgname;
        }

        // set image name 
        $data['image'] = $image_title;
        $data['password'] = Hash::make($data['password']);

        // create data to the table
        User::create($data);

        return redirect(route('user.index'))->with('success', 'User Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.Pages.User.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,' . $user->id],
            'phone' => ['nullable', 'numeric'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,gif', 'max:2048'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);
        // set all data from request to the variable $data
        $data = $request->all();

        // store image 
        $image_title = $user->image;
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imgpath = 'upload/user/';
            $imgname = now()->format('ymdhis') . rand(10000, 99999) . '.' . $img->getClientOriginalExtension();
            $img->move($imgpath, $imgname);
            $image_title = $imgpath . $imgname;
        }

        // set image name 
        $data['image'] = $image_title;

        // check password is null or not
        if ($data['password'] == null) {
            $data['password'] = $user->password;
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        // create data to the table
        $user->update($data);

        return redirect(route('user.index'))->with('success', 'User Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User Deleted Successfully!');
    }
}
