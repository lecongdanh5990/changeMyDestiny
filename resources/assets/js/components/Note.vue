<template>
    <div>
        <!-- alert area -->
        <div class="today-component__alert">
            <div class="alert alert-info">
            <strong>Info!</strong> Indicates a neutral informative change or action.
            </div>
            <div class="alert alert-success" role="alert" v-for="mission in listOfMissions">
                <h3>You have <strong>{{mission.dayleft}}</strong> days to complete <strong>{{mission.name}}</strong> mission.</h3>
                <hr>
                <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
            </div>
            <div class="alert alert-warning">
            <strong>Warning!</strong> Indicates a warning that might need attention.
            </div>

            <div class="alert alert-danger">
            <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
            </div>
        </div>
        <!-- end alert area -->
        <div>
            <h1>Rate you in today</h1>
            <form  v-on:submit.prevent="isCreate?addNote():updateNote()">
                <div class="form-group">
                    <div class="note-component__start-rating">
                        <h2>Star Rating</h2>
                        
                        <span 
                            v-for="n in 5"
                            v-on:click="changeSelect(n)"
                            v-bind:class="[n<=indexSelected? activeClass : '', iconClass,customClass]">
                        </span>
                        
                    </div>
                </div>
                    
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea v-model="form.description" class="form-control" id="exampleFormControlTextarea1" rows="3">
                        {{form.description}}
                    </textarea>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary "
                            v-if="isCreate">Add</button>
                    <button type="submit" class="btn btn-primary "
                            v-else>Update</button>
                </div>
            </form>
        </div>

    </div>
</template>
<script>
export default {
    data:function(){
        return{
            iconClass:'fa fa-star',
            customClass:'note-component__start-rating',
            activeClass:'checked',
            isSelected:false,
            indexSelected:'',
            isCreate:true,
            form:new Form({
                id:'',
                description:'',
                rating:''
            }),
            formEdit:new Form({
                name:'',
                id:'',
                description:'',
                iscomplete:0,
                step_id:''

            }),
            listOfMissions:[],
            listOfNotes:[],
        }
    },
    
    created(){
        this.getMissionOfToday();
        this.getNoteOfToday();
    },
    methods:{
        getMissionOfToday(){
            axios.get('/api/mission/today')
            .then(data=>{
                this.listOfMissions=data.data;
            })
        },
        getNoteOfToday(){
            axios.get('/api/note/today')
            .then(response=>{
                if(response.data.length!=0) this.isCreate=false;
                for (var i = 0; i < response.data.length; i++) { 
                    this.form.fill(response.data[i]); 
                    }
                this.indexSelected=this.form.rating;
            })
        },
        changeSelect(n){
            this.isSelected=!this.isSelected;
            this.indexSelected=n;
        },
        addNote(){
            this.form.rating=this.indexSelected;
            this.form.post('/api/note')
                .then(response=>{
                    alert("Added");
                    this.getNoteOfToday();
                })
        },
        updateNote(){
            
            this.form.rating=this.indexSelected;
            this.form.patch('/api/note/'+this.form.id)
                .then(response=>{
                    alert("Updated");
                })
        }
    }
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
    .checked{
        color: rgb(238, 184, 5);
        font-size:2rem;
    }
    .note-component__start-rating{
        cursor: pointer;
        font-size:2rem;
    }

</style>
