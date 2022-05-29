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
                        <form @submit.prevent="addProduct" @keydown="form.onKeydown($event)">
													<div :class="['form-group', errors.title ? 'has-error' : '']">
														<label>Title:</label>
														<input type="text" class="form-control" placeholder="Enter the title" v-model="form.title">
														<span v-if="errors.title" :class="['badge bg-danger']">Enter a valid title</span>
													</div>
													<div :class="['form-group', errors.description ? 'has-error' : '']">
														<label>Description:</label>
														<textarea type="text" class="form-control" placeholder="Enter the description" v-model="form.description"></textarea>
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
														<button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Add</button>
													</div>
												</form>
                    </div>
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
		export default {
        mounted() {
            console.log('Component mounted.')
        },
        
        data(){
        	return{
        		form: new Form({
         			title: '',
         			description: '',
         			color: '',
         			height: '',
         			width: '',
         			length: ''
         		}),
         		
         		image: '',
						file: '',
						url: '',
         		errors: []
        	}
        },
        
        methods: {
        	addFile(){
    				this.file = this.$refs.file.files[0];
    				this.image = this.file;
    			},
    			
    			addProduct(){
    				var formData = new FormData();
    				formData.set("title", this.form.title);
    				formData.set("description", this.form.description);
    				formData.set("color", this.form.color);
    				formData.set("height", this.form.height);
    				formData.set("width", this.form.width);
    				formData.set("length", this.form.length);
    				formData.append('image', this.image);
    				axios({
    					method: 'post',
    					url: '/api/addProduct',
    					data: formData,
    				})
        		.then(response => {
      	     		toast.fire({
      		      	icon: 'success',
                	title: 'Product Added'
            		});
            		this.errors = [];
            		$("#addModal").modal("hide");
            		this.$router.push('/admin/view-product/'+response.data.id);
    				})
    				.catch((error)=>{
            	toast.fire({
      	      	icon: 'error',
              	title: 'Operation Failed'
            	}); 
            	this.errors = error.response.data.errors;  
          	})
    			}
        }
    }
</script>
