<?php

namespace App\DataTables;

use App\Models\Course;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CoursesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($data) {
                $action = '<div class="d-flex justify-content-between gap-2">';
                $action .= '<a href="'. route('courses.edit', $data) .'" class="btn btn-sm btn-outline-warning">Edit</a>';
                $action .= '<a href="'. route('courses.delete', $data) .'" class="btn btn-sm btn-outline-danger" onclick="confirm("Silmek istediğinize emin misiniz?")>Delete</a>';
                $action .= '</div>';

                return $action;
            })
            ->editColumn('status', function ($data) {
                $status = ($data->status == 1) ? '<span class="badge rounded-pill bg-success">Active</span>' : '<span class="badge rounded-pill bg-danger">Passive</span>';

                return $status;
            })
            ->rawColumns(['status','action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Course $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $id = 'courses-table';

        return $this->builder()
                    ->setTableId($id)
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    //->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ])
                    ->parameters([
                        'drawCallback' => 'function() { document.getElementById("'. $id .'").style.width="100%" }',
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('release_date'),
            Column::make('status')
            ->width(20)
            ->addClass('text-center'),
            Column::computed('action')
            ->width(50)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Courses_' . date('YmdHis');
    }
}
