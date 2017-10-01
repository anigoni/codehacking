<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $users=User::all();

        return view('admin.users.index', compact('users'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $roles = Role::lists('name', 'id')->all();//$roles=array dei soli valori name e id

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //

        if (trim($request->password)==''){//se campo password non ha valore inserito

            $input=$request->except('password');//prendo tutti i campi eccetto password
        } else{

            $input = $request->all();

            $input['password'] = bcrypt($request->password);//cripto la password prima di store nel DB

        }



        if($file = $request->file('photo_id')){

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);//move file in cartella 'images' creata sotto 'public'

            $photo = Photo::create(['file'=>$name]);//creazione nuovo oggetto Photo anche nel DB

            $input['photo_id'] = $photo->id; //creato oggetto Photo, automaticamente ha un suo id

        }


        User::create($input);

        return redirect('/admin/users');

     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user=User::findOrFail($id);

        $roles=Role::lists('name', 'id')->all();//roles=array associativo name=>id

        return view('admin.users.edit', compact('user', 'roles'));//passo variabili user e array roles alla view


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        //

        $user=User::findOrFail($id);

        if (trim($request->password)==''){//se campo password non ha valore inserito

            $input=$request->except('password');//prendo tutti i campi eccetto password
        } else{

            $input = $request->all();

            $input['password'] = bcrypt($request->password);//cripto la password prima di store nel DB

        }


        if($file=$request->file('photo_id')){

            $name=time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo=Photo::create(['file'=>$name]);

            $input['photo_id']=$photo->id;

        }

        $user->update($input);

        return redirect('/admin/users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //



    }
}
