<template>
    <div>

        <div class="col-md-12">
            <div>
                <h1>{{mission.name}}</h1>
                <button type="button" class="btn btn-primary">Start day <span class="badge">{{mission.startday}}</span></button>
                <button type="button" class="btn btn-primary">End day <span class="badge">{{mission.endday}}</span></button>
                <button type="button" class="btn btn-primary">Real end day <span class="badge">7</span></button>
                <hr>
                <button type="button" class="btn btn-danger">Excellent day <span class="badge">{{mission.excellent}} %</span></button>
                <button type="button" class="btn btn-warning">Good day <span class="badge">{{mission.good}} %</span></button>
                <button type="button" class="btn btn-success">Nomal day <span class="badge">{{mission.normal}} %</span></button>
                <button type="button" class="btn btn-primary">Bad day <span class="badge">{{mission.bad}} %</span></button>
                <button type="button" class="btn btn-default">Terrible day <span class="badge">{{mission.terrible}} %</span></button>

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
                            <td>
                                <button class="btn btn-danger" 
                                    v-on:click="getStatuses(step.id);
                                                nameOfStep=step.name">
                                    Show detail
                                </button>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="col-md-12">
            <h1>Detail {{nameOfStep}} step </h1>
            <div style="border:1px solid black;width:100%;height:500px;overflow:scroll;overflow-y:scroll;overflow-x:hidden;">
                <table class="table table-bordered mission-detail__days-table">
                    <thead class="mission-detail__days-table__thead">
                        <tr >
                            <th class="text-center" scope="col">Day</th>
                            <th class="text-center" scope="col">Content</th>
                            <th class="text-center" scope="col">Number of prodomo</th>
                            <th class="text-center" scope="col">Date</th>
                            <th class="text-center" scope="col">Detail</th>
                            
                        </tr>
                    </thead>
                    <tbody class="mission-detail__days-table__tbody">
                        <tr v-for="(status,index) in statuses"
                            v-bind:style="{ 'background-color': backgroundColors[status.rating-1]}">
                            <th scope="row">{{index+1}}</th>
                            <td>{{status.content}}</td>
                            <td>{{status.tomato}}</td>
                            <td>{{status.formatDate}}</td>
                            <th>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailModal"
                                    v-on:click="getWorks(status.id)">
                                Show detail
                                </button>

                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mission-detail__days">
            

            <!-- Modal -->
            <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                            <th scope="col">Order</th>
                            <th scope="col">Work</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(work,index) in works">
                            <th scope="row">{{index+1}}</th>
                            <td>{{work.name}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>
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
            nameOfStep:'',
            statuses:[],
            works:[],
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
        this.getSteps();
    },
    methods:{
        getMission(){
            axios.get('/api/mission/'+this.missionId)
            .then(data=>{
                this.mission=data.data;
            });
            axios.get('/api/mission/'+this.missionId+'/statuses')
            .then(data=>{
                this.mission['excellent']=data.data.excellent;
                this.mission['good']=data.data.good;
                this.mission['normal']=data.data.normal;
                this.mission['bad']=data.data.bad;
                this.mission['terrible']=data.data.terrible;
                console.log(this.mission);
            })
        },
        getSteps(){
            axios.get('/api/mission/'+this.missionId+'/steps')
            .then(response=>{
                this.listOfSteps=response.data;
            })
        },
        getStatuses(id){
            axios.get('/api/step/'+id+'/statuses')
            .then(response=>{
                this.statuses=response.data;
            })
        },
        getWorks(id){
            axios.get('/api/status/'+id+'/works')
            .then(response=>{
                this.works=response.data;
            })
        }
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


