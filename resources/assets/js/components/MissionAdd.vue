<template>
    <div>
        <div class="mission">
            <h1>Name of mission</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Start day</th>
                        <th>End day</th>
                        <th>Modify</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="isMissionAdded">
                        <td>{{newestMission.name}}</td>
                        <td>{{newestMission.startday}}</td>
                        <td>{{newestMission.endday}}</td>
                        <td>
                            <button type="button" class="btn btn-primary" 
                                    v-on:click="missionModal(newestMission)">
                                Edit
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div v-if="!isMissionAdded">
                <form  v-on:submit.prevent="addMission" >
                <div class="form-group">
                        <label for="">Name of mission</label>
                        <input type="text" class="form-control" id="name" name="name" 
                            v-model="formMission.name">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Start day</label>
                                <input type="date" class="form-control" name="startday" 
                                    v-model="formMission.startday">
                            </div>
                    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">End day</label>
                                <input type="date" class="form-control" name="endday" 
                                    v-bind:min="formMission.startday"
                                    v-model="formMission.endday">
                            </div>
                        </div>
                    </div>
                    
                <button type="submit" class="btn btn-primary text-center"
                        >Add</button>
            </form>
            </div>
        </div>
        <!-- end div mission -->
        <div class="step" v-if="isMissionAdded">
            <h1>Steps of mission</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Name</th>
                        <th>Start day</th>
                        <th>End day</th>
                        <th>Modify</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(step,index) in listOfSteps">
                        <td>{{index+1}}</td>
                        <td>{{step.name}}</td>
                        <td>{{step.startday}}</td>
                        <td>{{step.endday}}</td>
                        <td>
                            <button type="button" class="btn btn-primary" 
                                    v-on:click="stepModal(step)">
                                Edit
                            </button>
                            <button class="btn btn-danger" 
                                v-on:click="deleteStep(step.id)">
                                <i class="fa fa-trash">Delete</i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <form  v-on:submit.prevent="addStep">
                <div class="form-group">
                    <label for="">Name of Step</label>
                    <input type="text" class="form-control" id="name" name="name" 
                        v-model="formStep.name">
                </div>
                        
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Start day</label>
                            <div>
                                <input type="date" class="form-control" name="startday" 
                                v-model="formStep.startday"
                                v-bind:min="newestMission.startday"
                                v-bind:max="formStep.endday||newestMission.endday">
                            </div>
                            
                        </div>
                
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">End day</label>
                            <input type="date" class="form-control" name="endday" 
                                v-model="formStep.endday"
                                v-bind:min="formStep.startday||newestMission.startday"
                                v-bind:max="newestMission.endday">
                        </div>
                    </div>
                </div>
                    <button type="submit" class="btn btn-primary text-center"
                            >Add</button>
                </form>
        </div>
        <!-- end step div -->

        <!-- modal -->
        <div class="modal" tabindex="-1" id="editMission" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new mission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form  v-on:submit.prevent="isMissionModal==true ? updateMission():updateStep()">
                <div class="modal-body">
                        <div class="form-group">
                                <label for="">Name of mission</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                    v-model="form.name">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Start day</label>
                                        <input type="date" class="form-control" name="startday" 
                                            v-model="form.startday">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">End day</label>
                                        <input type="date" class="form-control" name="endday" 
                                            v-model="form.endday">
                                    </div>
                                </div>
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
            isMissionModal:true,
            isMissionAdded:false,
            isShowStep:false,
            form:new Form({
                id:'',
                name:'',
                startday:'',
                endday:'',
                mission_id:''
            }),
            formMission:new Form({
                id:'',
                name:'',
                startday:'',
                endday:'',
            }),
            formStep:new Form({
                id:'',
                name:'',
                startday:'',
                endday:'',
                mission_id:''
            }),
            stepStartDay:null,
            stepEndDay:null,
            newestMission:{},
            listOfSteps:[]
        }
    },
    
    methods:{
        getNewestMission(){
            axios.get('/api/mission/'+this.formMission.id)
            .then(data=>{
                this.newestMission=data.data;
            })
        },
        missionModal(newestMission){
            this.isMissionModal=true;
            $('#editMission').modal('show');
            this.form.fill(newestMission);
        },
        stepModal(step){
            this.isMissionModal=false;
            $('#editMission').modal('show');
            this.form.fill(step);
        },
        addMission(){
            this.formMission.post('/api/mission')
                .then( data => { 
                        this.isMissionAdded=true;
                        this.formMission=data.data;
                        this.getNewestMission();
                        });
        },
        updateMission(){
            const swalWithBootstrapButtons = Swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
            })

            swalWithBootstrapButtons({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, update it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
                }).then((result) => {
                    this.form.patch('/api/mission/'+this.form.id)
                    .then( data => { 
                                this.getNewestMission();
                                $('#editMission').modal('hide');
                        })
                    .then(()=>{
                        if (result.value) {
                        swalWithBootstrapButtons(
                        'Updated!',
                        )}
                    else if (
                // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons(
                            'Cancelled',
                            'Your imaginary file is safe :)',
                            'error'
                            )
                        }
                    });
                 
            }).catch(()=>{
                Swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    footer: '<a href>Why do I have this issue?</a>'
                    })
            })
        },
        deleteMission(id){
            const swalWithBootstrapButtons = Swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
            })

            swalWithBootstrapButtons({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
                }).then((result) => {
                    this.form.delete('api/mission/'+id)
                        .then(()=>{
                            if (result.value) {
                            swalWithBootstrapButtons(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )}
                        else if (
                    // Read more about handling dismissals
                        result.dismiss === Swal.DismissReason.cancel
                            ) {
                                swalWithBootstrapButtons(
                                'Cancelled',
                                'Your imaginary file is safe :)',
                                'error'
                                )
                            }
                        }).then( data => { this.getMission(); });
                 
            }).catch(()=>{
                Swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    footer: '<a href>Why do I have this issue?</a>'
                    })
            })
        },
        getStepOfMission(){
            axios.get('/api/mission/'+this.newestMission.id+'/steps')
            .then(data=>{
                this.listOfSteps=data.data;
            })
        },
        addStep(){
            this.formStep.mission_id=this.newestMission.id;
            this.formStep.post('/api/step')
                .then( data => {
                    this.getStepOfMission();
                });
            this.stepStartDay=this.formStep.startday;
            this.stepEndDay=this.formStep.endday;
            this.formStep.reset();
        },
        updateStep(){
            console.log(this.formMission.id);
            console.log(this.form);
            this.form.mission_id=this.formMission.id;
            this.form.patch('/api/step/'+this.form.id)
                    .then( data => { 
                        this.getStepOfMission();
                        $('#editMission').modal('hide');
                    });
        },
        deleteStep(id){
            this.form.delete('/api/step/'+id)
                    .then( data => { 
                        this.getStepOfMission();
                        $('#editMission').modal('hide');
                });
        },
    },
}
</script>

