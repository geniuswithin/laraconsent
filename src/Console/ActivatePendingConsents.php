<?php

namespace Ekoukltd\LaraConsent\Console;

use Ekoukltd\LaraConsent\Models\ConsentOption;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ActivatePendingConsents extends Command
{
    protected $signature = 'laraconsent:activate-drafts';
    
    protected $description = 'Activate Pending Consents';
    
    public function handle()
    {
        $this->info('Checking for pending consents...');
        

        $readyToActivateIds = DB::table('consent_options')->select(DB::raw('max(id) as id,`key`'))
            ->whereDate('published_at','<=',Carbon::now())
            ->where('is_current',false)
            ->groupBy('key')
            ->pluck('id')
            ->toArray();
        
        if(count($readyToActivateIds)){
            $pendingConsents = ConsentOption::whereIn('id',$readyToActivateIds)->get();
            foreach($pendingConsents as $pendingConsent)
            {
                Log::info('Setting '.$pendingConsent->title.' active to version '.$pendingConsent->version);
                $pendingConsent->setCurrentVersion();
            }
        }
      
        
        
    }
}