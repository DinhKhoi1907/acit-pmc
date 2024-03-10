<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Http\Traits\SupportTrait;

use Helper, TableManipulation;

class TableController extends Controller
{
    //
    use SupportTrait;
    private $type, $table, $config;
    private $routeShow = 'admin.table.show';
    private $routeEdit = 'admin.table.edit';
    private $viewShow = 'admin.templates.table.man'; // admin/templates/color/man/color.blade.php
    private $viewEdit = 'admin.templates.table.add'; // admin/templates/color/man/color_add.blade.php
    private $folder = "";
    private $alert = "Hệ thống báo lỗi : Bạn không có quyền truy cập !";


    /*
    |--------------------------------------------------------------------------
    | Khởi tạo dữ liệu
    |--------------------------------------------------------------------------
    */
    public function initialization(Request $request){
        $this->category = $request->category;
        $this->type = $request->type;        
        $this->page_error = redirect()->back();
        $this->permissionShow = 'table_man';
        $this->permissionAdd = 'table_add';
        $this->permissionEdit = 'table_edit';
        $this->permissionDelete = 'table_delete';
    }


    /*
    |--------------------------------------------------------------------------
    | Hiển thị danh sách dữ liệu : color
    |--------------------------------------------------------------------------
    */
    public function Show(Request $request){
        //### khởi tạo giá trị cho model
        $this->initialization($request);


        //### check auth permission
        if(!$this->IsPermission($this->permissionShow)){
            $request->session()->flash('alert', $this->alert);
            return $this->page_error;
        }


        //### Thiết lập giá trị thuộc tính
        $table_name = $request->tablename;
        

        //### Code xử lý...
        $tables = TableManipulation::GetTables();
        if($table_name){
            $column = TableManipulation::GetTableColumns($table_name);
        }


        //### Trả về giao diện
        $response = array(
            'request'=>$request,
            'type'=> '',
            'tables' => $tables,
            'column' => (isset($column)) ? $column : null,
            'table_name' => $table_name
        );

        return view($this->viewShow)->with($response);
    }



    /*
    |--------------------------------------------------------------------------
    | Hiển thị danh sách dữ liệu : color
    |--------------------------------------------------------------------------
    */
    public function edit(Request $request){
        //### khởi tạo giá trị cho model
        $this->initialization($request);


        //### check auth permission
        if(!$this->IsPermission($this->permissionShow)){
            $request->session()->flash('alert', $this->alert);
            return $this->page_error;
        }


        //### Thiết lập giá trị thuộc tính
        $table_name = $request->tablename;
        $table_column = $request->tablecolumn;
        

        //### Code xử lý...
        $tables = TableManipulation::GetTables();
        $list_type = array(
            'numeric' => array('int','mediumint','bigint','double','float', 'boolean'),
            'string' => array('string','text','longtext', 'blob'),
            'date and time' => array('date','timestamp'),
            'json' => array('json')
        );


        //### Trả về giao diện
        $response = array(
            'request'=>$request,
            'type'=> '',
            'tables' => $tables,
            'table_name' => $table_name,
            'table_column' => $table_column,
            'list_type' => $list_type
        );

        return view($this->viewEdit)->with($response);
    }


    /*
    |--------------------------------------------------------------------------
    | Hiển thị danh sách dữ liệu : color
    |--------------------------------------------------------------------------
    */
    public function Save(Request $request){
        //### khởi tạo giá trị cho model
        $this->initialization($request);


        //### check auth permission
        if(!$this->IsPermission($this->permissionShow)){
            $request->session()->flash('alert', $this->alert);
            return $this->page_error;
        }


        //### Thiết lập giá trị thuộc tính
        $namechange = $request->namechange;
        $name = $request->name;
        $table = $request->table;
        $type = $request->type;


        //### Change name column
        if($namechange!=$name){
            if(!Schema::hasColumn($table, $namechange)) {
                Schema::table($table, function (Blueprint $table) use ($name, $namechange) {
                    $table->renameColumn($name, $namechange);
                });
            }
        }

        return redirect()->route($this->routeShow,[$table]);
    }
}
