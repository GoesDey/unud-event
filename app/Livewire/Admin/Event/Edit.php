<?php

namespace App\Livewire\Admin\Event;

use App\Models\Category;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Participant;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin-layout')]
#[Title('Edit Event')]
class Edit extends Component
{
   use WithFileUploads;

   #[Validate('required|string|min:8|max:255', 'nama')]
   public string $name;
   #[Validate('required|string|min:20|max:5000', 'deskripsi')]
   public string $description;
   #[Validate('required|date', 'tanggal mulai')]
   public $start_date;
   #[Validate('required|date|after_or_equal:start_date', 'tanggal selesai')]
   public $end_date;
   #[Validate('required|in:online,offline', 'lokasi')]
   public $location;
   #[Validate('required', 'tipe event')]
   public $eventType;
   #[Validate('required|array|min:1', 'kategori event')]
   public $eventCategories = [];
   #[Validate('required|array|min:1', 'partisipan')]
   public $eventParticipants = [];
   #[Validate('nullable|numeric|min:0|decimal:0,2', 'biaya event')]
   public $price;
   #[Validate('required|url|max:255', 'link pendaftaran')]
   public $regisLink;
   public $picture;

   public array $details = [['field' => '', 'value' => '']];
   public array $timelines = [['description' => '', 'start' => '', 'end' => '']];

   public string $lembaga;
   public string $instance;
   public string $faculty;
   public string $major;

   public $step = 1;
   public $totalStep = 4;
   public Event $event;

   public function mount(Event $event)
   {
      $user = auth()->user();
      $this->lembaga = $user->name ?? '';
      $this->faculty = $user->faculty->name ?? '';
      $this->major = $user->major->name ?? '';
      $this->instance = $user->instance ?? 'Universitas Udayana';

      $this->event = $event;

      $this->name = $event->name;
      $this->description = $event->description;
      $this->start_date = $event->start_date;
      $this->end_date = $event->end_date;
      $this->location = $event->location;
      $this->eventType = $event->event_type_id;
      $this->price = $event->price;
      $this->regisLink = $event->link;
      $this->picture = $event->picture;
      $this->eventCategories = $event->categories->pluck('id')->toArray();
      $this->eventParticipants = $event->participants->pluck('id')->toArray();

      $this->details = $event->detailEvents->isNotEmpty()
         ? $event->detailEvents
            ->map(
               fn($d) => [
                  'field' => $d->label,
                  'value' => $d->value,
               ],
            )
            ->toArray()
         : [['field' => '', 'value' => '']];

      $this->timelines = $event->timelines->isNotEmpty()
         ? $event->timelines
            ->map(
               fn($d) => [
                  'description' => $d->description,
                  'start' => $d->start->format('Y-m-d\TH:i'),
                  'end' => $d->end->format('Y-m-d\TH:i'),
               ],
            )
            ->toArray()
         : [['description' => '', 'start' => '', 'end' => '']];

      // dd($this->timelines);
   }

   public function updatedLocation(): void
   {
      $this->validateOnly('location');
   }

   public function nextStep()
   {
      $this->validateStep();
      $this->step++;
   }
   public function prevStep()
   {
      $this->step--;
   }

   public function validateStep(): void
   {
      match ($this->step) {
         1 => $this->validate(
            [
               'picture' => is_string($this->picture)
                  ? 'nullable'
                  : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
               'name' => 'required|string|min:8|max:255',
               'description' => 'required|string|min:20|max:5000',
               'start_date' => 'required|date',
               'end_date' => 'required|date|after_or_equal:start_date',
               'location' => 'required|in:online,offline',
               'eventType' => 'required',
               'eventCategories' => 'required|array|min:1',
               'eventParticipants' => 'required|array|min:1',
               'price' => 'nullable|numeric|min:0|decimal:0,2',
               'regisLink' => 'nullable|url|max:255',
            ],
            [],
            ['picture' => 'gambar/poster'],
         ),
         2 => $this->validateDetails(),
         3 => $this->validateTimelines(),
         4 => $this->validate(
            [
               'faculty' => 'nullable|string|max:50|min:3',
               'major' => 'nullable|string|max:50|min:3',
               'instance' => 'nullable|string|max:50|min:3',
            ],
            [],
            [
               'faculty' => 'fakultas',
               'major' => 'program studi',
               'instance' => 'instansi',
            ],
         ),
      };
   }

