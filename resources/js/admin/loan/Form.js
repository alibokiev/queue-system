import AppForm from '../app-components/Form/AppForm';

Vue.component('loan-form', {
    mixins: [AppForm],
    props: ['branches'],
    data: function() {
        return {
            form: {
                client_id:  '' ,
                loan_status_id:  '' ,
                //branch_id:  '' ,
                branch:  '' ,
                contract_number:  '' ,
                contract_date:  '' ,
                end_contract_date:  '' ,
                interest_rate:  '' ,
                interest_rate_type:  '' ,
                debt:  '' ,
                interest_debt:  '' ,
                costs:  '' ,
                profit:  '' ,
                created_by_admin_user_id:  '' ,
                updated_by_admin_user_id:  '' ,
                
            }
        }
    }

});