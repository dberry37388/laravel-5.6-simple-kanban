export default {
    methods: {
        nl2br (str) {
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1<br>$2');
        }
    }
};
