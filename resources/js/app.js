require('./bootstrap');


import { createApp } from "vue";
import SearchPanel from "./components/SearchPanel";
import StaysGrid from "./components/StaysGrid";
import LaravelVuePagination from "laravel-vue-pagination";

const app = createApp({})
app.component('search-panel', SearchPanel);
app.component('stays-grid', StaysGrid);
app.component('Pagination', LaravelVuePagination);
app.mount('#app')
