<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.usuarios.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    public function store(Request $r)
    {
        $d = $r->validate([
            'name'=>'required','email'=>'required|email|unique:oracle.users,email',
            'password'=>'required|confirmed|min:6','roles'=>'required|array','roles.*'=>'exists:oracle.roles,id'
        ]);
        $u = User::create([
            'name'=>$d['name'],'email'=>$d['email'],'password'=>Hash::make($d['password'])
        ]);
        $u->roles()->sync($d['roles']);
        return redirect()->route('admin.usuarios.index')->with('success','Creado.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $ur    = $user->roles->pluck('id')->toArray();
        return view('admin.usuarios.edit',compact('user','roles','ur'));
    }

    public function update(Request $r, User $user)
    {
        $d = $r->validate([
            'name'=>'required','email'=>"required|email|unique:oracle.users,email,{$user->id},id",
            'password'=>'nullable|confirmed|min:6','roles'=>'required|array','roles.*'=>'exists:oracle.roles,id'
        ]);
        $user->update([
            'name'=>$d['name'],'email'=>$d['email'],
            'password'=> $d['password']?Hash::make($d['password']):$user->password
        ]);
        $user->roles()->sync($d['roles']);
        return redirect()->route('admin.usuarios.index')->with('success','Actualizado.');
    }

    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();
        return back()->with('success','Eliminado.');
    }
}
