<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SaqueRequest;
use App\Models\Saque;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SaqueCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SaqueCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Saque::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/saque');
        CRUD::setEntityNameStrings('saque', 'saques');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // set columns from db columns.
        CRUD::column('created_at');
        $this->crud->addColumn([
            // 1-n relationship
            'label'     => 'Usuario Loja', // Table column heading
            'type'      => 'select',
            'name'      => 'user_id', // the column that contains the ID of that connected entity;
            'entity'    => 'userLoja', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => "App\Models\UserLoja", // foreign key model
        ]);

        $this->crud->addColumn([
            // 1-n relationship
            'label'     => 'Contrato Loja', // Table column heading
            'type'      => 'select',
            'name'      => 'contrato_id', // the column that contains the ID of that connected entity;
            'entity'    => 'contrato', // the method that defines the relationship in your Model
            'attribute' => 'plano.name', // foreign key attribute that is shown to user
            'model'     => "App\Models\Contrato", // foreign key model
        ]);

        /**
         * Columns can be defined using the fluent syntax:
         * -

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
        CRUD::setValidation(SaqueRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

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


    public function darBaixa($id)
    {
        $saque = Saque::find($id);


        $saque->update(['status'=>1]);
        \Alert::add('success', 'Operação realizada com sucesso!')->flash();
        return redirect()->back()->with('alert', ['success' => 'Operação realizada com sucesso!']);
        ;

    }
}
