<template>
    <form @submit.prevent="filter" class="shadow-sm mb-2">
        <h5>Filter by date published:</h5>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">Start Date</label>
                    <input type="date" class="form-control" name="startDate" v-model="startDate" id="startDate">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">End Date</label>
                    <input type="date" name="endDate" class="form-control" v-model="endDate" id="endstartDate">
                </div>
            </div>
        </div>

        <div class="form-group d-flex justify-content-end mt-2 m-2">
            <button @click="clearFilter" class="btn btn-secondary ml-auto mr-2">Clear</button>
            <button type="submit" class="btn btn-success ml-auto">Filter</button>
        </div>

    </form>
</template>

<script>
    export default {
        name: "FilterDate",
        data(){
            return{
                startDate: '',
                endDate: '',
            }
        },
        methods: {
            filter(){
                let data = {
                    startDate : this.startDate,
                    endDate : this.endDate,
                }
                this.$emit('filter-date', data);
            },
            clearFilter(){
                let data = {
                    startDate : '',
                    endDate : '',
                }
                this.$emit('clear-filter-date', data);
            }
        }


    }
</script>
