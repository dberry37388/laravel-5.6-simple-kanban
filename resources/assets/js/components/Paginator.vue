<template>
    <nav aria-label="Page navigation" v-if="shouldPaginate">
        <ul class="pagination">
            <li class="page-item" v-show="previousUrl">
                <a class="page-link" href="#" aria-label="Previous" rel="prev" @click.prevent="page--">
                    &laquo; Previous
                </a>
            </li>

            <li class="page-item" v-show="nextUrl">
                <a class="page-link" href="#" aria-label="Next" rel="next" @click.prevent="page++">
                    Next &raquo;
                </a>
            </li>
        </ul>
    </nav>
</template>

<script type="text/babel">
    export default {
        props: ['dataSet'],

        data() {
            return {
                page: 1,
                previousUrl: false,
                nextUrl: false
            }
        },

        watch: {
            dataSet() {
                this.page = this.dataSet.current_page;
                this.previousUrl = this.dataSet.prev_page_url;
                this.nextUrl = this.dataSet.next_page_url;
            },

            page() {
                this.broadcast().updateUrl();
            }
        },

        computed: {
            shouldPaginate() {
                return !! this.previousUrl || !! this.nextUrl;
            }
        },

        methods: {
            broadcast() {
                this.$emit('changed', this.page);

                return this;
            },

            updateUrl() {
                history.pushState(null, null, '?page=' + this.page);
            }
        }
    }
</script>
