
<x-admintools-block title="{{__('Contracts')}}">
{!! $dataTable->table(['class'=>'table '.($classes??'')],false)  !!}
</x-admintools-block>
@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
