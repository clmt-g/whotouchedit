<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Display the forgot password form.
     */
    public function showForgotForm()
    {
        return view('login.forgot_password');
    }

    /**
     * Send a password reset link to the user's email.
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        // On ne révèle pas si l'email existe ou non (sécurité)
        if (!$user) {
            return back()->with(
                'success',
                'Si un compte correspond à cet email, un lien de réinitialisation vous a été envoyé.'
            );
        }

        // Supprimer les anciens tokens pour cet email
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        // Générer un token unique
        $token = Str::random(64);

        // Insérer le token en base
        DB::table('password_reset_tokens')->insert([
            'email'      => $request->email,
            'token'      => Hash::make($token),
            'created_at' => Carbon::now(),
        ]);

        // Envoyer le mail
        Mail::send(
            'emails.reset_password',
            ['token' => $token, 'email' => $request->email, 'user' => $user],
            function ($mail) use ($request) {
                $mail->to($request->email)
                    ->subject('Réinitialisation de votre mot de passe — WhoTouchedIt');
            }
        );

        return back()->with(
            'success',
            'Si un compte correspond à cet email, un lien de réinitialisation vous a été envoyé.'
        );
    }

    /**
     * Display the reset password form.
     */
    public function showResetForm(Request $request, string $token)
    {
        return view('login.reset_password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    /**
     * Handle the password reset.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'                 => ['required', 'email'],
            'token'                 => ['required'],
            'password'              => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        // Récupérer l'entrée en base
        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        // Vérifier que le token existe, correspond et n'a pas expiré (60 min)
        if (
            !$record ||
            !Hash::check($request->token, $record->token) ||
            Carbon::parse($record->created_at)->addMinutes(60)->isPast()
        ) {
            return back()->withErrors([
                'email' => 'Ce lien de réinitialisation est invalide ou a expiré.',
            ])->withInput(['email' => $request->email]);
        }

        // Mettre à jour le mot de passe
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Aucun compte associé à cet email.',
            ]);
        }

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        // Supprimer le token utilisé
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return redirect()
            ->route('login')
            ->with('success', 'Mot de passe réinitialisé avec succès. Vous pouvez vous connecter.');
    }
}
