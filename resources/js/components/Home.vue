<template>
<div>
    <nav class="panel column is-offset-2 is-8">
        <p class="panel-heading">
            Vue.js PhoneBook Application
            <button class="button is-link is-outlined" @click="openAdd">
                Add New
            </button>
            <span class="is-pulled-right" v-if="loading">
                <i class="fas fa-spinner fa-spin fa-2x fa-fw"></i>
            </span>
        </p>
        <div class="panel-block">
            <p class="control has-icons-left">
            <input class="input is-small" type="text" placeholder="search" v-model="searchQuery">
            <span class="icon is-small is-left">
            <i class="fa fa-search"></i>
            </span>
            </p>
        </div>

        <a class="panel-block " v-for="item,key in temp">
            <span class="column is-9">
                {{item.name}}
            </span>
            <span class="panel-icon column is-1">
                <span @click="del(key,item.id)">
                    <i class="has-text-danger fa fa-trash" aria-hidden="true"></i>
                </span>
            </span>
            <span class="panel-icon column is-1">
                <span @click="openUpdate(key)">
                    <i class="has-text-info fa fa-edit" aria-hidden="true"></i>
                </span>
            </span>
            <span class="panel-icon column is-1">
                <span @click="openShow(key)">
                    <i class="has-text-primary fa fa-eye" aria-hidden="true"></i>
                </span>
            </span>
        </a>

    </nav>

    <Add :openModal="addActive" @closeRequest="close"></Add>
    <Show :openModal="showActive" @closeRequest="close"></Show>
    <Update :openModal="updateActive" @closeRequest="close"></Update>
</div>
</template>

<script>

Vue.component('Add', require('./Add.vue').default);
Vue.component('Show', require('./Show.vue').default);
Vue.component('Update', require('./Update.vue').default);

export default {
    data(){
        return {
            addActive : '',
            showActive : '',
            updateActive : '',
            loading:false,
            searchQuery:'',
            errors:{},
            items:{},
            temp:''
        }
    },
    watch:{
        searchQuery(){
            if(this.searchQuery.length > 0 ){
                this.temp = this.items.filter((item) => {
                    return Object.keys(item).some((key)=>{
                        let result = String(item[key])
                        return result.toLowerCase().indexOf(this.searchQuery.toLowerCase())>-1
                    })
                });

            } else {
                this.temp = this.items
            }
        }
    },
    created(){
        axios.post('/getData').
        then((response)=> this.items = this.temp = response.data)
          .catch((error) => this.errors=error.response.data.errors)
    },
    methods:{
        openAdd(){
            this.addActive = 'is-active';
        },
        openShow(key){
            this.$children[1].list = this.temp[key]
            this.showActive = 'is-active';
        },
        openUpdate(key){
            this.$children[2].list = this.temp[key]
            this.updateActive = 'is-active';
        },
        close(){
            this.addActive = this.showActive = this.updateActive = '';
        },
        del(key,id){
            if(confirm("Are You Sure?")){
                this.loading = !this.loading;
                axios.delete(`/phoneBook/${id}`).
                then((response)=> {
                        this.items.splice(key,1);
                        this.loading=!this.loading;
                    })
                  .catch((error) => this.errors=error.response.data.errors)
            }
        }
    },
};
</script>
