<?php

/**
 * AdminuserDataTable Data Table
 *
 * AdminuserDataTable Data Table handles AdminuserDataTable datas.
 *
 * @category   AdminuserDataTable
 * @package    vRent
 * @author     Techvillage Dev Team
 * @copyright  2020 Techvillage
 * @license
 * @version    2.7
 * @link       http://techvill.net
 * @since      Version 1.3
 * @deprecated None
 */

namespace App\DataTables;

use App\Models\ContactUs;
use Yajra\DataTables\Services\DataTable;

class ContactUsDataTable extends DataTable
{
    public function ajax()
    {
        $admin = $this->query();

        return datatables()
            ->of($admin)
            ->addColumn('action', function ($admin) {
                $delete = '<a href="' . url('admin/delete-contact/' . $admin->id) . '" class="btn btn-xs btn-danger delete-warning"><i class="glyphicon glyphicon-trash"></i></a>';
                return  $delete;
            })
            ->addColumn('username', function ($admin) {
                return '<a href="' . url('admin/edit-admin/' . $admin->id) . '">' . $admin->username . '</a>';
            })
            ->rawColumns(['username','action'])
            ->make(true);
    }

    public function query()
    {
        $admin = ContactUs::select(['contact_us.id as id', 'name', 'email', 'message']);
        return $this->applyScopes($admin);
    }

    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'name', 'name' => 'contact_us.name', 'title' => 'Name'])
            ->addColumn(['data' => 'email', 'name' => 'contact_us.email', 'title' => 'Email'])
            ->addColumn(['data' => 'message', 'name' => 'contact_us.message', 'title' => 'Message'])
            ->addColumn(['data' => 'action', 'name' =>'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])
            ->parameters(dataTableOptions());
    }

    protected function getColumns()
    {
        return [
            'id',
            'created_at',
            'updated_at',
        ];
    }

    protected function filename()
    {
        return 'admindatatables_' . time();
    }
}
