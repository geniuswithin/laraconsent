@component('laraconsent::components.inputs.select',[
                              'name'=>'version',
                              'id'=>'versionPicker',
                              'class'=>'js-versionPicker',
                              'label'=>__("Other Versions"),
                              'showUrl'=>true,
                              'selected'=>[$consentOption->id],
                              'options'=>$consentOption->getAllVersionsForSelect()
                   ])@endcomponent
