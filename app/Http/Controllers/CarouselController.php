<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Carousel;
use App\Mail\ContactNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carousels= Carousel::orderBy('created_at','desc')->get();        
        return view('admin.carousel.index',compact('carousels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.carousel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('image_url')){
            $path = Storage::put('/carousel',$request->image_url);
        }
        $carousel = Carousel::create([            
            'slogan' => $request->slogan,
            'image_url' => $path,
        ]);
        
        return redirect()->route('carousels.index');
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
        $carousel =Carousel::find($id);
        return view('admin.carousel.edit',compact('carousel'));
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
        $carousel = Carousel::find($id);
        if($request->hasFile('image_url')){
            Storage::delete($carousel->image_url);
            $path=Storage::put('/carousel',$request->image_url);            
        }else{
            $path =$carousel->image_url;
        }
        $carousel->update([
            'slogan' => $request->slogan,
            'image_url' => $path,
    ]);
        return redirect()->route('carousels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feature =Carousel::find($id);
        Storage::delete($feature->image_url);        
        $feature->delete();
        return redirect()->route('carousels.index');
    }

    public function contact(Request $request)
    {
        $validated =$request->validate([
            'email'=>'email',
            'phone'=>'required|min:9|max:10',
            'name'=>'required|max:50',
            'content'=>'required|max:500',
            'g-recaptcha-response' => 'recaptcha',
            recaptchaFieldName() => recaptchaRuleName()
        ]);
        $contact=Contact::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'content'=>$request->content,
        ]);
        Mail::to('demostarmoon@gmail.com')->send(new ContactNotify($contact));
        return redirect()->route('carousels.index');

    }
}
