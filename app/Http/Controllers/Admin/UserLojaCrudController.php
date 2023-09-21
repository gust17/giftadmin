<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserLojaRequest;
use App\Models\Responsavel;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserLojaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserLojaCrudController extends CrudController
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
        CRUD::setModel(\App\Models\UserLoja::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user-loja');
        CRUD::setEntityNameStrings('Usuario Parceiro', 'Usuario Parceiro');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
       // CRUD::setFromDb(); // set columns from db columns.
        CRUD::addColumn('name');
        CRUD::addColumn('email');
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
        CRUD::field([
            'label' => "Loja",
            'type' => 'select',
            'name' => 'parceira', // the db column for the foreign key

            // optional
            // 'entity' should point to the method that defines the relationship in your Model
            // defining entity will make Backpack guess 'model' and 'attribute'

            // optional - manually specify the related model and attribute
            'model' => "App\Models\Parceira", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user

            // optional - force the related options to be a custom query, instead of all();
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }), //  you can use this to filter the results show in the select
        ]);
        CRUD::field([   // radio
            'name' => 'tipo', // the name of the db column
            'label' => 'Tipo de Usuário', // the input label
            'type' => 'radio',
            'options' => [
                // the key will be stored in the db, the value will be shown as label;
                0 => "Comum",
                1 => "Admin"
            ],
            // optional
            'inline' => true, // show the radios all on the same line?
        ]);
        CRUD::removeField('password');
        CRUD::field('name')
            ->type('text')->label('Nome');
        CRUD::field('cpf')
            ->type('text')->label('CPF');
        CRUD::field('whatsapp')
            ->type('text')->label('Whatsapp');
        CRUD::field('email')
            ->type('email')->label('Email');


        CRUD::setValidation(UserLojaRequest::class);
        //CRUD::setFromDb(); // set fields from db columns.

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

    public function store(UserLojaRequest $request)
    {
        // Acesse os dados da requisição
        $data = $request->all();

        // Adicione campos extras, se necessário
        $data['password'] = bcrypt($data['cpf']);

        //dd($data);


        // Crie o recurso
        $item = $this->crud->create($data);


        Responsavel::create(['user_id'=>$item->id,'parceira_id'=>$data['parceira'],'adminstrador'=>$data['tipo']]);

        // Redirecione para a página de listagem após a criação
        return redirect($this->crud->route);
    }


}
