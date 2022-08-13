<template>
<div>
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <full-calendar :events="fcEvents" locale="en"></full-calendar>
            </div>
        </div>
    </div>
</div>
</template>
<script>
var demoEvents = [
{
    title: 'Interviews with Candidates',
    start: '2022-08-01',
    end: '2022-08-03',
},
{
    title     :  'event1',
    start     : '2022-08-03',
    
  },
  {
    title     : 'event2',
    start     : '2022-09-03',
    end       : '2022-08-08',
  },

]
export default {
    data() {
        return {
            fcEvents: demoEvents
        }
    },
    components: {
        'full-calendar': require('vue-fullcalendar')
    }
}

</script>
