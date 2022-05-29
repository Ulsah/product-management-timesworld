<template>
	<div>
    <div class="container">
        <div class="row" v-if="$gate.isAdmin()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                        	<div class="col-md-6">
                        		<img class="img-fluid" :src="product.image_url" alt="Product image"/>
                        	</div>
                        	<div class="col-md-6">
                        		<div class="col-md-12">
                        			<h2>{{product.title}}</h2>
                        		</div>
                        		<div class="col-md-12">
                        			<h5>{{product.description}}</h5>
                        		</div>
                        		<div class="col-md-12">
                        			<h5><b>Dimensions(length x widht x height): {{product.length}} X {{product.width}} X {{product.height}}</b></h5>
                        		</div>
                        	</div>
                        </div>
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
        
        created(){
        	this.getProduct();
        },
        
        data(){
        	return{
        		product: {}
        	}
        },
        
        methods: {
        	getProduct(){
        		axios.get("/api/product/"+this.$route.params.id)
        		.then(response => {
        			this.product = response.data;
        		});
        	}
        }
    }
</script>
