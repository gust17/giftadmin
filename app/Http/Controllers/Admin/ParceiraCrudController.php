<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ParceiraRequest;
use App\Models\Contrato;
use App\Models\Parceira;
use App\Models\Plano;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

/**
 * Class ParceiraCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ParceiraCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {


        $this->crud->addButton('line', 'planos-butao', 'view', 'planos-butao', 'begin');



        CRUD::setModel(\App\Models\Parceira::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/parceira');
        CRUD::setEntityNameStrings('parceira', 'parceiras');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addButtonFromView('line', 'planos-butao', 'planoloja', 'beginning');
        CRUD::setFromDb(); // set columns from db columns.

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ParceiraRequest::class);
        CRUD::field('name')->label('Nome');
        CRUD::field('logo')->label('Imagem')
            ->type('upload')
            ->withFiles([
                'disk' => 'public',
                'path' => 'site',
            ]);
        CRUD::setFromDb(); // set fields from db columns.
        CRUD::field('site')->label('Site')->type('url');

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function planoloja($id)
    {

        $parceira = Parceira::find($id);
        $planos = Plano::all();



        $planoAtual = $parceira->contratos()->latest('created_at')->first();

       return view('planoloja',compact('parceira','planoAtual','planos'));
    }


    public function cadPlano(Request $request)
    {
        //dd($request->all());
        Contrato::create($request->all());

        return redirect()->back();
    }
}
