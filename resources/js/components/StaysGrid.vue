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
                        <input class="form-control" type="number" placeholder="Кількість туристів" aria-label="Search">
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
                    <h5 class="text-decoration-underline"> Тип помешкання</h5>
                </button>
                <div class="collapse show" id="home-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><input type="checkbox" v-model="checkedFiltersTypes" @change="filterTypes" value="hotel"> Готелі ({{typesReactive.hotels ? typesReactive.hotels : 0}})</li>
                        <li><input type="checkbox" v-model="checkedFiltersTypes" @change="filterTypes" value="apartment"> Квартири ({{typesReactive.apartments ? typesReactive.apartments : 0}})</li>
                        <li><input type="checkbox" v-model="checkedFiltersTypes" @change="filterTypes" value="resort"> Курорти ({{typesReactive.resorts ? typesReactive.resorts : 0}})</li>
                        <li><input type="checkbox" v-model="checkedFiltersTypes" @change="filterTypes" value="villa"> Вілли ({{typesReactive.villas ? typesReactive.villas : 0}})</li>
                        <li><input type="checkbox" v-model="checkedFiltersTypes" @change="filterTypes" value="cottage"> Котеджі ({{typesReactive.cottages ? typesReactive.cottages : 0}})</li>
                    </ul>
                </div>
            </li>

            <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                   <h5 class="text-decoration-underline"> Зручності</h5>
                </button>
                <div class="collapse show" id="home-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><input type="checkbox" v-model="checkedFiltersAmenities" @change="filterTypes" value="WiFi"> WiFi ({{typesReactive.wiFi ? typesReactive.wiFi : 0}})</li>
                        <li><input type="checkbox" v-model="checkedFiltersAmenities" @change="filterTypes" value="кабельне TV"> кабельне TV ({{typesReactive.tv ? typesReactive.tv : 0}})</li>
                        <li><input type="checkbox" v-model="checkedFiltersAmenities" @change="filterTypes" value="джакузі"> джакузі ({{typesReactive.jacuzzi ? typesReactive.jacuzzi : 0}})</li>
                        <li><input type="checkbox" v-model="checkedFiltersAmenities" @change="filterTypes" value="басейн"> басейн ({{typesReactive.pool ? typesReactive.pool : 0}})</li>
                    </ul>
                </div>
            </li>

            <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                    <h5 class="text-decoration-underline"> Бюджет за ніч</h5>
                </button>
                <div class="collapse show" id="home-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><input type="checkbox" v-model="checkedFiltersPrices" @change="filterTypes" value="low99"> до 100 грн за добу ({{typesReactive.lowerHundred ? typesReactive.lowerHundred : 0}})</li>
                        <li><input type="checkbox" v-model="checkedFiltersPrices" @change="filterTypes" value="100-500"> 100 - 499 грн за добу  ({{typesReactive.oneFiveHundred ? typesReactive.oneFiveHundred : 0}})</li>
                        <li><input type="checkbox" v-model="checkedFiltersPrices" @change="filterTypes" value="500-1000">  500 - 999 грн за добу ({{typesReactive.fiveHundredThousand ? typesReactive.fiveHundredThousand : 0}})</li>
                        <li><input type="checkbox" v-model="checkedFiltersPrices" @change="filterTypes" value="hi1000"> Більше 1000 грн за добу ({{typesReactive.upperThousand ? typesReactive.upperThousand : 0}})</li>
                    </ul>
                </div>
            </li>

            <li class="border-top my-3"></li>

        </ul>
    </div>

    <div class="content p-3" v-if="filtersOn">
        <h5 class="mt-3 p-3" >Показано відфільтрованих помешкань: {{filteredStays.length}} </h5>
        <div class="card mb-3 " v-for="stay in filteredStays" :key="stay.id">
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

                            <a :href="'stays/'+stay.id">
                                <show-rating


                                ></show-rating>

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
                        <a :href="'booking/'+stay.id">
                            <button  class="btn btn-primary mt-3">Забронювати</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content p-3" v-else>
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
                            <a :href="'stays/'+stay.id">
                                    <show-rating :rating="stay.ratings"></show-rating>

                            </a>
                        </div>

                        <div class="d-flex justify-content-between">
                            <p class="card-text me-2">
                                <small class="text-muted">Локація: <span class="stay-location">{{ stay.location }}</span></small>
                            </p>
                            <p class="card-text me-2">
                            Відгуків: {{stay.feedbacks}}
                            </p>
                        </div>
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

                            <span class="card-text p-2">
                                Деталі оплати:
                                <strong>предоплата</strong>
                            </span>

                        </p>
                        <h5 class="card-text stay-price">Ціна: <strong> {{stay.price}} грн.</strong></h5>
                        <a :href="'booking/'+stay.id">
                            <button  class="btn btn-primary mt-3">Забронювати</button>
                        </a>
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



