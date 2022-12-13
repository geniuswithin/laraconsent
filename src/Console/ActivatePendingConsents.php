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
		
		$currentConsents = ConsentOption::allActiveConsents()->get();
		
		$currentConsents->each(function($currentConsent){
			if($pendingConsent  = $currentConsent->nextConsentReadyToActivate()){
				$pendingConsent->setCurrentVersion();
			}
				
		});
		
        
    }
}