<template>
	<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    	View Country
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                        		<v-select :options="countries" label="country" :reduce="countries => countries.id" :value="countries => countries=>countries.id" v-model="cid" @input="getCountry"></v-select>
                        </div>
                        <div class="col-sm-12" v-if="country != ''">
                        		<div class="row">
                        				<div class="col-sm-3">
                        						<img :src="country.flag" style="height: 120px;width: 200px;">
                        				</div>
                        				<div class="col-sm-6">
                        						<h2>{{country.country}}</h2>
                        						<h4>Rank: <b>{{country.rank}}</b></h4>
                        						<h4>{{country.continent}}</h4>
                        				</div>
                        		</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	</div>
</template>

<script>		
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        
        created(){
        	this.getCountries();
        },
        
        data(){
       		return {
       			countries: [],
       			country: '',
       			cid: ''
       		} 
        },
        
        methods: {
        	getCountries(){
        		axios.get("/api/getAllCountries")
        		.then(response => {
        			this.countries = response.data;
        		})
        	},
        	
        	getCountry(){
        		axios.get("/api/country/"+this.cid)
        		.then(response => {
        			this.country = response.data;
        		})
        	}
        }
    }
</script>
