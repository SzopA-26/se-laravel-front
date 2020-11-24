<?php

namespace App\Http\Controllers;

use App\Room;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function addRoommateView($id,$result=null){
        $response = Http::get('http://localhost:9090/api/room/' . $id);
        $room = json_decode($response);
        $response = Http::get('http://localhost:9090/api/users/room_id/' . $id);
        $users = json_decode($response);
        $response = Http::get('http://localhost:9090/api/type/' . $room->type_id);
        $type = json_decode($response);
        return view('rooms.addRoommate',['room' => $room,'result'=>$result, 'users' => $users, 'type' => $type]);
    }

    public function sendInvite($id,Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if ($user === null) {
            $message = "ไม่พบ user ดังกล่าว หากมีข้อสงสัยติดต่อนิติบุคคล";
        }elseif($user->role === 'admin' | $user->role === 'staff'){
            $message = "ไม่สามารถส่งคำชวนได้";
        }elseif($user->room_id != null){
            $message = "user มีห้องอยู่แล้ว หากมีข้อสงสัยติดต่อนิติบุคคล";
        }elseif ($user->invited != null){
            $message = "user มีคำชวนอยู่แล้วโปรดติดต่อ user ดังกล่าวด้วยตนเอง";
        }else{
            $message = "ส่งคำเชิญสำเร็จ โปรดรอ user ตอบรับ";
            $user->invited = $id;
            $user->save();
        }
        return $this->addRoommateView($id,$message);
    }

    public function acceptInvite($id){
        $user = User::findOrFail(Auth::id());
        $user->room_id = $id;
        $user->invited = null;
        $user->save();

        return redirect()->route('rooms.show.user',['id' => $id]);
    }

    public function denyInvite($id){
        $user = User::findOrFail(Auth::id());
        $user->invited = null;
        $user->save();
        return redirect()->route('home.index');
    }

    public function buyCashView(){
        return view('rooms.cash');
    }

    public function buyCashUpdate(Request $request){
        $cash = $request->input('cash');
        $user = User::findOrFail(Auth::id());
        $user->money += $cash;
        $user->save();
        return redirect()->route('buyCash');
    }

    public function show($id) {
        $user = User::findOrFail($id);
        return view('auth.profile', ['user' => $user]);
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return view('auth.edit', ['user' => $user]);
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        $validateData  = $request->validate([
            'title' => ['required'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
            'birth_date' => ['required', 'date', 'before:today'],
            'citizen_id' => ['required', 'digits:13'],
            'address' => ['required'],
            'phone_number_1' => ['required', 'digits:10'],
            'phone_number_2' => ['nullable', 'digits:10']
        ]);

//        return Hash::check($request->password, $user->password);

        if(!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('alert', 'รหัสผ่านไม่ถูกต้อง');
        }

        $user->title = $request->title;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->birth_date = $request->birth_date;
        $user->citizen_id = $request->citizen_id;
        $user->address = $request->address;
        $user->phone_number_1 = $request->phone_number_1;
        $user->phone_number_2 = $request->phone_number_2;

        $user->save();
        return redirect()->route('user.show', ['user' => $user->id]);
    }

    public function updateImg(Request $request, $id) {
        if (!$request->file('img')) {
            return redirect()->back()->with('alert', 'เกิดข้อผิดพลาด');
        }

        $user = User::findOrFail($id);

        $img = $request->file('img');
        $input = time() . '-' . $user->first_name . '.' . $img->getClientOriginalExtension();
        $des = public_path('/images/profile');
        $img->move($des, $input);
        $user->img = '/images/profile/' . $input;

        $user->save();
        return redirect()->route('user.show', ['user' => $user->id])->with('alert', 'เปลี่ยนรูปประจำตัวเรียบร้อยแล้ว');
    }

    public function deleteImg($id) {
        $user = User::findOrFail($id);

        $user->img = null;
        $user->save();
        return redirect()->route('user.show', ['user' => $user->id])->with('alert', 'ลบรูปประจำตัวเรียบร้อยแล้ว');

    }

    public function updatePassword($id, Request $request) {
        $user = User::findOrFail($id);
        if(!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with('alert', 'รหัสผ่านปัจจุบันไม่ถูกต้อง');
        }

        if(strlen($request->password) < 8) {
            return redirect()->back()->with('alert', 'รหัสผ่่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร');
        }

        if($request->password != $request->password_confirmation) {
            return redirect()->back()->with('alert', 'รหัสผ่านใหม่ไม่ตรงกัน');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.show', ['user' => $user->id])->with('alert', 'เปลี่ยนรหัสผ่านเรียบร้อย');

    }
}
