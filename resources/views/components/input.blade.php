@props ([
   'label' => '',
   'name' => '',
   'type' => 'text',
   'classLabel' => '',
   'classInput' => '',
   'placeholder' => '',
   'borderClass' => 'border-[#001524]/60 focus:border-black',
   'icon' => '',
   'rows' => 2,
   'value' => '',
   'noError' => false,
   'togglePass' => false
])

<div
   {{
      $attributes
         ->only('class')
         ->class(['flex flex-col gap-1 transition duration-300'])
   }}
>
   @if ($label)
      <label for="{{ $name }}" @class (['font-semibold block', $classLabel])>{{ $label }}</label>
   @endif

   <div @class (['relative flex items-center']) @if ($togglePass) x-data="{ show: false }" @endif>
      @if ($icon)
         <div class="absolute inset-y-0 left-3 flex items-center">
            <x-dynamic-component
               :component="'icons.' . $icon"
               class="size-4.5! text-[#001524]/60!"
            />
         </div>
      @endif

      @if ($type === 'text area')
         <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            rows="{{ $rows }}"
            placeholder="{{ $placeholder }}"
            {{
               $attributes->except([
                  'class',
                  'classLabel',
                  'classInput',
                  'icon',
                  'togglePass',
                  'value',
                  'placeholder',
                  'rows',
                  'type',
                  'label',
                  'name',
                  'noError',
                  'borderClass',
               ])
            }}
            @class ([
               'rounded-[10px] w-full border text-[#001524] px-3 py-3 text-sm font-medium focus:outline-none',
               $borderClass => !$errors->has($name),
               'border-red-500 focus:border-red-500' => $errors->has($name),
               $classInput,
               'pl-10' => $icon
            ])
            >{{ old($name, $value) }}</textarea
         >
      @else
         <input
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ $type === 'checkbox' ? $value : old($name, $value) }}"
            {{
               $attributes->except([
                  'class',
                  'classLabel',
                  'classInput',
                  'icon',
                  'togglePass',
                  'value',
                  'placeholder',
                  'rows',
                  'type',
                  'label',
                  'name',
                  'noError',
                  'borderClass',
               ])
            }}
            @if ($togglePass)
               :type="show ? 'text' : 'password'"
            @else
               type="{{ $type }}"
            @endif
            placeholder="{{ $placeholder }}"
            @class ([
               'rounded-[10px] w-full border text-[#001524] px-3 py-3 text-sm font-medium focus:outline-none',
               $borderClass => !$errors->has($name),
               'border-red-500 focus:border-red-500' => $errors->has($name),
               $classInput,
               'pl-10' => $icon
            ])
         />
      @endif

      @if ($togglePass)
         <button
            type="button"
            class="absolute inset-y-0 right-3 flex cursor-pointer items-center text-gray-400 hover:text-gray-600"
            @click="show = !show"
         >
            <x-icons.eye x-show="!show" class="size-4.5 text-[#001524]!" />
            <x-icons.eye-off x-show="show" class="size-4.5 text-[#001524]!" />
         </button>
      @endif
   </div>

   @if (!$noError)
      @error ($name)
         <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
   @endif
</div>
