<template>
    <div>

        <div class="col-md-6">
            <div>
                <h1>Missions</h1>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Start day</th>
                        <th>End day</th>
                        <th>Complete</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr >
                            <td>{{mission.name}}</td>
                            <td>{{mission.startday}}</td>
                            <td>{{mission.endday}}</td>
                            <td>{{mission.isComplete}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <h1>Steps</h1>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Order</th>
                        <th>Name</th>
                        <th>Start day</th>
                        <th>End day</th>
                        <th>Complete</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(step,index) in listOfSteps">
                            <td>{{index}}</td>
                            <td>{{step.name}}</td>
                            <td>{{step.startday}}</td>
                            <td>{{step.endday}}</td>
                            <td>{{step.isComplete}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="col-md-6">
            <h1>Detail</h1>
            <div style="border:1px solid black;width:100%;height:500px;overflow:scroll;overflow-y:scroll;overflow-x:hidden;">
                <table class="table table-bordered mission-detail__days-table">
                    <thead class="mission-detail__days-table__thead">
                        <tr >
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Description</th>
                        <th class="text-center" scope="col">Date</th>
                        
                        </tr>
                    </thead>
                    <tbody class="mission-detail__days-table__tbody">
                        <tr v-for="(day,index) in listOfDays"
                            v-bind:style="{ 'background-color': backgroundColors[day.rating-1]}">
                            <th scope="row">{{index+1}}</th>
                            <td>{{day.description}}</td>
                            <td>{{day.convertDate}}</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mission-detail__days">
            
        </div>
    </div>
</template>
<script>
export default {
    data:function(){
        return{
            mission:{},
            missionId:this.$route.params.id,
            listOfSteps:[],
            listOfDays:[],
            backgroundColors:[
                '#222226',
                '#70777a',
                '#38b20c',
                '#f9ab26',
                '#f9dd27',
            ]
        }
    },
    
    created(){
        this.getMission();
        this.getStepsOfThisMission();
        this.getProcess();
    },
    methods:{
        getMission(){
            axios.get('/api/mission/3')
            .then(data=>{
                this.mission=data.data;
            })
        },
        
        getStepsOfThisMission(){
            axios.get('/api/mission/3/steps')
            .then(response=>{
                this.listOfSteps=response.data;
            })
        },
        getWorksOfThisMission(){
            axios.get('/api/mission/3/steps')
            .then(response=>{
                this.listOfSteps=response.data;
            })
        },
        getProcess(){
            axios.get('/api/note/noteofmission/')
            .then(response=>{
                this.listOfDays=response.data;
            })
        },
    },
}
</script>
<style>
    .mission-detail__days{
        padding-left: 15px;
        padding-right: 15px;
    }
    .mission-detail__days table{
        background-color: white;
    }
    .mission-detail__days-table__thead{
        background-color: black;
        color: white;
        font-weight: bold;
        text-align: center;
    }
    .mission-detail__days-table__thead{
        background-color: #4095ef;
        color: white;
        font-weight: bold;
    }
    .mission-detail__days-table__tbody{
        color: white;
        text-align: center;
    }
    .mission-detail__five-start{
        background-color: yellowgreen;
    }
    .mission-detail__four-start{
        background-color: rgb(205, 156, 50);
    }
</style>


