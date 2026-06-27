<?php

namespace App\Livewire\User;

use App\Models\Category;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Participant;
use Livewire\Component;
use Livewire\WithPagination;

class UserEvent extends Component
{
    use WithPagination;
    public string $search = '';
    public int $perPage = 2;

    public $activeEventType = null;
    public $activeCategory = null;
    public $activeParticipant = null;
    public $activeLocation = null;
    public $activePrice = null;

    public $eventTypes = [];
    public $categories = [];
    public $participants = [];
    public $locationOptions = [];
    public $priceOptions = [];

    public function mount()
    {
        $this->eventTypes = EventType::select('id', 'name')->get();
        $this->categories = Category::select('id', 'name')->get();
        $this->participants = Participant::select('id', 'name')->get();
        $this->priceOptions = [
            (object) ['id' => 'berbayar', 'name' => 'Berbayar'],
            (object) ['id' => 'gratis', 'name' => 'Gratis'],
        ];
        $this->locationOptions = [
            (object) ['id' => 'offline', 'name' => 'Offline'],
            (object) ['id' => 'online', 'name' => 'Online'],
        ];

    }
    public function updatingSearch()
    {
        $this->resetPage();
    } 
    public function setEventType($selectedEventType)
    {
        $this->activeEventType = $selectedEventType;
        $this->resetPage();
    } 
    public function setCategory($selectedCategory)
    {
        $this->activeCategory = $selectedCategory;
        $this->resetPage();
    } 
    public function setParticipant($selectedParticipant)
    {
        $this->activeParticipant = $selectedParticipant;
        $this->resetPage();
    }
    public function setPrice($selectedPrice)
    {
        $this->activePrice = $selectedPrice;
        $this->resetPage();
    }
    public function setLocation($selectedLocation)
    {
        $this->activeLocation = $selectedLocation;
        $this->resetPage();
    } 

    public function render()
    {

        $query = Event::with('eventType', 'categories', 'participants');

        if ($this->activeEventType) {
            $query->where('event_type_id', $this->activeEventType);
        }
        if ($this->activeCategory) {
        $query->whereHas('categories', function ($q) {
                $q->where('categories.id', $this->activeCategory);
            });
        }
        if ($this->activeParticipant) {
            $query->whereHas('participants', function ($q) {
                $q->where('participants.id', $this->activeParticipant);
            });
        }
        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        if ($this->activePrice) {
            if ($this->activePrice === 'berbayar') {
                $query->where('price', '>', 0);
            } 
            elseif ($this->activePrice === 'gratis') {
                $query->where(function($q) {
                    $q->where('price', 0)->orWhereNull('price');
                });
            }
        }
        if ($this->activeLocation) {
            $query->where('location', $this->activeLocation);
        }

        // dd($query->get());
        return view('livewire.user.user-event', [
            'events' => $query->paginate($this->perPage),
        ])->extends('layouts.user-layout')->section('content')->layoutData(['title' => 'Events']);
    }
}
