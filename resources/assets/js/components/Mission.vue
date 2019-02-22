<template>
    <div>
        <div>
                <label for="">List of missions</label>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Start day</th>
                        <th>End day</th>
                        <th>Complete</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="mission in listOfMissions">
                            <td>
                                <router-link to='/mission/detail/'>
                                    {{mission.name}}
                                </router-link>
                            </td>
                            <td>{{mission.startday}}</td>
                            <td>{{mission.endday}}</td>
                            <td>{{mission.isComplete}}</td>
                            <td>
                                <button type="button" class="btn btn-primary" 
                                        v-on:click="editMission(mission)">
                                        <i class="fa fa-edit"></i>
                                </button>

                            </td>
                            <td>
                                <button class="btn btn-danger" 
                                    v-on:click="deleteMission(mission.id)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
                <form  v-on:submit.prevent="updateMission">
                <div class="modal-body">
                        <div class="form-group">
                                <label for="">Name of mission</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                    v-model="formEdit.name">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Start day</label>
                                        <input type="date" class="form-control" name="startday" 
                                            v-model="formEdit.startday">
                                    </div>
                            
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">End day</label>
                                        <input type="date" class="form-control" name="endday" 
                                            v-model="formEdit.endday">
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
            form:new Form({
                name:'',
                startday:'',
                endday:'',
            }),
            formEdit:new Form({
                id:'',
                name:'',
                startday:'',
                endday:'',
                
            }),
            listOfMissions:[],
            id:3
        }
    },
    
    created(){
        this.getMission();
    },
    methods:{
        getMission(){
            axios.get('/api/mission')
            .then(data=>{
                this.listOfMissions=data.data;
            })
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
                    this.formEdit.patch('api/mission/'+this.formEdit.id)
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
                    }).then( data => { 
                                this.getMission(); 
                                $('#editMission').modal('hide');
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

        editMission(mission){
            $('#editMission').modal('show');
            this.formEdit.fill(mission);
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
        }
    },
}
</script>

