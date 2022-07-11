require('./bootstrap');
import $ from 'jquery';

import 'jquery-ui/ui/widgets/datepicker.js';

import { createApp } from "vue";
import StaysGrid from "./components/StaysGrid";
import SearchPanel from "./components/SearchPanel";
import LaravelVuePagination from "laravel-vue-pagination";
import ShowRating from "./components/ShowRating";

const app = createApp({})
app.component('stays-grid', StaysGrid);
app.component('search-panel', SearchPanel);
app.component('Pagination', LaravelVuePagination);
app.component('show-rating', ShowRating);
app.mount('#app')


//appends an "active" class to .popup and .popup-content when the "Open" button is clicked
$(".open").on("click", function() {
    $(".popup-overlay, .popup-content").addClass("active");

});

//removes the "active" class to .popup and .popup-content when the "Close" button is clicked
$(".close, .popup-content").on("click", function() {
    $(".popup-overlay, .popup-content").removeClass("active");
});





