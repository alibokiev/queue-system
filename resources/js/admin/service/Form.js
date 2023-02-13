import AppForm from '../app-components/Form/AppForm';

Vue.component('service-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                boj:  '' ,
                hizmat:  '' ,
                kogaz:  '' ,
                
            }
        }
    }

});