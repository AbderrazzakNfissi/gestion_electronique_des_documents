<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Models\Entreprise;
use Illuminate\Support\Facades\Crypt;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
       

        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'telephone' => 'required|numeric|digits:10',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'pays' => ['required', 'string', 'max:100'],
            'industrie'=> ['required','string','max:100'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $entreprise = new Entreprise();
        $user = new User();
        $entreprise->nom = $request->nom;
        $entreprise->telephone = $request->telephone;
        $entreprise->email = $request->email;
        $entreprise->pays = $request->pays;
        $entreprise->industrie = $request->industrie;
        $entreprise->password = Hash::make($request->password);
        $entreprise->save();
        $entreprise_id = DB::table('entreprises')->where('email', $entreprise->email)->value('id');;
        
        $user = User::create([
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'est_admin' => 1,
            'password' => Hash::make($request->password),
            'entreprise_id'=>$entreprise_id
        ]);
        
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
