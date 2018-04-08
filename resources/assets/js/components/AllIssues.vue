<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mb-3">
                    <h2>Backlog</h2>
                </div>

                <div v-for="issue in issues">
                    <issue-preview :issue="issue"></issue-preview>
                </div>

                <div class="mt-3">
                    <paginator :dataSet="dataSet" @changed="fetch"></paginator>
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
                issues: [],
                dataSet: false
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
                axios.get(this.url(page)).then(this.refresh);
            },

            refresh({data}) {
                this.dataSet = data;
                this.issues = data.data;

                setTimeout(() => {
                    window.scroll({
                        top: 0,
                        left: 0,
                        behavior: 'smooth'
                    });
                }, 100);
            },

            url(page) {
                if (! page) {
                    let query = location.search.match(/page=(\d+)/);

                    page = query ? query[1] : 1;
                }

                return `${location.pathname}?page=${page}`;
            }
        }
    }
</script>
