@props(['label' => 'Tipe Event', 'width' => 'fit' ,'data' => [], 'methodName' => 'setCategory'])

<div class="relative inline-block text-left" x-data="{ isShow : false, currentLabel: '{{ $label }}' }" >
     <button x-on:click="isShow = !isShow; console.log('klik')" 
             {{ $attributes->merge(['class' => "flex $width h-fit items-center justify-between gap-3 bg-primary p-3 text-white rounded-lg select-none cursor-pointer"]) }}>
          <p class="font-bold text-base" x-text="currentLabel"></p>
          <x-icons.down-arrow class="text-primary-50 transition-transform duration-200" x-bind:class="isShow ? 'rotate-180' : 'rotate-0'" />
     </button>

     <div x-show="isShow" 
          @click.outside="isShow = false" 
          class="absolute left-0 mt-2 z-50 bg-white rounded-lg border border-primary overflow-hidden shadow-lg min-w-full"
          style="display: none;"
          x-transition:enter="transition ease-out duration-100"
          x-transition:enter-start="opacity-0 scale-95"
          x-transition:enter-end="opacity-100 scale-100"
          x-transition:leave="transition ease-in duration-75"
          x-transition:leave-start="opacity-100 scale-100"
          x-transition:leave-end="opacity-0 scale-95">
          
          <div class="{{ $width }} flex flex-col divide-y divide-primary-50 max-h-80 overflow-y-auto">
               @foreach ($data as $product)
                    <button wire:click="{{ $methodName }}('{{ $product->id }}')" type="button"
                         x-on:click="currentLabel = '{{ $product->name }}'; isShow = false"
                         class="w-full block text-left px-4 py-2.5 text-sm text-zinc-600 hover:bg-zinc-50 active:bg-zinc-100 transition-colors cursor-pointer"
                         > {{ $product->name }}
                    </button>
               @endforeach
               <button type="button"
                    wire:click="{{ $methodName }}('')"
                    x-on:click="currentLabel = '{{ $label }}'; isShow = false"
                    class="w-full block text-center px-4 py-2.5 text-sm text-rose-600 font-medium hover:bg-rose-50 active:bg-rose-100 transition-colors cursor-pointer"
                    > Clear Filter
               </button>
          </div>
     </div>
</div>