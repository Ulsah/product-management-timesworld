<template>
	<div>
    <div class="container">
        <div class="row" v-if="$gate.isAdmin()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    	Manage Countries
                    	<button class="btn btn-primary float-right" @click="addPrompt"><i class="fa fa-plus"></i> Add Country</button>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
													<thead>
														<tr>
															<th scope="col">Country</th>
															<th scope="col">Rank</th>
															<th scope="col">Continent</th>
															<th scope="col">Flag</th>
															<th scope="col">Delete</th>
														</tr>
													</thead>
													<tbody>
														<tr v-for="a in countries" :key="a.id">
															<td>{{a.country}}</td>
															<td>{{a.rank}}</td>
															<td>{{a.continent}}</td>
															<td>
																<img :src="a.flag" style="height: 60px;width: 100px;"/>
															</td>
															<td>
																<button class="btn btn-danger" @click="deleteCountry(a.id)"><i class="fa fa-trash"></i> Delete</button>
															</td>
														</tr>
													</tbody>
												</table>
                    </div>
                    <div class="card-footer">
                    	<pagination :pagination="pagination"
														 	@prev="getCountries(pagination.prevPageUrl)"
															@next="getCountries(pagination.nextPageUrl)"
														></pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="addModal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
				    <h5 class="modal-title">Add Country</h5>
				    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
				      <span aria-hidden="true">&times;</span>
				    </button>
				  </div>
				  <div class="modal-body">
				  	<!-- Only doctor and timings can be changed -->
				  	<form @submit.prevent="addCountry" @keydown="form.onKeydown($event)">
							<div :class="['form-group', errors.name ? 'has-error' : '']">
								<label>Country:</label>
								<input type="text" class="form-control" placeholder="Enter the country" v-model="form.country" id="nmfld">
								<span v-if="errors.country" :class="['badge bg-danger']">{{errors.country[0]}}</span>
							</div>
							<div :class="['form-group', errors.rank ? 'has-error' : '']">
								<label>Rank:</label>
								<input type="number" class="form-control" placeholder="Enter the rank" v-model="form.rank" id="rankfld" min="1">
								<span v-if="errors.rank" :class="['badge bg-danger']">{{errors.rank[0]}}</span>
							</div>
							<div :class="['form-group', errors.continent ? 'has-error' : '']">
								<label>Continent:</label>
								<select class="form-control" placeholder="Enter the continent" v-model="form.continent" id="cfld">
									<option value="Africa">Africa</option>
									<option value="Asia">Asia</option>
									<option value="Oceania">Oceania</option>
									<option value="Europe">Europe</option>
									<option value="North America">North America</option>
									<option value="South America">South America</option>
									<option value="Antarctica">Antarctica</option>
								</select>
								<span v-if="errors.continent" :class="['badge bg-danger']">Please choose a valid continent.</span>
							</div>
							<div :class="['form-group', errors.image ? 'has-error' : '']">
								<label for="nf-image">Image</label>
								<input type="file" label="image" placeholder="Select Image" name="image" class="form-control" id="file" ref="file" @change="addFile">
								<span v-if="errors.image" :class="['badge bg-danger']">Please select a valid image.</span>
							</div>
							<div class="form-group">
								<button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Add Country</button>
							</div>
						</form>
				  </div>
				  <div class="modal-footer">
				    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				  </div>
				</div>
			</div>
		</div>
		<div v-if="!$gate.isAdmin()">
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
        
        components: {pagination:Pagination},
        
        created(){
        	this.getCountries();
        },
        
        data(){
        	return{
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
         			country: '',
         			id: '',
         			rank: '',
         			continent: ''
         		}),
         		
         		image: '',
						file: '',
						url: '',
         		
         		countries: [],
         		errors: []
        	}
        },
        
        methods: {
        	addPrompt(){
        		this.form.reset();
        		$("#addModal").modal("show");
        	},
        	
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
        	
        	getCountries(url = "/api/getCountries"){
        		axios.get(url)
        		.then(response => {
        			this.countries = response.data.data.data;
        			this.configPagination(response.data.data);
        		});
        	},
        	
        	addFile(){
    				this.file = this.$refs.file.files[0];
    				this.image = this.file;
    			},
    			
    			addCountry(){
    				var formData = new FormData();
    				formData.set("country", this.form.country);
    				formData.set("rank", this.form.rank);
    				formData.set("continent", this.form.continent)
    				formData.append('image', this.image);
    				axios({
    					method: 'post',
    					url: '/api/addCountry',
    					data: formData,
    				})
        		.then(()=>{
      	     		toast.fire({
      		      	icon: 'success',
                	title: 'Country Added'
            		});
            		this.errors = [];
            		$("#addModal").modal("hide")
            		this.getCountries();
    				})
    				.catch((error)=>{
            	toast.fire({
      	      	icon: 'error',
              	title: 'Operation Failed'
            	}); 
            	this.errors = error.response.data.errors;  
          	})
    			},
        	
        	deleteCountry(id){
        		axios.post("/api/deleteCountry", {id})
        		.then(() => {
        			toast.fire({
      		      	icon: 'success',
                	title: 'Country Deleted'
            		});
            		this.getCountries();
        		})
        	}
        }
    }
</script>
