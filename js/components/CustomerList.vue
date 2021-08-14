<template>
  <div class="container">
    <h2>Customer List</h2>
    <div>
    <input type="text" class="form-control" placeholder="What are you looking for??" 
    v-on:keyup="searchCus" v-model="keyword" /> 
    <!-- {{ results }} -->
    <div class="card-footer" v-if="results.length">
        <ul class="list-group">
            <li class="list-group-item" v-for="result in results" :key="result.id">
                <a style="color:#000" :href="'api/get_customer/'+result.id">{{result.name}}</a> <br>
                <span class="badge badge-success">{{result.nic}}</span>
            </li>

        </ul>

    </div>
</div>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Nic</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="customer in customers" :key="customer.id">
                <td scope='row'>{{customer.id}}</td>
                <td>{{customer.name}}</td>
                <td>{{customer.nic}}</td>
                <td>
                    <button class="btn btn-danger btn-sm btn-custom" @click="deleteCustomer(customer.id)">Delete</button>
                    <router-link :to="{ name:'get_customer', params:{id:customer.id}}" class="btn btn-primary btn-sm">Edit</router-link>

                    </td>
            </tr>
            
        </tbody>
    </table>
</div>
</template>

<script>
export default {
    name:'CustomerList',
    created(){
        this.loadData();

    },
    methods:{
        loadData(){
            let url = this.url + '/api/getCustomers';
            this.axios.get(url).then(response =>{
                this.customers = response.data
                console.log(this.customers);
            })

        },
        deleteCustomer(id){
            let url = this.url + `/api/delete_customer/${id}`;
            this.axios.delete(url).then(response =>{
                if(response.status){
                    this.loadData();
                    this.$utils.showSuccess('success', response.message);
                }else{
                        this.$utils.showError('Error', response.message);
                    }
            })
        },
        searchCus(){
            this.results=[];
            let url = this.url + '/api/customer/search';
            if(this.keyword.length > 1){
                axios.get(url,this.results)
                .then(response=>{
                    this.results=response.data
                });

            }

        },
    },
    mounted(){
        console.log('customer List Component');

    },
    data(){
        return{
            url:document.head.querySelector('meta[name="url"]').content,
            customers:[],
            keyword: '',
            results:[],
        }
    }

}
</script>
<style scoped>
/* .btn-custom{
    background-color: ;
} */
</style>