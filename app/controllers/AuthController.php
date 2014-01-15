<?php
/**
 * This file is a part of a project by ITECHSPARK.
 * User: Saarang
 * Date: 9/10/13
 * Time: 3:34 PM
 */
class AuthController extends BaseController {

    public function login()
    {

        $credentials = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
            );
        try {
        	
            $user = Sentry::authenticate($credentials, false);
            $user->touch();
            switch($user->permissions){
                case 1 : return Redirect::route('clientAdmin'); break;
                case 2 : return Redirect::route('caller'); break;
            }


        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            $errorMessage = 'Login field is required.';

        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            $errorMessage = 'Password field is required.';

        }
        catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
            $errorMessage = 'Wrong password, try again.';

        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $errorMessage = 'User was not found.';

        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            $errorMessage = 'User is not activated.';

        }
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            $errorMessage = 'User is suspended for 15 minutes.';

        }
        catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
            $errorMessage = 'User is banned.';

        }
        return Redirect::route('loginForm')->with("data",$errorMessage);

    }

    public function logout(){
        Sentry::logout();
        return Redirect::route('loginForm');
    }

     public function loginForm(){
        return View::make('public.login');
    }

}