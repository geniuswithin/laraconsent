<?php

namespace Ekoukltd\LaraConsent\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;


/**
 * @property integer $id
 * @property integer $consent_option_id
 * @property integer $consentable_id
 * @property string $consentable_type
 * @property string $key
 * @property boolean $accepted
 * @property string $created_at
 * @property string $updated_at
 */

class ConsentOptionUser extends MorphPivot
{
    public $incrementing = true;
    
    protected $table = 'consentables';
    
    public static function getAllSavedUserTypes() : array
    {
        return self::query()->select('consentable_type')->distinct()->pluck('consentable_type')->toArray();
    }
    
    public function consentOption()
    {
        return $this->belongsTo(ConsentOption::class,'consent_option_id','id',);
    }
    
    
    /**
     * @return $this
     */
    public function toggleStatus()
    {
        $this->accepted = !$this->accepted;
        return $this;
    }
    
}