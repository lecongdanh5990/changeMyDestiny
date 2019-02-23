<template>
    <div>
        <!-- alert area -->
        <div class="today-component__alert">
            <div v-if="listOfMissions.length">
                <div v-for="mission in listOfMissions" v-bind:class="[mission.missiondayleft<30 ? alertDangerClass : alertInfoClass, alertClass]" role="alert" >
                    <h3>You have <strong>{{mission.missiondayleft}}</strong> days to complete <strong>{{mission.name}}</strong> mission.</h3>
                    <hr>
                    <p class="mb-0">You have <strong>{{mission.stepdayleft}}</strong> days to 
                        complete step <strong>{{mission.stepname}}</strong> of this mission  
                    </p>
                </div>
                
            </div>
        </div>
        <!-- end alert area -->
        <div>
            <label for="">List of works</label>
            <table class="table table-bordered" id="today-worktable">
                <thead >
                <tr>
                    <th>Priotiry</th>
                    <th>Name</th>
                    <th>Mission</th>
                    <th>Description</th>
                    <th>Modify</th>
                    <th>Completed</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="(work) in listOfWorks"
                        v-bind:style="{ 'background-color': backgroundColors[work.priority-1]}">
                        <td>{{work.priority}}</td>
                        <td>{{work.name}}</td>
                        <td>{{work.missionname}}</td>
                        <td>{{work.description}}</td>
                        <td>
                            <!-- <button type="button" class="btn btn-primary" 
                                    v-on:click="editWork(work)">
                                Edit 
                            </button> -->
                            <button class="btn btn-danger" 
                                v-on:click="deleteWork(work.id)">
                                <i class="fa fa-trash">Delete</i>
                            </button>
                        </td>
                        <td class="text-center">
                            <div class="form-check today-component__checkbox text-center">
                                <input class="form-check-input today-component__checkbox" 
                                    v-on:change="completeWork(work)"
                                    type="checkbox" value="" id="defaultCheck1">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <label for="">List of works were completed</label>
            <table class="table table-bordered" id="today-completeworktable">
                <thead class="thead-dark">
                <tr>
                    <th>Priotiry</th>
                    <th>Name</th>
                    <th>Mission</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="work in listOfCompletedWorks"
                         v-bind:style="{ 'background-color': backgroundColors[work.priority-1]}">
                        <td>{{work.priority}}</td>
                        <td>{{work.name}}</td>
                        <td>{{work.missionname}}</td>
                        <td>{{work.description}}</td>
                    </tr>
                
                
                </tbody>
            </table>
            <h1>What will you do today?</h1>
            <form v-on:submit.prevent="addWork">
                <div class="form-group">
                    <label for="">Add new work for today</label>
                    <input type="text" class="form-control"
                        v-model="formCreate.name">
                </div>
                    
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Choose mission</label>
                            <select v-model="formCreate.mission_id"  class="form-control form-control-lg">
                                <option value="2" v-bind:selected="true">Choose mission</option>
                                <option v-for="mission in listOfMissions" v-bind:value="mission.id">
                                    {{mission.name}}
                                </option>
                            </select>
                        </div>
                
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Choose priority</label>
                            <select name="priority" v-model="formCreate.priority" class="form-control form-control-lg">
                                <option value="0" selected>Choose Priority</option>
                                <option value="1">Important, not emergency</option>
                                <option value="2">Important and emergency</option>
                                <option value="3">Not important but emergency</option>
                                <option value="4">Not important, not emergency</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea v-model="formCreate.description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary "
                            >Add</button>
                </div>
            </form>
        </div>

        

        <!-- modal -->
        <div class="modal" tabindex="-1" id="editWork" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new mission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form  v-on:submit.prevent="updateWork">
                <div class="modal-body">
                        <div class="form-group">
                                <label for="">Name of mission</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                    v-model="formEdit.name">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Choose mission</label>
                                        <select v-model="selectedMission" v-on:change="" name="" id="" class="form-control form-control-lg">
                                            <option v-for="mission in listOfMissions" v-bind:value="mission.id">
                                                {{mission.name}}
                                            </option>
                                        </select>
                                    </div>
                            
                                </div>
                                <div class="col-md-6">
                                    <!-- <div class="form-group">
                                        <label for="">Choose step</label>
                                        <select name="" id="" v-model="formEdit.step_id" disabled class="form-control form-control-lg">
                                            <option v-for="step in todaySteps" v-bind:value="step.id">{{step.name}}</option>
                                        </select>
                                    </div> -->
                                </div>
                            </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea v-model="formEdit.description" class="form-control" 
                                    id="exampleFormControlTextarea1" rows="3">
                                    {{formEdit.description}}
                            </textarea>
                        </div>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data:function(){
        return{
            alertDangerClass:'alert-danger',
            alertInfoClass:'alert-info',
            alertClass:'alert',
            backgroundColors:[
                '#FF0000',
                '#FF7F00',
                '#FFFF00',
                '#00FF00',
            ],
            formCreate:new Form({
                name:'',
                priority:'',
                id:'',
                description:'',
                iscomplete:'',
                mission_id:'',
            }),
            formEdit:new Form({
                name:'',
                id:'',
                description:'',
                selectedMission:'',
                priority:'',
                iscomplete:0,
                step_id:''
            }),
            selectedMission:1,
            listOfMissions:[],
            listOfWorks:[],
            listOfCompletedWorks:[],
        }
    },
    
    created(){
        this.getMissionOfToday();
        this.getWorksOfToday();
        this.getCompletedWorksOfToday();
        console.log(this.listOfWorks);
    },
    methods:{
        show(){
            alert(this.formCreate.name);
        },
        getMissionOfToday(){
            axios.get('/api/mission/today')
            .then(data=>{
                this.listOfMissions=data.data;
                console.log(this.listOfMissions.length);
            })
        },
        // getStepsOfToday(){
        //     axios.get('/api/mission/today')
        //     .then(data=>{
        //         var today = new Date();
        //         var dd = today.getDate();
        //         var mm = today.getMonth() + 1; //January is 0!
        //         var yyyy = today.getFullYear();
        //         if (dd < 10) {
        //         dd = '0' + dd;
        //         }
        //         if (mm < 10) {
        //         mm = '0' + mm;
        //         }
        //         today = mm + '-' + dd + '-' + yyyy;
                
        //         for (var j = 0; j < data.data.length; j++){
        //                 var now=moment(today);
        //                 var endday=moment(data.data[j].endday);
        //                 data.data[j]['dayleft']=endday.diff(now,'day');
        //             }
        //         this.listOfWorks=data.data;
        //     })
        // },
        // getTodayStepOfMission(){
        //     axios.get('/api/mission/'+this.selectedMission+'/steps/today')
        //     .then(response=>{
        //         this.todaySteps=response.data;
        //         this.formEdit.step_id=this.todaySteps[0].id;
        //     })
        // },
        
        getWorksOfToday(){
            axios.get('/api/work/today')
            .then(response=>{
                this.listOfWorks=response.data;
            })
            
        },
        getCompletedWorksOfToday(){
            axios.get('/api/work/completed')
            .then(response=>{
                this.listOfCompletedWorks=response.data;
            })
        },
        addWork(){
            console.log(this.formCreate);
            this.formCreate.post('api/work')
                .then( data => {
                    this.getWorksOfToday();
                    this.formCreate.reset();
                });
        },
        completeWork(work){
            this.formCreate.fill(work);
            this.formCreate.iscomplete=1;
            this.formCreate.patch('/api/work/'+work.id)
                .then(response=>{
                    this.getWorksOfToday();
                    this.getCompletedWorksOfToday();
                });
        },
        editWork(work){
            $('#editWork').modal('show');
            this.formEdit.fill(work);
        },
        updateWork(){
            this.formEdit.patch('/api/work/'+this.formEdit.id)
            .then( response => { 
                this.getWorksOfToday();
                $('#editWork').modal('hide');
            })      
        },
        deleteWork(id){
            Swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    this.formCreate.delete('api/work/'+id)
                        .then( data => { 
                            this.getWorksOfToday(); 
                    });
                })
            
        }
    },
}
</script>

<style>
    .today-component__alert{
        font-size: 1.5rem;
    }
    .today-component__checkbox{
        width: 2rem;
        height: 2rem;
    }
    #today-worktable tr td,
    #today-completeworktable tr td{
        color: white;
        text-align: center;
        font-weight: bold;
    }
    #today-worktable thead,
    #today-completeworktable thead{
        background-color:lavenderblush;
    }
</style>
