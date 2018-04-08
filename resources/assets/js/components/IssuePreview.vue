<template>
    <div class="card mb-3">
        <div class="card-header d-flex">
            <div class="mr-auto">
                <strong>#{{ issue.id }}</strong>
                <a :href="route('showIssue', { issue: issue.id })" v-text="issue.title"> </a>
            </div>

            <!--@can('update', $issue)-->
            <div v-if="canUpdate(issue)">
                <a :href="route('editIssue', { issue: issue.id})">
                    <i class="fa fa-edit"></i>
                </a>
            </div>
            <!--@endcan-->
        </div>

        <div class="card-body">
            <div class="issue-meta-data">
                <small>
                    Created by <a href="#">{{ issue.creator.name }}</a> on
                    <span v-text="createdAt(issue.created_at)"></span> in
                    <a :href="route('showLane', { lane: issue.lane.id })" v-text="issue.lane.title"></a>
                </small>
            </div>

            <hr>

            <div class="issue-description">
                <truncate clamp="..." :length="100" type="html" less="... Show Less"
                          :text="nl2br(issue.description)"></truncate>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    import moment from 'moment';
    import truncate from 'vue-truncate-collapsed';

    export default {
        props: ['issue'],
        components: {truncate},
        data() {
            return {
            }
        },

        methods: {
            createdAt(date) {
                return moment.utc(date).format('M/D/YYYY');
            },

            nl2br (str, is_xhtml) {
                if (typeof str === 'undefined' || str === null) {
                    return '';
                }
                var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
                return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
            }
        }
    }
</script>
