<?php

namespace App\Livewire\SuperAdmin;

use App\Models\Category;
use App\Models\EventType;
use App\Models\Participant; // 🌟 Model Participant sudah di-import di sini
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin-layout')]
#[Title('Manage Event')]
class Settings extends Component
{
    use WithPagination;

    public $currentTab = 'categories';
    public $search = '';
    public bool $isOpenModal = false;
    public string $name = '';
    public string $description = '';
    public bool $isEditMode = false;
    public $editingId = null;
    
    public array $deleteEvents = [];
    public bool $selectAll = false;

    public function openModal()
    {
        $this->resetForm();
        $this->isEditMode = false;
        $this->isOpenModal = true;
    }

    private function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->editingId = null;
        $this->resetErrorBag();
    }

    public function closeModal()
    {
        $this->isOpenModal = false;
        $this->resetForm();
    }

    public function save()
    {
        if ($this->currentTab === 'categories') {
            $this->validate([
                'name' => 'required|string|min:3|max:255|unique:categories,name,' . $this->editingId,
            ]);

            Category::updateOrCreate(
                ['id' => $this->editingId],
                ['name' => $this->name]
            );
        } 
        
        if ($this->currentTab === 'participants') {
            $this->validate([
                'name' => 'required|string|min:3|max:255|unique:participants,name,' . $this->editingId,
            ]);

            Participant::updateOrCreate(
                ['id' => $this->editingId],
                ['name' => $this->name]
            );
        }

        if ($this->currentTab === 'event_types') {
            $this->validate([
                'name' => 'required|string|min:3|max:255|unique:event_types,name,' . $this->editingId,
                'description' => 'required|string|min:5',
            ]);

            EventType::updateOrCreate(
                ['id' => $this->editingId],
                [
                    'name' => $this->name,
                    'description' => $this->description
                ]
            );
        }

        unset($this->items);
        $this->closeModal();
    }

    public function edit($id)
    {
        $this->resetForm();
        $this->editingId = $id;
        $this->isEditMode = true;

        if ($this->currentTab === 'categories') {
            $item = Category::findOrFail($id);
            $this->name = $item->name;
        } else if ($this->currentTab === 'participants') {
            $item = Participant::findOrFail($id);
            $this->name = $item->name;
        } else {
            $item = EventType::findOrFail($id);
            $this->name = $item->name;
            $this->description = $item->description;
        }

        $this->isOpenModal = true;
    }

    public function delete($id)
    {
        if ($this->currentTab === 'categories') {
            Category::destroy($id);
        } else if ($this->currentTab === 'participants') {
            Participant::destroy($id);
        } else {
            EventType::destroy($id);
        }

        $this->deleteEvents = array_diff($this->deleteEvents, [$id]);

        unset($this->items);
        $this->checkIfCurrentPageIsAllSelected();

        if ($this->items->isEmpty() && $this->page > 1) {
            $this->previousPage();
        }
    }

    #[On('delete-some-data')]
    public function deleteSelected()
    {
        if ($this->selectAll) {
            if ($this->currentTab === 'categories') {
                Category::where('name', 'like', '%' . $this->search . '%')->delete();
            } else if ($this->currentTab === 'participants') {
                Participant::where('name', 'like', '%' . $this->search . '%')->delete();
            } else if ($this->currentTab === 'event_types') {
                EventType::where('name', 'like', '%' . $this->search . '%')->delete();
            }
        } else {
            if (empty($this->deleteEvents)) return;

            if ($this->currentTab === 'categories') {
                Category::whereIn('id', $this->deleteEvents)->delete();
            } else if ($this->currentTab === 'participants') {
                Participant::whereIn('id', $this->deleteEvents)->delete();
            } else {
                EventType::whereIn('id', $this->deleteEvents)->delete();
            }
        }

        $this->resetSelectState();
        $this->resetPage();
    }

    public function changeTab($tab)
    {
        $this->currentTab = $tab;
        $this->search = '';
        $this->resetPage();
        $this->resetSelectState(); 
    }

    public function updatedPage()
    {
        $this->syncPageCheckboxes();
    }

    public function updatedSearch()
    {
        $this->resetPage(); 
        $this->resetSelectState(); 
    }

    #[Computed]
    public function items()
    {
        if ($this->currentTab === 'categories') {
            return Category::where('name', 'like', '%' . $this->search . '%')->paginate(10);
        }
        
        if ($this->currentTab === 'participants') {
            return Participant::where('name', 'like', '%' . $this->search . '%')->paginate(10);
        }
        
        if ($this->currentTab === 'event_types') {
            return EventType::where('name', 'like', '%' . $this->search . '%')->paginate(10);
        }

        return collect(); 
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            if ($this->currentTab === 'categories') {
                $this->deleteEvents = Category::where('name', 'like', '%' . $this->search . '%')->pluck('id')->toArray();
            } else if ($this->currentTab === 'participants') {
                $this->deleteEvents = Participant::where('name', 'like', '%' . $this->search . '%')->pluck('id')->toArray();
            } else {
                $this->deleteEvents = EventType::where('name', 'like', '%' . $this->search . '%')->pluck('id')->toArray();
            }
        } else {
            $this->deleteEvents = [];
        }

        $this->deleteEvents = array_map('intval', $this->deleteEvents);
        unset($this->items); 
    }

    public function updatedDeleteEvents()
    {
        $this->deleteEvents = array_map('intval', $this->deleteEvents);
        
        if ($this->currentTab === 'categories') {
            $totalCount = Category::where('name', 'like', '%' . $this->search . '%')->count();
        } else if ($this->currentTab === 'participants') {
            $totalCount = Participant::where('name', 'like', '%' . $this->search . '%')->count();
        } else {
            $totalCount = EventType::where('name', 'like', '%' . $this->search . '%')->count();
        }

        $this->selectAll = (count($this->deleteEvents) === $totalCount && $totalCount > 0);
    }

    private function checkIfCurrentPageIsAllSelected()
    {
        $currentPageIds = $this->items->pluck('id')->toArray();
        if (empty($currentPageIds)) {
            $this->selectAll = false;
            return;
        }
        $this->selectAll = count(array_intersect($currentPageIds, $this->deleteEvents)) === count($currentPageIds);
    }

    private function syncPageCheckboxes()
    {
        if ($this->selectAll) {
            if ($this->currentTab === 'categories') {
                $this->deleteEvents = Category::where('name', 'like', '%' . $this->search . '%')->pluck('id')->toArray();
            } else if ($this->currentTab === 'participants') {
                $this->deleteEvents = Participant::where('name', 'like', '%' . $this->search . '%')->pluck('id')->toArray();
            } else {
                $this->deleteEvents = EventType::where('name', 'like', '%' . $this->search . '%')->pluck('id')->toArray();
            }
            $this->deleteEvents = array_map('intval', $this->deleteEvents);
        }
    }

    private function resetSelectState()
    {
        $this->deleteEvents = [];
        $this->selectAll = false;
    }

    public function render()
    {
        if ($this->currentTab === 'categories' || $this->currentTab === 'participants') {
            $theads = ['', 'Name', ''];
        } else {
            $theads = ['', 'Name', 'Description', ''];
        }

        return view('livewire.super-admin.settings', [
            'data' => $this->items,
            'theads' => $theads,
        ]);
    }
}