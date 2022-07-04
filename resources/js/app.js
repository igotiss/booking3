require('./bootstrap');


import { createApp } from "vue";
import SearchPanel from "./components/SearchPanel";

const app = createApp({})
app.component('search-panel', SearchPanel);
app.mount('#app')
