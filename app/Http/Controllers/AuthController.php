<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm() { return view('auth.login'); }
    public function login(Request $request)
    {
        $data = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
            'role'=>'required|in:BIBLIOTECARIO,USUARIO',
        ]);
        if (! Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {
            return back()->withErrors(['email'=>'Credenciales inválidas']);
        }
        $user = Auth::user();
        if (! $user->roles->contains('name',$data['role'])) {
            Auth::logout();
            return back()->withErrors(['email'=>'No tienes acceso como '.$data['role']]);
        }
        $request->session()->regenerate();
        return redirect()->intended($data['role']==='BIBLIOTECARIO'?route('dashboard'):route('home'));
    }

    public function showRegisterForm() { return view('auth.register'); }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:oracle.users,email',
            'password'=>'required|confirmed|min:6',
        ]);
        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password'])
        ]);
        $user->roles()->attach(2); // USUARIO
        Auth::login($user);
        return redirect()->route('home');
    }

    public function logout(Request $r)
    {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect()->route('login');
    }
    
}
