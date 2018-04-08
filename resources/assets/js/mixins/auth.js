export default {
    methods: {
        canUpdate(item) {
            if (this.currentUser.is_admin || this.currentUser.id == item.user_id) {
                return true;
            }
        },

        canDelete(item) {
            if (this.currentUser.is_admin || this.currentUser.id == item.user_id) {
                return true;
            }
        }
    },

    computed: {
        currentUser() {
            return window.App.currentUser;
        },
    },
};
