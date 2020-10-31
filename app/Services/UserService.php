<?php


namespace App\Services;


use App\Mail\PasswordResetEmail;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserService
{
    /**
     * @param $formRequest
     * @return mixed
     */
    static function create($formRequest){

        return $user = User::create([
            'name' => $formRequest->get('name'),
            'email' => $formRequest->get('email'),
            'password' => sha1($formRequest->get('password')),
        ]);
    }

    /**
     * @param $user
     * @return bool
     */
    static function createSession($user){
        Session::put('auth', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ]);
        return true;
    }

    /**
     * @param $request
     * @return mixed
     */
    static function userExist($request){
        return User::where(self::username(), $request->get('email'))->first();
    }

    /**
     * @param $request
     * @return bool
     */
    static function verifyPassword($request){
        return self::userExist($request)->password === sha1($request->get('password'));
    }

    static function getUniqueToken()
    {
        $code = Str::random();
        $time = time();
        return Crypt::encryptString("{$code}tests{$time}");
    }

    static function sendPasswordResetNotification($request, $token){
        Mail::to($request->get('email'))->send(new PasswordResetEmail($token));
    }

    /**
     * @param $request
     * @param $token
     * @return bool
     */
    static function PasswordResetToken($request, $token){

        $count = DB::table("password_resets")->where("token", $token)->count();
        if($count == 0){
            DB::table('password_resets')->insert(['email' => $request->get('email'), 'token' => $token]);
        }else{
            DB::table('password_resets')->where(self::username(), $request->get('email'))->update(['token' => $token]);
        }
        return true;
    }

    static function VerifyResetPasswordLink($code){
        $count = DB::table("password_resets")->where("token", $code)->count();

        if ($count == 0){
            return false;
        }
        $code = Crypt::decryptString($code);
        $detach = explode('tests',$code);
        $time   = end($detach);

        $expire_time = strtotime('+1 day', $time);

        if((time() > $expire_time)){
            return false;
        }
        return true;
    }

    /**
     * @param $request
     * @return bool
     */
    static function verifyPasswordResetEmailAndToken($request){
        $count = DB::table("password_resets")->where("token", $request->get('token'))->where(self::username(), $request->get('email'))->count();
        if($count == 0){
            return false;
        }
        return true;
    }

    /**
     * @param $request
     * @return bool
     */
    static function updateUserPassword($request){
        User::where(self::username(), $request->get('email'))->update(['password' => sha1($request->get('password'))]);
        return true;
    }
    static function activeUser($id){
       if(User::findOrFail($id)->email_verified_at == null)
           return false;
       return true;
    }

    /**
     * @return string
     */
    static function username(){
        return 'email';
    }

}
