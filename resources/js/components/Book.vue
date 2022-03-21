<template>
    <div class="shadow p-1">
       <small>Title: </small>
       <span class="font-weight-bold text-uppercase" style="font-size:1rem">
           {{book.name}}
        </span>
        <p>Author: {{book.author}}</p>

        <div class="d-flex justify-content-end">
            <button @click="showBook(book.id)">More info</button>
             <button class="btn btn-warning btn-sm" @click="editBook(book.id)">
                Edit
            </button>
            <button class="btn btn-danger btn-sm ml-1" @click="deleteBook(book.id)">
                Delete
            </button>
        </div>
        <div v-if="moreInfo">
            <hr>
            More Information:
            <p>Description: <strong>{{book.description}}</strong></p>
            <p>Date published: {{book.date_published}}</p>
        </div>


    </div>
</template>

<script>
    export default {
        name: "Book",
        data(){
            return{
                selectedBook: [],
                moreInfo: false
            }
        },
        props: {
            book: Object,
        },
        methods:{
            editBook(id){
                this.$emit('edit-book', id);
            },
            deleteBook(id){
                this.$emit('delete-book', id);
            },
            async showBook(id) {
                await axios
                .get(`/api/books/${id}`)
                .then((res) => {
                    this.selectedBook = res.data;
                    this.moreInfo = !this.moreInfo;
                })
                .catch((err) => console.log(err));
            },
        }

    }
</script>
