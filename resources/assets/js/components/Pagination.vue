<template>
    <nav aria-label="Pagination">
        <ul class="pagination">
            <li class="page-item" v-if="pagination.prev != null">
                <a class="page-link" href="javascript:void(0)" v-on:click.prevent="changePage(pagination.first)">
                    <<
                </a>
            </li>

            <li class="page-item" v-if="pagination.prev">
                <a class="page-link" href="javascript:void(0)" v-on:click.prevent="changePage(pagination.prev)">
                    <
                </a>
            </li>

            <li class="page-item" v-if="pagination.next">
                <a class="page-link" href="javascript:void(0)" v-on:click.prevent="changePage(pagination.next)">
                    >
                </a>
            </li>

            <li class="page-item" v-if="pagination.next != null">
                <a class="page-link" href="javascript:void(0)" v-on:click.prevent="changePage(pagination.last)">
                    >>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default{
        props: {
            pagination: {
                required: true
            }
        },

        methods : {
            changePage(page) {
                this.pagination.current_page = page;
                this.$emit('paginate');
            }
        }
    }
</script>
