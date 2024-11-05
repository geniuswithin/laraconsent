<?php

namespace Ekoukltd\LaraConsent\Traits;

use Ekoukltd\LaraConsent\Models\ConsentOption;
use Ekoukltd\LaraConsent\Models\ConsentOptionUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

/**
 * Trait for adding to a user model
 */
trait HasConsent
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function requiredConsents()
    {
        return ConsentOption::findbykeys($this->requiredConsentKeys())->get();
    }
    
    /**
     * @return array
     */
    public function requiredConsentKeys(): array
    {
        return ConsentOption::getAllActiveKeysbyUserClass(class_basename($this));
    }
    
    public function outstandingConsentValidators()
    {
        $consents = $this->outstandingConsents();
        $validationArray = [];
        foreach ($consents as $consent) {
            $validationArray[ 'consent_option.'.$consent->id ] = 'boolean|'.($consent->is_mandatory ? 'accepted' : 'required');
        }
        return $validationArray;
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function outstandingConsents()
    {
        return ConsentOption::findbykeys($this->requiredConsentKeys())
            ->whereNotIn(
                'id', $this->consents()
                ->pluck('consent_options.id')
                ->toArray()
            )
            ->orderBy('sort_order')
            ->get();
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function consents()
    {
        return $this->morphToMany(ConsentOption::class, 'consentable')
            ->withTimestamps()
            ->withPivot('accepted')
            ->using(ConsentOptionUser::class);
            
    }
    
    public function lastConsentByKey($key)
    {
        return $this->consents()->where('consentables.key',$key)->latest()->first();
    }
    
    public function hasPreviousConsents($key)
    {
        return $this->consents()->where('consentables.key',$key)->count();
    }
    
    
    /**
     * @return mixed
     */
    public function activeConsents()
    {
        $usersSeenConsentsQuery = DB::table('consentables')
            ->selectRaw('max(consent_option_id) as id')
            ->where('consentable_id',$this->id)
            ->where('consentable_type',get_class($this))
        ;

        // If the user is logged in
        // and has a company assigned with consent options
        // then uses these to filter
        $user = auth()->user();
        if ($user && $user->department && $user->department->company) {
            $consentOptions = $user->department->company->consentOptions()->pluck('id');
            if ($consentOptions->isNotEmpty()) {
                $usersSeenConsentsQuery = $usersSeenConsentsQuery
                    ->whereIn('consent_option_id', $consentOptions->toArray())
                ;
            }
        }

        $usersSeenConsents = $usersSeenConsentsQuery
            ->groupBy('key')
            ->pluck('id')
            ->toArray()
        ;
        
        return  $this->consents()
            ->wherePivotIn('consent_option_id', $usersSeenConsents)
            ->withPivot(['accepted','id']);
    }
    
    /**
     * @return bool
     */
    public function hasRequiredConsents()
    {
        $requiredConsents = ConsentOption::findbykeys($this->requiredConsentKeys())
            ->where('force_user_update',true)
            ->pluck('id')
            ->toArray();
        $givenConsents    = $this->consents()
            ->pluck('consent_options.id')
            ->toArray();
        return !array_diff($requiredConsents, $givenConsents);
    }
}
