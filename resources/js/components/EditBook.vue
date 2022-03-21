<template>
    <div class="row">
        <div class="col-12">
            <h1>Edit Book</h1>
        </div>
        <div class="col-md-12 mx-auto">
            <hr>
            <form @submit.prevent="handleUpdate" action="" class="border p-2">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Book Name</label>
                            <input
                                type="text"
                                name="name"
                                v-model="name"
                                id="name"
                                class="form-control"
                            />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="author">Book Author</label>
                            <input
                                type="text"
                                v-model="author"
                                name="author"
                                id="author"
                                class="form-control"
                            />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <textarea
                        name="description"
                        v-model="description"
                        class="border form-control mt-2"
                        id="description"
                        cols="15"
                        rows="5"
                    ></textarea>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <div class="form-group">
                            <label for="date_published">
                                Date published
                            </label>
                            <input type="date" v-model="date_published" class="border" name="date_published" id="date_published">
                        </div>
                    </div>
                </div>
                <div class="form-group d-flex justify-content-end">
                    <button type="submit" class="ml-auto  btn btn-success">Update Book</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "EditBook",
    props:{
        book: Object,
        default: null
    },
    data(){
        return {
            name: '',
            description: '',
            date_published: '',
            author: '',
        }
    },
    created(){
        if(this.book !== null){
            this.name = this.book.name;
            this.description = this.book.description;
            this.date_published = this.book.date_published;
            this.author = this.book.author;
        }

    },
    methods: {
        handleUpdate(){
            let book = {
                name: this.name,
                description: this.description,
                author: this.author,
                date_published: this.date_published,
            }
            this.$emit('edit-book', book);
            this.name = '';
            this.description = '';
            this.date_published = '';
            this.author = '';
        },
    }
};
</script>
