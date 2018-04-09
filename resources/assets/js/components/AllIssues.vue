<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mb-3">
                    <h2>Backlog</h2>
                </div>

                <div v-for="issue in issues.data">
                    <issue-preview :issue="issue"></issue-preview>
                </div>

                <div class="mt-3">
                    <pagination :pagination="pagination" @paginate="fetch" :offset="4"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">

    import IssuePreview from './IssuePreview';

    export default {

        data() {
            return {
                pagination: {
                    current_page: '/api/issues'
                },
                issues: []
            }
        },

        components: {
            IssuePreview
        },

        created() {
            this.fetch()
        },

        methods: {
            fetch(page) {
                axios.get(`${this.pagination.current_page}`)
                    .then(response => {
                        this.issues = response.data;
                        this.pagination = response.data.links;

                        this.refresh();
                    });
            },

            refresh() {
                setTimeout(() => {
                    window.scroll({
                        top: 0,
                        left: 0,
                        behavior: 'smooth'
                    });
                }, 100);
            },

            url(page) {
                let query = location.search.match(/page=(\d+)/);

                if (query) {
                    query = query[1];
                } else {
                    query = 1
                }

                console.log(`${page}?page=${query}`);

                return `${page}?page=${query}`;
            }
        }
    }
</script>
