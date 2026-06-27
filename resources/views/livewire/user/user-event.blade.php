@php
    $current = $events->currentPage();
    $last = $events->lastPage();
    $first = 1;
@endphp
<div>
    <section class="-mx-16 -mt-16 relative bg-white pb-12">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -bottom-50 left-1/2 -translate-x-1/2 translate-y-1/2 w-[140%] aspect-3/1 rounded-[50%] bg-blue-50"></div>
        </div>
        
        <div class="relative z-10 py-16 text-center">
            <div class="text-center font-bold text-[40px] text-primary mb-6">
                <p>Cari <span class="bg-primary text-white px-2 py-1 rounded-lg">Event</span> yang Kamu</p>
                <p>Minati!</p>
            </div>

            <div class="flex gap-4 justify-center mb-3">
                <input wire:model.live.debounce.300ms="search" class="p-3 w-143 border-2 border-primary rounded-lg bg-white text-primary font-bold text-lg" placeholder="Cari Event" type="text" >
                <x-button class="w-39! bg-secondary shadow-md shadow-primary/25">Cari</x-button> 
            </div>
            
            <div class="flex gap-4 justify-center flex-wrap">
                <x-filter-dropdown :data="$eventTypes" methodName="setEventType" label="Pilih Tipe Event" />
                <x-filter-dropdown :data="$categories" methodName="setCategory" label="Pilih Kategori" />
                <x-filter-dropdown :data="$participants" methodName="setParticipant" label="Pilih Partisipan" />
                <x-filter-dropdown :data="$priceOptions" methodName="setPrice" label="Pilih Pembayaran" />
                <x-filter-dropdown :data="$locationOptions" methodName="setLocation" label="Pilih Lokasi" />
            </div>
        </div>
    </section>

    <section class="py-16 w-full">
        <h2 class="text-center font-bold text-[40px] text-primary">
            Jelajahi Event-Event Menarik dengan
        </h2>
        <h2 class="text-center font-bold text-[40px] text-primary mb-9">Berbagai Benefit</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse ($events as $event)
                <x-event-card :data="$event" />
            @empty
                <div class="col-span-full text-center py-12 text-4xl text-slate-400">
                    Tidak ada event ditemukan.
                </div>
            @endforelse
        </div>

        <div class="flex mt-5 w-full items-center text-2xl justify-between">
               <strong class="font-semibold text-primary">Show {{ $events->firstItem() ?? 0 }} to {{ $events->lastItem() ?? 0 }} of {{ $events->total() }} entries</strong>
               <div class="flex items-center gap-2.5">
                    <button type="button" 
                        wire:click="previousPage" 
                        wire:loading.attr="disabled" 
                        @disabled($events->onFirstPage())
                        class="size-12 flex items-center justify-center rounded-lg transition-all {{ $events->onFirstPage() ? 'bg-zinc-200 text-zinc-400 cursor-not-allowed' : 'bg-secondary text-white hover:bg-amber-500' }}">
                        
                        {{-- Panah menghadap ke kiri (rotate-90) --}}
                        <x-icons.down-arrow class="rotate-90 size-6 stroke-3" />
                    </button>

                    <div class="flex items-center gap-2">
                    @if ($last == 1)
                        <button disabled class="size-12 text-white bg-primary cursor-not-allowed rounded-lg">
                            1
                        </button>
                    @else
                        <button type="button" wire:click="gotoPage(1)" wire:loading.attr="disabled" 
                            class="size-12 flex items-center justify-center rounded-lg font-bold text-lg transition-colors {{ $current == 1 ? 'text-white bg-primary' : 'bg-white text-primary border-2 border-primary' }}">
                            1
                        </button>

                        @if ($current > 3)
                            <div class="size-12 flex items-center justify-center text-primary font-bold tracking-widest">...</div>
                        @endif

                        @if ($current > 2)
                            <button type="button" wire:click="gotoPage({{ $current - 1 }})" wire:loading.attr="disabled" 
                                class="size-12 flex items-center justify-center rounded-lg bg-white text-primary border-2 border-primary font-bold text-lg transition-colors">
                                {{ $current - 1 }}
                            </button>
                        @endif

                        @if ($current != 1 && $current != $last)
                            <button type="button" disabled 
                                class="size-12 flex items-center justify-center rounded-lg bg-primary text-white font-bold text-lg cursor-default">
                                {{ $current }}
                            </button>
                        @endif

                        @if ($current < $last - 1)
                            <button type="button" wire:click="gotoPage({{ $current + 1 }})" wire:loading.attr="disabled" 
                                class="size-12 flex items-center justify-center rounded-lg bg-white text-primary border-2 border-primary font-bold text-lg transition-colors">
                                {{ $current + 1 }}
                            </button>
                        @endif

                        @if ($current < $last - 2)
                            <div class="size-12 flex items-center justify-center text-primary font-bold tracking-widest">...</div>
                        @endif

                        <button type="button" wire:click="gotoPage({{ $last }})" wire:loading.attr="disabled" 
                            class="size-12 flex items-center justify-center rounded-lg font-bold text-lg transition-colors {{ $current == $last ? 'bg-primary text-white' : 'bg-white text-primary border-2 border-primary' }}">
                            {{ $last }}
                        </button>
                    @endif
                </div>
                    <button type="button" 
                        wire:click="nextPage" 
                        wire:loading.attr="disabled" 
                        @disabled(!$events->hasMorePages())
                        class="size-12 flex items-center justify-center rounded-lg transition-all {{ !$events->hasMorePages() ? 'bg-zinc-200 text-zinc-400 cursor-not-allowed' : 'bg-secondary text-white hover:bg-amber-500' }}">
                        <x-icons.down-arrow class="-rotate-90 size-6 stroke-3" />
                    </button>
               </div>
          </div>

    </section>

</div>