@props ([ 'label' => 'Tipe Event', 'width' => 'fit', 'data' => [], 'methodName' => 'setCategory' ])

<div
   class="relative inline-block text-left"
   x-data="{ isShow : false, currentLabel: '{{ $label }}' }"
>
   <button
      x-on:click="
         isShow = !isShow;
         console.log('klik');
      "
      {{
         $attributes->merge([
            'class' => "flex $width h-fit items-center justify-between gap-3 bg-primary p-3 text-white rounded-lg select-none cursor-pointer",
         ])
      }}
   >
      <p class="text-base font-bold" x-text="currentLabel"></p>
      <x-icons.down-arrow
         class="text-primary-50 transition-transform duration-200"
         x-bind:class="isShow ? 'rotate-180' : 'rotate-0'"
      />
   </button>

   <div
      x-show="isShow"
      @click.outside="isShow = false"
      class="border-primary absolute left-0 z-50 mt-2 min-w-full overflow-hidden rounded-lg border bg-white shadow-lg"
      style="display: none"
      x-transition:enter="transition ease-out duration-100"
      x-transition:enter-start="opacity-0 scale-95"
      x-transition:enter-end="opacity-100 scale-100"
      x-transition:leave="transition ease-in duration-75"
      x-transition:leave-start="opacity-100 scale-100"
      x-transition:leave-end="opacity-0 scale-95"
   >
      <div class="{{ $width }} flex flex-col divide-y divide-primary-50 max-h-80 overflow-y-auto">
         @foreach ($data as $product)
            <button
               wire:click="{{ $methodName }}('{{ $product->id }}')"
               type="button"
               x-on:click="currentLabel = '{{ $product->name }}'; isShow = false"
               class="block w-full cursor-pointer px-4 py-2.5 text-left text-sm text-zinc-600 transition-colors hover:bg-zinc-50 active:bg-zinc-100"
            >
               {{ $product->name }}
            </button>
         @endforeach
         <button
            type="button"
            wire:click="{{ $methodName }}('')"
            x-on:click="currentLabel = '{{ $label }}'; isShow = false"
            class="block w-full cursor-pointer px-4 py-2.5 text-center text-sm font-medium text-rose-600 transition-colors hover:bg-rose-50 active:bg-rose-100"
         >
            Clear Filter
         </button>
      </div>
   </div>
</div>
