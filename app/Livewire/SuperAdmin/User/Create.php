<?php

namespace App\Livewire\SuperAdmin\User;

use App\Models\Faculty;
use App\Models\Major;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.admin-layout')]
#[Title('Create User')]
class Create extends Component
{
   #[Validate('required|string|max:100|min:3')]
   public string $name;
   #[Validate('required|string|max:100|min:3|unique:users,username')]
   public string $username;
   #[Validate('required|email')]
   public string $email;
   #[Validate('required|string')]
   public string $password;
   #[Validate('nullable')]
   public $faculty;
   #[Validate('nullable')]
   public $major;

   public function mount()
   {
      $user = auth()->user();
      if ($user->faculty_id) {
         $this->faculty = $user->faculty_id;
      }
   }

   public function updatedFaculty(): void
   {
      $this->major = null;
      $this->validateOnly('faculty');
   }

   public function store()
   {
      $this->validate();
      User::create([
         'name' => $this->name,
         'username' => $this->username,
         'email' => $this->email,
         'password' => Hash::make($this->password),
         'role' => 'admin',
         'faculty_id' => $this->faculty,
         'major_id' => $this->major,
         'status' => true,
      ]);

      redirect()->route('super-admin.manage-user');
   }

   public function render()
   {
      $facultyQuery = Faculty::query();

      if (auth()->user()->faculty_id) {
         $facultyQuery->where('id', auth()->user()->faculty_id);
      }

      $majorQuery = Major::query();

      if (auth()->user()->faculty_id) {
         $majorQuery->where('faculty_id', auth()->user()->faculty_id);
      }
      // dd($this->faculty);
      return view('livewire.super-admin.user.create', [
         'faculties' => $facultyQuery
            ->get(['id', 'name'])
            ->map(fn($f) => ['value' => $f->id, 'label' => $f->name])
            ->toArray(),
         'majors' => $majorQuery
            ->get(['id', 'name'])
            ->map(fn($m) => ['value' => $m->id, 'label' => $m->name])
            ->toArray(),
      ]);
   }
}
