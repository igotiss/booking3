<template>
    <div class="search-panel mb-3 bg-success bg-opacity-10">
        <nav class="navbar-brand ">
            <div class="qwe"></div>
            <div class="container-fluid justify-content-center">
                <form class="d-flex row" role="search" >
                    <div class="input-group ">
                        <input type="text" aria-label="First name" v-model="searchLocation" placeholder="Куди ви вирушаєте?" class="form-control ml">
                        <input type="text"  placeholder="Дата заїзду" class="form-control" onfocus="(this.type = 'date')">
                        <input type="text"  placeholder="Дата виїзду" class="form-control" onfocus="(this.type = 'date')">
                        <input class="form-control" type="number" v-model="searchRooms" placeholder="Кількість номерів" aria-label="Search">
                        <input class="form-control" type="number" placeholder="Кількість ліжок" aria-label="Search">
                        <button class="btn btn-outline-warning"  @click.prevent="searchedStays">Шукати</button>

                    </div>
                </form>
            </div>
        </nav>
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
                        <li><input type="checkbox" v-model="checkedFilters" @change="check($event)" value="hotel"> Готелі ({{hotels}})</li>
                        <li><input type="checkbox" v-model="checkedFilters" @change="check($event)" value="apartment"> Квартири ({{types.apartments}})</li>
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

    <div class="content p-3">
        <h5 class="mt-3 p-3" v-if="stays.length">Знайдено помешкань: {{stays.length}} </h5>
        <h5 class="mt-3 p-3" v-else="total">Пoмешкань не знайдено </h5>

        <div class="card mb-3 " v-for="stay in stays" :key="stay.id">
            <div class="row g-0">
                <div class="col-md-4 stay-image p-2">
                    <a :href="'stays/'+stay.id">
                    <img v-if="stay.image" :src="'uploads/stays/'+stay.image"  class="card-img-stays p-2" >
                    <svg v-else class="bd-placeholder-img img-fluid rounded-start" width="100%" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image</text></svg>
                    </a>
                </div>

                <div class="col-md-8">
                    <div class="card-body pb-2">
                        <div class="d-flex flex-row justify-content-between align-items-baseline">
                            <a :href="'stays/'+stay.id">
                                <h3 class="card-title">{{stay.title}}</h3>
                            </a>

                            <p class="card-text" ><small class="text-muted">Тип помешкання: <strong>
                                <span v-if="stay.type === 'hotel'">Готель</span>
                                <span v-else-if="stay.type === 'apartment'">Квартира</span>
                                <span v-else-if="stay.type === 'resort'">Курорт</span>
                                <span v-else-if="stay.type === 'villa'">Вілла</span>
                                <span v-else="stay.type === 'cottage'">Котедж</span>
                            </strong></small></p>
                            <a href="#">
                                <h5>Рейтинг 9.8</h5>
                                4 відгуки
                            </a>
                        </div>
                        <p class="card-text me-2"><small class="text-muted">Локація: <span class="stay-location">{{ stay.location }}</span></small></p>
                        <p class="card-text">
                            Опис:
                            <i>{{stay.description}}</i>
                        </p>
                        <p class="card-text">
                            Зручності:
                            <i>{{stay.amenities}}</i>

                        </p>
                        <p class="card-text ">
                            Кімнат:
                            <strong>{{stay.rooms}}</strong>

                            <span class="card-text p-2">
                                Ліжок:
                                <strong>{{stay.beds}}</strong>
                            </span>
                        </p>
                        <h5 class="card-text stay-price">Ціна: <strong> {{stay.price}} грн.</strong></h5>

                        <button  class="btn btn-primary mt-3">Забронювати</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--    <Pagination  :data="stays" @pagination-change-page="getStays" align="center" activeClassIn="false">
        <template #prev-nav>
            <span>&lt; Попередня</span>
        </template>
        <template #next-nav>
            <span>Наступна &gt;</span>
        </template>
        <template #active-nav>
            <span>Поточна&gt;</span></template>
    </Pagination>-->

</template>

<script>


import {forEach} from "lodash";

export default {
    name: "StaysGrid",
    data() {
        return {
            searchLocation: "",
            searchRooms: 0,
            stays: {},
            types: {},
            checkedFilters: [],
            numbers: [ 1, 2, 3, 4, 5 ]
        }
    },
    methods: {
        async getStays(page = 1) {
            await axios.get('api/stays')
                .then(response => {
                    this.stays = response.data.data;
                });
        },
        async getTypes() {
            await axios.get('api/types')
                .then(response =>{
                    this.types = response.data;
                })
        },
        check(e) {
            console.log(this.checkedFilters)
        },

        searchedStays() {
            if(this.searchLocation.length || this.searchRooms > 0) {


                this.stays =  this.stays.filter( stay => stay.location.toLowerCase().includes(this.searchLocation.toLowerCase()) );
                if (this.searchRooms > 0) {
                    this.stays =  this.stays.filter(stay => stay.rooms ===(this.searchRooms) );
                }

                // Types && stay.rooms ===(this.searchRooms)
                this.types.hotels = this.stays.filter(obj=>obj.type === 'hotel').length;
                this.types.apartments = this.stays.filter(obj=>obj.type === 'apartment').length;
                this.types.resorts = this.stays.filter(obj=>obj.type === 'resort').length;
                this.types.villas = this.stays.filter(obj=>obj.type === 'villa').length;
                this.types.cottages = this.stays.filter(obj=>obj.type === 'cottage').length;

            } else {
                this.stays = this.getStays();
                this.types = this.getTypes();
            }
        },
    },
    mounted() {
        this.getStays();
        this.getTypes();
    },
    computed: {
        hotels: function () {
            if(this.stays.length){
                return this.stays.filter(obj=>obj.type === 'hotel').length;
            } else {
                return 0;
            }

        },
        evenNumbers: function () {
            return this.numbers.filter(function (number) {
                return number % 2 === 0
            })
        }

    }




}
</script>

<style scoped>

</style>
