<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompaniesM;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\URL;
use Auth;

class CompaniesC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        $companies = CompaniesM::latest()->paginate(5);
        return view('companies.index',compact('companies'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'logo'  => 'dimensions:max_width=100,max_height=100',
        ]);
    
        if ($request->hasFile('logo')) {
      $image = $request->file('logo');
      $filename = trim($request->name) . '_' . date('d-m-Y-H-i') . '_' . Auth::user()->id . '.' . $image->getClientOriginalExtension();
      Storage::disk('logo')->put($filename, File::get($image));

      $companies = new CompaniesM();
      $companies->name = $request->name;
      $companies->email = $request->email;
      $companies->logo = $filename;
      $companies->save();
    }else{
      $companies = new CompaniesM();
      $companies->name = $request->name;
      $companies->email = $request->email;
      $companies->save();  
    }
    
        return redirect()->route('companies.index')
                        ->with('success','Company created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\CompaniesM  $product
     * @return \Illuminate\Http\Response
     */
    public function show(CompaniesM $company)
    {
        return view('companies.show',compact('company'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompaniesM  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(CompaniesM $company)
    {
        return view('companies.edit',compact('company'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompaniesM  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompaniesM $company)
    {
         if ($request->hasFile('logo')) {
      $image = $request->file('logo');
      $filename = trim($company->name) . '_' . date('d-m-Y-H-i') . '_'.'update'. Auth::user()->id . '.' . $image->getClientOriginalExtension();
      Storage::disk('logo')->put($filename, File::get($image));
      $oldfile = Storage::disk('logo')->delete($company->logo);

      
      $company->name = $request->name;
      $company->logo = $filename;
      $company->email = $request->email;
      $company->save();
    } else {
      $company->name = $request->name;
      $company->email = $request->email;
      $company->save();
    }
    
        return redirect()->route('companies.index')
                        ->with('success','Company updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompaniesM  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompaniesM $company)
    {
        $company->delete();
    
        return redirect()->route('companies.index')
                        ->with('success','company deleted successfully');
    }
}