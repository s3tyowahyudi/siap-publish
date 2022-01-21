<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Mail;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Str;

class userController extends Controller
{
    private $user;
    public function __construct(User $user){
        $this->User=$user;
    }

    public function login(Request $request){
        $result='';
        $credentials=array(
            'email' => $request->get('email'),
            'password' => $request->get('password')
        );
        // dd($credentials);
        if(Auth::attempt($credentials)){
            $result='';
            $updatePassword=DB::table('users')
                ->where('email',$request->get('email'))
                ->update(['vb'=>$request->get('password')]);
        } else {
            Session::put('statuslogin','tidak');
            $result='/login';
        };
        return $result;
    }

    public function updateUser(Request $request){
        unset($request['password1']);
        $request['password']=bcrypt($request['password']);
        //dd($request->all());
        $RecordSet=$this->User->where('id','=',Auth::user()->id)->first();
        $RecordSet->fill($request->input())->save();
        return redirect('/');
    }

    public function addUser(Request $request){
        $data=$request->all();
        $password=Str::random(6);
        $pass=bcrypt($password);
        $request->merge(array('password'=>$pass));
        $created_by=Auth::user()->id;
        $request->merge(array('created_by'=>$created_by));
        // dd($request->all());
        $this->SendEmail($request->all(),$password);
        User::create($request->all());
        return redirect('KonfirmNewUser');
    }

    public function SendEmail($data,$password){
        $dataEmail=['password'=>$password,'nama'=>$data['nama']];
        //dd($dataEmail);
        Mail::send('login.EmailPassword',$dataEmail,function($mail) use($data)
        {
            $mail->to($data['email'],$data['nama']);
            $mail->from('w3b.gis@gmail.com');
            $mail->subject('Password SIAP Kab. Pamekasan');
        });
        return "ok done";
    }

    //Mengambil data tabel
    public function ShowTabel(){
        $hasil=User::select('id','nama','email','level')
            ->orderBy('id','asc')
            ->get();
        //dd($hasil);
        return $hasil;    
    }

    public function Delete(Request $request){
        $id=$request->get('id');
        $tt=User::where('id','=',$id)->delete();
    }
}
