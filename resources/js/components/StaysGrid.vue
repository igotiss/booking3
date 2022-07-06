<template>
<!--    @if($stays->isEmpty())
    <h5>На даний час немає жодного опублікованого помешкання</h5>
    @else
    -->
    <h5 class="mt-3" >Знайдено помешкань: {{total}}

    </h5>

    <div class="card mb-3" v-for="stay in stays.data" :key="stay.id">
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

    <Pagination  :data="stays" @pagination-change-page="getResults" align="center" activeClassIn="false">
        <template #prev-nav>
            <span>&lt; Попередня</span>
        </template>
        <template #next-nav>
            <span>Наступна &gt;</span>
        </template>
        <template #active-nav>
            <span>Поточна &gt;</span></template>
    </Pagination>

</template>

<script>
export default {
    name: "StaysGrid",
    data() {
        return {
            stays: {},
            total: 0,
        }
    },
    methods: {
        async getResults(page = 1) {
            await axios.get('api/stays?page=' + page)
                .then(response => {
                    this.stays = response.data;
                    this.total = response.data.meta.total;
                });
        },

    },
    mounted() {
        this.getResults();
    }

}
</script>

<style scoped>

</style>
