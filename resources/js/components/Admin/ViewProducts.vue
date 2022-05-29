<template>
	<div>
    <div class="container">
        <div class="row" v-if="$gate.isAdmin()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    	Manage Products
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
													<thead>
														<tr>
															<th scope="col">Title</th>
															<th scope="col">Description</th>
															<th scope="col">Image</th>
															<th scope="col">Color</th>
															<th scope="col">Height</th>
															<th scope="col">Width</th>
															<th scope="col">Length</th>
															<th scope="col">Manage</th>
														</tr>
													</thead>
													<tbody>
														<tr v-for="a in products" :key="a.id">
															<td>{{a.title}}</td>
															<td>{{a.description}}</td>
															<td>
																<img :src="a.image_url" style="height: 60px;width: 100px;"/>
															</td>
															<td>{{a.color}}</td>
															<td>{{a.height}}</td>
															<td>{{a.width}}</td>
															<td>{{a.length}}</td>
															<td>
																<button class="btn btn-secondary" @click="viewPrompt(a.id)"><i class="fa fa-eye"></i> View</button>
																<button class="btn btn-primary" @click="editPrompt(a)"><i class="fa fa-edit"></i> Edit</button>
																<button class="btn btn-danger" @click="deleteProduct(a.id)"><i class="fa fa-trash"></i> Delete</button>
															</td>
														</tr>
													</tbody>
												</table>
                    </div>
                    <div class="card-footer">
                    	<pagination :pagination="pagination"
														 	@prev="getProducts(pagination.prevPageUrl)"
															@next="getProducts(pagination.nextPageUrl)"
														></pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="editModal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
				    <h5 class="modal-title">Edit Product</h5>
				    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
				      <span aria-hidden="true">&times;</span>
				    </button>
				  </div>
				  <div class="modal-body">
				  	<form @submit.prevent="editProduct" @keydown="form.onKeydown($event)">
													<div :class="['form-group', errors.title ? 'has-error' : '']">
														<label>Title:</label>
														<input type="text" class="form-control" placeholder="Enter the title" v-model="form.title">
														<span v-if="errors.title" :class="['badge bg-danger']">Enter a valid title</span>
													</div>
													<div :class="['form-group', errors.description ? 'has-error' : '']">
														<label>Description:</label>
														<input type="text" class="form-control" placeholder="Enter the description" v-model="form.description">
														<span v-if="errors.description" :class="['badge bg-danger']">Enter a valid description</span>
													</div>
													<div :class="['form-group', errors.color ? 'has-error' : '']">
														<label>Color:</label>
														<input type="text" class="form-control" placeholder="Enter the color" v-model="form.color">
														<span v-if="errors.color" :class="['badge bg-danger']">Enter a valid color</span>
													</div>
													<div :class="['form-group', errors.height ? 'has-error' : '']">
														<label>Height:</label>
														<input type="number" class="form-control" placeholder="Enter the height" v-model="form.height" min="1" step="0.01">
														<span v-if="errors.height" :class="['badge bg-danger']">Enter a valid height</span>
													</div>
													<div :class="['form-group', errors.width ? 'has-error' : '']">
														<label>Width:</label>
														<input type="number" class="form-control" placeholder="Enter the width" v-model="form.width" id="rankfld" min="1" step="0.01">
														<span v-if="errors.width" :class="['badge bg-danger']">Enter a valid width</span>
													</div>
													<div :class="['form-group', errors.length ? 'has-error' : '']">
														<label>Length:</label>
														<input type="number" class="form-control" placeholder="Enter the length" v-model="form.length" min="1" step="0.01">
														<span v-if="errors.length" :class="['badge bg-danger']">Enter a valid length</span>
													</div>
													<div :class="['form-group', errors.image ? 'has-error' : '']">
														<label>Image</label>
														<input type="file" label="image" placeholder="Select Image" name="image" class="form-control" id="file" ref="file" @change="addFile">
														<span v-if="errors.image" :class="['badge bg-danger']">Please select a valid image.</span>
													</div>
													<div class="form-group">
														<button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Update</button>
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
        	this.getProducts();
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
         			title: '',
         			description: '',
         			color: '',
         			height: '',
         			width: '',
         			length: '',
         			id: ''
         		}),
         		
         		image: '',
						file: '',
						url: '',
         		
         		products: [],
         		errors: []
        	}
        },
        
        methods: {
        	editPrompt(product){
        		this.form.fill(product);
        		$("#editModal").modal("show");
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
        	
        	getProducts(url = "/api/getProducts"){
        		axios.get(url)
        		.then(response => {
        			this.products = response.data.data.data;
        			this.configPagination(response.data.data);
        		});
        	},
        	
        	addFile(){
    				this.file = this.$refs.file.files[0];
    				this.image = this.file;
    			},
    			
    			editProduct(){
    				var formData = new FormData();
    				formData.set("id", this.form.id);
    				formData.set("title", this.form.title);
    				formData.set("description", this.form.description);
    				formData.set("color", this.form.color);
    				formData.set("height", this.form.height);
    				formData.set("width", this.form.width);
    				formData.set("length", this.form.length);
    				formData.append('image', this.image);
    				axios({
    					method: 'post',
    					url: '/api/editProduct',
    					data: formData,
    				})
        		.then(()=>{
      	     		toast.fire({
      		      	icon: 'success',
                	title: 'Product Updated'
            		});
            		this.errors = [];
            		$("#editModal").modal("hide")
            		this.getProducts();
    				})
    				.catch((error)=>{
            	toast.fire({
      	      	icon: 'error',
              	title: 'Operation Failed'
            	}); 
            	this.errors = error.response.data.errors;  
          	})
    			},
        	
        	deleteProduct(id){
        		axios.post("/api/deleteProduct", {id})
        		.then(() => {
        			toast.fire({
      		      	icon: 'success',
                	title: 'Product Deleted'
            		});
            		this.getProducts();
        		});
        	},
        	
        	viewPrompt(id){
        		this.$router.push('/admin/view-product/'+id);
        	}
        }
    }
</script>
