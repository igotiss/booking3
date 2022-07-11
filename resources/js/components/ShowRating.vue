<template>
    <div class="rating">
        <ul class="list">
            <li  v-for="star in 5" :class="{ 'active': star <= rating }" :key="star.rating" class="star">
                <i :class="star <= rating ? 'fa fa-star' : 'fa fa-star'"></i>
            </li>
        </ul>
        <div v-if="rating" class="info counter">
            <span class="score-rating">{{ mathRatingRound }}</span>
            {{}}
        </div>
        <!--Creates the popup body-->
        <div class="popup-overlay">
            <!--Creates the popup content-->
            <div class="popup-content">
                <ul class="list">
                    <li  v-for="star in 5" :key="star.rating" class="star">
                        <i class="fa fa-star" @click="saveRate(star)"></i>
                    </li>
                </ul>
                <button class="close">Close</button> </div>
        </div>
        <!--Content shown when popup is not displayed-->
        <div v-show="authId">
            <span class="badge bg-secondary" v-if="authVoted">проголосовано</span>
            <button class="open"  v-else>Голосувати</button>
        </div>

    </div>
</template>

<script>
export default {
    name: "ShowRating",
    props: {
        rating: {
            default: 0,
            type:Number},
        stayId: Number,
        authVoted: Number,
        authId: Number
    },
    data() {
        return {
            checkedRate: 0,
            innerRating: 0,
            userVoted: false,
        }
    },
    methods: {

        async saveRate (i) {
            let redirectUrl = ""+this.stayId;
            await axios.post('rating/'+this.stayId, {'rating': i})
                .then( function (response){
                        //axios.get('/api/rating'+this.stayId)
                        window.location.href = redirectUrl
                    }
                )
                .catch((err) => console.log(err));
        },
        checkIsUserVoted () {
            if(this.authVoted === 1) {
                this.userVoted = true;
            }
        }
    },
    mounted() {
        this.checkIsUserVoted();

        this.innerRating = this.rating;
    },
    computed: {
        mathRatingRound: function () {
            return (Math.ceil((this.rating)*100)/100);
        }
    }
}
</script>

<style scoped>
</style>
