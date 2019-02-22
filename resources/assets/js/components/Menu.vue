<template>
    <div class="panel panel-default">
        <div class="panel-heading">Menu</div>
        <div class="panel-body">
                <router-link to="/dashboard">Home</router-link>
        </div>
        <div class="panel-body">
            <router-link to="/today">Today's Work</router-link>
        </div>
        <div class="panel-body">
            <router-link to="/note">Write note for today</router-link>
        </div>
        <div class="panel-body">
            <router-link to="/mission">Show all Mission</router-link>
        </div>
        <div class="panel-body">
            <router-link to="/mission/add">Add new Mission</router-link>
        </div>
        <div class="panel-body">
            <router-link to="/step">Show Step</router-link>
        </div>
        <hr>
            <h3 class="text-center">Today Prodomo: {{prodomo.quantity}}</h3>
        <hr>
        <div class="panel-body text-center">
            <div v-if="isStart">
                <button class="btn btn-primary" v-on:click="startCount();isStart=!isStart">Start forcus</button>
            </div>
            <div v-else>
                <button class="btn btn-danger" v-on:click="stopCount();isStart=!isStart">Stop</button>
            </div>
            
            <div class="menu-timer text-center">
                <div id="menu-timer__mins">00</div> : <div id="menu-timer__secs">00</div>
            </div>
            
        </div>
    </div>
</template>
<script>
export default {
    created(){
        this.getProOfToday(); 
    },
    data:function(){
        return{
            c:0,
            time:'',
            isRun:true,
            isStart:true,
            numOfSec:10,
            quantity:0,
            prodomo:{},
            form:new Form({
                id:'',
                quantity:'',
            }),
        }
    },
    methods:{
        startCount() {
            if(this.isRun){
                this.numOfSec=this.numOfSec-1;
                var mins=Math.floor(this.numOfSec/60);
                var secs=this.numOfSec-(mins*60);
                document.getElementById("menu-timer__mins").innerHTML = mins;
                document.getElementById("menu-timer__secs").innerHTML = secs;
                this.time = setTimeout(this.startCount, 1000);
                if(this.numOfSec<=0) {
                    this.isStart=!this.isStart;
                    clearTimeout(this.time);
                    if(this.prodomo===undefined){
                        this.createPro(1);
                        this.numOfSec=10;
                    }
                    else{
                        this.updatePro(1);
                        this.numOfSec=10;
                    }
                }
            }
            else{
                clearTimeout(this.time);
                this.numOfSec=10;
                document.getElementById("menu-timer__mins").innerHTML = 0;
                document.getElementById("menu-timer__secs").innerHTML = 0;
                this.isRun=true;
            }
        },
        stopCount(){
            this.isRun=false;
            if(this.prodomo===undefined){
                alert("create prodomo");
                this.form.quantity=Number((this.numOfSec/10).toFixed(1));
                this.createPro(this.form.quantity);
            }
            else{
                alert("updated prodomo");
                var quantity=Number((this.numOfSec/10).toFixed(1));
                this.updatePro(quantity);
            }
        },
        getProOfToday(){
            var dateNow=moment().format('YYYY-MM-DD');
            axios.get('/api/prodomo/getproofthisday/'+dateNow)
                .then(response=>{
                    this.prodomo=response.data[0];
                    if(this.prodomo!==undefined){
                        this.form.fill(response.data[0]);
                        console.log(this.form);
                    }
                    else{
                        
                    }
                    console.log(this.prodomo);
                    
            })
        },
        createPro(quantity){
            this.form.quantity=quantity;
            console.log(this.form);
            this.form.post('/api/prodomo')
                .then( response => {
                    this.form.fill(response.data);
                    console.log(this.form);
                    this.prodomo=response.data;
                });
        },
        updatePro(quantity){
            this.form.quantity+=quantity;
            this.form.put('/api/prodomo/'+this.form.id)
                .then( response => {
                    this.prodomo=response.data;
                });
        }
        
    }
// function stopCount() {
//   clearTimeout(t);
//   timer_is_on = 0;
// }
}
</script>

<style>
    .menu-timer{
        background-color: rgb(168, 175, 73);
        margin: 1rem;
        color: white;
        font-size: 3rem;
        border-radius: 10px;
        width: 100%;
        margin-left: 0px;
        margin-right: 0px;
        padding-top: 10px;
        /* border-bottom-width: 10px; */
        padding-bottom: 10px;
    }
    #menu-timer__mins{
        height: 90%;
        width: 40%;
        background-color: blue;
        display: inline-block;
        
        border-radius: 15px;
        border: 2px solid white;
    }
    #menu-timer__secs{
        height: 90%;
        width: 40%;
        background-color: green;
        display: inline-block;
        border-radius: 15px;
        border: 2px solid white;
    }
</style>
