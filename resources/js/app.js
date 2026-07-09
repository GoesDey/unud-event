import intersect from "@alpinejs/intersect";

document.addEventListener("livewire:init", () => {
    window.Alpine.plugin(intersect);
});
