/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
	window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': token.content}});
} else {
	console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

Vue.mixin({
    methods: {
        __relativeTime(date) {
            if (date == null) return 'Не указано';
            // 5 минут назад, 3 дня назад
            return moment(date).startOf('minute').fromNow();
        },
        __ordinaryTime(date) {
            if (date == null) return 'Не указано';
            // 5 минут назад, 3 дня назад
            return moment(date).format('LT');
        },
    }
});

