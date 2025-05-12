<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Auth extends Controller
{
    protected $users;
   public function __construct(users $users) {
    $this->users = $users;
   }

    public function login_page()
    {
       $data = [
           'title' => 'Login'
       ];
       return view('auth.login', $data);
    }


    public function Check(Request $request)
    {
                $request->validate([
                    'username' => 'required|alpha_dash',
                    'password' => 'required',
                ]);


                $username = $request->input('username');
                $password = $request->input('password');


                $user = $this->users->where('username', $username)->first();

                if ($user) {
                    $check = $user && Hash::check($password, $user->password);

                    if ($check) {
                        $checkAktif =  $user->is_active;

                     
                        if ($checkAktif === 1) {
                            $checkrole =  $user->role_id;

                 if ($checkrole === 1) {
    
                    $sess = [
                        'id_user' => $user['id_user'],
                        'username' => $user['username'],
                        'role_id' => $user['role_id'],
                    ];
                    session()->put($sess);
                    return redirect()->to('Admin/Dashboard');
    
    
                 }elseif ($checkrole === 2) {
                    $sess = [
                        'id_user' => $user['id_user'],
                        'username' => $user['username'],
                        'role_id' => $user['role_id'],
                    ];
                    session()->put($sess);
                    return redirect()->to('Employe/Home');
    
                 }
                 else {
                    return redirect()->back()->withErrors([
                        'Chekrole' => 'Your role Not found.',
                        ]);
                   }
                      
                        }else {
                            return redirect()->back()->withErrors([
                                'Chekstatus' => 'account anda nonaktif.',
                                ]);
                        }
                    }else {
                        return redirect()->back()->withErrors([
                            'ChekaMatch' => 'password / username Salah.',
                            ]);
                    }
                }else {
                    return redirect()->back()->withErrors([
                        'checkUsername' => 'username Tidak Ada.',
                        ]);
                }
    }


    public function Logout(Request $request) {
       $request->session()->flush();
       $request->session()->invalidate();
       $request->session()->regenerateToken();
       return redirect('/');
   }


}
