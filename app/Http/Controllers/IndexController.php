<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function check()
    {
        $user=null;
        if (\request()->has("code")){
            $user = User::where("tracking_code",\request()->code)->first();
            session()->forget("error");
            session()->forget("success");
            if (!$user){
                session()->flash("error","Error Tracking Code Not Exits");
            }else{
                session()->flash("success","Tracking Code Exists");
            }

        }

        return view("check",[
            'user'  => $user
        ]);
    }

    public function submit(){
        auth()->user()->update([
            "tracking_code"  =>(string) \Str::uuid(),
            "status"  =>"new"
        ]);
        session()->flash("success","Tracking Code Set Successfully");
        return redirect()->back();
    }

    public function index()
    {
        return view("index");
    }

    public function profile()
    {
        return view("profile");
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.auth()->id()],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:255', 'unique:users,phone,'.auth()->id()],
            'password' => [ 'nullable','min:8', 'confirmed'],
        ]);
        $input["password"] = User::find(auth()->id())->password;
        if ($request->has("password")){
            $input["password"] = bcrypt($request->password);
        }
        $data =$request->except("_token");
        auth()->user()->update([
            'password' => $input['password'],
            'name' => $data['name'],
            'phone' => $data['phone'],
            'lat' => $data['lat'] ?? null,
            'lng' => $data['lng']?? null,
            'address' => $data['address'],
            'email' => $data['email'],
        ]);

        session()->flash("success"," Updated Successfully");
        return redirect()->route("home");
    }

    public function users()
    {
        if (auth()->user()->role == 'admin'){
            $users = User::where("role","user")->get();
        }else{
            $users = User::where(["role" => "user","delivery_id" => auth()->id()])
                ->whereIn("status" ,['approved','shipped','outForDelivery','delivered'])->get();
        }

        return view("users",[
            "users"  => $users
        ]);

    }
    public function staffs()
    {
        $users = User::whereIn("role",["admin","delivery"])->get();
        return view("users.staffs",[
            "users"  => $users
        ]);

    }

    public function createStaff(){
        return view("users.create");
    }

    public function editStaff($id){
        $user = User::find($id);
        return view("users.edit",[
            "user"  => $user
        ]);
    }

    public function deleteStaff($id){
        $user = User::find($id);
        $user->delete();
        session()->flash("success"," Deleted Successfully");
        return redirect()->back();
    }
    public function updateStaff(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$request->user_id],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:255', 'unique:users,phone,'.$request->user_id],
            'password' => [ 'nullable','min:8', 'confirmed'],
        ]);
        $user=User::find($request->user_id);

        $input["password"] = $user->password;
        if ($request->has("password")){
            $input["password"] = bcrypt($request->password);
        }
        $data =$request->except("_token");
        $user->update([
            'password' => $input['password'],
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'email' => $data['email'],
        ]);

        session()->flash("success"," Updated Successfully");
        return redirect()->route("admin.staffs.index");
    }
    public function storeStaff(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => [ 'required','min:8', 'confirmed'],
        ]);

        $data =$request->except("_token");

        User::create([
            'password' => bcrypt($data['password']),
            'name' => $data['name'],
            'phone' => $data['phone'],
            'role' => $data['role'],
            'address' => $data['address'],
            'email' => $data['email'],
        ]);
        session()->flash("success"," Created Successfully");
        return redirect()->route("admin.staffs.index");
    }

    public function show($id)
    {
        $user = User::find($id);
        return view("user",[
            "user"  => $user
        ]);
    }

    public function chang(Request $request)
    {
        $user=User::find($request->user_id);
        $user->update([
            "status"    => $request->status,
            "delivery_id"    => $request->delivery_id != null ?$request->delivery_id :$user->delivery_id
        ]);

        session()->flash("success"," Updated Successfully");
        return redirect()->back();
    }
}
