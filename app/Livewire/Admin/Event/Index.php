<?php

namespace App\Livewire\Admin\Event;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin-layout')]
#[Title('Manage Event')]
class Index extends Component
{
   use WithPagination;
   public string $search = '';

   public array $deleteEvents = [];
   public bool $selectAll = false;

   public array $filters = [];
   public array $categories = [];
   public array $theads = ['', 'Nama Event', 'Tipe Event', 'Kategori', 'Status', ''];

   public function mount()
   {
      $this->loadData();
      // dd($this->events);
   }

   #[Computed]
   public function events()
   {
      return auth()
         ->user()
         ->events()
         ->with(['categories', 'eventType'])
         ->paginate(10);
   }

   public function updatedSelectAll($value)
   {
      if ($value) {
         // Ambil semua ID di halaman ini menggunakan Computed $this->events
         $this->deleteEvents = $this->events->pluck('id')->map(fn($id) => (string) $id)->toArray();
      } else {
         $this->deleteEvents = [];
      }
   }

   public function updatedDeleteEvents()
   {
      $currentPageIds = $this->events->pluck('id')->map(fn($id) => (string) $id)->toArray();

      $this->selectAll =
         count(array_intersect($currentPageIds, $this->deleteEvents)) === count($currentPageIds);
   }

   #[On('delete-some-data')]
   public function deleteSelected()
   {
      if (empty($this->deleteEvents)) {
         return;
      }

      auth()->user()->events()->whereIn('id', $this->deleteEvents)->delete();

      // Reset state
      $this->deleteEvents = [];
      $this->selectAll = false;
      $this->resetPage();
   }

   public function loadData() {}

   public function filter(string $sortBy, string $sortOrder): void
   {
      if (isset($this->filters[$sortBy]) && $this->filters[$sortBy] === $sortOrder) {
         unset($this->filters[$sortBy]);
         return;
      }
      $this->filters[$sortBy] = $sortOrder;
   }

   public function removeFilter(string $sortBy)
   {
      unset($this->filters[$sortBy]);
   }

   public function deleteEvent(int $id)
   {
      auth()->user()->events()->where('id', $id)->delete();
      $this->resetPage();
   }

   public function render()
   {
      // dd($this->events);
      return view('livewire.admin.event.index');
   }
}
