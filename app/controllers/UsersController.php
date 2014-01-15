<?php

class UsersController extends BaseController
{



    public function storeNewUser()
    {

        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'passwordConfirm' => 'required|same:password',
            );

        $validator = Validator::make(Input::all(),$rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        try{

            $user = Sentry::getUserProvider()->create(Input::except(array('passwordConfirm')));
            $user->activated = 1;
            $user->save();

            $message = "Well done! Registration is done successfuly.";

            return Redirect::route('newuser')->with('message',$message);

        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            $errorMessage = 'Please check the password field.';

        }
        catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            $errorMessage = 'This email already exist.';

        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            $errorMessage = 'Please enter your email.';

        }
        return Redirect::back()->with('errorMessage',$errorMessage)->withInput();;

    } 

    public function newuser()
    {
        return View::make('clientAdmin.users.newUser');
    }


    public function viewUsers()
    {
        return View::make('clientAdmin.users.viewUsers');
    }


    public function updatePassword()
    {
        if(Request::ajax()){
            try {
                sleep(1);
                $userID = Input::get('clientID');
                $user = Sentry::findUserById($userID);
                $user->password = Input::get('password');
                $user->save();
                return Response::make('1',200) ;
            }
            catch(Cartalyst\Sentry\Users\UserNotFoundException $e){
                return Response::make('Something wrong!',400);
            }
        }else{
            return "Invalid HTTPXML Request";
        }
    }

    public function deleteuser()
    {
       if(Request::ajax()){
            try {
                sleep(1);
                $userID = Input::get('clientid');
                $user = Sentry::findUserById($userID);
                $user->delete();
                return Response::make('1',200) ;
            }
            catch(Cartalyst\Sentry\Users\UserNotFoundException $e){
                return Response::make('اطلاعات کاربر نادرست است',400);
            }
        }else{
            return "Invalid HTTPXML Request";
        }
   }

  
}