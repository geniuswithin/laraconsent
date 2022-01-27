<?php

namespace Ekoukltd\LaraConsent\Http\Controllers;

use Ekoukltd\LaraConsent\Datatables\ConsentOptionsUsersDatatables;
use Ekoukltd\LaraConsent\Events\ConsentsUpdatedComplete;
use Ekoukltd\LaraConsent\Events\ConsentUpdated;
use Ekoukltd\LaraConsent\Models\ConsentOptionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LaraConsentController extends Controller
{
    public function index(Request $request,ConsentOptionsUsersDatatables $dataTable)
    {
        if ($request->ajax()) {
            return $dataTable->ajax();
        }
        
        //Hack to handle printing
        if($request->action && in_array($request->action,['csv','excel','pdf','print']))
        {
            return $dataTable->render('vendor.ekoukltd.consent-options.index');
        }
        
        return view('vendor.ekoukltd.consent-options.index')->with(
            [
                'dataTable' => $dataTable->html(),
                'classes'   => 'table-bordered table-striped table-hover table-vcenter'
            ]
        );
    }
    
    public function request()
    {
        $user = Auth::user();
        
        if (!$user) {
            abort(403, 'Only authenticated users can set consent options');
        }
        
        $consentOptions = $user->outstandingConsents();
        if ($consentOptions->count() < 1) {
            return redirect()
                ->back()
                ->withErrors('No required Consents');
        }
        
        return view('vendor.ekoukltd.user-consent.request', compact('consentOptions'));
    }
    
    public function store(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            abort(403, 'Only authenticated users can set consent options');
        }
        
        $request->validate($user->outstandingConsentValidators());
        
        $outstandingConsents = $user->outstandingConsents();
        foreach ($outstandingConsents as $consentOption) {
            $user->consents()
                ->save(
                    $consentOption, [
                    'accepted' => $request->consent_option[ $consentOption->id ],
                    'key'      => $consentOption->key
                ]
                );
            event(new ConsentUpdated($consentOption, $request->consent_option[ $consentOption->id ]));
        }
        
        event(new ConsentsUpdatedComplete($outstandingConsents, $user));
        
        return Redirect::intended(
            $request->session()
                ->get('url.saved')
        );
    }
    
   
    
    public function show()
    {
        $user = Auth::user();
        
        if (!$user) {
            abort(403, 'Only authenticated users can view consent options');
        }
        
        $consentOptions = $user->activeConsents;
        
        return view('vendor.ekoukltd.user-consent.show', compact('consentOptions'));
    }
    
    public function toggle(ConsentOptionUser $consentOptionUser)
    {
        if(!request()->ajax()){
            abort(403, 'Unauthorised action');
        }
        
        if($consentOptionUser->consentable_type !== get_class(Auth::user()) || $consentOptionUser->consentable_id !== Auth::id()){
            return response()->json(['error'=>true,'message'=>'Only an owner can update their consent option']);
        }
        
        if($consentOptionUser->toggleStatus()->save()){
            $consentOption= $consentOptionUser->consentOption;
            $enabled = filter_var($consentOptionUser->accepted, FILTER_VALIDATE_BOOLEAN);
            $msg= $consentOption->title." has been ".($enabled?"enabled":"disabled");
            event(new ConsentUpdated($consentOption, $enabled));
            return response()->json(['success'=>true,'message'=>$msg,'colour'=>$enabled?'success':'warning']);
        }
        return response()->json(['error'=>true,'message'=>'Something went wrong']);
    }
    
    public function print()
    {
        $user = Auth::user();
        
        if (!$user) {
            abort(403, 'Only authenticated users can view consent options');
        }
        
        $pdf = App::make('dompdf.wrapper');
        try {
            $pdf->loadView('vendor.ekoukltd.user-consent.print',
                           ['consentOptions' => $user->activeConsents])
                ->setPaper('A4');
            return $pdf->stream('Approved Consent');
        } catch (\DOMException $ex) {
            throw new \DOMException(
                $ex->getMessage(), 500
            );
        }
        return view('vendor.ekoukltd.user-consent.print', compact('consentOptions'));
    }
}