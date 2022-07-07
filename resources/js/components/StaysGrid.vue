<template>
    <div class="search-wrapper">
        <input type="text" v-model="search" placeholder="Search title.."/>
        <button class="btn btn-outline-success" @click="filteredStays">search</button>

    </div>
<div class="d-flex">

    <div class="flex-shrink-0 p-3 bg-white border border-info" style="width: 280px;">
        <a href="#" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
            <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-5 fw-bold">Сортувати за такими критеріями</span>
        </a>
        <ul class="list-unstyled ps-0">
            <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                    Тип помешкання
                </button>
                <div class="collapse show" id="home-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><input type="checkbox"> Готелі ({{types.hotels}})</li>
                        <li><input type="checkbox"> Квартири ({{types.apartments}})</li>
                        <li><input type="checkbox"> Курорти ({{types.resorts}})</li>
                        <li><input type="checkbox"> Вілли ({{types.villas}})</li>
                        <li><input type="checkbox"> Котеджі ({{types.cottages}})</li>

                    </ul>
                </div>
            </li>

            <li class="border-top my-3"></li>
            <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                    Account
                </button>
                <div class="collapse" id="account-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New...</a></li>
                        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Profile</a></li>
                        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Settings</a></li>
                        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Sign out</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

    <div class="content">
        <h5 class="mt-3 p-3" v-if="total">Знайдено помешкань: {{total}} </h5>
        <h5 class="mt-3 p-3" v-else="total">Пoмешкань не знайдено </h5>

        <div class="card mb-3" v-for="stay in stays" :key="stay.id">
            <div class="row g-0">
                <div class="col-md-4 stay-image p-2">
                    <svg class="bd-placeholder-img img-fluid rounded-start" width="100%" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image</text></svg>
                </div>
                <div class="col-md-8">
                    <div class="card-body pb-2">
                        <div class="d-flex flex-row justify-content-between align-items-baseline">
                            <h3 class="card-title">{{stay.title}}</h3>
                            <p class="card-text" ><small class="text-muted">Тип помешкання: <strong>{{stay.type}}</strong></small></p>
                        </div>
                        <p class="card-text me-2"><small class="text-muted">Локація: <span class="stay-location">{{ stay.location }}</span></small></p>
                        <p class="card-text">{{stay.description}}</p>
                        <h5 class="card-text stay-price">Ціна: <strong> {{stay.price}} грн.</strong></h5>

                        <button  class="btn btn-primary mt-3">Забронювати</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <Pagination  :data="stays" @pagination-change-page="getStays" align="center" activeClassIn="false">
        <template #prev-nav>
            <span>&lt; Попередня</span>
        </template>
        <template #next-nav>
            <span>Наступна &gt;</span>
        </template>
        <template #active-nav>
            <span>Поточна&gt;</span></template>
    </Pagination>

</template>

<script>

import { ref } from "vue";
export default {
    name: "StaysGrid",
    data() {
        return {
            search: "",
            stays: {},
            total: 0,
            types: {},
        }
    },
    methods: {
        async getStays(page = 1) {
            await axios.get('api/stays?page=' + page)
                .then(response => {
                    this.stays = response.data.data;
                    this.total = response.data.meta.total;
                });
        },
        async getTypes() {
            await axios.get('api/types')
                .then(response =>{
                    this.types = response.data;
                    console.log(this.types)
                })
        },
        filteredStays() {
            const searchRes =  this.stays.filter(stay =>
                stay.title.toLowerCase().includes(this.search.toLowerCase())
            );
            console.log(this.search.toLowerCase());

    },
    },
    mounted() {
        this.getStays();
        this.getTypes();
    },
}
</script>

<style scoped>

</style>
