<template>
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-space-between w-100">
                <button class="btn btn-secondary btn-block mb-2 mr-5" @click="toggleAddBookForm">{{ !showForm ? 'Add book' : 'Close'}}</button>
            </div>
        </div>
        <div class="col-md-12 mx-auto">


        <hr>
        <!-- {{showForm = isEditing}} -->
        <form @submit.prevent="addBook" action="" class="border p-2" v-if="showForm">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Book Name</label>
                        <input
                            type="text"
                            name="name"
                            v-model="name"
                            required
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
                            required
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
                    id=""
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
                        <input type="date" required v-model="date_published" class="border" name="date_published" id="date_published">
                    </div>
                </div>
            </div>
            <div class="form-group d-flex justify-content-end">
                <button type="submit" class="ml-auto  btn btn-success">Add Book</button>
            </div>
        </form>
        </div>
    </div>
</template>

<script>

export default {
    name: "AddBook",
    props: ['book'],
    data(){
        return {
            showForm: false,
            name: '',
            description: '',
            date_published: '',
            author: ''
        }
    },
    methods: {
        toggleAddBookForm(){
            this.showForm = !this.showForm;
        },
        addBook(){
            let book = {
                name: this.name,
                description: this.description,
                author: this.author,
                date_published: this.date_published,
            }
            this.$emit('add-book', book);

            this.showForm = false;
            this.name = '';
            this.description = '';
            this.date_published = '';
            this.author = '';
        },
    }
};
</script>
