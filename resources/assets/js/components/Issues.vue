<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
        props: ['url'],

        data() {
            return {
                pagination: {
                    current_page: this.url,
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
        }
    }
</script>
