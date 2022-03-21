<template>
    <form @submit.prevent="searchBook" class="d-flex mb-2">
        <input type="text" class="form-control" name="search"
        placeholder="Search books..." @change="searchBook"
         v-model="search">
         <button type="submit" class="search">Search</button>
    </form>
</template>

<script>
    export default {
        name: "Search",
        data(){
            return{
                search: ''
            }
        },
        methods:{
            searchBook(){
                this.$emit('search-book', this.search);
            },
        }

    }
</script>
