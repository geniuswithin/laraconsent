<?php

namespace Ekoukltd\LaraConsent\Traits;



use Ekoukltd\LaraConsent\Models\ConsentOption;

/**
 * Trait to dynamically inititalise withCount property from user defined
 */
trait UserCount
{
    public function initializeUserCount()
    {
        $models = ConsentOption::getAllUserTypes();
        $relations = [];
        foreach($models as $model)
        {
            $relations[]=$model->relation;
        }
        $this->withCount = $relations;
    }
    
    
}