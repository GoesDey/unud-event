@props ([
   'label',
   'model' => null,
   'classLabel' => '',
   'borderClass' => 'border-[#001524]/60 focus:border-black',
   'type' => 'date'
])

<div class="w-full">
   @if ($label)
      <label for="{{ $model }}" @class (['font-semibold block', $classLabel])>{{ $label }}</label>
   @endif

   <input
      type="{{ $type }}"
      onclick="this.showPicker()"
      id="{{ $model }}"
      name="{{ $model }}"
      @if ($model) wire:model.live.debounce.300ms="{{ $model }}" @endif
      {{
         $attributes->class([
            'rounded-[10px] w-full border text-[#001524] px-3 py-3 text-sm font-medium focus:outline-none bg-white',
            $borderClass => !$errors->has($model),
            'border-red-500 focus:border-red-500' => $errors->has($model),
         ])
      }}
   />

   @error ($model)
      <span class="text-sm text-red-500">{{ $message }}</span>
   @enderror
</div>
