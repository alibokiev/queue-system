<template>
    <dl class="dl-horizontal">
        <dt>Завершено:</dt>
        <dd>
            <div class="progress progress-striped active m-b-sm">
                <div :style="'width: '+percent+'%;'" class="progress-bar"></div>
            </div>
            <small>
                Контракт завершен на <strong>{{percent}}%</strong>.
                До перехода залогов в собственность ломбарда осталось <strong>{{todayEnd}}</strong> дн.
            </small>
        </dd>
    </dl>
</template>

<script>
    export default {
        props: ['start', 'end'],
        data() {
            return {
                total: 0,
                todayEnd: 0,
                percent: 0,
                left:0
            }
        },
        mounted() {
            const start = moment(this.start);
            const end = moment(this.end);
            const today = moment();

            this.total = start.diff(end, 'days');

            this.todayEnd = end.diff(today, 'days') + 1;

            const startToday = start.diff(today, 'days');

            this.percent =  100 / this.total * startToday;
        }
    }
</script>
