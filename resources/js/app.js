import "./bootstrap";
import "./flash";

import Alpine from "alpinejs";
import focus from '@alpinejs/focus'
import collapse from '@alpinejs/collapse'

Alpine.plugin(focus)
Alpine.plugin(collapse)

window.Alpine = Alpine;

if (window.Livewire) {
    window.Livewire.start();
}

Alpine.start();
