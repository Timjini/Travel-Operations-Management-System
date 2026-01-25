import "./bootstrap";
import "./flash";

import Alpine from "alpinejs";
import focus from '@alpinejs/focus'

window.Alpine = Alpine;
Alpine.plugin(focus)

Alpine.start();


// /** Auth  */
// document.addEventListener('alpine:init', () => {
//     console.log("loading function")
// function togglePassword(input)
// {
//     const el = document.getElementById(input);
//     if (el.type === 'password')
//     {
//         el.type = 'text';
//     } else 
//     {
//         el.type = 'password';
//     }
// }
// });