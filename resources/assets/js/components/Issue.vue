<template>
    <div class="card" v-if="loaded">
        <div class="card-header">
            <strong>#{{ issue.id }}</strong> - {{ issue.title }}
        </div>

        <div class="card-body">
            <div class="issue-meta-data">
                <small>
                    Created by <a href="#">{{ issue.creator.name }}</a> on
                    <span v-text="createdAt(issue.created_at)"></span> in
                    <a :href="route('showLane', { lane: issue.lane_id})" v-text="issue.lane.title"></a>

                </small>
            </div>

            <hr>

            <div class="issue-description-full" v-html="nl2br(issue.description)"></div>

        </div>

        <div class="card-footer" v-if="canUpdate(issue)">
            <a :href="route('editIssue', { issue: issue.id })" class="btn btn-secondary btn-sm">Update</a>
            <button class="btn btn-link" @click="destroy"><span class="text-danger">Delete</span></button>
        </div>
    </div>
</template>

<script type="text/babel">
    import moment from 'moment';
    import text from '../mixins/text'

    export default {
        props: ['id', 'issue'],
        mixins: [text],

        data() {
            return {
                data: '',
                loaded: true
            }
        },

        async created() {
            //this.fetch();
        },

        methods: {
            createdAt(date) {
                return moment.utc(date).format('M/D/YYYY');
            },

            fetch() {
                axios.get(`/api/issues/${this.id}`)
                    .then(response => {
                        this.issue = response.data.data;
                        this.loaded = true;
                    });
            },

            destroy() {

                let self = this;

                bootbox.confirm("Are you sure you want to delete this issue?", function(result) {
                    console.log(self);
                    if (result) {
                        axios.delete(route('deleteIssue', { issue: self.issue.id }))
                            .then(response => {
                                flash('Issue was deleted.', 'success');

                                setTimeout(function() {
                                    window.location = route('issuesIndex');
                                }, 2000);
                            })
                    }
                });
            }
        }
    }
</script>
