<template>
    <div class="card mb-3">
        <div class="card-header d-flex">
            <div class="mr-auto">
                <strong>#{{ issue.id }}</strong>
                <a :href="route('showIssue', { issue: issue.id })" v-text="issue.title"> </a>
            </div>

            <div v-if="canUpdate(issue)">
                <a :href="route('editIssue', { issue: issue.id})">
                    <i class="fa fa-edit"></i>
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="issue-meta-data">
                <small>
                    Created by <a href="#">{{ issue.creator }}</a> on
                    <span v-text="createdAt(issue.created_at)"></span> in
                    <a :href="route('showLane', { lane: issue.lane_id})" v-text="issue.lane_title"></a>

                </small>
            </div>

            <hr>

            <div class="issue-description">
                <truncate clamp="..." :length="75" type="html" less="show less"
                          :text="nl2br(issue.description)" actionClass="text-muted text-bold pull-right"></truncate>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    import moment from 'moment';
    import truncate from 'vue-truncate-collapsed';
    import text from '../mixins/text'

    export default {
        props: ['issue'],
        components: {truncate},
        mixins: [text],
        methods: {
            createdAt(date) {
                return moment.utc(date).format('M/D/YYYY');
            },
        }
    }
</script>