export default {
    name: "StaysGrid",
    data() {
        return {
            searchLocation: "",
            searchRooms: [],
            stays: {},
            filteredStays: [],
            checkedFiltersTypes: [],
            checkedFiltersAmenities: [],
            checkedFiltersPrices: [],
            filtersOn: false,
        }
    },
    methods: {
        async getStays(page = 1) {
            await axios.get('api/stays')
                .then(response => {
                    this.stays = response.data.data;
                });
        },

        filterTypes() {
            let filtersArr  = {
                'typesON':  this.checkedFiltersTypes.length,
                'amenitiesON':  this.checkedFiltersAmenities.length,
                'pricesON': this.checkedFiltersPrices.length
            };
            this.filtersOn = !!( filtersArr.typesON|| filtersArr.amenitiesON || filtersArr.pricesON);

            this.filteredStays = [];

            // Filtering by Types
            let resourceType = this.stays;
            if(filtersArr.typesON) {
                let tempArr = [];
                for (let i=0; i<this.checkedFiltersTypes.length; i++) {
                     tempArr.push( resourceType.filter(stay => stay.type === (this.checkedFiltersTypes[i])));
                }
                for (let i=0; i<tempArr.length; i++) {
                    this.filteredStays=this.filteredStays.concat(tempArr[i]);
                }
                this.filteredStays = this.filteredStays.filter((item,index)=>{return (this.filteredStays.indexOf(item) == index)})
            }

            //Filtering by Amenities
            if(filtersArr.amenitiesON) {
                if(filtersArr.typesON) {
                    resourceType = this.filteredStays;
                }
                let tempArr = [];
                let tempArr2 = [];
                for (let i=0; i<this.checkedFiltersAmenities.length; i++) {
                    tempArr.push( resourceType.filter(stay => stay.amenities === (this.checkedFiltersAmenities[i])));
                }
                for (let i=0; i<tempArr.length; i++) {
                    tempArr2=tempArr2.concat(tempArr[i]);
                }
                this.filteredStays = tempArr2.filter((item,index)=>{return (tempArr2.indexOf(item) == index)})
            }

            //Filtering by Prices
            if(filtersArr.pricesON) {
                if(filtersArr.amenitiesON || filtersArr.typesON) {
                    resourceType = this.filteredStays;
                }
                let tempArr = [];
                let tempArr2 = [];
                for (let i=0; i<this.checkedFiltersPrices.length; i++) {
                    switch (this.checkedFiltersPrices[i]) {
                        case ("low99"):
                            tempArr.push( resourceType.filter(stay => stay.price < 99 ));
                            break;
                        case ("100-500"):
                            tempArr.push( resourceType.filter(stay => stay.price >= 100 && stay.price < 500));
                            break;
                        case ("500-1000"):
                            tempArr.push( resourceType.filter(stay => stay.price >= 500 && stay.price < 1000));
                            break;
                        case ("hi1000"):
                            tempArr.push( resourceType.filter(stay => stay.price >= 1000 ));
                            break;
                    }
                }
                for (let i=0; i<tempArr.length; i++) {
                    tempArr2=tempArr2.concat(tempArr[i]);
                }
                this.filteredStays = tempArr2.filter((item,index)=>{return (tempArr2.indexOf(item) == index)})
            }
        },

        searchedStays() {
            this.getStays().then(response => {
                if(this.searchLocation.length ) {
                    this.stays = this.stays.filter(stay => stay.location.toLowerCase().includes(this.searchLocation.toLowerCase()));
                }
                if (this.searchRooms > 0) {
                    this.stays = this.stays.filter(stay => stay.rooms === (this.searchRooms));
                }
            })
        },
    },
    mounted() {
        this.getStays();

    },
    computed: {
        typesReactive: function () {
            if(this.stays.length && !this.filtersOn ) {
                return {
                    'hotels': this.stays.filter(obj => obj.type === 'hotel').length,
                    'apartments': this.stays.filter(obj => obj.type === 'apartment').length,
                    'resorts': this.stays.filter(obj => obj.type === 'resort').length,
                    'villas': this.stays.filter(obj => obj.type === 'villa').length,
                    'cottages': this.stays.filter(obj => obj.type === 'cottage').length,
                    'wiFi': this.stays.filter(obj => obj.amenities === 'WiFi').length,
                    'tv': this.stays.filter(obj => obj.amenities === 'кабельне TV').length,
                    'jacuzzi': this.stays.filter(obj => obj.amenities === 'джакузі').length,
                    'pool': this.stays.filter(obj => obj.amenities === 'басейн').length,
                    'lowerHundred': this.stays.filter(obj => obj.price < 100).length,
                    'oneFiveHundred': this.stays.filter(obj => (obj.price >= 100 && obj.price < 500)).length,
                    'fiveHundredThousand': this.stays.filter(obj => (obj.price >= 500 && obj.price < 1000)).length,
                    'upperThousand': this.stays.filter(obj => (obj.price >= 1000)).length,
                }
            } else {
                return {
                    'hotels': this.filteredStays.filter(obj => obj.type === 'hotel').length,
                    'apartments': this.filteredStays.filter(obj => obj.type === 'apartment').length,
                    'resorts': this.filteredStays.filter(obj => obj.type === 'resort').length,
                    'villas': this.filteredStays.filter(obj => obj.type === 'villa').length,
                    'cottages': this.filteredStays.filter(obj => obj.type === 'cottage').length,
                    'wiFi': this.filteredStays.filter(obj => obj.amenities === 'WiFi').length,
                    'tv': this.filteredStays.filter(obj => obj.amenities === 'кабельне TV').length,
                    'jacuzzi': this.filteredStays.filter(obj => obj.amenities === 'джакузі').length,
                    'pool': this.filteredStays.filter(obj => obj.amenities === 'басейн').length,
                    'lowerHundred': this.filteredStays.filter(obj => obj.price < 100).length,
                    'oneFiveHundred': this.filteredStays.filter(obj => (obj.price >= 100 && obj.price < 500)).length,
                    'fiveHundredThousand': this.filteredStays.filter(obj => (obj.price >= 500 && obj.price < 1000)).length,
                    'upperThousand': this.filteredStays.filter(obj => (obj.price >= 1000)).length,
                }
            }
        },


    }




}
</script>

<style scoped>

</style>
