<template>
    <div class="container">
        <div class="row">
            <Search @search-book="searchBook" />
            <FilterDate
                @filter-date="filterByDatePublished"
                @clear-filter-date="clearFilterByDatePublished"
            />

            <AddBook
                @add-book="addBook"
                :book="book"
                :isEditing="isEditing"
                @search-book="searchBook"
            >
            </AddBook>
            <EditBook v-if="isEditing" :book="book" @edit-book="updateBook"/>
            <div
                class="col-lg-4 col-md-6 col-sm-12 col-sm-2 pr-2 mb-2"
                v-for="book in books"
                :key="book.id"
            >
                <Book
                    :book="book"
                    @edit-book="handleEditBook"
                    @delete-book="deleteBook"
                />
            </div>
            <div v-if="books.length == 0">
                <h4>No Results found</h4>
            </div>
        </div>


    </div>
</template>

<script>
import Vue from "vue";
import Toaster from "v-toaster";
import "v-toaster/dist/v-toaster.css";
Vue.use(Toaster, { timeout: 5000 });

import Book from "./Book.vue";
import AddBook from "./AddBook.vue";
import EditBook from './EditBook.vue';
import Search from "./Search.vue";
import FilterDate from "./FilterDate.vue";

export default {
    name: "Books",
    components: {
        Book,
        AddBook,
        EditBook,
        Search,
        FilterDate,
    },
    data() {
        return {
            books: {},
            book: {},
            isEditing: false,
        };
    },
    mounted() {
        this.fetchBooks();
    },
    methods: {
        async fetchBooks() {
            await axios
                .get("/api/books")
                .then((res) => {
                    this.books = res.data;
                })
                .catch((err) => console.log(err));
        },
        async searchBook(search) {
            await axios
                .get(`/api/books?search=${search}`)
                .then((res) => {
                    this.books = res.data;
                })
                .catch((err) => console.log(err));
        },
        async filterByDatePublished(data) {
            await axios
                .get(
                    `/api/books?start_date=${data.startDate}&end_date=${data.endDate}`
                )
                .then((res) => {
                    this.books = res.data;
                })
                .catch((err) => console.log(err));
        },
        async clearFilterByDatePublished() {
            await axios
                .get("/api/books")
                .then((res) => {
                    this.books = res.data;
                    this.fetchBooks();
                })
                .catch((err) => console.log(err));
        },

        async addBook(book) {
            await axios
                .post("/api/books", {
                    name: book.name,
                    description: book.description,
                    author: book.author,
                    date_published: book.date_published,
                })
                .then((res) => {
                    this.$toaster.success(
                        "A new book has been added successfully"
                    );
                    console.log(res);
                })
                .catch((err) => console.log(err));

            this.fetchBooks();
        },
        async handleEditBook(id) {
            await axios
                .get(`/api/books/${id}`)
                .then((res) => {
                    this.book = res.data;
                    this.isEditing = true;
                })
                .catch((err) => console.log(err));
        },
        async updateBook(book) {
            await axios
                .put(`/api/books/${this.book.id}`, {
                    name: book.name,
                    description: book.description,
                    author: book.author,
                    date_published: book.date_published,
                })
                .then((res) => {
                    this.$toaster.success(
                        "A book has been updated successfully"
                    );
                    this.isEditing = false;
                })
                .catch((err) => console.log(err));

            this.fetchBooks();
        },
        async deleteBook(id) {
            if (confirm("Are you sure you want to delete this book?")) {
                await axios
                    .delete(`api/books/${id}`)
                    .then((res) => {
                        this.$toaster.success(
                            "A book has been deleted successfully"
                        );
                        this.fetchBooks();
                    })
                    .catch((err) => console.log(err));

                this.fetchBooks();
            }
        },
    },
};
</script>
