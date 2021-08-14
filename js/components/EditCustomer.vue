<template>
<div>
    <div class="container">
        <h2 class="">Edit Customer</h2>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form id="validateForm" @submit.prevent="updateCustomer" novalidate>
                    <div class="alert alert-danger" v-if="errors.length">
                        <ul class="mb-0">
                            <li v-for="(error,index) in errors" :key="index">{{error}}</li>
                        </ul>

                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" v-model="customer.name" class="form-control" placeholder="Enter Name" />
                    </div>
                    <div class="form-group">
                        <label for="nic">NIC</label>
                        <input type="text" id="nic" v-model="customer.nic" class="form-control" placeholder="Enter NIC" />
                    </div>
                    <div class="form-group">
                        <label for="Address">Address</label>
                        <input type="text" id="address" v-model="customer.address" class="form-control" placeholder="Address" />
                    </div>
                    <div class="form-group">
                        <label for="contactno">Contact No</label>
                        <input type="text" id="contactno" v-model="customer.contactno" class="form-control" placeholder="Enter Contact No" />
                        <button type="button" class="btn btn-primary btn-sm" id="add_cus_cont">+</button>
                        <button type="button" class="btn btn-danger btn-sm" id="del_cus_cont">-</button>
                    </div>
                    <button class="btn btn-primary mt-4">Submit</button>
                    
                </form>

            </div>
        </div>
    </div>
</div>
  
</template>

<script>
export default {
    name:'AddCustomer',
    data(){
        return{
            url:document.head.querySelector('meta[name="url"]').content,
            customer:{},
            name:'',
            nic:'',
            address:'',
            contactno:'',
            errors:[]

        }
    },
    methods:{
        loadData(){
            let url = this.url + `/api/get_customer/${this.$route.params.id}`;
            this.axios.get(url).then((response) =>{
                this.customer = response.data;
                console.log(this.customer);

            });
        },
        updateCustomer(){
            this.errors = [];
            if(!this.customer.name){
                this.errors.push('Name is require');

            }
            if(!this.customer.nic){
                this.errors.push('NIC is require');

            }
            if(!this.errors.length){
                let formData = new FormData();
                formData.append('name', this.customer.name);
                formData.append('nic', this.customer.nic);
                formData.append('address', this.customer.address);
                let url = this.url + `/api/update_customer/${this.$route.params.id}`;
                this.axios.post(url,formData).then((response)=>{
                    if(response.status){
                        this.$utils.showSuccess('success', response.message);
                        this.$router.push({
                            name:'/'

                        });

                    }else{
                        this.$utils.showError('Error', response.message);

                    }
                }).catch(error => {
                    //this.errors.push(error.response.data.error);
                });
            }
        }

    },
    created(){
        this.loadData();

    },
    mounted: function(){
        console.log('Edit Customer Component Loaded');
    }
}
</script>
