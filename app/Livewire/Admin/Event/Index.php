<?php

namespace App\Livewire\Admin\Event;

use App\Models\Category;
use App\Models\EventType;
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

   public array $sorts = [];
   public array $filters = [
      'categories' => [],
      'type' => null,
   ];
   public array $theads = ['', 'Nama Event', 'Tipe Event', 'Kategori', 'Status', ''];

   public function mount()
   {
      $this->loadData();
   }

   #[Computed]
   public function events()
   {
      $query = auth()
         ->user()
         ->events()
         ->with(['categories', 'eventType']);

      if ($this->search) {
         $query->where('name', 'like', '%' . $this->search . '%');
      }

      if (!empty($this->filters['categories'])) {
         $query->whereHas(
            'categories',
            fn($q) => $q->whereIn('categories.id', $this->filters['categories']),
         );
      }

      if ($this->filters['type']) {
         $query->where('event_type_id', $this->filters['type']);
      }

      if (!empty($this->sorts)) {
         foreach ($this->sorts as $kolom => $order) {
            if ($order) {
               $query->orderBy($kolom, $order);
            }
         }
      }

      return $query->paginate(10);
   }

   public function updatedSelectAll($value)
   {
      if ($value) {
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

   public function addSort(string $sortBy, string $sortOrder): void
   {
      if (isset($this->sorts[$sortBy]) && $this->sorts[$sortBy] === $sortOrder) {
         unset($this->sorts[$sortBy]);
         return;
      }
      $this->sorts[$sortBy] = $sortOrder;
   }

   public function removeSort(string $sortBy)
   {
      unset($this->sorts[$sortBy]);
   }

   public function addFilter(string $filter, mixed $id)
   {
      match ($filter) {
         'category' => ($this->filters['categories'][] = $id),
         'type' => ($this->filters['type'] = $id),
         default => null,
      };
   }

   public function toggleFilter(string $filter, mixed $id)
   {
      match ($filter) {
         'category' => in_array($id, $this->filters['categories'])
            ? $this->removeFilter('category', $id)
            : $this->addFilter('category', $id),

         'type' => $this->filters['type'] === $id
            ? $this->removeFilter('type', $id)
            : $this->addFilter('type', $id),
      };
   }

   public function removeFilter(string $filter, mixed $id)
   {
      match ($filter) {
         'category' => ($this->filters['categories'] = array_values(
            array_filter($this->filters['categories'], fn($c) => $c !== $id),
         )),
         'type' => ($this->filters['type'] = null),
         default => null,
      };
   }

   public function deleteEvent(int $id)
   {
      auth()->user()->events()->where('id', $id)->delete();
      $this->resetPage();
   }

   public function render()
   {
      // dd($this->events);
      return view('livewire.admin.event.index', [
         'categories' => Category::orderBy('name')->get(),
         'types' => EventType::get(['id', 'name']),
      ]);
   }
}
