import AppListing from '../app-components/Listing/AppListing';

Vue.component('loan-listing', {
    mixins: [AppListing],

    data() {
        return {
            showBranchesFilter: false,
            branchesMultiselect: {},

            filters: {
                branches: [],
            },
        }
    },

    watch: {
        showBranchesFilter: function (newVal, oldVal) {
            this.branchesMultiselect = [];
        },

        branchesMultiselect: function(newVal, oldVal) {
            this.filters.branches = newVal.map(function(object) { return object['key']; });
            this.filter('branches', this.filters.branches);
        }
    }
});