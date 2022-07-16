<template>
    <div class="search-panel mb-3 bg-success bg-opacity-10">
        <nav class="navbar-brand ">
            <div class="qwe"></div>
            <div class="container-fluid justify-content-center">
                <form class="d-flex row" role="search" >
                    <div class="input-group ">
                        <input type="text" aria-label="First name" v-model="searchLocation" placeholder="Куди ви вирушаєте?" class="form-control ml">
                        <input type="text"  placeholder="Дата заїзду" v-model="searchStartDate" class="form-control" onfocus="(this.type = 'date')">
                        <input type="text"  placeholder="Дата виїзду" v-model="searchEndDate" class="form-control" onfocus="(this.type = 'date')">
                        <input class="form-control" type="number" v-model="searchRooms" placeholder="Кількість номерів" aria-label="Search">
                        <input class="form-control" type="number" v-model="searchBeds" placeholder="Кількість туристів" aria-label="Search">
                        <button class="btn btn-outline-warning"  @click.prevent="searchedStays">Шукати</button>
                    </div>
                </form>
            </div>
        </nav>
    </div>



<div class="d-flex">

    <!--Filters-->
    <div class="flex-shrink-0 p-3 bg-white border border-info" style="width: 280px;">
        <a href="#" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">

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

            <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                    <h5 class="text-decoration-underline"> Зірковий рейтинг</h5>
                </button>
                <div class="collapse show" id="home-collapse">
                    <ul class="list btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><input type="checkbox" v-model="checkedFiltersStarsRating" @change="filterTypes" value="fiveStars">
                            <i class="fa fa-star "></i><i class="fa fa-star "></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                            ({{typesReactive.fiveStars ? typesReactive.fiveStars : 0}})
                        </li>

                        <li><input type="checkbox" v-model="checkedFiltersStarsRating" @change="filterTypes" value="fourStars">
                            <i class="fa fa-star "></i><i class="fa fa-star "></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                            ({{typesReactive.fourStars ? typesReactive.fourStars : 0}})
                        </li>

                        <li><input type="checkbox" v-model="checkedFiltersStarsRating" @change="filterTypes" value="threeStars">
                            <i class="fa fa-star "></i><i class="fa fa-star "></i><i class="fa fa-star"></i>
                            ({{typesReactive.threeStars ? typesReactive.threeStars : 0}})
                        </li>

                        <li><input type="checkbox" v-model="checkedFiltersStarsRating" @change="filterTypes" value="twoStars">
                            <i class="fa fa-star "></i><i class="fa fa-star  "></i>
                            ({{typesReactive.twoStars ? typesReactive.twoStars : 0}})
                        </li>

                        <li><input type="checkbox" v-model="checkedFiltersStarsRating" @change="filterTypes" value="oneStars">
                                    <i class="fa fa-star "></i>
                                 ({{typesReactive.oneStars ? typesReactive.oneStars : 0}})
                        </li>

                        <li><input type="checkbox" v-model="checkedFiltersStarsRating" @change="filterTypes" value="noneStars">
                             <span> Без рейтингу</span> ({{typesReactive.noneStars ? typesReactive.noneStars : 0}})
                        </li>

                    </ul>
                </div>
            </li>

            <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                    <h5 class="text-decoration-underline"> Рейтинг за відгуками</h5>
                </button>
                <div class="collapse show" id="home-collapse">
                    <ul class="list btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><input type="checkbox" v-model="checkedFiltersReviewsRating" @change="filterTypes" value="fiveReviews">
                            Найкраще
                            ({{typesReactive.fiveReviews ? typesReactive.fiveReviews : 0}})
                        </li>

                        <li><input type="checkbox" v-model="checkedFiltersReviewsRating" @change="filterTypes" value="fourReviews">
                            Добре
                            ({{typesReactive.fourReviews ? typesReactive.fourReviews : 0}})
                        </li>

                        <li><input type="checkbox" v-model="checkedFiltersReviewsRating" @change="filterTypes" value="threeReviews">
                            Посередньо
                            ({{typesReactive.threeReviews ? typesReactive.threeReviews : 0}})
                        </li>

                        <li><input type="checkbox" v-model="checkedFiltersReviewsRating" @change="filterTypes" value="twoReviews">
                            Погано
                            ({{typesReactive.twoReviews ? typesReactive.twoReviews : 0}})
                        </li>

                        <li><input type="checkbox" v-model="checkedFiltersReviewsRating" @change="filterTypes" value="oneReviews">
                            Найгірше
                            ({{typesReactive.oneReviews ? typesReactive.oneReviews : 0}})
                        </li>

                        <li><input type="checkbox" v-model="checkedFiltersReviewsRating" @change="filterTypes" value="noneReviews">
                            <span> Без рейтингу</span> ({{typesReactive.noneReviews ? typesReactive.noneReviews : 0}})
                        </li>

                    </ul>
                </div>
            </li>

            <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                    <h5 class="text-decoration-underline"> Кількість ліжок</h5>
                </button>
                <div class="collapse show" id="home-collapse">
                    <ul class="list btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><input type="checkbox" v-model="checkedFiltersBeds" @change="filterTypes" value="overFourBeds">
                            Більше 4 ліжок
                            ({{typesReactive.overFourBeds ? typesReactive.overFourBeds : 0}})
                        </li>

                        <li><input type="checkbox" v-model="checkedFiltersBeds" @change="filterTypes" value="fourBeds">
                            4 ліжка
                            ({{typesReactive.fourBeds ? typesReactive.fourBeds : 0}})
                        </li>

                        <li><input type="checkbox" v-model="checkedFiltersBeds" @change="filterTypes" value="threeBeds">
                            3 ліжка
                            ({{typesReactive.threeBeds ? typesReactive.threeBeds : 0}})
                        </li>

                        <li><input type="checkbox" v-model="checkedFiltersBeds" @change="filterTypes" value="twoBeds">
                            2 ліжка
                            ({{typesReactive.twoBeds ? typesReactive.twoBeds : 0}})
                        </li>

                        <li><input type="checkbox" v-model="checkedFiltersBeds" @change="filterTypes" value="oneBeds">
                            1 ліжко
                            ({{typesReactive.oneBeds ? typesReactive.oneBeds : 0}})
                        </li>
                    </ul>
                </div>
            </li>

            <li class="border-top my-3"></li>

        </ul>
    </div>

    <!--Stays filtered-->
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
                                <show-rating :rating="stay.ratings"
                                ></show-rating>
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

    <!--Stays All-->
    <div class="content p-3" v-else>
        <h5 class="mt-3 p-3" v-if="stays.length">Знайдено помешкань: {{stays.length}} </h5>
        <h5 class="mt-3 p-3" v-else>Пoмешкань не знайдено </h5>

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

                            <span v-if="stay.date">Має заброньовані періоди: {{stay.date.start_date}} - {{stay.date.end_date}}</span>

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
            searchBeds: [],
            searchStartDate: '',
            searchEndDate: '',
            stays: {},
            filteredStays: [],
            checkedFiltersTypes: [],
            checkedFiltersAmenities: [],
            checkedFiltersPrices: [],
            checkedFiltersStarsRating: [],
            checkedFiltersReviewsRating: [],
            checkedFiltersBeds:[],
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
                'pricesON': this.checkedFiltersPrices.length,
                'starsRating': this.checkedFiltersStarsRating.length,
                'reviewsRating': this.checkedFiltersReviewsRating.length,
                'beds': this.checkedFiltersBeds.length,
            };
            this.filtersOn = !!( filtersArr.typesON|| filtersArr.amenitiesON || filtersArr.pricesON || filtersArr.starsRating || filtersArr.reviewsRating || filtersArr.beds);

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

            //Filtering by stars
            if(filtersArr.starsRating) {

                if(filtersArr.amenitiesON || filtersArr.typesON || filtersArr.pricesON) {
                    resourceType = this.filteredStays;
                }
                let tempArr = [];
                let tempArr2 = [];

                for (let i=0; i<this.checkedFiltersStarsRating.length; i++) {
                    switch (this.checkedFiltersStarsRating[i]) {
                        case ('noneStars'):
                            tempArr.push( resourceType.filter(stay => stay.ratings < 0.5 ));
                            break;
                        case ('oneStars'):
                            tempArr.push( resourceType.filter(stay => stay.ratings >= 0.5 && stay.ratings < 1.5 ));
                            break;
                        case ('twoStars'):
                            tempArr.push( resourceType.filter(stay => stay.ratings >= 1.5 && stay.ratings < 2.5));
                            break;
                        case ('threeStars'):
                            tempArr.push( resourceType.filter(stay => stay.ratings >= 2.5 && stay.ratings < 3.5));
                            break;
                        case ('fourStars'):
                            tempArr.push( resourceType.filter(stay => stay.ratings >= 3.5 && stay.ratings < 4.5));
                            break;
                        case ('fiveStars'):
                            tempArr.push( resourceType.filter(stay => stay.ratings >= 4.5));
                            break;
                    }
                    for (let i=0; i<tempArr.length; i++) {
                        tempArr2=tempArr2.concat(tempArr[i]);
                    }
                    this.filteredStays = tempArr2.filter((item,index)=>{return (tempArr2.indexOf(item) == index)})
                }
            }

            //Filtering by reviews rating
            if(filtersArr.reviewsRating) {

                if(filtersArr.amenitiesON || filtersArr.typesON || filtersArr.pricesON || filtersArr.starsRating) {
                    resourceType = this.filteredStays;
                }
                let tempArr = [];
                let tempArr2 = [];

                for (let i=0; i<this.checkedFiltersReviewsRating.length; i++) {
                    switch (this.checkedFiltersReviewsRating[i]) {
                        case ('noneReviews'):
                            tempArr.push( resourceType.filter(stay => stay.feedbacks_mark < 0.5 ));
                            break;
                        case ('oneReviews'):
                            tempArr.push( resourceType.filter(stay => stay.feedbacks_mark >= 0.5 && stay.feedbacks_mark < 1.5 ));
                            break;
                        case ('twoReviews'):
                            tempArr.push( resourceType.filter(stay => stay.feedbacks_mark >= 1.5 && stay.feedbacks_mark < 2.5));
                            break;
                        case ('threeReviews'):
                            tempArr.push( resourceType.filter(stay => stay.feedbacks_mark >= 2.5 && stay.feedbacks_mark < 3.5));
                            break;
                        case ('fourReviews'):
                            tempArr.push( resourceType.filter(stay => stay.feedbacks_mark >= 3.5 && stay.feedbacks_mark < 4.5));
                            break;
                        case ('fiveReviews'):
                            tempArr.push( resourceType.filter(stay => stay.feedbacks_mark >= 4.5));
                            break;
                    }
                    for (let i=0; i<tempArr.length; i++) {
                        tempArr2=tempArr2.concat(tempArr[i]);
                    }
                    this.filteredStays = tempArr2.filter((item,index)=>{return (tempArr2.indexOf(item) == index)})
                }
            }

            //Filtering by beds
            if(filtersArr.beds) {

                if(filtersArr.amenitiesON || filtersArr.typesON || filtersArr.pricesON || filtersArr.starsRating || filtersArr.reviewsRating) {
                    resourceType = this.filteredStays;
                }
                let tempArr = [];
                let tempArr2 = [];

                for (let i=0; i<this.checkedFiltersBeds.length; i++) {
                    switch (this.checkedFiltersBeds[i]) {
                        case ('oneBeds'):
                            tempArr.push( resourceType.filter(stay => stay.beds === 1 ));
                            break;
                        case ('twoBeds'):
                            tempArr.push( resourceType.filter(stay => stay.beds === 2 ));
                            break;
                        case ('threeBeds'):
                            tempArr.push( resourceType.filter(stay => stay.beds === 3));
                            break;
                        case ('fourBeds'):
                            tempArr.push( resourceType.filter(stay => stay.beds === 4));
                            break;
                        case ('overFourBeds'):
                            tempArr.push( resourceType.filter(stay => stay.beds > 4));
                            break;
                    }
                    for (let i=0; i<tempArr.length; i++) {
                        tempArr2=tempArr2.concat(tempArr[i]);
                    }
                    this.filteredStays = tempArr2.filter((item,index)=>{return (tempArr2.indexOf(item) == index)})

                }
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
                if (this.searchBeds > 0) {
                    this.stays = this.stays.filter(stay => stay.beds === (this.searchBeds));
                }
                if (this.searchStartDate || this.searchEndDate) {
                    this.searchStartDate = Date.parse(this.searchStartDate);
                    this.searchEndDate = Date.parse(this.searchEndDate);
                    console.log(this.searchStartDate)
                    console.log(this.searchEndDate)
                    if(this.searchStartDate && !this.searchEndDate) {
                        alert('Ви не обрали дату виїзду')
                    }
                    if(!this.searchStartDate && this.searchEndDate) {
                        alert('Ви не обрали дату заїзду')
                    }
                    if(this.searchStartDate>=this.searchEndDate) {
                        alert('Дата заїзду має бути ранішою ніж дата виїзду!')
                    }

                }
                this.searchLocation = '';
                this.searchRooms = [];
                this.searchBeds = [];
                this.searchStartDate = '';
                this.searchEndDate = '';
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

                    'noneStars': this.stays.filter(obj => (!obj.ratings)).length,
                    'oneStars': this.stays.filter(obj => (obj.ratings > 0 && obj.ratings < 1.5)).length,
                    'twoStars': this.stays.filter(obj => (obj.ratings >=1.5 && obj.ratings < 2.5)).length,
                    'threeStars': this.stays.filter(obj => (obj.ratings >= 2.5 && obj.ratings < 3.5)).length,
                    'fourStars': this.stays.filter(obj => (obj.ratings >= 3.5 && obj.ratings < 4.5)).length,
                    'fiveStars': this.stays.filter(obj => (obj.ratings >= 4.5 )).length,

                    'noneReviews': this.stays.filter(obj => (!obj.feedbacks_mark)).length,
                    'oneReviews': this.stays.filter(obj => (obj.feedbacks_mark > 0 && obj.feedbacks_mark < 1.5)).length,
                    'twoReviews': this.stays.filter(obj => (obj.feedbacks_mark >=1.5 && obj.feedbacks_mark < 2.5)).length,
                    'threeReviews': this.stays.filter(obj => (obj.feedbacks_mark >= 2.5 && obj.feedbacks_mark < 3.5)).length,
                    'fourReviews': this.stays.filter(obj => (obj.feedbacks_mark >= 3.5 && obj.feedbacks_mark < 4.5)).length,
                    'fiveReviews': this.stays.filter(obj => (obj.feedbacks_mark >= 4.5 )).length,

                    'overFourBeds': this.stays.filter(obj => (obj.beds > 4 )).length,
                    'fourBeds': this.stays.filter(obj => (obj.beds === 4 )).length,
                    'threeBeds': this.stays.filter(obj => (obj.beds === 3 )).length,
                    'twoBeds': this.stays.filter(obj => (obj.beds === 2 )).length,
                    'oneBeds': this.stays.filter(obj => (obj.beds === 1 )).length,

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

                    'noneStars': this.filteredStays.filter(obj => (!obj.ratings)).length,
                    'oneStars': this.filteredStays.filter(obj => (obj.ratings > 0 && obj.ratings < 1.5)).length,
                    'twoStars': this.filteredStays.filter(obj => (obj.ratings >=1.5 && obj.ratings < 2.5)).length,
                    'threeStars': this.filteredStays.filter(obj => (obj.ratings >= 2.5 && obj.ratings < 3.5)).length,
                    'fourStars': this.filteredStays.filter(obj => (obj.ratings >= 3.5 && obj.ratings < 4.5)).length,
                    'fiveStars': this.filteredStays.filter(obj => (obj.ratings >= 4.5 )).length,

                    'noneReviews': this.filteredStays.filter(obj => (!obj.feedbacks_mark)).length,
                    'oneReviews': this.filteredStays.filter(obj => (obj.feedbacks_mark > 0 && obj.feedbacks_mark < 1.5)).length,
                    'twoReviews': this.filteredStays.filter(obj => (obj.feedbacks_mark >=1.5 && obj.feedbacks_mark < 2.5)).length,
                    'threeReviews': this.filteredStays.filter(obj => (obj.feedbacks_mark >= 2.5 && obj.feedbacks_mark < 3.5)).length,
                    'fourReviews': this.filteredStays.filter(obj => (obj.feedbacks_mark >= 3.5 && obj.feedbacks_mark < 4.5)).length,
                    'fiveReviews': this.filteredStays.filter(obj => (obj.feedbacks_mark >= 4.5 )).length,

                    'overFourBeds': this.filteredStays.filter(obj => (obj.beds > 4 )).length,
                    'fourBeds': this.filteredStays.filter(obj => (obj.beds === 4 )).length,
                    'threeBeds': this.filteredStays.filter(obj => (obj.beds === 3 )).length,
                    'twoBeds': this.filteredStays.filter(obj => (obj.beds === 2 )).length,
                    'oneBeds': this.filteredStays.filter(obj => (obj.beds === 1 )).length,
                }
            }
        },
    }

}
</script>

<style scoped>
.star {
    display: inline-block;
    font-size: 20px;
    transition: all .2s ease-in-out;
    cursor: pointer;
}

.star:first-child {
     margin-left: 0;
 }
.star.active {
     color: #ffe100;
 }

</style>
