<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{

     public function index()
    {
        return view('listings.index' ,
         [ 'listings' => Listing::latest()->filter(request(['tag' , 'search']))->paginate(6)  ]);
    }


    public function create()
    {
        return view('listings.create') ;
    }


    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' =>  'required' ,
            'company' => ['required'] ,
            'location' => 'required' ,
            'email'    => ['required' , 'email'] ,
            'website'   => 'required' ,
            'tags'    =>'required' ,
            'description' => 'required' ,
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos' , 'public') ;
        }

        $formFields['user_id'] = auth()->id() ;

        Listing::create($formFields) ;
        return redirect('/')->with('message' , 'Post Created Successfully !') ;
    }


    public function show(Listing $listing)
    {
         return view('listings.show' , ['listing' => $listing]);
    }


    public function edit(Listing $listing)
    {
        //dd($listing->title) ;
        return view('listings.edit' , ['listing' => $listing]) ;
    }


    public function update(Request $request, Listing $listing)
    {
        if($listing->user_id != auth()->id() ){
            abort(403 , 'Unauthorized Action');
        }
         $formFields = $request->validate([
            'title'         => 'required' ,
            'company'       =>'required'  ,
            'location'      => 'required' ,
            'email'         => ['required' , 'email'] ,
            'website'       => 'required' ,
            'tags'          =>'required' ,
            'description'   => 'required' ,
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos' , 'public') ;
        }

        $listing->update($formFields) ;

        return redirect('/listings/manage')->with('message' , 'Post Updated Successfully !') ;
    }



    public function destroy(Listing $listing)
    {
        if($listing->user_id != auth()->id() ){
            abort(403 , 'Unauthorized Action');
        }
        $listing->delete() ;
        return redirect('/')->with('message' , 'Post Deleted Successfully !') ;
    }


    public function manage(User $user){

        return view('listings.manage' ,['listings' => auth()
            ->user()->listings()->get()
        ]) ;
    }
}
