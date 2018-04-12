<?php

namespace App\Http\Controllers;


//Be sure to Use Model (Class of the current Controller)
use App\Passport;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $passports=Passport::all();
        return view('Passports/index',compact('passports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Passports/create');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
    
            if ($request->hasfile('filename')) {
                $file = $request->file('filename');
                $name = time().$file->getClientOriginalName();
                $file->move(public_path().'/images/passports/', $name);
            }
            $passport = new Passport();
            $passport->name = $request->get('name');
            $passport->email = $request->get('email');
            $passport->number = $request->get('number');
            $date = date_create($request->get('date'));
            $format = date_format($date, "Y-m-d");
            $passport->date = strtotime($format);
            $passport->office = $request->get('office');
            $passport->filename = $name;
            $passport->save();
    
            return redirect('passports')->with('success', 'Information has been added');
        
        } catch (Exception $e){
            $msg = $e->getMessage();
            return redirect('passports')->with('success', $msg);
        }
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
        $passport = Passport::find($id);
        return view('Passports/edit',compact('passport','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fieldsError = "";
        $arrError    = [];
        $passport= Passport::find($id);
        
        //Check fields
        if(empty($request->get('name'))){
            $fieldsError = "Name, ";
            $arrError[] = true;
        }
        if(empty($request->get('email'))){
            $fieldsError .= "Email, ";
            $arrError[] = true;
        }
        if(empty($request->get('number'))){
            $fieldsError .= "Number, ";
            $arrError[] = true;
        }
        if(empty($request->get('date'))){
            $fieldsError .= "Birth date, ";
            $arrError[] = true;
        }
        if(empty($request->get('office'))){
            $fieldsError .= "Office, ";
            $arrError[] = true;
        }
        
        //Check if some fields are missing - Display an error message if it is the case
        if(!empty($fieldsError)){
            if( count($arrError) > 1){
                $msg = "Please fill the following fields correctly : ".$fieldsError;
            } else {
                $msg = "Please fill the following field correctly : ".$fieldsError;
    
            }
            $msg = rtrim($msg,", ");
            return redirect('passports/'.$id.'/edit/')->with('error', $msg);
        }
        
        $passport->name=$request->get('name');
        $passport->email=$request->get('email');
        $passport->number=$request->get('number');
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $passport->date = strtotime($format);
        $passport->office=$request->get('office');
        
        //File Processing -  (Remove older if new file has been sent)
        $olderFile = $passport->filename;
        if ($request->hasfile('filename')) {
            if(!is_null($olderFile) && !empty($olderFile)){
                unlink(public_path().'/images/passports/'.$olderFile);
            }
            $file = $request->file('filename');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/passports/', $name);
            $passport->filename = $name;
        }
        //Save the updated data && redirect to the current edit page with a success message
        $passport->save();
        return redirect('passports/'.$id.'/edit/')->with('success','Information has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $passport = passport::find($id);
        $passport->delete();
        return redirect('passports')->with('success','Information has been  deleted');
    }

}
