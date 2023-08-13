{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Users" icon="la la-question" :link="backpack_url('user')" />
<x-backpack::menu-item title="Categorias" icon="la la-question" :link="backpack_url('categoria')" />
<x-backpack::menu-item title="Perguntas" icon="la la-question" :link="backpack_url('pergunta')" />
<x-backpack::menu-item title="Cartaos" icon="la la-question" :link="backpack_url('cartao')" />
<x-backpack::menu-item title="Sobres" icon="la la-question" :link="backpack_url('sobre')" />
<x-backpack::menu-item title="Centros" icon="la la-question" :link="backpack_url('centro')" />
<x-backpack::menu-item title="Parceiras" icon="la la-question" :link="backpack_url('parceira')" />
<x-backpack::menu-item title="Topos" icon="la la-question" :link="backpack_url('topo')" />
<x-backpack::menu-item title="Termos" icon="la la-question" :link="backpack_url('termo')" />