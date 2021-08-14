<template>
<div>
    <div class="container">
        <h2 class="">Add Customer</h2>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form id="validateForm" @submit.prevent="saveCustomer" novalidate>
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
                    <div class="form-group" v-for="(contact_nos, k) in customer_contacts" :key="k">
                        <label for="contactno">Contact No</label>
                        <input type="text" id="contactno" v-model="contact_nos.contact_no" class="form-control" placeholder="Enter Contact No" />
                        <div class="mt-3" role="group" style="float:right;">
                          <button type="button" class="btn btn-primary btn-sm mr-3" id="add_cus_cont" @click="addNewRow(k, contact_nos)"><i class="fas fa-plus-circle"></i> +</button>
                          <button type="button" class="btn btn-danger btn-sm ml-5"  id="del_cus_cont" @click="deleteRow(k, contact_nos)"><i class="far fa-trash-alt"></i> -</button>
                        </div>
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
            errors:[],
            customer_contacts: [{
                contact_no: '',
            }],

        }
    },
    methods:{
        saveCustomer(){
            this.errors = [];
            if(!this.customer.name){
                this.errors.push('Name is require');

            }
            if(!this.customer.nic){
                this.errors.push('NIC is require');

            }
            if(!this.customer.address){
                this.errors.push('Address is require');

            }
            if(!this.errors.length){
                let formData = new FormData();
                formData.append('name', this.customer.name);
                formData.append('nic', this.customer.nic);
                formData.append('address', this.customer.address);
                let url = this.url + '/api/save_customer';
                this.axios.post(url,formData).then((response)=>{
                    if(response.status){
                        //alert('ssss')
                        document.getElementById("name").value = '';
                        document.getElementById("nic").value = '';
                        document.getElementById("address").value = '';

                        this.$utils.showSuccess('success', response.message);

                    }else{
                        this.$utils.showError('Error', response.message);

                    }
                }).catch(error => {
                    //this.errors.push(error.response.data.error);
                });
            }
        },
        addNewRow(index, contact_nos) {
            this.customer_contacts.push({
                contact_no: ''
            });
        },
        deleteRow(index, contact_nos) {
            var idx = this.customer_contacts.indexOf(contact_nos);
            console.log(idx, index);
            if (idx >=1) {
                this.customer_contacts.splice(idx, 1);
            }
        }
    },
    mounted: function(){
        console.log('Add Customer Component Loaded');
    }
}
</script>
