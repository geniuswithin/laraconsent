<?php

namespace Ekoukltd\LaraConsent\Datatables;

use Ekoukltd\LaraConsent\Models\ConsentOption;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ConsentOptionsDatatables extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  mixed  $query  Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->filterColumn('card', function ($query, $keyword) {
                $query->whereRaw("title like ?", ["%{$keyword}%"]);
                $query->orWhereRaw("text like ?", ["%{$keyword}%"]);
            })
            ->addColumn('card', 'vendor.ekoukltd.laraconsent.consent-options.'.config('laravel-admin-tools.css_format','bootstrap4').'.widgets.consent-card')
            ->rawColumns(['card']);
    }
    
    /**
     * Get query source of dataTable.
     *
     * @param  ConsentOption  $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ConsentOption $model)
    {
        $query = $model->newQuery();
        
        if (!request()->has('all')) {
            $query->where(function ($query) {
                $query->whereIsCurrent(true);
                $query->orWhere(function ($queryTwo) {
                    $queryTwo->where('published_at', '>=', Carbon::now());
                });
            });
        }
        
        if (request()->has('deleted')) {
            $query->onlyTrashed();
        }
        
        return $query;
    }
    
    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        $builder = $this->builder();
        $builder->columns($this->getColumns())
            ->orderBy(1, 'asc');
        $builder->setTableId("dt_".Str::snake(class_basename($this)));
        
        return $builder->minifiedAjax()
            ->responsive(true)
            ->info(true)
            ->dom(config('laraconsent.datatables.dom.'.config('laravel-admin-tools.css_format')))
            ->language([
                           'processing'        => config('laravel-admin-tools.datatables.processing'),
                           'search'            => "_INPUT_",
                           'searchPlaceholder' => "Search contracts...",
                           'info'              => "<strong>_TOTAL_</strong> Contract Templates",
                           'paginate'          => [
                               'first'    => '<i class="fa fa-angle-double-left"></i>',
                               'previous' => '<i class="fa fa-angle-left"></i>',
                               'next'     => '<i class="fa fa-angle-right"></i>',
                               'last'     => '<i class="fa fa-angle-double-right"></i>'
                           ],
                       ]
            
            )
            ->buttons([])
            ->parameters([
                             'classes' => [
                                 'sWrapper'      => "dataTables_wrapper dt-".config('laravel-admin-tools.css_format'),
                                 'sFilterInput'  => "form-control form-control-lg",
                                 'sLengthSelect' => "form-control form-control-lg",
                             ],
                             'buttons' => []
            
                         ])
            ->pagingType('full_numbers')
            ->autoWidth(false);
    }
    
    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $btn = '<div class="d-flex align-items-center">
            <span class="h4 mb-0">Consent Forms</span>
            <a class="ms-auto btn btn-primary" title="Add New Consent Form" href="'.route(
                config('laraconsent.routes.admin.prefix').'.create'
            ).'">Add New</a>
        </div>
        ';
        
        return [
            Column::make('id')
                ->hidden()
                ->className('d-none'),
            Column::make('sort_order')
                ->hidden()
                ->searchable(false)
                ->className('d-none'),
            Column::make('card')
                ->title("")
                ->sortable(false)
        ];
    }
    
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Consent Options';
    }
}