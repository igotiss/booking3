<template>
<div class="search-panel mt-3 ">
    <nav class="navbar-brand ">
        <div class="container-fluid justify-content-center">
            <form class="d-flex row" role="search" >
                <div class="input-group ">
                    <input type="text" aria-label="First name" placeholder="Куди ви вирушаєте?" class="form-control ml">
                    <input type="text" aria-label="Last name" placeholder="Заїзд - виїзд" class="form-control">
                    <input class="form-control" type="search" placeholder="2  дорослих * 0 дітей * 1 номер" aria-label="Search">
                    <button class="btn btn-outline-warning" type="submit">Шукати</button>
                </div>
            </form>
        </div>
    </nav>
</div>
</template>

<script>
export default {
    name: "SearchPanel"
}
</script>

<style scoped>
    .ml {
        margin-left: 1rem;
    }
</style>
