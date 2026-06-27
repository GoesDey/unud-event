Alpine.data(
   'selectDropdown',
   ({ options = [], multiple = false, wireModel = null, initial = null }) => ({
      open: false,
      search: '',
      selected: initial !== null ? initial : multiple ? [] : '',
      options,

      init() {
         // Sync ke Livewire saat Alpine re-init
         if (wireModel) {
            this.$watch('$wire.' + wireModel, (value) => {
               this.selected = value ?? (multiple ? [] : '');
            });
         }
      },

      get filtered() {
         return this.options.filter((o) =>
            o.label.toLowerCase().includes(this.search.toLowerCase()),
         );
      },

      isSelected(value) {
         return multiple ? this.selected.includes(value) : this.selected === value;
      },

      toggle(value) {
         if (multiple) {
            this.selected.includes(value)
               ? (this.selected = this.selected.filter((v) => v !== value))
               : this.selected.push(value);
         } else {
            this.selected = this.selected === value ? '' : value;
            this.open = false;
         }

         if (wireModel) {
            this.$wire.set(wireModel, this.selected);
         }
      },

      getLabel(value) {
         return this.options.find((o) => o.value == value)?.label ?? '';
      },
   }),
);
