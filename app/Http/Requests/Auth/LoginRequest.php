<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;




class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    //A seconda del vincolo che viene violato, viene restituito un messaggio di errore

    public function rules()
    {
        return [
            'username' => 'required|string|min:8',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages(){
        return [
            'required' => 'il campo :attribute è necessario',
            'min' => 'Il campo :attribute deve avere almeno 8 caratteri'
        ];

    }


    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

//        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
        if (! Auth::attempt($this->only('username', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
//                'email' => trans('auth.failed'),
                'username' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
//            'email' => trans('auth.throttle', [
            'username' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
//        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
        return Str::transliterate(Str::lower($this->input('username')).'|'.$this->ip());
    }
}
