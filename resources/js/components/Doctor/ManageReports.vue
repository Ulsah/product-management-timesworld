<template>
	<div>
    <div class="container">
        <div class="row" v-if="$gate.isDoctor()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    	Manage Reports
                    	<button class="btn btn-primary float-right" @click="changePrompt"><i class="fa fa-plus"></i> Add Report</button>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
													<thead>
														<tr>
															<th scope="col">Reports</th>
															<th scope="col">Delete</th>
														</tr>
													</thead>
													<tbody>
														<tr v-for="a in reports" :key="a.id">
															<td><button class="btn btn-primary" @click="openFile(a)">View {{ a.name }} {{ a.location }}</button></td>
															<td>
																<button class="btn btn-danger" @click="deletePDF(a)"><i class="fa fa-trash"></i> Delete</button>
															</td>
														</tr>
													</tbody>
												</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="addModal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
				    <h5 class="modal-title">Edit Appointment</h5>
				    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
				      <span aria-hidden="true">&times;</span>
				    </button>
				  </div>
				  <div class="modal-body">
				  	<div :class="['form-group', errors.name ? 'has-error' : '']">
							<label>Name:</label>
							<input type="text" class="form-control" placeholder="Enter the name" v-model="name">
							<span v-if="errors.name" :class="['badge bg-danger']">Please enter a valid character.</span>
						</div>
						<div :class="['form-group', errors.file ? 'has-error' : '']">
							<label>File:</label>
							<input type="file" class="form-control" id="file" ref="file" @change="addFile">
							<span v-if="errors.file" :class="['badge bg-danger']">Please choose a valid character.</span>
						</div>
						<button class="btn btn-primary" @click="upload">Add</button>
				  </div>
				  <div class="modal-footer">
				    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				  </div>
				</div>
			</div>
		</div>
		<div v-if="!$gate.isDoctor()">
			<denied></denied>
		</div>
	</div>
</template>

<script>
		import Pagination from '../pagination.vue';
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        
        created(){
        	this.getReports();
        },
        
        data(){
        	return{
        		reports: [],
        		errors: [],
        		name: '',
        		file: '',
        		pdf: ''
        	}
        },
        
        methods: {
        	changePrompt(){
        		$("#addModal").modal("show");
        	},
        	
        	getReports(){
        		axios.post("/getReports", {id: this.$route.params.id})
        		.then(response => {
        			this.reports = response.data;
        		});
        	},
        	
        	addFile(){
    				this.file = this.$refs.file.files[0];
    			},
    			
    			upload(){
    				var formData = new FormData();
    				formData.set("id", this.$route.params.id);
    				formData.set("name", this.name)
    				formData.append('file', this.file);
    				axios({
    					method: 'post',
    					url: '/addReport',
    					data: formData,
    				})
        		.then(()=>{
      	     		toast.fire({
      		      	icon: 'success',
                	title: 'Report Added'
            		});
            		this.errors = [];
            		this.getReports();
    				})
    				.catch((error)=>{
            	toast.fire({
      	      	icon: 'error',
              	title: 'Operation Failed'
            	}); 
            	this.errors = error.response.data.errors;  
          	})
    			},
    			
    			openFile(file){
    				window.open(file.location, '_blank');
    			},
    			
    			deletePDF(a){
    				axios.post("/deleteReport", {id: a.id})
        		.then(response => {
        			if(response.data == 200){
        				toast.fire({
        					icon: 'success',
        					title: 'Removed'
        				});
        				this.getReports();
        			}
        		})
    			}
        }
    }
</script>