   public function validateDetails(): void
   {
      $this->details = collect($this->details)
         ->filter(fn($d) => $d['field'] || $d['value'])
         ->values()
         ->toArray();

      if (count($this->details) > 0) {
         $this->validate(
            [
               'details.*.field' => 'required|string|max:255|min:3',
               'details.*.value' => 'required|string|max:5000|min:3',
            ],
            [],
            ['details.*.field' => 'nama info', 'details.*.value' => 'value'],
         );
      }
   }

   public function validateTimelines(): void
   {
      $this->timelines = collect($this->timelines)
         ->filter(fn($t) => $t['description'] || $t['start'] || $t['end'])
         ->values()
         ->toArray();

      if (count($this->timelines) > 0) {
         $this->validate(
            [
               'timelines.*.start' => 'required|date',
               'timelines.*.end' => 'required|date|after_or_equal:timelines.*.start',
               'timelines.*.description' => 'required|string|max:5000|min:3',
            ],
            [],
            [
               'timelines.*.start' => 'waktu mulai',
               'timelines.*.end' => 'waktu selesai',
               'timelines.*.description' => 'deskripsi',
            ],
         );
      }
   }

   public function addDetail(): void
   {
      $this->details[] = ['field' => '', 'value' => ''];
   }

   public function removeDetail(int $index): void
   {
      array_splice($this->details, $index, 1);
   }

   public function addTimeline(): void
   {
      $this->timelines[] = ['description' => '', 'start' => '', 'end' => ''];
   }

   public function removeTimeline(int $index): void
   {
      array_splice($this->timelines, $index, 1);
   }

   public function update()
   {
      $this->validateStep();

      $picturePath = is_string($this->picture)
         ? $this->picture
         : $this->picture->store('events', 'public');

      $this->event->update([
         'event_type_id' => $this->eventType,
         'name' => $this->name,
         'description' => $this->description,
         'faculty' => $this->faculty ?: null,
         'major' => $this->major ?: null,
         'instance' => $this->instance ?: null,
         'picture' => $picturePath,
         'link' => $this->regisLink,
         'location' => $this->location,
         'price' => $this->price ?: null,
         'start_date' => $this->start_date,
         'end_date' => $this->end_date,
      ]);

      $this->event->categories()->sync($this->eventCategories);
      $this->event->participants()->sync($this->eventParticipants);

      $this->event->detailEvents()->delete();
      $filteredDetails = collect($this->details)
         ->filter(fn($d) => $d['field'] && $d['value'])
         ->values();
      foreach ($filteredDetails as $detail) {
         $this->event->detailEvents()->create([
            'label' => $detail['field'],
            'value' => $detail['value'],
         ]);
      }

      $this->event->timelines()->delete();
      $filteredTimelines = collect($this->timelines)
         ->filter(fn($t) => $t['description'] && $t['start'] && $t['end'])
         ->values();
      foreach ($filteredTimelines as $timeline) {
         $this->event->timelines()->create($timeline);
      }

      redirect()->route('admin.manage-event');
   }

   public function render()
   {
      return view('livewire.admin.event.edit', [
         'types' => EventType::get(['id', 'name'])
            ->map(fn($t) => ['value' => $t->id, 'label' => $t->name])
            ->toArray(),
         'categories' => Category::get(['id', 'name'])
            ->map(fn($c) => ['value' => $c->id, 'label' => $c->name])
            ->toArray(),
         'participants' => Participant::all()
            ->map(fn($c) => ['value' => $c->id, 'label' => $c->name])
            ->toArray(),
      ]);
   }
}
