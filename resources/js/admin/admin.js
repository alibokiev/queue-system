import './bootstrap';

import 'vue-multiselect/dist/vue-multiselect.min.css';
import flatPickr from 'vue-flatpickr-component';
import VueQuillEditor from '@vueup/vue-quill';
import Notifications from '@kyvg/vue3-notification';
import Multiselect from 'vue-multiselect';
import VeeValidate from 'vee-validate';
    import 'flatpickr/dist/flatpickr.css';
import VueCookie from 'vue-cookie';
import { Admin } from 'craftable';
import VModal from 'vue3-simple-dialog'
import Vue from 'vue';
import Example from './example/ExampleComponent.vue';
import Monitor from './monitor/Monitor.vue';
import Badge from './ui/Badge.vue';
import PillBadge from './ui/PillBadge.vue';
import Reception from './reception/Reception';
import TestPrint from './reception/Test.vue';
import Cabinet from './cabinet/Cabinet.vue';

import './app-components/bootstrap';
import './index';

import 'craftable/dist/ui';

import VueHtmlToPaper from 'vue-html-to-paper';

const options = {
    name: '_blank',
    specs: [
        'fullscreen=no',
        'titlebar=no',
        'scrollbars=no'
    ],
    styles: [
        // 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
        // 'https://unpkg.com/kidlat-css/css/kidlat.css'
    ]
}

Vue.use(VueHtmlToPaper, options);

Vue.component('multiselect', Multiselect);
Vue.use(VeeValidate, {strict: true});
Vue.component('datetime', flatPickr);
Vue.use(VModal, { dialog: true, dynamic: true, injectModalsContainer: true });
Vue.use(VueQuillEditor);
Vue.use(Notifications);
Vue.use(VueCookie);

Vue.use('test-print', TestPrint);



// example
Vue.component('example', Example);

// monitor
Vue.component('monitor', Monitor);

//Reception
Vue.component('reception', Reception);

//Cabinet
Vue.component('cabinet', Cabinet);

//ui
Vue.component('badge', Badge);
Vue.component('pill-badge', PillBadge);


new Vue({
    mixins: [Admin],
});
