<?php

namespace Ekoukltd\LaraConsent\Datatables;


use Ekoukltd\LaraConsent\Models\ConsentOption;
use Ekoukltd\LaraConsent\Models\ConsentOptionUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ConsentOptionsUsersDatatables extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  mixed  $query  Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        $format= datatables()
            ->eloquent($query)
            ->editColumn('groupedemail', function ($model) {
                return $model->groupedemail;
            })
            ->editColumn('consentable_type', function ($model) {
                return class_basename($model->consentable_type);
            })
            ->editColumn('created_at', function ($model) {
                return $model->created_at->format('d/m/y');
            });
            
        $keys  = ConsentOption::getAllKeys();
        //Edit Dynamic Columns
        foreach ($keys as $key) {
            $format->editColumn($key, function ($model) use($key) {
                return $model->$key==1?'<i class="fa fa-check-circle text-success"></i>':($model->$key===0?'<i class="fa fa-exclamation-circle text-danger"></i>':'');
            });
        }
        
        $models = ConsentOptionUser::getAllSavedUserTypes();
        //Filter emails from all found user types
        $format->filterColumn('groupedemail', function ($query, $keyword) use($models) {
            foreach ($models as $model) {
                $model = app($model);
                $table = with(new $model())->getTable();
                $query->orWhereRaw($table.".email like ?", ["%{$keyword}%"]);
            }
            
        });
        
        $format->rawColumns($keys);
        return $format;
    }
    
    /**
     * Get query source of dataTable.
     *
     * @param  ConsentOptionUser  $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ConsentOptionUser $model)
    {
        $query = $model->newQuery()->selectRaw('concat(consentable_type,"/",consentable_id) as user,consentable_type,max(consentables.created_at) as created_at' );
        
        $keys  = ConsentOption::getAllKeys();
        $models = ConsentOptionUser::getAllSavedUserTypes();
        
        foreach ($keys as $key) {
            $query->addSelect(DB::raw("MAX(CASE WHEN consentables.key = '$key' THEN accepted ELSE NULL END) AS '".$key."'"));
        }
        $query->groupBy(['user','consentable_type']);
        $select = "COALESCE( ";
        foreach ($models as $model)
        {
            $model = app($model);
            $table = with(new $model())->getTable();
            
            $query->leftJoin($table,function($join) use ($model,$table){
                    $join->on($table.'.id','=','consentable_id');
                    $join->where('consentable_type','like',"%".class_basename($model)."%");
            });
            $select.=$table.'.email,';
            $query->addSelect(DB::raw($table.".email as ".$table."email") );
            $query->groupBy([$table."email"]);
        }
        $select = rtrim($select, ',').") as groupedemail";
        $query->addSelect(DB::raw($select));
        

        return $query;
    }
    
    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        $keycount = ConsentOption::getAllKeysCount();
        $totalColumns = $keycount+3;
        $builder = $this->builder();
        $builder->columns($this->getColumns())
            ->orderBy($totalColumns-1, 'desc');
        $builder->setTableId("dt_".Str::snake(class_basename($this)));
        $builder->buttons(
            Button::make('export')->addClass('btn btn-sm btn-alt-secondary mr-2'),
            Button::make('print')->addClass('btn btn-sm btn-alt-secondary'),
        );
        
        return $builder->minifiedAjax()
            ->responsive(true)
            ->info(true)
            ->dom(
                "<'row'<'col-sm-12 text-right'B>><'row'<'col-sm-12 col-md-6 text-left'f><'col-sm-12 col-md-6 text-right'i>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5 mb-3'l><'col-sm-12 col-md-7 mb-3'p>>"
            )
            ->language([
                           'processing'        => '<i class="fa fa-4x fa-cog fa-spin text-warning"></i>',
                           'search'            => "_INPUT_",
                           'searchPlaceholder' => "Search..",
                           'info'              => "<strong>_TOTAL_</strong> Users",
                           'paginate'          => [
                               'first'    => '<i class="fa fa-angle-double-left"></i>',
                               'previous' => '<i class="fa fa-angle-left"></i>',
                               'next'     => '<i class="fa fa-angle-right"></i>',
                               'last'     => '<i class="fa fa-angle-double-right"></i>'
                           ],
                       ]
            
            )
            ->parameters([
                             'classes' => [
                                 'sWrapper'      => "dataTables_wrapper dt-bootstrap4",
                                 'sFilterInput'  => "form-control form-control-lg",
                                 'sLengthSelect' => "form-control form-control-lg",
                             ]
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
    
       
        $cols =  [
            Column::make('consentable_type')->title('User Type'),
            Column::make('groupedemail')->title('Email')
        ];
        
        $keys  = ConsentOption::getAllKeys();
        foreach($keys as $key){
            $cols[]= Column::make($key)->addClass('text-center')->searchable(false);
        }
        $cols[] = Column::make('created_at')->title('Updated');
        return $cols;
        
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