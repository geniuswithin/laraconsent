<?php

namespace Ekoukltd\LaraConsent\Http\Controllers;

use Ekoukltd\LaraConsent\Datatables\ConsentOptionsDatatables;
use Ekoukltd\LaraConsent\Http\Requests\ConsentOptionFormRequest;
use Ekoukltd\LaraConsent\Models\ConsentOption;
use Illuminate\Support\Facades\Auth;

class ConsentOptionController extends Controller
{
    public function index(ConsentOptionsDatatables $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->ajax();
        }
        return view('vendor.ekoukltd.laraconsent.consent-options.index')->with(
            ['dataTable' => $dataTable->html()]);
    }
    
    public function create()
    {
        $consentOption = new ConsentOption();
        return view(
            'vendor.ekoukltd.laraconsent.consent-options.create', compact('consentOption')
        );
    }
    
    public function show(ConsentOption $consentOption)
    {
        return view('vendor.ekoukltd.laraconsent.consent-options.show', compact('consentOption'));
    }
    
    public function edit(ConsentOption $consentOption)
    {
        //Only latest version is editable
        if(!$consentOption->isHighestVersion){
            $editableVersion = $consentOption->editableVersion();
            return redirect(route(config('laraconsent.routes.admin.prefix').'.edit',$editableVersion))
                ->with(['success'=>'Version '.$consentOption->version.' is not editable. Editing current version '.$editableVersion->version]);
        }
        
        return view('vendor.ekoukltd.laraconsent.consent-options.edit', compact('consentOption'));
    }
    
    public function update(
        ConsentOptionFormRequest $request,
        ConsentOption            $consentOption
    ) {
        $data = $request->getData();

        if ($requiresNewVersion = $consentOption->usersViewedThisVersion) {
            //create a new version
            $data[ 'version' ] = $consentOption->nextVersionNumber;
            $newConsent        = ConsentOption::create($data);
            
            if ($newConsent->canPublish) {
                $newConsent->setCurrentVersion();
            }
        }
        else {
            //update this version
            $consentOption->update($data);
            
            if ($consentOption->canPublish) {
                $consentOption->setCurrentVersion();
            }
            
        }
        return redirect(route(config('laraconsent.routes.admin.prefix').'.index'));
    }
    
    public function store(ConsentOptionFormRequest $request)
    {
        if (!Auth::check()) {
            abort(403, 'Only authenticated users can create new consent options.');
        }
        $consentOption             = ConsentOption::create($request->getData());
        $consentOption->is_current = true;
        $consentOption->version    = 1;
        $consentOption->save();
        
        return redirect(
            route(config('laraconsent.routes.admin.prefix').'.show', $consentOption)
        );
    }
    
    public function toggleStatus(ConsentOption $consentOption)
    {
        if($consentOption->toggleStatus()->save()){
            $enabled = filter_var($consentOption->enabled, FILTER_VALIDATE_BOOLEAN);
            $msg=$consentOption->__toString()." has been ".($enabled?"enabled":"disabled");
            return response()->json(['success'=>true,'message'=>$msg,'colour'=>$enabled?'success':'warning']);
        }
        return response()->json(['error'=>true,'message'=>'Something went wrong']);
    }
}