<template>
	<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    	Manage Users
                    	<button class="btn btn-primary float-right" @click="addPrompt"><i class="fa fa-plus"></i> Add User</button>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
													<thead>
														<tr>
															<th scope="col">Name</th>
															<th scope="col">Email</th>
															<th scope="col">Type</th>
															<th scope="col">Change</th>
														</tr>
													</thead>
													<tbody>
														<tr v-for="user in users" :key="user.id">
															<td>{{user.name}}</td>
															<td>{{user.email}}</td>
															<td>{{user.type}}</td>
															<td><button class="btn btn-danger" @click="changePrompt(user)"><i class="fa fa-cog"></i> Change</button></td>
														</tr>
													</tbody>
													<tfoot>
														<pagination :pagination="pagination"
														 	@prev="getUsers(pagination.prevPageUrl)"
															@next="getUsers(pagination.nextPageUrl)"
														></pagination>
													</tfoot>
												</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="typeModal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
				    <h5 class="modal-title">Edit User</h5>
				    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
				      <span aria-hidden="true">&times;</span>
				    </button>
				  </div>
				  <div class="modal-body">
				  	<form @submit.prevent="updateUser" @keydown="form.onKeydown($event)">
							<div :class="['form-group', errors.name ? 'has-error' : '']">
								<label>Name:</label>
								<input type="text" class="form-control" placeholder="Enter the name" v-model="form.name" required>
								<span v-if="errors.name" :class="['badge bg-danger']">Please enter a valid character.</span>
							</div>
							<div :class="['form-group', errors.email ? 'has-error' : '']">
								<label>Email:</label>
								<input type="email" class="form-control" placeholder="Enter the email" v-model="form.email">
								<span v-if="errors.email" :class="['badge bg-danger']">Please enter a valid email.</span>
							</div>
							<div :class="['form-group', errors.type ? 'has-error' : '']">
								<label>Type</label>
								<select class="form-control" v-model="form.type">
									<option value="Admin">Admin</option>
									<option value="Doctor">Doctor</option>
									<option value="User">Patient</option>
								</select>
								<span v-if="errors.type" :class="['badge bg-danger']">Please choose and option.</span>
							</div>
							<div class="form-group">
								<button class="btn btn-primary" type="submit">Change</button>
							</div>
						</form>
				  </div>
				  <div class="modal-footer">
				    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				  </div>
				</div>
			</div>
		</div>
		<div class="modal" tabindex="-1" role="dialog" id="addModal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
				    <h5 class="modal-title">Edit User</h5>
				    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
				      <span aria-hidden="true">&times;</span>
				    </button>
				  </div>
				  <div class="modal-body">
				  	<form @submit.prevent="addUser" @keydown="form.onKeydown($event)">
							<div :class="['form-group', errors.name ? 'has-error' : '']">
								<label>Name:</label>
								<input type="text" class="form-control" placeholder="Enter the name" v-model="userform.name" required>
								<span v-if="errors.name" :class="['badge bg-danger']">Please enter a valid character.</span>
							</div>
							<div :class="['form-group', errors.email ? 'has-error' : '']">
								<label>Email:</label>
								<input type="email" class="form-control" placeholder="Enter the email" v-model="userform.email">
								<span v-if="errors.email" :class="['badge bg-danger']">Please enter a valid email.</span>
							</div>
							<div :class="['form-group', errors.type ? 'has-error' : '']">
								<label>Type</label>
								<select class="form-control" v-model="userform.type">
									<option value="Admin">Admin</option>
									<option value="Doctor">Doctor</option>
									<option value="User">Patient</option>
								</select>
								<span v-if="errors.type" :class="['badge bg-danger']">Please choose and option.</span>
							</div>
							<div class="form-group">
								<button class="btn btn-primary" type="submit">Change</button>
							</div>
						</form>
				  </div>
				  <div class="modal-footer">
				    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				  </div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>		
    import Pagination from '../pagination.vue';
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        
        components: {pagination:Pagination},
        
        created(){
        	this.getUsers();
        },
        
        data(){
       		return {
       			users: [],
       			pagination: {
          		lastPage: '',
           		currentPage: '',
            	total: '',
            	lastPageUrl: '',
            	nextPageUrl: '',
            	prevPageUrl: '',
            	from: '',
            	to: '',
         		},
         		form: new Form({
         			id: '',
         			name: '',
         			email: '',
         			type: ''
         		}),
         		userform: new Form({
         			name: '',
         			email: '',
         			type: ''
         		}),
         		errors: []
       		} 
        },
        
        methods: {
        	configPagination(data){
		    		this.pagination.lastPage=data.lastPage;
		       	this.pagination.currentPage=data.current_page;
		  	  	this.pagination.total=data.total;
		      	this.pagination.lastPageUrl=data.last_page_url;
		     		this.pagination.nextPageUrl=data.next_page_url;
		     		this.pagination.prevPageUrl=data.prev_page_url;
		   		 	this.pagination.from=data.from;
		      	this.pagination.to=data.to;
		  		},
    		
        	getUsers(url = '/getUsers'){
        		axios.post(url)
        		.then(response => {
        			this.users = response.data.data.data;
        			this.configPagination(response.data.data);
        		})
        	},
        	
        	changePrompt(user){
        		this.form.fill(user);
        		$("#typeModal").modal('show');
        	},
        	
        	addPrompt(){
        		this.form.reset;
        		$("#addModal").modal('show');
        	},
        	
        	updateUser(){
        		this.form.post('/updateUser')
		      		.then(response => {
		      			if(response.data == 200){
		      				alert('Updated');
		      				this.form.reset();
		      				$("#typeModal").modal('hide');
		      				this.getUsers();
		      			}
		      		})
		      		.catch((errors) => {
		      			this.errors = errors.response.data.errors;
		      		})
        	},
        	
        	addUser(){
        		this.userform.post('/addUser')
		      	.then(response => {
		      		if(response.data == 200){
		      			alert('Added');
		      			this.userform.reset();
		      			$("#addModal").modal('hide');
		      			this.getUsers();
		      		}
		      	})
		      	.catch((errors) => {
		      		this.errors = errors.response.data.errors;
		      	})
        	}
        }
    }
</script>
