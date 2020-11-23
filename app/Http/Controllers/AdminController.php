<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $staffs = User::get()->where('role', 'staff');

        return view('admin.index', ['staffs' => $staffs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
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
            'title' => ['required'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'birth_date' => ['required', 'date', 'before:today'],
            'citizen_id' => ['required', 'digits:13'],
            'address' => ['required'],
            'phone_number_1' => ['required', 'digits:10'],
        ]);

        $password = $request->input('first_name') . '@' . $request->input('phone_number_1');
        $gender = 1;
        if ($request->input('title') != 'นาย') {
            $gender = 0;
        }

        $user = new User;
        $user->title = $request->input('title');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($password);
        $user->gender = $gender;
        $user->birth_date = $request->input('birth_date');
        $user->citizen_id = $request->input('citizen_id');
        $user->address = $request->input('address');
        $user->phone_number_1 = $request->input('phone_number_1');
        $user->role = 'staff';
        $user->save();

        $user = User::get()->where('email', $request->input('email'))->first();

        return redirect()->route('admin.show',['admin' => $user->id] );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.show', ['user' => $user]);
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
        $staff = User::findOrFail($id);
        $staff->delete();
        return redirect()->route('admin.index');
    }
}
