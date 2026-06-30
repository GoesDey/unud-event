<?php

namespace App\Livewire\SuperAdmin\User;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin-layout')]
#[Title('Manage User')]
class Index extends Component
{
   use WithPagination;
   public string $search = '';
   public array $deleteUsers = [];
   public bool $selectAll = false;

   public array $sorts = [];
   public array $filters = [
      'categories' => [],
      'type' => null,
   ];

   public array $theads = ['', 'User', 'Email', 'Status', ''];
   #[Computed]
   public function users()
   {
      $user = auth()->user();
      $userFaculty = $user->faculty;
      $query = null;
      if ($userFaculty) {
         $query = User::where(['faculty_id' => $userFaculty->id, 'role' => 'admin']);
      } else {
         $query = User::whereNot('id', $user->id);
      }

      return $query->select(['id', 'username', 'email', 'status'])->paginate(8);
   }

   public function updatedSelectAll($value)
   {
      if ($value) {
         $this->deleteUsers = $this->users->pluck('id')->map(fn($id) => (string) $id)->toArray();
      } else {
         $this->deleteUsers = [];
      }
   }

   public function updatedDeleteUsers()
   {
      $currentPageIds = $this->users->pluck('id')->map(fn($id) => (string) $id)->toArray();

      $this->selectAll =
         count(array_intersect($currentPageIds, $this->deleteUsers)) === count($currentPageIds);
   }

   public function deleteUser(int $id)
   {
      User::where('id', $id)->delete();
      $this->resetPage();
   }

   #[On('delete-some-data')]
   public function deleteSelected()
   {
      if (empty($this->deleteUsers)) {
         return;
      }

      User::whereIn('id', $this->deleteUsers)->delete();

      // Reset state
      $this->deleteUsers = [];
      $this->selectAll = false;
      $this->resetPage();
   }

   public function render()
   {
      return view('livewire.super-admin.user.index');
   }
}
