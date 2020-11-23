<?php

namespace App\Http\Controllers;

use App\Package;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::where('status','รอรับของ')->orderBy('created_at','desc')->get();
        return view('packages.allPackages',['packages' => $packages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required','min:3'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'image' => ['required']
        ]);
        $title = $request->input('title');
        $first = $request->input('first_name');
        $last = $request->input('last_name');
        $building = $request->input('building_name');
        $room = $request->input('room_number');
        $image_filename = time() . '.' . $request->file('image')->getClientOriginalName();
        $public_path = 'images/packages';
        $destination = base_path()."/public/".$public_path;
        $request->file('image')->move($destination, $image_filename);

        $package = new Package();
        $room_id = (new User())->getRoomFromUser($building,$room);

        $package->user_id = Auth::id();
        $package->recipient = $title . $first . " " . $last;
        $package->room_id = $room_id;
        $package->image_path =  '/images/packages/' . $image_filename;
        $detail = $request->input('detail');
        if ($detail == ''){
            $detail = '-';
        }
        $package->detail = $detail;
        $package->save();
        return redirect()->route('packages.index');
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

    public function packageConfirm($room_id,$package_id){
        $package = Package::findOrFail($package_id);
        $package->status = 'ได้รับแล้ว';
        $package->save();

        $packages = Package::where('room_id',$room_id)->where('status','รอรับของ')->orderBy('created_at','desc')->get();
        return redirect()->route('packages.index');
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

    public function packageReport(){
        $packages = Package::orderBy('created_at','desc')->get();
        return view('packages.packageReport',["packages" => $packages]);
    }
}
