<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Modelable;
use Livewire\Component;

class HeaderPage extends Component
{
   #[Modelable]
   public $search = '';

   public $isSearch = true;

   public array $breadcrumbs = [];

   public function render()
   {
      return view('livewire.admin.header-page');
   }
}
