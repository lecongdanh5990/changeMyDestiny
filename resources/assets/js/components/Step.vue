<template>
    <div>
        <div>
                <label for="">List of missions</label>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                        <tr>
                            <td></td>
                            <td>Doe</td>
                            <td>john@example.com</td>
                        </tr>
                    
                    
                    </tbody>
                </table>
            </div>
        <label for="">Add new mission</label>
        <form action="/api/mission" method="post" v-on:submit.prevent="addMission">
            <div class="form-group">
                <input type="text" class="form-control" id="name" name="name" v-model="name">
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Start day</label>
                        <input type="date" class="form-control" name="startday" v-model="startday">
                    </div>
            
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">End day</label>
                        <input type="date" class="form-control" name="endday" v-model="endday">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-default">Add</button>
        </form>
    </div>
</template>
<script>
export default {
    data:function(){
        return{
            name:'',
            startday:'',
            endday:'',
            listOfMissions:[]
        }
    },
    methods:{
        getMission(){
            axios.get('/api/mission')
                .then(({data})=>(this.listOfMissions=data));
        },
        addMission(){
            axios.post('/api/mission',{
                name:this.name,
                startday:this.startday,
                endday:this.endday
                });
            alert("add");
        }
    },
    created(){
        this.getMission();
    }
}
</script>

