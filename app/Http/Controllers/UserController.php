<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
